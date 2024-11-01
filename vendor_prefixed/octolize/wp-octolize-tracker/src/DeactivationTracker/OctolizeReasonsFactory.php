<?php

namespace WCWeightVendor\Octolize\Tracker\DeactivationTracker;

use WCWeightVendor\WPDesk\Tracker\Deactivation\Reason;
use WCWeightVendor\WPDesk\Tracker\Deactivation\ReasonsFactory;
class OctolizeReasonsFactory implements ReasonsFactory
{
    public const MISSING_FEATURE = 'missing_feature';
    public const NOT_SELECTED = 'not_selected';
    public const I_HAD_DIFFICULTIES = 'i_had_difficulties';
    public const STOPPED_WORKING = 'stopped_working';
    public const FOUND_ANOTHER_PLUGIN = 'found_another_plugin';
    public const DONT_NEED_ANYMORE = 'dont_need_anymore';
    public const TEMPORARY_DEACTIVATION = 'temporary_deactivation';
    private const MIGRATION_SHOPIFY = 'migration_shopify';
    public const OTHER = 'other';
    private string $plugin_docs_url;
    private string $plugin_support_forum_url;
    private string $pro_plugin_title;
    private string $contact_us_url;
    public function __construct(string $plugin_docs_url = '', string $plugin_support_forum_url = '', string $pro_plugin_title = '', string $contact_us_url = '')
    {
        $this->plugin_docs_url = $plugin_docs_url === '' ? 'https://octol.io/docs-exit-pop-up' : $plugin_docs_url;
        $this->plugin_support_forum_url = $plugin_support_forum_url;
        $this->pro_plugin_title = $pro_plugin_title;
        $this->contact_us_url = $contact_us_url;
    }
    /**
     * Create reasons.
     *
     * @return Reason[]
     */
    public function createReasons(): array
    {
        return [self::NOT_SELECTED => new Reason(self::NOT_SELECTED, '', '', \false, '', \true, \true), self::I_HAD_DIFFICULTIES => new Reason(self::I_HAD_DIFFICULTIES, __('I had difficulties configuring the plugin', 'woo-cart-weight'), sprintf(__('Sorry to hear that! We\'re certain that with a little help, configuring the plugin will be a breeze. Before you deactivate, try to find a solution in our %1$sdocumentation%2$s%3$s.', 'woo-cart-weight'), '<a href="' . esc_url($this->plugin_docs_url) . '" target="_blank">', '</a>', $this->plugin_support_forum_url ? sprintf(__(' or post a question on the %1$sforum%2$s', 'woo-cart-weight'), '<a href="' . esc_url($this->plugin_support_forum_url) . '" target="_blank">', '</a>') : '')), self::STOPPED_WORKING => new Reason(self::STOPPED_WORKING, __('The plugin stopped working', 'woo-cart-weight'), sprintf(__('We take any issues with our plugins very seriously. Try to find a reason in our %1$sdocumentation%2$s%3$s.', 'woo-cart-weight'), '<a href="' . esc_url($this->plugin_docs_url) . '" target="_blank">', '</a>', $this->plugin_support_forum_url ? sprintf(__(' or post the problem on the %1$sforum%2$s', 'woo-cart-weight'), '<a href="' . esc_url($this->plugin_support_forum_url) . '" target="_blank">', '</a>') : '')), self::FOUND_ANOTHER_PLUGIN => new Reason(self::FOUND_ANOTHER_PLUGIN, __('I have found another plugin', 'woo-cart-weight'), __('That hurts a little bit, but we\'re tough! Can you let us know which plugin you are switching to?', 'woo-cart-weight'), \true, __('Which plugin are you switching to?', 'woo-cart-weight')), self::MISSING_FEATURE => new Reason(self::MISSING_FEATURE, __('The plugin doesn\'t have the functionality I need', 'woo-cart-weight'), $this->pro_plugin_title ? sprintf(__('Good news! There\'s a great chance that the functionality you need is already implemented in the PRO version of the plugin. %1$sContact us%2$s to receive a discount for %3$s. Also, can you describe what functionality you\'re looking for?', 'woo-cart-weight'), '<a href="' . esc_url($this->contact_us_url) . '" target="_blank">', '</a>', $this->pro_plugin_title) : __('We\'re sorry to hear that. Can you describe what functionality you\'re looking for?', 'woo-cart-weight'), \true, __('What functionality are you looking for?', 'woo-cart-weight')), self::MIGRATION_SHOPIFY => new Reason(self::MIGRATION_SHOPIFY, __('I\'m moving my shop from WooCommerce to Shopify', 'woo-cart-weight'), sprintf(__('Switching to Shopify? We\'ve got you covered! %1$sExplore our Shopify apps%2$s and see how they can help you make the most of your new platform!', 'woo-cart-weight'), '<a href="https://octol.io/plugin-deactivation-woo-shopify-apps" target="_blank">', '</a>')), self::DONT_NEED_ANYMORE => new Reason(self::DONT_NEED_ANYMORE, __('I don\'t need the plugin anymore', 'woo-cart-weight'), __('Sorry to hear that! Can you let us know why the plugin is not needed anymore?', 'woo-cart-weight'), \true, __('Why is the plugin not needed anymore?', 'woo-cart-weight')), self::TEMPORARY_DEACTIVATION => new Reason(self::TEMPORARY_DEACTIVATION, __('I\'m deactivating temporarily for debugging purposes', 'woo-cart-weight')), self::OTHER => new Reason(self::OTHER, __('Other reason', 'woo-cart-weight'), __('Can you provide some details on the reason behind deactivation?', 'woo-cart-weight'), \true, __('Please provide details', 'woo-cart-weight'))];
    }
}