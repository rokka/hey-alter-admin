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
            'zip' => ['nullable', 'integer' ],
            'city' => [ 'nullable', 'string' ],
            'street' => ['nullable', 'string' ],
            'phone' => [ 'nullable', 'integer' ]
        ];
    }

    public function authorize()
    {
        return true;
        //return Gate::allows('task_access');
    }
}
