<?php

namespace App\Services\Firebase;

use App\Models\Lead;
use App\Models\UserDeviceToken;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Throwable;

class LeadPushNotificationService
{
    public function sendNewLeadNotification(Lead $lead): void
    {
        $tokens = UserDeviceToken::query()
            ->whereHas('user', function ($query) {
                $query->whereIn('role', [
                    'admin',
                    'lead_manager',
                ]);
            })
            ->pluck('token')
            ->filter()
            ->unique()
            ->values()
            ->all();

        if ($tokens === []) {
            return;
        }

        $message = CloudMessage::new()
            ->withNotification([
                'title' => "New Lead: {$lead->name}",
                'body' => $this->notificationBody($lead),
            ])
            ->withData([
                'type' => 'lead',
                'lead_id' => (string) $lead->id,
            ]);

        try {
            $report = Firebase::messaging()->sendMulticast(
                $message,
                $tokens,
            );

            $tokensToDelete = array_values(
                array_unique([
                    ...$report->unknownTokens(),
                    ...$report->invalidTokens(),
                ]),
            );

            if ($tokensToDelete !== []) {
                UserDeviceToken::query()
                    ->whereIn('token', $tokensToDelete)
                    ->delete();
            }

            if ($report->hasFailures()) {
                Log::warning(
                    'Some new lead push notifications failed.',
                    [
                        'lead_id' => $lead->id,
                        'successful' => $report->successes()->count(),
                        'failed' => $report->failures()->count(),
                        'removed_tokens' => count($tokensToDelete),
                    ],
                );
            }
        } catch (Throwable $exception) {
            Log::error(
                'New lead push notification job failed.',
                [
                    'lead_id' => $lead->id,
                    'error' => $exception->getMessage(),
                ],
            );

            throw $exception;
        }
    }

    private function notificationBody(Lead $lead): string
    {
        if ($lead->property) {
            return "Property: {$lead->property->title}";
        }

        if ($lead->developer) {
            return "Developer: {$lead->developer->name}";
        }

        if ($lead->source) {
            return "New enquiry from {$lead->source}";
        }

        return 'A new enquiry has been received on Avanor.';
    }
}
