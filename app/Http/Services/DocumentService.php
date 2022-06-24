<?php

namespace App\Http\Services;
use App\Http\Services\FileService;
use App\Models\Mongo\ArticleLegalDocument;

class DocumentService
{
    public function upload($articleId, $request) {
        $fileService = new FileService();
        $uploadResponse = $fileService->upload(FileService::DOCUMENT_PATH.$articleId.'/', $request->file('document'));

        $newDocument = [
            'article_id' => $articleId,
            'name'       => $uploadResponse['original_name'],
            'path'       => $uploadResponse['path'],
            'url'        => $request->getSchemeAndHttpHost() . $uploadResponse['path']
        ];
        $created = ArticleLegalDocument::create($newDocument);
        return $created;
    }

    public function delete($document) {
        $fileService = new FileService();
        $filePath = str_replace('/storage/', '', $document->path);
        $deleted = $fileService->delete($filePath);
        if($deleted) {
            $document->delete();
            return $deleted;
        }
        return false;
    }
}