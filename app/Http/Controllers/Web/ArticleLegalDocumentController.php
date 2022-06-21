<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\FileService;
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
            $fileService = new FileService();
            $uploadResponse = $fileService->upload(FileService::DOCUMENT_PATH.$articleId.'/', $request->file('document'));

            $newDocument = [
                'article_id' => $articleId,
                'name'       => $uploadResponse['original_name'],
                'path'       => $uploadResponse['path'],
                'url'        => $request->getSchemeAndHttpHost() . $uploadResponse['path']
            ];
            $created = ArticleLegalDocument::create($newDocument);
            return $this->responseSuccess($created, "Action successfully");
        }

        return $this->responseFail([], "Invalid article");
    }

    public function delete(Request $request, $id) {
        $document = ArticleLegalDocument::find($id);
        if($document) {
            $fileService = new FileService();
            try {
                $filePath = str_replace('/storage/', '', $document->path);
                $deleted = $fileService->delete($filePath);
                if($deleted) {
                    $document->delete();
                    return $this->responseSuccess($deleted, "Delete document successfully");
                }
            } catch (Exception $e) {
                return $this->responseFail([],  $e->getMessage());
            }
        }
        return $this->responseFail([], "Invalid document");
    }
}
