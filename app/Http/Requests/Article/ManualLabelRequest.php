<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class ManualLabelRequest extends FormRequest
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
        $rules = [
            'request_type' => 'required',
            'capcha_token' => 'required',
            'country_id'   => 'nullable',
        ];
        $request_type = request()->get('request_type');
        if($request_type === LABEL_TYPE_IMAGE) {
            if(!request()->hasFile('image') && request()->get('caption') === null) {
                $rules['image'] = 'required';
                $rules['caption'] = 'string|max:10000';
            }
            if(request()->hasFile('image')) {
                $rules['image'] = 'required';
                $rules['caption'] = 'nullable';
            }
            if(request()->has('caption')) {
                $rules['image'] = 'nullable';
                $rules['caption'] = 'required|string|max:10000';
            }
        }else if($request_type === LABEL_TYPE_URL) {
            $rules['url'] = 'required|url';
        }
        return $rules;
    }
}
