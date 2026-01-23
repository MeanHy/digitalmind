<button type="submit" <?php innovio_mikado_inline_style($button_styles); ?> <?php innovio_mikado_class_attribute($button_classes); ?> <?php echo innovio_mikado_get_inline_attrs($button_data); ?> <?php echo innovio_mikado_get_inline_attrs($button_custom_attrs); ?>>
    <span class="mkdf-btn-text"><?php echo esc_html($text); ?></span>
    <?php if($type !== 'simple') {
        echo innovio_mikado_icon_collections()->renderIcon( $icon, $icon_pack );
        } else {
            echo innovio_mikado_icon_collections()->renderIcon( 'icon_plus', 'font_elegant' );
        }
    ?>
</button>