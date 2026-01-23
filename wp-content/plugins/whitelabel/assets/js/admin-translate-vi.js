$ = jQuery;
jQuery(document).ready(function ($) {
    $('#menu-plugins a .wp-menu-name').html('Tính Năng');
    $('#menu-plugins ul li:nth-child(2) a').html('Tính năng đã cài đặt');
    $('#menu-plugins ul li:nth-child(3) a').html('Cài Mới Tính Năng');
    $('#toplevel_page_wbfb-botsetting-page a .wp-menu-name').html('Chat Messenger');
    $('#toplevel_page_wbfb-botsetting-page ul li.wp-first-item a.wp-first-item').html('Chat Messenger');
    $("a[href='admin.php?page=wc-admin&path=%2Fanalytics%2Fcategories&chart=items_sold&orderby=items_sold&order=desc'] div.woocommerce-summary__item-label span").html('Sản Phẩm Đã Bán');
});

jQuery(document).ready(function () {
    $('a[href="admin.php?page=wc-admin&path=%2Fanalytics%2Fcategories&chart=items_sold&orderby=items_sold&order=desc"] div.woocommerce-summary__item-label span').each(function() {
        // get element text
        var text = $(this).text();
        // modify text
        text = text.replace('Items Sold', 'Hàng Đã Bán');
        // update element text
        $(this).text(text); 
    });
});