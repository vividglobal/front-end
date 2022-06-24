<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\DocumentService;
use App\Models\Mongo\ArticleLegalDocument;
use Illuminate\Support\Facades\Validator;
use App\Models\Mongo\Article;

class ArticleLegalDocumentController extends Controller
{
    public function upload(Request $request) {
        $inputs = $request->all();
        $validator = Validator::make($inputs, [
            'document' => 'required|mimes:pdf',
            'article_id' => 'required'
        ]);

        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }
        $articleId = $inputs['article_id'];
        $article = Article::find($articleId);
        if($article && $article->status === Article::STATUS_VIOLATION) {
            $documentService = new DocumentService();
            $uploaded = $documentService->upload($articleId, $request);
            return $this->responseSuccess($uploaded, "Action successfully");
        }

        return $this->responseFail([], "Invalid article");
    }

    public function delete(Request $request, $id) {
        $document = ArticleLegalDocument::find($id);
        if($document) {
            $documentService = new DocumentService();
            $deleted = $documentService->delete($document);
            if($deleted) {
                return $this->responseSuccess($deleted, "Delete document successfully");
            }
        }
        return $this->responseFail([], "Invalid document");
    }
}
