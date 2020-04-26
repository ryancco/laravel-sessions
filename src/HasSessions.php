<?php

namespace Ryancco\Sessions;

use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasSessions
{
    public function sessions(): HasMany
    {
        return $this->hasMany(config('sessions.model'));
    }
}