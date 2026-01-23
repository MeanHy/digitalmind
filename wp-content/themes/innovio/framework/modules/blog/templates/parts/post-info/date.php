<?php
$month = get_the_time('m');
$year = get_the_time('Y');
$title = get_the_title();
?>
<div itemprop="dateCreated" class="mkdf-post-info-date entry-date published updated">
    <?php if(empty($title) && innovio_mikado_blog_item_has_link()) { ?>
        <a itemprop="url" href="<?php the_permalink() ?>">
    <?php } else { ?>
        <a itemprop="url" href="<?php echo get_month_link($year, $month); ?>">
    <?php } ?>
            <svg version="1.1" ixmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                 viewBox="0 0 20 16" style="enable-background:new 0 0 20 16;" xml:space="preserve" width="20" height="16">
            <path class="st0" d="M16,1.7V0.5C16,0.2,15.8,0,15.5,0S15,0.2,15,0.5v1.2H5V0.5C5,0.2,4.8,0,4.5,0S4,0.2,4,0.5v1.2H0V16h20V1.7H16z
                 M19,15H1V5.7h18V15z M19,4.7H1v-2h3v0.8C4,3.8,4.2,4,4.5,4S5,3.8,5,3.5V2.7h10v0.8C15,3.8,15.2,4,15.5,4S16,3.8,16,3.5V2.7h3V4.7z"
                            />
            </svg>
        <?php the_time(get_option('date_format')); ?>
        </a>
    <meta itemprop="interactionCount" content="UserComments: <?php echo get_comments_number(innovio_mikado_get_page_id()); ?>"/>
</div>