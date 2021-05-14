<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInquiryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'school' => [ 'required', 'string' ],
            'contact_person' => [ 'required', 'string' ],
            'telephone' => [ 'required', 'string' ],
            'email' => [ 'required', 'string' ],
            'contact_person2' => [ 'nullable', 'string' ],
            'telephone2' => [ 'nullable', 'string' ],
            'email2' => [ 'nullable', 'string' ],
        ];
    }

    public function authorize()
    {
        return true;
        //return Gate::allows('task_access');
    }
}