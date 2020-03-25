<?php

namespace App\Http\Requests\Staff;

use App\Http\Requests\Request;

class Staff_DepartmentRequest extends Request
{
    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'bonus' => ['integer', 'nullable'],
                        'start_at' => 'date|nullable',
                        'd_id' => 'integer|required'
                    ];
                }
            case 'GET':
            case 'DELETE':
            default:
                {
                    return [];
                }
        }
    }

    public function messages()
    {
        return [
            'bonus.integer' => '獎金必須是數字格式',
            'start_at.date' => '起始日期必須是日期格式',
        ];
    }
}
