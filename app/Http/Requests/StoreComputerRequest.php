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
            'type' => ['required', 'string' ],
            'model' => ['nullable', 'string' ],
            'state' => ['required', 'string' ],
            'comment' => [ 'nullable' ],
            'is_deletion_required' => [ 'boolean' ],
            'needs_donation_receipt' => [ 'boolean' ],
            'has_webcam' => [ 'boolean' ],
            'has_wlan' => [ 'boolean' ],
            'required_equipment' => ['nullable', 'string' ],
        ];
    }

    public function authorize()
    {
        return true;
        //return Gate::allows('task_access');
    }
}