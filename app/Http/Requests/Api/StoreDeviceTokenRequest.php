<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDeviceTokenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'token' => [
                'required',
                'string',
                'max:1024',
            ],

            'platform' => [
                'required',
                'string',
                Rule::in([
                    'android',
                    'ios',
                ]),
            ],
        ];
    }
}
