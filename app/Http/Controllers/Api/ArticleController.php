<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\CreateRequest;
use App\Http\Services\ArticleService;
use App\Models\Mongo\Article;

class ArticleController extends Controller
{
    public function create(CreateRequest $request) {
        $validated = $request->validated();
        $articleService = new ArticleService();
        $data = $articleService->createArticleFromAIDetection($validated, $detectionType = Article::DETECTION_TYPE_BOT);

        if(!$data['success']) {
    
            return $this->responseFail([], $data['error']);
        }

        return $this->responseSuccess($data['data'], "Create article successfully");
    }
}
