<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campaign extends Model
{
    protected $table = 'campaigns';

    protected $fillable = [
        'name',
    ];
    public function scheduleOrders(): HasMany
    {
        return $this->hasMany(related: ScheduledOrder::class);
    }
}
