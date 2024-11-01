<?php

namespace WCWeightVendor\WPDesk\PluginBuilder\Plugin;

interface Hookable
{
    /**
     * Init hooks (actions and filters).
     *
     * @return void
     */
    public function hooks();
}