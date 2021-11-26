<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSchoolRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['nullable', 'string' ],
            'type' => ['nullable', 'string' ],
            'zip' => ['nullable', 'string' ],
            'city' => [ 'nullable', 'string' ],
            'street' => ['nullable', 'string' ],
            'phone' => [ 'nullable', 'string' ],
            'contact_person' => [ 'nullable', 'string' ],
        ];
    }

    public function authorize()
    {
        return true;
        //return Gate::allows('task_access');
    }
}
