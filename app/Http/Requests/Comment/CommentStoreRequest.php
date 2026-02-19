<?php

namespace App\Http\Requests\Comment;

use App\Http\Requests\BaseRequest;

class CommentStoreRequest extends BaseRequest
{
   
    public function rules(): array
    {
        return [
            'body' => ['required','string','max:1000']
        ];
    }
}
