<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Mongo\Admin;

class UpdateRequest extends FormRequest
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
            'full_name'    => 'required|max:100',
            'phone_number' => 'required',
            'email'        => 'required|email|unique:email',
            'role'         => 'required|in:'.Admin::ROLE_ADMIN.','.Admin::ROLE_SUPERVISOR.','.Admin::ROLE_OPERATOR,
        ];
    }
}
