<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Article\CreateRequest;
use App\Http\Requests\Article\ManualLabelRequest;

use App\Models\Mongo\Article;
use App\Models\Mongo\ArticleLegalDocument;
use App\Models\Mongo\ViolationCode;

use App\Http\Services\UserRoleService;
use App\Http\Services\ArticleExportService;
use App\Http\Services\DocumentService;
use App\Http\Services\CapchaService;
use App\Http\Services\ArticleService;
use App\Http\Services\AIService;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public $articleExportService;

    function __construct() {
        $this->articleExportService = new ArticleExportService();
    }

     // ============================================= //
     // ================== VIEW ==================== //
    // ============================================ //

    public function getAutoDetectionList(Request $request) {
        $articleModel = new Article();
        $params = $request->all();
        $params['detection_type'] = Article::DETECTION_TYPE_BOT;
        $params['status'] = Article::STATUS_PENDING;

        if(isset($params['export']) && $params['export'] == true && Auth::check()) {
            $articles = $articleModel->getList($params, $usePagination = false);
            $articleExportService = new ArticleExportService();
            return  $this->articleExportService->exportPendingArticles('auto_detection_violation', $articles);
        }

        $articles = $articleModel->getList($params);
        $violationCode = ViolationCode::all();

        return view('pages/auto-detection/index', compact('articles', 'violationCode'));
    }

    public function getManualDetectionList(Request $request) {
        $articleModel = new Article();
        $params = $request->all();
        $params['detection_type'] = Article::DETECTION_TYPE_MANUAL;
        $params['status'] = Article::STATUS_PENDING;

        if(isset($params['export']) && $params['export'] == true && Auth::check()) {
            $articles = $articleModel->getList($params, $usePagination = false);

            return  $this->articleExportService->exportPendingArticles('label-detection-violation',$articles);
        }
        $articles = $articleModel->getList($params);
        $violationCode = ViolationCode::all();

        return view('pages/manual-detection/index', compact('articles', 'violationCode'));
    }

    public function getViolationList(Request $request) {
        $articleModel = new Article();
        $params = $request->all();
        $params['status'] = Article::STATUS_VIOLATION;

        if(isset($params['export']) && $params['export'] == true && Auth::check()) {
            $articles = $articleModel->getList($params, $usePagination = false);

            return  $this->articleExportService->exportViolationArticles('violation_article', $articles);
        }

        $articles = $articleModel->getList($params);
        return view('pages/violation/index', compact('articles'));
    }

    public function getNoneViolationList(Request $request) {
        $articleModel = new Article();
        $params = $request->all();
        $params['status'] = Article::STATUS_NONE_VIOLATION;

        if(isset($params['export']) && $params['export'] == true && Auth::check()) {
            $articles = $articleModel->getList($params, $usePagination = false);

            return  $this->articleExportService->exportNoneViolationArticles('non_violation_article', $articles);
        }

        $articles = $articleModel->getList($params);

        return view('pages/none-violation/index', compact('articles'));
    }

    public function getOne($id) {
        $article = Article::findOrFail($id);
        $violationCode = ViolationCode::all();
        return view('pages/components/article-detail', compact('article','violationCode'));
    }

    public function getOneViolation($id){
        $article = Article::findOrFail($id);
        $violationCode = ViolationCode::all();
        return view('pages/components/violation-detail', compact('article','violationCode'));
    }

    public function getOneNonViolation($id){
        $article = Article::findOrFail($id);
        $violationCode = ViolationCode::all();
        return view('pages/components/non-violation-detail', compact('article','violationCode'));
    }

      // ============================================ //
     // ================== AJAX ==================== //
    // =========================================== //

    public function switchArticleProgressStatus(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'progress_status' => 'required|in:'.Article::PROGRESS_NOT_STARTED.','.Article::PROGRESS_PROCESSING.','.Article::PROGRESS_COMPLETED
        ]);
        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }

        $inputs = $validator->validated();
        $article = Article::find($id);
        if($article && $article->progress_status === Article::PROGRESS_COMPLETED) {
            if(isset($$article->documents) && count($article->documents) === 0) {
                return $this->responseFail([], "Please upload legal documents for this article");
            }
        }

        $article->progress_status = $inputs['progress_status'];
        $result = $article->update();
        if($result){
            return $this->responseSuccess([], "Successful state transition");
        }
        return $this->responseFail([], "Change status progress failed");
    }

    public function moderateArticle(Request $request, $id) {
        $inputs =$request->all();
        $validator = Validator::make($request->all(), [
            'is_agreed' => 'required|in:'.Article::AGREE_VIOLATION.','.Article::DISAGREE_VIOLATION,
            'action' => 'required|in:'.Article::ACTION_CHECK_STATUS.','.Article::ACTION_CHECK_CODE,
            'status' => 'required|in:'.Article::STATUS_NONE_VIOLATION.','.Article::STATUS_VIOLATION,
        ]);

        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }
        $article = Article::find($id);
        if($article && $article->status === Article::STATUS_PENDING) {
            $requestStatus = $inputs['status'];
            $requestAction = $inputs['action'];
            $isAgreedWithBot = $inputs['is_agreed'] === Article::AGREE_VIOLATION;
            $botViolationStatus = count($article->detection_result['violation_code']) > 0 ? Article::STATUS_VIOLATION : Article::STATUS_NONE_VIOLATION;

            // Check action is being performed by other supervisor / operator
            if($requestAction === Article::ACTION_CHECK_STATUS) {
                $reviewStatus = UserRoleService::isSupervisor() ? $article->supervisor_review['status'] : $article->operator_review['status'];
                if(($reviewStatus !== Article::STATUS_PENDING)) {
                    return $this->responseFail([], "This article is being reviewed by other ".auth()->user()->role);
                }
            }else {
                $validationCode = UserRoleService::isSupervisor() ? $article->supervisor_review['violation_code'] : $article->operator_review['violation_code'];
                if(count($validationCode) > 0) {
                    return $this->responseFail($validationCode, "This article is being reviewed by other ".auth()->user()->role);
                }
            }
            $isDoneReview = false;
            $reviewViolationCode = [];
            $reviewViolationTypes = [];
            if($requestAction === Article::ACTION_CHECK_STATUS) {
                if($botViolationStatus === Article::STATUS_NONE_VIOLATION) {
                    if($isAgreedWithBot) {
                        $reviewViolationCode = [];
                        $reviewStatus = $botViolationStatus;
                        $isDoneReview = true;
                    }else {
                        $reviewViolationCode = [];
                        $reviewViolationTypes = [];
                        $reviewStatus = Article::STATUS_VIOLATION;
                    }
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
                    $reviewViolationCode = $article->detection_result['violation_code'];
                    $reviewViolationTypes = $article->detection_result['violation_types'];
                    $reviewStatus = Article::STATUS_VIOLATION;
                }else {
                    // supervisor / operator needs to submit new violation code
                    if(!isset($inputs['violation_code']) || count(json_decode($inputs['violation_code'])) === 0) {
                        return $this->responseFail([], "Please add violation code for this article");
                    }
                    $data = $this->getViolationCodeAndTypeData(json_decode($inputs['violation_code']));
                    if(count($data) === 0) {
                        return $this->responseFail([], "Invalid violation code");
                    }
                    $reviewViolationCode = $data['violation_code'];
                    $reviewViolationTypes = $data['violation_types'];
                    $reviewStatus = Article::STATUS_VIOLATION;
                }

                if(UserRoleService::isOperator()) {
                    $isDoneReview = true;
                }
            }

            $reviewData = [
                'violation_code'  => $reviewViolationCode,
                'violation_types' => $reviewViolationTypes,
                'status'          => $reviewStatus,
                'review_date'     => time()
            ];
            $reviewMessage = "Review Completed.";
            if(UserRoleService::isSupervisor()) {
                $article->supervisor_review = $reviewData;
            }else if(UserRoleService::isOperator()) {
                $article->operator_review = $reviewData;
                if($isDoneReview) {
                    $article->status = $reviewStatus;
                    $reviewMessage = "Review completed.";
                }
            }
            $article->update();

            return $this->responseSuccess($reviewData, $reviewMessage);
        }

        return $this->responseFail([], "Article not found or invalid");
    }

    private function getViolationCodeAndTypeData($violationCodeArr) {
        $articleService = new ArticleService();
        return $articleService->getViolationCodeAndTypeData($violationCodeArr);
    }

    public function resetArticleToOriginState(Request $request, $id) {
        $article = Article::find($id);
        if($article) {
            $status = $article->status;
            $article->status = Article::STATUS_PENDING;
            $article->progress_status = Article::STATUS_PENDING;
            $article->operator_review = Article::DEFAULT_REVIEW_STATES;
            $article->supervisor_review = Article::DEFAULT_REVIEW_STATES;
            $article->update();

            if($status === Article::STATUS_VIOLATION) {
                $documents = ArticleLegalDocument::where('article_id', $id)->get();
                $documentService = new DocumentService();
                foreach ($documents as $key => $document) {
                    $documentService->delete($document);
                }
            }
            return $this->responseSuccess([], "Reset article successfully");
        }
        return $this->responseFail([], "Article not found, reset article failed");
    }

    public function documents(Request $request, $id) {
        $article = Article::find($id);
        if($article) {
            $documents = ArticleLegalDocument::where('article_id', $id)->get();
            $articleDocs = [];
            foreach ($documents as $document) {
                $articleDocs[] = [
                    'id'   => $document->_id,
                    'name' => $document->name,
                    'url'  => $document->url,
                ];
            }
            return $this->responseSuccess($articleDocs, "Get list documents successfully");
        }
        return $this->responseFail([], "Article not found");
    }

    public function detectArticleManually(ManualLabelRequest $request) {
        $validated = $request->validated();

        $capchaService = new CapchaService;
        $isVerified = $capchaService->verify($validated['capcha_token']);
        if(!$isVerified) {
            return $this->responseFail([], "Invalid capcha");
        }

        $body = [];
        $response = [];
        $aiService = new AIService();
        if($validated['request_type'] === LABEL_TYPE_IMAGE) {
            if($request->hasFile('image')) {

                $uploadFile = $request->file('image');
                $filename = $uploadFile->getClientOriginalName();
                $filedata = $uploadFile->getPathName();

                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $type = finfo_file($finfo, $filedata);
                $imgdata = array('file' => $filedata);
                $body['image'] =  new \CurlFile($filedata, $type, $filename);
            }
            if(isset($validated['caption'])) {
                $body['text'] = $validated['caption'];
            }
            $response = $aiService->detectViolationFromTextAndImage($body);
        }else if($validated['request_type'] === LABEL_TYPE_URL) {
            $body['url'] = $validated['url'];
            $response = $aiService->detectViolationFromUrl(json_encode($body));
        }
        
        if(!isset($response['status']) || $response['status'] === false) {
            return $this->responseFail([], "Unable to detect. Please try again");
        }
        
        $response = array_merge($response, $body);
        $articleService = new ArticleService();
        $data = $articleService->createArticleFromAIDetection($response);

        if(!$data['success']) {
    
            return $this->responseFail([], $data['error']);
        }

        return $this->responseSuccess($data['data'], "Submit violation successfully");

    }
}
