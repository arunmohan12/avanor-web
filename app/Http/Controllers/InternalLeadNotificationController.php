<?php

namespace App\Http\Controllers;

use App\Jobs\SendNewLeadPushNotification;
use App\Models\Lead;
use Illuminate\Http\Request;

class InternalLeadNotificationController extends Controller
{
    public function notify(Request $request, Lead $lead)
    {
        abort_unless(
            hash_equals(
                (string) config('services.internal.secret'),
                (string) $request->header('X-Internal-Secret')
            ),
            403
        );

        SendNewLeadPushNotification::dispatch($lead->id);

        return response()->json([
            'success' => true,
            'message' => 'Lead notification queued.',
            'lead_id' => $lead->id,
        ]);
    }
}
