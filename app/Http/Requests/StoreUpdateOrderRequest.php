<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateOrderRequest extends FormRequest
{
    public function rules()
    {
        return [
            'school_id' => ['required', 'int', 'gt:0' ],
            'user_id' => ['required', 'int', 'gt:0' ],
            'desktop_count' => ['required', 'int' ],
            'laptop_count' => ['required', 'int' ],
            'tablet_count' => ['required', 'int' ],
            'sff_count' => ['required', 'int' ],
            'comment' => [ 'nullable' ],
        ];
    }

    public function authorize()
    {
        return true;
        //return Gate::allows('task_access');
    }
}