<?php

namespace App\Http\Requests;

use App\Rules\SafeLeadMessage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class LeadSubmissionRequest extends FormRequest
{
    private const MINIMUM_COMPLETION_SECONDS = 3;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'property_id' => ['nullable', 'exists:properties,id'],
            'developer_id' => ['nullable', 'exists:developers,id'],
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30', 'unique:leads,phone'],
            'email' => ['nullable', 'email', 'max:255', 'unique:leads,email'],
            'budget' => ['nullable', 'string', 'max:255'],
            'source' => ['nullable', 'string', 'max:100'],
            'message' => ['nullable', 'string', 'max:2000', new SafeLeadMessage],
            'utm_source' => ['nullable', 'string', 'max:255'],
            'utm_medium' => ['nullable', 'string', 'max:255'],
            'utm_campaign' => ['nullable', 'string', 'max:255'],
            'utm_content' => ['nullable', 'string', 'max:255'],
            'utm_term' => ['nullable', 'string', 'max:255'],
            'gclid' => ['nullable', 'string', 'max:255'],
            'fbclid' => ['nullable', 'string', 'max:255'],
            'page_url' => ['nullable', 'string', 'max:1000'],
            'website' => ['present', 'prohibited'],
            'form_started_at' => ['required', 'integer'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            $startedAt = $this->integer('form_started_at');

            if ($startedAt > 0 && now()->timestamp - $startedAt < self::MINIMUM_COMPLETION_SECONDS) {
                $validator->errors()->add('form', 'Please wait a moment and try again.');
            }
        });
    }

    public function messages(): array
    {
        return [
            'phone.unique' => 'This mobile number has already been registered with us.',
            'email.unique' => 'This email address has already been registered with us.',
            'website.prohibited' => 'Unable to process this submission.',
            'form_started_at.required' => 'Please refresh the page and try again.',
        ];
    }
}
