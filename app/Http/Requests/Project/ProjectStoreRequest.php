<?php

namespace App\Http\Requests\Project;

use App\Http\Requests\BaseRequest;

class ProjectStoreRequest extends FormRequest
{
    /**
     *
     * Summary: Get the validation rules that apply to the request
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date']
        ];
    }
}
