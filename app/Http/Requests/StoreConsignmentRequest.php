<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConsignmentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'donor' => ['required', 'string' ],
            'email' => ['nullable', 'email' ],
            'desktop_count' => ['required', 'numeric'],
            'laptop_count' => ['required', 'numeric'],
            'laptop_count' => ['required', 'numeric'],
            'privacy' => ['required', 'boolean'],
        ];
    }

    public function authorize()
    {
        return true;
        //return Gate::allows('task_access');
    }
}