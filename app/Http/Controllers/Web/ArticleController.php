<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Article\CreateRequest;
use App\Models\Mongo\Article;
use App\Models\Mongo\CompanyBrand;
use App\Models\Mongo\Country;
use App\Models\Mongo\ViolationCode;
use App\Models\Mongo\ViolationType;
use App\Models\Mongo\ArticleLegalDocument;

use Illuminate\Support\Facades\Validator;
use App\Http\Traits\ApiResponse;

use App\Http\Services\UserRoleService;

class ArticleController extends Controller
{
    use ApiResponse;

    public function getAutoDetectionList(Request $request) {
        $articleModel = new Article();
        $params = $request->all();
        $params['detection_type'] = Article::DETECTION_TYPE_BOT;
        $articles = $articleModel->getList($params);
        return view('pages/auto-detection/index', compact('articles'));
    }

    public function getManualDetectionList(Request $request) {
        $articleModel = new Article();
        $params = $request->all();
        $params['detection_type'] = Article::DETECTION_TYPE_MANUAL;
        $articles = $articleModel->getList($params);
        return view('pages/manual-detection/index', compact('articles'));
    }

    public function getViolationList(Request $request) {
        $articleModel = new Article();
        $params = $request->all();
        $params['status'] = Article::STATUS_VIOLATION;
        $articles = $articleModel->getList($params);
        return view('pages/violation/index', compact('articles'));
    }

    public function getNoneViolationList(Request $request) {
        $articleModel = new Article();
        $params = $request->all();
        $params['status'] = Article::STATUS_NONE_VIOLATION;
        $articles = $articleModel->getList($params);
        return view('pages/none-violation/index', compact('articles'));
    }

    public function switchArticleProgressStatus(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'progress_status' => 'required|in:'.Article::PROGRESS_NOT_STARTED.','.Article::PROGRESS_PROCESSING.','.Article::PROGRESS_COMPLETED
        ]);

        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }
        $inputs = $validator->validated();
        $article = Article::find($id);
        if($article && $article->progress_status !== Article::PROGRESS_COMPLETED) {
            if(count($article->documents) === 0) {
                return $this->responseFail([], "Please upload legal documents for this article");
            }
            $article->progress_status = $inputs['progress_status'];
            $article->update();
            return $this->responseSuccess([], "Switch progression status successfully");
        }
        return $this->responseFail([], "Switch progression status failed");
    }

    public function moderateArticle(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'is_agreed' => 'required|in:1,0',
            'status' => 'required|in:'.Article::ACTION_CHECK_STATUS.','.Article::ACTION_CHECK_CODE,
            'action' => 'required|in:'.Article::AGREE_VIOLATION.','.Article::DISAGREE_VIOLATION,
        ]);

        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }
        $inputs = $validator->validated();
        $article = Article::find($id);
        if($article && $article->status === Article::STATUS_PENDING) {
            $requestStatus = $inputs['status'];
            $requestAction = $inputs['action'];
            $isAgreedWithBot = (int)$inputs['is_agreed'];
            $botViolationStatus = count($article->bot_detecting['violation_code']) > 0 ? Article::STATUS_VIOLATION : Article::STATUS_NONE_VIOLATION;

            // Check action is being performed by other supervisor / operator
            if($requestAction === Article::ACTION_CHECK_STATUS) {
                $reviewStatus = UserRoleService::isSupervisor() ? $article->supervisor_review['status'] : $article->operator_review['status'];
                if(($reviewStatus !== Article::STATUS_PENDING)) {
                    return $this->responseFail([], "This article is being reviewed by other ".auth()->user()->role);
                }
            }else {
                $validationCode = UserRoleService::isSupervisor() ? $article->supervisor_review['violation_code'] : $article->operator_review['violation_code'];
                if(count($validationCode) > 0) {
                    return $this->responseFail([], "This article is being reviewed by other ".auth()->user()->role);
                }
            }
            $isDoneReview = false;
            if($requestAction === Article::ACTION_CHECK_STATUS) {
                if($botViolationStatus === Article::STATUS_NONE_VIOLATION) {
                    if($isAgreedWithBot) {
                        $reviewViolationCode = [];
                        $reviewStatus = $botViolationStatus;
                    }else {
                        // supervisor / operator needs to submit new violation code
                        if(!isset($inputs['violation_code']) || count($inputs['violation_code']) === 0) {
                            return $this->responseFail([], "Please add violation code for this article");
                        }
                        $reviewViolationCode = $inputs['violation_code'];
                        $reviewStatus = self::STATUS_VIOLATION;
                    }
                    $isDoneReview = true;
                }else {
                    if($isAgreedWithBot) {
                        $reviewStatus = $botViolationStatus;
                         // Need extra action [Article::ACTION_CHECK_CODE] to select violation code
                        $reviewViolationCode = [];
                    }else {
                        $reviewStatus = Article::STATUS_NONE_VIOLATION;
                        $reviewViolationCode = [];
                        $isDoneReview = true;
                    }
                }
            }else {
                $reviewStatus = UserRoleService::isSupervisor() ? $article->supervisor_review['status'] : $article->operator_review['status'];
                // Check if article has been reviewed from action [Article::ACTION_CHECK_STATUS]
                if($reviewStatus === Article::STATUS_PENDING) {
                    return $this->responseFail([], "Please approve or reject VIVID violation status first");
                }
                if($isAgreedWithBot) {
                    $reviewViolationCode = $article->operator_review['bot_detecting'];
                }else {
                    // supervisor / operator needs to submit new violation code
                    if(!isset($inputs['violation_code']) || count($inputs['violation_code']) === 0) {
                        return $this->responseFail([], "Please add violation code for this article");
                    }
                    $reviewViolationCode = $inputs['violation_code'];
                }
            }

            $reviewData = [
                'violation_code' => $reviewViolationCode,
                'violation_types' => [],
                'status' => $reviewStatus,
                'review_date' => time()
            ];

            if(UserRoleService::isSupervisor()) {
                $article->supervisor_review = $reviewData;
            }else if(UserRoleService::isOperator()) {
                $article->operator_review = $reviewData;
                if($isDoneReview) {
                    $article->status = $reviewStatus;
                }
            }
            $article->update();
            return $this->responseSuccess([], "Action successfully");
        }
        return $this->responseFail([], "Article not found or not valid");
    }

    public function resetArticleToOriginState(Request $request, $id) {
        $article = Article::find($id);
        if($article && $article->progress_status !== Article::PROGRESS_COMPLETED) {
            
            $article->status = Article::STATUS_PENDING;
            $article->progress_status = Article::STATUS_PENDING;
            $article->operator_review = Article::DEFAULT_REVIEW_STATES;
            $article->supervisor_review = Article::DEFAULT_REVIEW_STATES;
            $article->update();

            $article->documents()->destroy(); //Remove all related documents
            return $this->responseSuccess([], "Switch progression status successfully");
        }
        return $this->responseFail([], "Article not found, reset article failed");
    }
}
