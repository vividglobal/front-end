<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Article\CreateRequest;
use App\Models\Mongo\Article;
use App\Models\Mongo\ArticleLegalDocument;
use App\Models\Mongo\ViolationCode;
use Illuminate\Support\Facades\Validator;

use App\Http\Services\UserRoleService;
use App\Http\Services\ExportService;
use App\Http\Services\DocumentService;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{

     // ============================================= //
     // ================== VIEW ==================== //
    // ============================================ //

    public function getAutoDetectionList(Request $request) {
        $articleModel = new Article();
        $params = $request->all();
        $params['detection_type'] = Article::DETECTION_TYPE_BOT;
        $params['status'] = Article::STATUS_PENDING;
        $articles = $articleModel->getList($params);
        if(isset($params['export']) && $params['export'] == true && Auth::check()) {
            return  $this->exportPendingArticles('auto_detection_violation', $articles);
        }
        $violationCode = ViolationCode::all();
        return view('pages/auto-detection/index', compact('articles', 'violationCode'));
    }

    public function getManualDetectionList(Request $request) {
        $articleModel = new Article();
        $params = $request->all();
        $params['detection_type'] = Article::DETECTION_TYPE_MANUAL;
        $params['status'] = Article::STATUS_PENDING;
        $articles = $articleModel->getList($params);

        if(isset($params['export']) && $params['export'] === true && Auth::check()) {
            return  $this->exportPendingArticles('label-detection-violation',$articles);
        }

        $violationCode = ViolationCode::all();
        return view('pages/manual-detection/index', compact('articles', 'violationCode'));
    }

    public function getViolationList(Request $request) {
        $articleModel = new Article();
        $params = $request->all();
        $params['status'] = Article::STATUS_VIOLATION;
        $articles = $articleModel->getList($params);
        if(isset($params['export']) && $params['export'] == true && Auth::check()) {
            return  $this->exportViolationArticles('violation_article', $articles);
        }
        return view('pages/violation/index', compact('articles'));
    }

    public function getNoneViolationList(Request $request) {
        $articleModel = new Article();
        $params = $request->all();

        $params['status'] = Article::STATUS_NONE_VIOLATION;
        $articles = $articleModel->getList($params);

        if(isset($params['export']) && $params['export'] == true && Auth::check()) {
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
            $titles = array_merge($titles, ['SUPERVISOR - Status', 'SUPERVISOR - Code Article', 'SUPERVISOR - Violation Type']);
        }
        if($isOperator) {
            $titles = array_merge($titles, ['OPERATOR - Status', 'OPERATOR - Code Article', 'OPERATOR - Violation Type']);
        }

        $exportData = [];
        foreach ($articles as $key => $article) {
            $botStatus = $article->detection_result['status'] ?? count($article->detection_result['violation_code']) > 0 ? Article::STATUS_VIOLATION : Article::STATUS_NONE_VIOLATION ;
            $publishedDate = $article->published_date ? date('Y-m-d', $article->published_date) : '';
            $crawlDate = $article->crawl_date ? date('Y-m-d', $article->crawl_date) : '';
            $row = [
                $key+1,
                $article->company['name'] ?? '',
                $article->country['name'] ?? '',
                $article->brand['name'] ?? '',
                $article->caption,
                $article->image,
                $publishedDate,
                $crawlDate,
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
            [ 'row_titles' => $titles, 'name' => $fileName, 'data' => $exportData ]
        ];
        return ExportService::exportExcelFile($sheets, $fileName);
    }

    public function exportViolationArticles($fileName, $articles) {
        $titles = [
            '#', 'Company', 'Country', 'Brand', 'Caption', 'Image', 'Published Date', 'Crawl Date',
            'Penalty issued','Link', 'Legal documents', 'Code Article', 'Violation Type', 'Status Progress'
        ];
        $exportData = [];
        foreach ($articles as $key => $article) {
            $penaltyIssued = ''; // Last upload documents
            $legalDocuments = ''; // From documents collection _id = article_id
            if($article->has_document) {
                $legalDocuments = [];
                $penaltyIssued = $article->penalty_issued;
                foreach ($article->documents as $document) {
                    $legalDocuments[] = $document->url;
                }
                $legalDocuments = implode('', $legalDocuments);
            }
            $publishedDate = $article->published_date ? date('Y-m-d', $article->published_date) : '';
            $crawlDate = $article->crawl_date ? date('Y-m-d', $article->crawl_date) : '';
            $row = [
                $key+1,
                $article->company['name'] ?? '',
                $article->country['name'] ?? '',
                $article->brand['name'] ?? '',
                $article->caption,
                $article->image,
                $publishedDate,
                $crawlDate,
                $penaltyIssued,
                $article->link,
                $legalDocuments,
                convertArrayToString($article->operator_review['violation_code'], 'name'),
                convertArrayToString($article->operator_review['violation_types'], 'name'),
                $article->progress_status ??  Article::PROGRESS_NOT_STARTED,
            ];

            $exportData[] = $row;
        }
        $sheets = [
            ['row_titles' => $titles, 'name' => $fileName, 'data' => $exportData ]
        ];
        return ExportService::exportExcelFile($sheets, $fileName);
    }

    public function exportNoneViolationArticles($fileName, $articles) {
        $titles = [
            '#', 'Company', 'Country', 'Brand', 'Caption', 'Image', 'Published Date', 'Checking Date', 'Link'
        ];
        $exportData = [];
        foreach ($articles as $key => $article) {
            $publishedDate = $article->published_date ? date('Y-m-d', $article->published_date) : '';
            $crawlDate = $article->crawl_date ? date('Y-m-d', $article->crawl_date) : '';
            $row = [
                $key+1,
                $article->company['name'] ?? '',
                $article->country['name'] ?? '',
                $article->brand['name'] ?? '',
                $article->caption,
                $article->image,
                $publishedDate,
                $crawlDate,
                $article->link,
            ];

            $exportData[] = $row;
        }
        $sheets = [
            ['row_titles' => $titles, 'name' => $fileName, 'data' => $exportData ]
        ];
        return ExportService::exportExcelFile($sheets, $fileName);
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
                        // supervisor / operator needs to submit new violation code
                        // if(!isset($inputs['violation_code']) || count(json_decode($inputs['violation_code'])) === 0) {
                        //     return $this->responseFail([], "Please add violation code for this article");
                        // }
                        // $data = $this->getViolationCodeAndTypeData($inputs['violation_code']);
                        // if(count($data) === 0) {
                        //     return $this->responseFail([], "Invalid violation code");
                        // }
                        // $reviewViolationCode = $data['violation_code'];
                        // $reviewViolationTypes = $data['violation_types'];
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
                    $data = $this->getViolationCodeAndTypeData($inputs['violation_code']);
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
            $reviewMessage = "Review Complete";
            if(UserRoleService::isSupervisor()) {
                $article->supervisor_review = $reviewData;
            }else if(UserRoleService::isOperator()) {
                $article->operator_review = $reviewData;
                if($isDoneReview) {
                    $article->status = $reviewStatus;
                    $reviewMessage = "Review complete";
                }
            }
            $article->update();
            return $this->responseSuccess($reviewData, $reviewMessage);
        }
        return $this->responseFail([], "Article not found or invalid");
    }

    private function getViolationCodeAndTypeData($violationCodeArr) {
        $codex = ViolationCode::whereIn('_id', json_decode($violationCodeArr))->get();
        if($codex) {
            $listCode = [];
            $listTypes = [];
            foreach ($codex as $key => $code) {
                $listCode[] = [
                    'id' => $code->_id,
                    'name' => $code->name,
                ];
                $type = $code->violationType()->first();
                $listTypes[] = [
                    'id'    => $type->_id,
                    'name'  => $type->name,
                    'color' => $type->color
                ];
            }
            $unique_type_array = [];
            foreach($listTypes as $element) {
                $hash = $element['id'];
                $unique_type_array[$hash] = $element;
            }
            $violationTypes = array_values($unique_type_array);
            return [
                'violation_code'  => $listCode,
                'violation_types' => $violationTypes
            ];
        }
        return [];
    }

    public function resetArticleToOriginState(Request $request, $id) {
        $article = Article::find($id);
        if($article && $article->progress_status !== Article::PROGRESS_COMPLETED) {
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

    public function getOne($id) {
        $article = Article::findOrFail($id);
        return view('pages/components/article-detail', compact('article'));
    }
}
