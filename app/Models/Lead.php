<?php

namespace App\Models;

use App\Enums\LeadStatus;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'property_id',
        'developer_id',
        'name',
        'phone',
        'email',
        'source',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_content',
        'utm_term',
        'gclid',
        'fbclid',
        'page_url',
        'budget',
        'message',
        'status',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function developer()
    {
        return $this->belongsTo(Developer::class);
    }

    protected function casts(): array
    {
        return [
            'status' => LeadStatus::class,
        ];
    }
}
