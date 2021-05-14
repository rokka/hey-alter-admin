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
            'cpu' => ['nullable', 'string' ],
            'memory_in_gb' => ['nullable', 'int' ],
            'hard_drive_type' => ['nullable', 'int' ],
            'hard_drive_space_in_gb' => ['nullable', 'int' ],
        ];
    }

    public function authorize()
    {
        return true;
        //return Gate::allows('task_access');
    }
}