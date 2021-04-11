<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateComputerRequest extends FormRequest
{
    public function rules()
    {
        return [
            'donor' => ['nullable', 'string' ],
            'email' => ['nullable', 'email' ],
            'model' => ['nullable', 'string' ],
            'state' => ['required', 'string' ],
            'comment' => [ 'nullable' ],
            'is_deletion_required' => [ 'boolean' ],
            'needs_donation_receipt' => [ 'boolean' ],
            'has_webcam' => [ 'boolean' ],
            'required_equipment' => ['nullable', 'string' ],
        ];
    }

    public function authorize()
    {
        return true;
        //return Gate::allows('task_access');
    }
}