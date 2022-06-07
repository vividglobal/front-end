<?php

namespace App\Models\Mongo;

use Jenssegers\Mongodb\Eloquent\Model;

class ArticleLegalDocument extends Model
{
    protected $collection = 'article_legal_documents';

    const CREATE_AT = 'created';
    const UPDATED_AT = 'modified';

    protected $fillable = [
        'article_id',
        'url'
    ];
}
