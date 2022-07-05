<?php

namespace App\Http\Services;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileService
{
    const DOCUMENT_PATH = 'public/documents/';
    const ARTICLE_PATH = 'public/articles/';

    public $fileExtensions = ['pdf'];

    public function upload($path, $file) {
        $name =  time()."_".Str::random(50);
        $fullName = "$name.".$file->extension();
        $file->storeAs("$path", $fullName);

        $uploadedPath = $path.$fullName;
        $storagePath = Storage::url($uploadedPath);
        return [
            'path'          => $storagePath,
            'original_name' => $file->getClientOriginalName()
        ];
    }

    public function delete($path) {
        return Storage::disk('public')->delete($path);
    }
}