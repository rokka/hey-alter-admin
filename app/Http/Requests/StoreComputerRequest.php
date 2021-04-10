<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComputerRequest extends FormRequest
{
    public function rules()
    {
        return [
            'donor' => ['nullable', 'string' ],
            'email' => ['nullable', 'email' ],
            'model' => ['nullable', 'string' ],
            'comment' => [ 'nullable' ],
            'is_deletion_required' => [ 'nullable', 'boolean' ],
            'needs_donation_receipt' => [ 'nullable', 'boolean' ],
            'has_webcam' => [ 'nullable', 'boolean' ],
            'required_equipment' => ['nullable', 'string' ],
        ];
    }

    public function authorize()
    {
        return true;
        //return Gate::allows('task_access');
    }
}