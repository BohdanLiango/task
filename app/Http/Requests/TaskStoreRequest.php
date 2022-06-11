<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'task' => 'required|max:255'
        ];
    }

    public function messages()
    {
        return [
            'task.required' => 'Task required!',
            'task.max' => 'Max size 255 symbols'
        ];
    }
}
