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
use App\Http\Services\ExportService;

class ArticleController extends Controller
{
    use ApiResponse;

     // ============================================= //
     // ================== VIEW ==================== //
    // ============================================ //

    public function getAutoDetectionList(Request $request) {
        $articleModel = new Article();
        $params = $request->all();
        $params['detection_type'] = Article::DETECTION_TYPE_BOT;
        $articles = $articleModel->getList($params);

        if(isset($params['export']) && $params['export'] == true) {
            return  $this->exportPendingArticle('auto_detection_violation', $articles);
        }
        return view('pages/auto-detection/index', compact('articles'));
    }

    public function getManualDetectionList(Request $request) {
        $articleModel = new Article();
        $params = $request->all();
        $params['detection_type'] = Article::DETECTION_TYPE_MANUAL;
        $articles = $articleModel->getList($params);

        if(isset($params['export']) && $params['export'] === true) {
            return  $this->exportPendingArticle('label-detection-violation',$articles);
        }
        return view('pages/manual-detection/index', compact('articles'));
    }

    public function getViolationList(Request $request) {
        $articleModel = new Article();
        $params = $request->all();
        $params['status'] = Article::STATUS_VIOLATION;
        $articles = $articleModel->getList($params);
        if(isset($params['export']) && $params['export'] == true) {
            return  $this->exportViolationArticles('violation_article', $articles);
        }
        return view('pages/violation/index', compact('articles'));
    }

    public function getNoneViolationList(Request $request) {
        $articleModel = new Article();
        $params = $request->all();
        $params['status'] = Article::STATUS_NONE_VIOLATION;
        $articles = $articleModel->getList($params);
        if(isset($params['export']) && $params['export'] == true) {
            return  $this->exportNoneViolationArticles('non_violation_article', $articles);
        }
        return view('pages/none-violation/index', compact('articles'));
    }

      // ============================================ //
     // =============== EXPORT EXCEL =============== //
    // ============================================ //

    public function exportPendingArticles($fileName, $articles) {
        $titles = [
            '#', 'Company', 'Country', 'Brand', 'Caption', 'Image', 'Published Date', 'Crawl Date', 'Link',
            'VIVID - Status', 'VIVID - Code Article', 'VIVID - Violation Type',
        ];
        $isSupervisor = UserRoleService::isSupervisor();
        $isOperator = UserRoleService::isOperator();

        if($isSupervisor || $isOperator) {
            $titles = array_merge(['SUPERVISOR - Status', 'SUPERVISOR - Code Article', 'SUPERVISOR - Violation Type'], $titles);
        }
        if($isOperator) {
            $titles = array_merge(['OPERATOR - Status', 'OPERATOR - Code Article', 'OPERATOR - Violation Type'], $titles);
        }

        $exportData = [];
        foreach ($articles as $key => $article) {
            $botStatus = $article->detection_result['status'] ?? count($article->detection_result['violation_code']) > 0 ? Article::STATUS_VIOLATION : Article::STATUS_NONE_VIOLATION ;

            $row = [
                $key+1,
                $article->company,
                $article->country,
                $article->brand,
                $article->caption,
                $article->image,
                date('Y-m-d', $article->published_date),
                date('Y-m-d', $article->detection_result['crawl_date']),
                $article->link,
                $botStatus,
                convertArrayToString($article->detection_result['violation_code'], 'name'),
                convertArrayToString($article->detection_result['violation_types'], 'name')
            ];

            if($isSupervisor || $isOperator) {
                $violationStatus = $article->supervisor_review['status'];
                $violationCodeNames = '';
                $violationTypeNames = '';
                if($violationStatus === Article::STATUS_VIOLATION) {
                    $violationCodeNames = convertArrayToString($article->supervisor_review['violation_code'], 'name');
                    $violationTypeNames = convertArrayToString($article->supervisor_review['violation_types'], 'name');
                }
                $row[] = $violationStatus;
                $row[] = $violationCodeNames;
                $row[] = $violationTypeNames;
            }
            if($isOperator) {
                $violationStatus = $article->operator_review['status'];
                $violationCodeNames = '';
                $violationTypeNames = '';
                if($violationStatus === Article::STATUS_VIOLATION) {
                    $violationCodeNames = convertArrayToString($article->operator_review['violation_code'], 'name');
                    $violationTypeNames = convertArrayToString($article->operator_review['violation_types'], 'name');
                }
                $row[] = $violationStatus;
                $row[] = $violationCodeNames;
                $row[] = $violationTypeNames;
            }

            $exportData[] = $row;
        }

        $sheets = [
            ['name' => $fileName, 'data' => $exportData ]
        ];
        return ExportService::exportExcelFile($titles, $sheets, $fileName);
    }

    public function exportViolationArticles($fileName, $articles) {
        $titles = [
            '#', 'Company', 'Country', 'Brand', 'Caption', 'Image', 'Published Date', 'Crawl Date',
            'Penalty issued','Link', 'Legal documents', 'Code Article', 'Violation Type'
        ];
        $exportData = [];
        foreach ($articles as $key => $article) {
            $penaltyIssued = 'TODO'; // Last upload documents
            $legalDocuments = 'TODO'; // From documents collection _id = article_id
            $row = [
                $key+1,
                $article->company,
                $article->country,
                $article->brand,
                $article->caption,
                $article->image,
                date('Y-m-d', $article->published_date),
                date('Y-m-d', $article->detection_result['date']),
                $penaltyIssued,
                $article->link,
                $legalDocuments,
                convertArrayToString($article->operator_review['violation_code'], 'name'),
                convertArrayToString($article->operator_review['violation_types'], 'name')
            ];

            $exportData[] = $row;
        }
        $sheets = [
            ['name' => $fileName, 'data' => $exportData ]
        ];
        return ExportService::exportExcelFile($titles, $sheets, $fileName);
    }

    public function exportNoneViolationArticles($fileName, $articles) {
        $titles = [
            '#', 'Company', 'Country', 'Brand', 'Caption', 'Image', 'Published Date', 'Checking Date', 'Link'
        ];
        $exportData = [];
        foreach ($articles as $key => $article) {

            $row = [
                $key+1,
                $article->company,
                $article->country,
                $article->brand,
                $article->caption,
                $article->image,
                date('Y-m-d', $article->published_date),
                date('Y-m-d', $article->detection_result['crawl_date']), //Checking Date
                $article->link,
            ];

            $exportData[] = $row;
        }
        $sheets = [
            ['name' => $fileName, 'data' => $exportData ]
        ];
        return ExportService::exportExcelFile($titles, $sheets, $fileName);
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
                    $reviewViolationCode = $article->operator_review['detection_result'];
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
