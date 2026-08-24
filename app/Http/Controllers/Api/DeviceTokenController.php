<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreDeviceTokenRequest;
use App\Models\UserDeviceToken;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeviceTokenController extends Controller
{
    public function store(StoreDeviceTokenRequest $request): JsonResponse
    {
        $validated = $request->validated();

        UserDeviceToken::query()->updateOrCreate(
            [
                'token' => $validated['token'],
            ],
            [
                'user_id' => $request->user()->id,
                'platform' => $validated['platform'],
                'last_seen_at' => now(),
            ],
        );

        return response()->json([
            'message' => 'Device token registered.',
        ]);
    }

    public function destroy(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'token' => [
                'required',
                'string',
                'max:1024',
            ],
        ]);

        UserDeviceToken::query()
            ->where('user_id', $request->user()->id)
            ->where('token', $validated['token'])
            ->delete();

        return response()->json([
            'message' => 'Device token removed.',
        ]);
    }
}
