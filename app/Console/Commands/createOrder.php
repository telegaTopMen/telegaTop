<?php

namespace App\Console\Commands;

use App\Models\ScheduledOrder;
use App\service\TgTopApiService;
use Illuminate\Console\Command;

class createOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:order-create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        // Ищем все заказы, у которых run_at <= текущее время и статус = 'pending'
        $now = now();
        $pendingOrders = ScheduledOrder::query()->where('status', 'pending')
            ->where('run_at', '<=', $now)
            ->get();

        foreach ($pendingOrders as $pendingOrder) {
            // Вызываем API tg-top.ru
            // Допустим, у нас есть сервис TgTopApiService с методом addOrderDefault
            $response = app(TgTopApiService::class)->addOrder(
                $pendingOrder->service_id,
                $pendingOrder->link,
                $pendingOrder->quantity
            );

            // Предположим, API возвращает что-то вроде { "order": 12345 }
            if (!empty($response['order'])) {
                $pendingOrder->tg_top_order_id = $response['order'];
                $pendingOrder->status = 'created';
            } else {
                // Можно логировать ошибку или отметить как failed
                $pendingOrder->status = 'failed';
            }

            $pendingOrder->save();
        }
    }
}
