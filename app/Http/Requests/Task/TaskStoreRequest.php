<?php

namespace App\Http\Requests\Task;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;
use App\Constant\Status;

class TaskStoreRequest extends BaseRequest
{
   
    public function rules(): array
    {
        return [
            'title' => ['required','string','max:255'],
            'description' => ['nullable','string'],
            'status' => ['nullable',Rule::in(Status::PENDING, Status::IN_PROGRESS, Status::DONE)],
            'due_date' => ['nullable','date'],
            'assigned_to' => ['required', Rule::exists('users', 'id')]
        ];
    }
}
