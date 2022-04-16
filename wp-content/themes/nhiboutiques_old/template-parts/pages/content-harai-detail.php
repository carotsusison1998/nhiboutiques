<?php
    $id = $post -> ID;
    $banner = get_custom_field_by_post_id('banner', $id);
    $japanse_link_obj = get_custom_field_by_post_id('video_japanese', $id);
    $video_englist_link_obj = get_custom_field_by_post_id('video_englist', $id);
    $japanse_link = "";
    $english_link = "";
    if (!empty($japanse_link_obj['link'])) {
        $japanse_link = $japanse_link_obj['link'];
    }
    if (!empty($video_englist_link_obj['link'])) {
        $english_link = $video_englist_link_obj['link'];
    }
?>
<div class="harai-detail">
    <?php if (!empty($banner['url'])){?>
        <div class="container banner-container">
            <div class="banner"><img src="<?php echo $banner['url']?>" alt="" /></div>
        </div>
    <?php }?>
    <div class="container content-container">
    	<h1 class="title"><?php echo $post -> post_title?></h1>
        <div class="content">
            <?php
                while ( have_posts() ) : the_post();
                    the_content();
                endwhile;
            ?>
        </div>
        <div class="group-link">
            <div class="inner">
                <div class="row">
                    
                </div>
            </div>
        </div>
         <!-- social -->
        <?php echo get_template_part(TEMPLATES_PARTS, 'share');?>
        <!-- // social -->
    </div>
</div>