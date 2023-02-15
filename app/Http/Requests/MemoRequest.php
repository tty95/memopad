<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MemoRequest extends FormRequest
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
                    'title' => 'required|max:40',
                    'content' => 'required|max:255',
            ];
        }

        public function attributes()
        {
                return [
                        'title' => 'タイトル',
                        'content' => 'メモ内容',
                ];
        }

        public function messages()
        {
                return [
                        'required' => ':attributeは必須です',
                        'title.max' => ':attributeは40文字以内で入力してください',
                        'content.max' => ':attributeは255文字以内で入力してください',
                ];
        }
}
