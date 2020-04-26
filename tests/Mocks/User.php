<?php

namespace Ryancco\Sessions\Tests\Mocks;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Ryancco\Sessions\HasSessions;

class User extends Authenticatable
{
    use HasSessions;
    
    protected $guarded = [];
}