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

class ArticleController extends Controller
{
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
        // 
    }

    public function moderateArticle(Request $request, $id) {
        // 
    }

    public function resetArticleToOriginState(Request $request, $id) {
        // 
    }
}
