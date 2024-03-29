<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTweet extends FormRequest
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
            'tweet_text'         => 'required|min:10|max:140',
            'tweet_text_ar'      => 'required|min:10|max:140',
            'user_id'            => 'required|exists:users,id',
        ];
    }
}
