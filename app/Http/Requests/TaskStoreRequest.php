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
            'title' => 'required|max:255',
            'category_id' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Task required!',
            'title.max' => 'Max size 255 symbols',
        ];
    }
}
