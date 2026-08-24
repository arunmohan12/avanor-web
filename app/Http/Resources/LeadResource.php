<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeadResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,

            'budget' => $this->budget,
            'message' => $this->message,

            'source' => $this->source,
            'page_url' => $this->page_url,

            'developer' => $this->whenLoaded('developer', function () {
                return [
                    'id' => $this->developer?->id,
                    'name' => $this->developer?->name,
                ];
            }),

            'property' => $this->whenLoaded('property', function () {
                return [
                    'id' => $this->property?->id,
                    'name' => $this->property->title,
                ];
            }),

            'tracking' => [
                'utm_source' => $this->utm_source,
                'utm_medium' => $this->utm_medium,
                'utm_campaign' => $this->utm_campaign,
                'utm_content' => $this->utm_content,
                'utm_term' => $this->utm_term,
                'gclid' => $this->gclid,
                'fbclid' => $this->fbclid,
            ],

            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
