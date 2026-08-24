<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LeadResource;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LeadController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $perPage = min(
            max($request->integer('per_page', 20), 1),
            100,
        );

        $leads = Lead::query()
            ->with([
                'developer:id,name',
                'property:id,title',
            ])
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        return LeadResource::collection($leads);
    }

    public function show(Lead $lead): LeadResource
    {
        $lead->load([
            'developer:id,name',
        ]);

        return new LeadResource($lead);
    }
}
