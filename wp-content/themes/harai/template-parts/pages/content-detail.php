<?php
    $content_info = get_custom_field_by_post_id('_detail_content_info', $post -> ID);
?>
<div class="page-detail">
    <div class="container">
        <p class="date"><?php echo get_the_date('Y/m/d')?></p>
    	<h1 class="title"><?php echo $post -> post_title?></h1>
        <div class="content">
            <?php
                while ( have_posts() ) : the_post();
                    the_content();
                endwhile;
            ?>
        </div>
        <?php if ($content_info && (!empty($content_info['_detail_page_image']) || !empty($content_info['_detail_page_title']) || !empty($content_info['_detail_page_description']))){?>
            <div class="content-info">
                <div class="inner">
                    <div class="tbl">
                        <div class="tbl-row">
                            <div class="tbl-cell cell-first">
                                <div class="img">
                                    <?php if (!empty($content_info['_detail_page_image']['url'])){?>
                                        <img src="<?php echo $content_info['_detail_page_image']['url']?>" alt="" />
                                    <?php }else {?>
                                        <img src="<?php echo DEF_IMAGES?>no-image.png" alt="" />
                                    <?php }?>
                                </div>
                            </div>
                            <div class="tbl-cell">
                                <?php if (!empty($content_info['_detail_page_title'])){?><p class="title"><?php echo $content_info['_detail_page_title']?></p><?php }?>
                                <?php if (!empty($content_info['_detail_page_description'])){?><p class="desc"><?php echo nl2br($content_info['_detail_page_description'])?></p><?php }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
         <!-- social -->
        <?php echo get_template_part(TEMPLATES_PARTS, 'share');?>
        <!-- // social -->
    </div>
</div>