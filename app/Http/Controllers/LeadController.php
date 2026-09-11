<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeadSubmissionRequest;
use App\Models\Lead;

class LeadController extends Controller
{
    public function show(Lead $lead): LeadResource
    {
        $lead->load([
            'developer:id,name',
            'property:id,name',
        ]);

        return new LeadResource($lead);
    }

    public function store(LeadSubmissionRequest $request)
    {
        $validated = $request->validated();

        Lead::create($validated);

        return back()->with(
            'lead_success',
            'Thank you. Our property advisor will contact you shortly.'
        );
    }

    public function storeLanding(LeadSubmissionRequest $request)
    {
        $validated = $request->validated();

        Lead::create($validated);

        return redirect()
            ->route('landing.thank-you');
    }
}
