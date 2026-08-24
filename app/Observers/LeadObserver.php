<?php

namespace App\Observers;

use App\Jobs\SendNewLeadPushNotification;
use App\Models\Lead;
use App\Services\Firebase\LeadPushNotificationService;

class LeadObserver
{
    public function __construct(
        private readonly LeadPushNotificationService $notificationService,
    ) {}

    public function created(Lead $lead): void
    {
        SendNewLeadPushNotification::dispatch($lead->id)
            ->afterCommit();
    }
}
