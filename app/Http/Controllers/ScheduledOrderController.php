<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleOrderRequest;
use App\Models\Campaign;
use App\Models\ScheduledOrder;
use Illuminate\Http\JsonResponse;

class ScheduledOrderController extends Controller
{
    /**
     * @param ScheduleOrderRequest $request
     * @return JsonResponse
     */
    public function scheduleOrders(ScheduleOrderRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $campaign = Campaign::query()->create([
            'name' => $validated['name'],
        ]);

        foreach ($validated['channels'] as $channel) {
            $now = now();

            foreach ($channel['orders'] as $order) {
                ScheduledOrder::query()->create([
                    'campaign_id' => $campaign->id,
                    'service_id' => $channel['service_id'],
                    'link' => $channel['link'],
                    'quantity' => $order['quantity'],
                    'run_at' => $now->copy()->addHours($order['hour']),
                    'status' => 'pending',
                ]);
            }
        }

        return response()->json([
            'message' => 'Задания созданы'
        ]);
    }
}
