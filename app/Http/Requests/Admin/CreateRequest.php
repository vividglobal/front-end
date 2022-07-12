<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Mongo\Admin;

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
            'full_name'    => 'required|max:100',
            'password'     => 'required|min:6|max:20',
            'email'        => 'required|email|unique:email',
            'phone_number' => 'required',
            'role'         => 'required|in:'.Admin::ROLE_ADMIN.','.Admin::ROLE_SUPERVISOR.','.Admin::ROLE_OPERATOR,
        ];
    }
}
