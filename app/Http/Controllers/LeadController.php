<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id' => [
                'nullable',
                'exists:properties,id',
            ],

            'developer_id' => [
                'nullable',
                'exists:developers,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'phone' => [
                'required',
                'string',
                'max:30',
                'unique:leads,phone',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
                'unique:leads,email',
            ],

            'budget' => [
                'nullable',
                'string',
                'max:255',
            ],

            'source' => [
                'nullable',
                'string',
                'max:100',
            ],
            'message' => [
                'nullable',
                'string',
                'max:2000',
            ],
            'utm_source' => ['nullable', 'string', 'max:255'],
            'utm_medium' => ['nullable', 'string', 'max:255'],
            'utm_campaign' => ['nullable', 'string', 'max:255'],
            'utm_content' => ['nullable', 'string', 'max:255'],
            'utm_term' => ['nullable', 'string', 'max:255'],

            'gclid' => ['nullable', 'string', 'max:255'],
            'fbclid' => ['nullable', 'string', 'max:255'],

            'page_url' => ['nullable', 'string', 'max:1000'],

        ], [
            'phone.unique' => 'This mobile number has already been registered with us.',
            'email.unique' => 'This email address has already been registered with us.',
        ]);

        Lead::create($validated);

        return back()->with(
            'lead_success',
            'Thank you. Our property advisor will contact you shortly.'
        );
    }

    public function storeLanding(Request $request)
    {
        $validated = $request->validate([
            'property_id' => [
                'nullable',
                'exists:properties,id',
            ],

            'developer_id' => [
                'nullable',
                'exists:developers,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'phone' => [
                'required',
                'string',
                'max:30',
                'unique:leads,phone',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
                'unique:leads,email',
            ],

            'budget' => [
                'nullable',
                'string',
                'max:255',
            ],

            'source' => [
                'nullable',
                'string',
                'max:100',
            ],

            'message' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'utm_source' => ['nullable', 'string', 'max:255'],
            'utm_medium' => ['nullable', 'string', 'max:255'],
            'utm_campaign' => ['nullable', 'string', 'max:255'],
            'utm_content' => ['nullable', 'string', 'max:255'],
            'utm_term' => ['nullable', 'string', 'max:255'],

            'gclid' => ['nullable', 'string', 'max:255'],
            'fbclid' => ['nullable', 'string', 'max:255'],

            'page_url' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ], [
            'phone.unique' => 'This mobile number has already been registered with us.',

            'email.unique' => 'This email address has already been registered with us.',
        ]);

        Lead::create($validated);

        return redirect()
            ->route('landing.thank-you');
    }
}
