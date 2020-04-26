<?php

namespace Ryancco\Sessions\Contracts;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface Session
{
    public function user(): BelongsTo;

    public function device(): Device;
}