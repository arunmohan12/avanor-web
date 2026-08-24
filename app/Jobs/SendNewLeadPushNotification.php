<?php

namespace App\Jobs;

use App\Models\Lead;
use App\Services\Firebase\LeadPushNotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendNewLeadPushNotification implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

    public int $timeout = 30;

    public function __construct(
        public readonly int $leadId,
    ) {}

    public function handle(
        LeadPushNotificationService $notificationService,
    ): void {
        $lead = Lead::query()->find($this->leadId);

        if (! $lead) {
            return;
        }

        $notificationService->sendNewLeadNotification($lead);
    }

    public function backoff(): array
    {
        return [10, 30, 60];
    }
}
