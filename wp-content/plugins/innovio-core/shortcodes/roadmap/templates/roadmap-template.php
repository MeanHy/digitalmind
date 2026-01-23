<div class="mkdf-roadmap <?php echo esc_attr($holder_classes); ?>">
    <span class="mkdf-roadmap-start-label"><?php echo esc_html($start_label)?></span>
    <span class="mkdf-roadmap-end-label"><?php echo esc_html($end_label)?></span>
    <div class="mkdf-roadmap-line">
        <span class="mkdf-rl-arrow-left">
            <i class="mkdf-icon-font-awesome fa fa-angle-left"></i>
        </span>
        <span class="mkdf-rl-arrow-right">
            <i class="mkdf-icon-font-awesome fa fa-angle-right"></i>
        </span>
    </div>
<!--    <div class="mkdf-roadmap-holder">-->
        <?php if (is_array($stage) && count($stage)) { ?>
            <div class="mkdf-roadmap-inner-holder clearfix">
            <?php foreach($stage as $key => $stage_item) {
                $stage_item['number'] = $key;
                $quartal_counter = $stage_item['number'] + 1;
                $additional = $this_object->getItemAdditional($stage_item);
                $item_classes = $additional['classes'];
                $item_style = $additional['style'];
                ?>
                <div <?php innovio_mikado_class_attribute($item_classes);?>>
                    <span class="mkdf-roadmap-curve mkdf-roadmap-curve-1"></span>
                    <span class="mkdf-roadmap-curve mkdf-roadmap-curve-2"></span>
                    <span class="mkdf-roadmap-curve mkdf-roadmap-curve-3"></span>
                    <div class="mkdf-roadmap-item-circle-holder">
                        <div class="mkdf-roadmap-item-before-circle"></div>
                        <div class="mkdf-roadmap-item-circle"></div>
                        <div class="mkdf-roadmap-item-after-circle"></div>
                    </div>
                    <?php if (array_key_exists('stage_title', $stage_item)) { ?>
                    <div class="mkdf-roadmap-item-stage-title-holder">
                        <span class="mkdf-ris-title">
                            <?php echo esc_html($stage_item['stage_title'])?>
                        </span>
                    </div>
                    <?php } ?>
                    <span class="mkdf-roadmap-quartal">Q<?php echo esc_html($quartal_counter) ?></span>
                </div>
            <?php } ?>
            </div>
        <?php } ?>
<!--    </div>-->
</div>