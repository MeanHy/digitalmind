<?php if(innovio_mikado_core_plugin_installed()) { ?>
    <div class="mkdf-blog-like">
        <?php if( function_exists('innovio_mikado_get_like') ) innovio_mikado_get_like(); ?>
    </div>
<?php } ?>