<div class="mkdf-ps-image-holder">
    <div class="mkdf-ps-image-inner">
        <?php
        $media = innovio_core_get_portfolio_single_media();
    
        if(is_array($media) && count($media)) : ?>
            <?php foreach($media as $single_media) : ?>
                <div class="mkdf-ps-image">
                    <?php innovio_core_get_portfolio_single_media_html($single_media); ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<div class="mkdf-grid-row">
	<div class="mkdf-grid-col-9">
        <?php innovio_core_get_cpt_single_module_template_part('templates/single/parts/content', 'portfolio', $item_layout); ?>
    </div>
	<div class="mkdf-grid-col-3">
        <div class="mkdf-ps-info-holder">
            <h5 class="mkdf-ps-info"><?php echo esc_html__("Information", 'innovio-core')?></h5>

            <?php
            //get portfolio custom fields section
            innovio_core_get_cpt_single_module_template_part('templates/single/parts/custom-fields', 'portfolio', $item_layout);

            //get portfolio categories section
            innovio_core_get_cpt_single_module_template_part('templates/single/parts/categories', 'portfolio', $item_layout);
            
            //get portfolio date section
            innovio_core_get_cpt_single_module_template_part('templates/single/parts/date', 'portfolio', $item_layout);
            
            //get portfolio tags section
            innovio_core_get_cpt_single_module_template_part('templates/single/parts/tags', 'portfolio', $item_layout);
            ?>
        </div>
    </div>
</div>