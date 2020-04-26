<?php

namespace Ryancco\Sessions;

use Jenssegers\Agent\Agent;
use Ryancco\Sessions\Contracts\Device as DeviceInterface;

class Device extends Agent implements DeviceInterface
{
    public function platformVersion()
    {
        return $this->version($this->platform());
    }

    public function browserVersion()
    {
        return $this->version($this->browser());
    }
}