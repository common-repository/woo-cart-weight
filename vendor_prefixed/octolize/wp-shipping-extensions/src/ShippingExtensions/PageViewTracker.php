<?php

namespace WCWeightVendor\Octolize\ShippingExtensions;

use WCWeightVendor\Octolize\ShippingExtensions\Tracker\ViewPageTracker;
use WCWeightVendor\WPDesk\PluginBuilder\Plugin\Hookable;
/**
 * .
 */
class PageViewTracker implements Hookable
{
    use AdminPage;
    /**
     * @var ViewPageTracker
     */
    private $tracker;
    /**
     * @param ViewPageTracker $tracker .
     */
    public function __construct(ViewPageTracker $tracker)
    {
        $this->tracker = $tracker;
    }
    /**
     * @return void
     */
    public function hooks(): void
    {
        add_action('in_admin_header', [$this, 'view_tracking']);
    }
    /**
     * @return void
     */
    public function view_tracking(): void
    {
        if (!$this->is_shipping_extensions_page()) {
            return;
        }
        if (isset($_GET[PluginLinks::PLUGIN_LINKS_PAGE])) {
            $this->tracker->add_view_plugins_list();
        } else {
            $this->tracker->add_view_direct();
        }
    }
}
