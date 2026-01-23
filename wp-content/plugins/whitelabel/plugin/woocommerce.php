<?php
//Woocommerce
function wp_hide_woocommerce_metaboxes() {
        $screen = get_current_screen();
        if ( !$screen ) {
            return;
        }
        //Hide the "Product data" meta box.
        remove_meta_box('woocommerce-product-data', $screen->id, 'normal');
        //Hide the "Product short description" meta box.
        //remove_meta_box('postexcerpt', $screen->id, 'normal');
        //Hide the "Product gallery" meta box.
        remove_meta_box('woocommerce-product-images', $screen->id, 'side');
        //Hide the "Coupon data" meta box.
        remove_meta_box('woocommerce-coupon-data', $screen->id, 'normal');
        //Hide the "Order data" meta box.
        remove_meta_box('woocommerce-order-data', $screen->id, 'normal');
        //Hide the "Items" meta box.
        remove_meta_box('woocommerce-order-items', $screen->id, 'normal');
        //Hide the "Downloadable product permissions" meta box.
        remove_meta_box('woocommerce-order-downloads', $screen->id, 'normal');
        //Hide the "Order actions" meta box.
        remove_meta_box('woocommerce-order-actions', $screen->id, 'side');
        //Hide the "Order notes" meta box.
        remove_meta_box('woocommerce-order-notes', $screen->id, 'side');
        //Hide woocommerce dashboard widget
        remove_meta_box('wc_admin_dashboard_setup', 'dashboard', 'normal');
        remove_meta_box('reduk_dashboard_widget', 'dashboard', 'side');
        //old mtrl-core
        remove_meta_box( 'woocommerce_dashboard_status', 'dashboard', 'normal');
    }
add_action('add_meta_boxes', 'wp_hide_woocommerce_metaboxes', 993);

function wp_hide_woocommerce_menus() {
        if (!is_super_admin()) {
        //Hide "WooCommerce → Status".
             remove_submenu_page('woocommerce', 'wc-status');
        }
        //Hide "WooCommerce → Extensions".
        remove_submenu_page('woocommerce', 'wc-addons');
        remove_submenu_page('woocommerce-marketing', 'admin.php?page=wc-admin&path=/marketing');
        //Hide "Marketing → Coupons".
        //remove_submenu_page('woocommerce-marketing', 'edit.php?post_type=shop_coupon');
        //Hide "Settings → Privacy"
        remove_submenu_page('options-general.php', 'options-privacy.php');
    }
add_action('admin_menu', 'wp_hide_woocommerce_menus', 992);

    // function wp_hide_woocommerce_dashboard_widgets() {
    //     $screen = get_current_screen();
    //     if ( !$screen ) {
    //         return;
    //     }
    //     remove_meta_box('wc_admin_dashboard_setup', 'dashboard', 'normal');
    //     remove_meta_box('reduk_dashboard_widget', 'dashboard', 'side');
    // }
    // add_action('wp_dashboard_setup', 'wp_hide_woocommerce_dashboard_widgets', 991);
?>