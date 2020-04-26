<?php

namespace Ryancco\Sessions;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Ryancco\Sessions\Contracts\Device as DeviceInterface;

class Session extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'ip_address',
        'user_agent',
        'payload',
        'last_activity'
    ];

    protected $dates = [
        'last_activity'
    ];

    protected $dateFormat = 'U';

    public $timestamps = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(config('sessions.user_model'));
    }

    public function device(): DeviceInterface
    {
        return tap(new Device, function (Device $device) {
            $device->setUserAgent($this->user_agent);
        });
    }

    public function scopeInactive($query, $last_activity = 60)
    {
        if ($last_activity instanceof DateTime) {
            $last_activity = now()->diffInMinutes($last_activity);
        }

        $query->where('last_activity', '<', now()->subMinutes($last_activity)->unix());
    }

    public function scopeActive($query, $last_activity = 60)
    {
        if ($last_activity instanceof DateTime) {
            $last_activity = now()->diffInMinutes($last_activity);
        }

        $query->where('last_activity', '>=', now()->subMinutes($last_activity)->unix());
    }
}
