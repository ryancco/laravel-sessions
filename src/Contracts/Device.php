<?php

namespace Ryancco\Sessions\Contracts;

interface Device
{
    /**
     * Get the device name.
     *
     * @return string
     */
    public function device();

    /**
     * Get the platform name.
     *
     * @return string
     */
    public function platform();

    /**
     * Get the platform version.
     *
     * @return string|float
     */
    public function platformVersion();

    /**
     * Get the browser name.
     *
     * @return string
     */
    public function browser();

    /**
     * Get the browser version.
     *
     * @return string|float
     */
    public function browserVersion();
}
