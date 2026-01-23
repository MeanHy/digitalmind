<?php
function hide_link_mycred_main(){
    ?>
        <style>
            #mycred-thank-you-text, #mycred-social-media{display: none}
            #accordion div[id^="ui-id-"]{position: relative!important;}
        </style>
    <?php
}
function hide_link_mycred(){
    ?>
        <style>
            a[href^="https://codex.mycred.me/"],a[href^="http://codex.mycred.me/"]{display: none}
        </style>
    <?php
}
function hide_link_mycred_addon(){
    ?>
        <style>
            a[href$="mycred-addons&mycred_addons=free_addons"],a[href$="mycred-addons&mycred_addons=premium_addons"], .theme.add-new-theme, .addons-main-nav{display: none}
        </style>
    <?php
}
function hide_link_mycred_gateways(){
    ?>
        <style>
           #accordion h4:nth-last-child(2){display: none}
        </style>
    <?php
}
function hide_link_mycred_cashcreds(){
    ?>
        <style>
           #accordion h4:nth-last-child(2){display: none}
        </style>
    <?php
}
function hide_link_mycred_tools(){
    ?>
    <script>
        var $tools = "<?php echo __('Tools','mycred') ?>";
        var $bulk_assign = "<?php echo __('Bulk Assign','mycred') ?>";
        var $award_revoke = "<?php echo __('Award/ Revoke','mycred') ?>";
        var $award_revoke_to_all_uers = "<?php echo __('Award/ Revoke to All Users','mycred') ?>";
        var $check_if_you_award_all_users = "<?php echo __('Check if you want to award to all users.','mycred') ?>";
        var $users_to_award_revoke = "<?php echo __('Users to Award/ Revoke','mycred') ?>";
        var $choose_users_to_award = "<?php echo __('Choose users to award.','mycred') ?>";
        var $role_to_award_revoke = "<?php echo __('Roles to Award/ Revoke','mycred') ?>";
        var $choose_roles_to_award = "<?php echo __('Choose roles to award.','mycred') ?>";
        var $update = "<?php echo __('Update','mycred') ?>";
    </script>
    <?php
    wp_enqueue_script( 'script-cus-mycred', plugins_url('assets/js/mycred.js',__DIR__), array ( 'jquery' ), 1.1, true);
    ?>
        <script>
            restring_tools()
        </script>
    <?php
}
function hide_link_mycred_default(){
    ?>
    <script>
        var $all = "<?php echo __('All','mycred') ?>";
        var $published = "<?php echo __('Published','mycred') ?>";
    </script>
    <?php
    wp_enqueue_script( 'script-cus-mycred', plugins_url('assets/js/mycred.js',__DIR__), array ( 'jquery' ), 1.1, true);
    ?>
        <script>
            restring_defaults()
        </script>
    <?php
}