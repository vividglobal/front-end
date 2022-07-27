<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'violations' => 'array',
            'brands'     => 'array',
            'country'    => 'string',
            'text'       => 'string',
            'imgs'       => 'array',
            'url'        => 'string|url',
            'url_page'   => 'string|url',
            'post_time'  => 'string',
        ];
    }
}
