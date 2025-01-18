<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScheduledOrder extends Model
{
    protected $table = 'scheduled_orders';

    protected $fillable = [
        'campaign_id',
        'service_id',
        'link',
        'quantity',
        'run_at',
        'status',
        'tg_top_order_id'
    ];

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(related: Campaign::class);
    }
}
