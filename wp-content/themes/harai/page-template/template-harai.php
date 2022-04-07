<?php
/**
* Template Name: Harai Page
*/
?>
<?php get_header();?>
<?php
    $organization = get_organization_list();
?>
<!-- Harai -->
<div class="harai-page">
    <!-- Container -->
    <div class="container">
        <?php
            while ( have_posts() ) : the_post();
                the_content();
            endwhile;
        ?>
        <!-- manager -->
        <?php if ($organization && count($organization) > 0){?>
            <?php
                $organization_first = $organization[0];
                $japanse_link = "";
                $english_link = "";
                $japanse_link_obj = get_custom_field_by_post_id('video_japanese', $organization_first -> post_id);
                $video_englist_link_obj = get_custom_field_by_post_id('video_englist', $organization_first -> post_id);
                if (!empty($japanse_link_obj['link'])) {
                    $japanse_link = $japanse_link_obj['link'];
                }
                if (!empty($video_englist_link_obj['link'])) {
                    $english_link = $video_englist_link_obj['link'];
                }
                //$content = apply_filters('the_content', $organization_first -> post_content);
                $description = get_custom_field_by_post_id('description', $organization_first -> post_id);
                if ($description) {
                    $description = wp_trim_words($description, ORGANIZATION_CHAR_LIMIT, '...');
                }
            ?>
            <div class="manager">
                <div class="row mobile">
                    <div class="col left">
                        <a href="<?php echo $organization_first -> href?>">
                            <?php if (!empty($organization_first -> image_url)){?>
                                <img src="<?php echo $organization_first -> image_url?>" alt="<?php echo $organization_first -> post_title?>">
                            <?php } else {?>
                                <img src="<?php echo DEF_IMAGES?>no-image.png" alt="">
                            <?php }?>
                        </a>
                    </div>
                    <div class="col right">
                        <div class="top">
                            <div class="title"><?php echo $organization_first -> post_title?></div>
                            <div class="content break-word">
                                <?php echo $description?><a href="<?php echo $organization_first -> href?>" class="more"><?php echo __('続きを読む', TEXTDOMAIN)?></a>
                            </div>
                        </div>
                        <?php if ($japanse_link || $english_link){?>
                            <div class="bottom">
                                <?php if ($japanse_link){?><a target="_blank" class="jp" href="<?php echo $japanse_link?>"><?php echo __('メッセージ動画を見る（日本語）', TEXTDOMAIN)?></a><?php }?>
                                <?php if ($english_link){?><a target="_blank" class="en" href="<?php echo $english_link?>"><?php echo __('Watch message video（English）', TEXTDOMAIN)?></a><?php }?>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        <?php }?>
        <!-- // manager -->
        <!-- director -->
        <?php if ($organization && count($organization) > 2){?>
        <div class="director">
            <h3 class="title"><?php echo __('理事', TEXTDOMAIN)?></h3>
            <div class="content">
                <div class="row">
                    <?php $i=0; foreach($organization as $item){?>
                        <?php
                            $japanse_link = "";
                            $english_link = "";
                            $japanse_link_obj = get_custom_field_by_post_id('video_japanese', $item -> post_id);
                            $video_englist_link_obj = get_custom_field_by_post_id('video_englist', $item -> post_id);
                            if (!empty($japanse_link_obj['link'])) {
                                $japanse_link = $japanse_link_obj['link'];
                            }
                            if (!empty($video_englist_link_obj['link'])) {
                                $english_link = $video_englist_link_obj['link'];
                            }
                        ?>
                        <?php if ($i > 0 && $i < (count($organization) - 1)){?>
                            <div class="col item">
                                <?php if ($item -> image_url){?>
        						      <img src="<?php echo $item -> image_url?>" alt="<?php echo $item -> post_title?>">
                                <?php } else {?>
                                    <img src="<?php echo DEF_IMAGES?>no-image.png" alt="">
                                <?php }?>
                                <div class="row mobile info">
                                    <div class="title-name">
                                        <h3><?php echo $item -> post_title?></h3>
                                        <span><?php echo $item -> position?></span>
                                    </div>
                                    <div class="more">
                                        <a href="<?php echo $item -> href?>" class="read"><?php echo __('メッセージを読む', TEXTDOMAIN)?></a>
                                        <?php if ($japanse_link){?><a target="_blank" class="watch" href="<?php echo $japanse_link?>"><?php echo __('メッセージ動画を見る（日本語）', TEXTDOMAIN)?></a><?php }?>
                                        <?php if ($english_link){?><a target="_blank" class="watch-en" href="<?php echo $english_link?>"><?php echo __('Watch message video（English）', TEXTDOMAIN)?></a><?php }?>
                                    </div>
                                </div>
                            </div>
                        <?php }?>
                    <?php $i++; }?>
                </div>
            </div>
        </div>
        <?php }?>
        <!-- // director -->
        <!-- ceo -->
        <?php if ($organization && count($organization) > 1){?>
        <?php
            $organization_last = $organization[count($organization) - 1];
            $desc = get_custom_field_by_post_id('description', $organization_last -> post_id);
            if ($desc) {
                $desc = wp_trim_words($desc, ORGANIZATION1_CHAR_LIMIT, '...');
            }
        ?>
        <div class="ceo">
            <div class="row">
                <div class="col left">
                    <h2 class="title"><?php echo $organization_last -> post_title?></h2>
                    <p class="img-sp">
                        <a href="<?php echo $organization_last -> href?>">
                            <?php if ($organization_last -> image_url){?>
                                  <img src="<?php echo $organization_last -> image_url?>" alt="<?php echo $organization_last -> post_title?>">
                            <?php } else {?>
                                <img src="<?php echo DEF_IMAGES?>no-image.png" alt="">
                            <?php }?>
                        </a>
                    </p>
                    <div class="content">
                        <?php echo $desc?><a href="<?php echo $organization_last -> href?>" class="more"><?php echo __('続きを読む', TEXTDOMAIN)?></a>
                    </div>
                </div>
                <div class="col right pc">
                    <a href="<?php echo $organization_last -> href?>">
                        <?php if ($organization_last -> image_url){?>
                              <img src="<?php echo $organization_last -> image_url?>" alt="<?php echo $organization_last -> post_title?>">
                        <?php } else {?>
                            <img src="<?php echo DEF_IMAGES?>no-image.png" alt="">
                        <?php }?>
                    </a>
                </div>
            </div>
        </div>
        <?php }?>
        <!-- // ceo -->
        <!-- introduction -->
        <?php
            $instructors = get_instructor_list();
        ?>
        <?php if ($instructors && count($instructors) > 0){?>
            <div class="introduction">
                <h2 class="title"><?php echo __('主席講師紹介', TEXTDOMAIN)?></h2>
                <div class="row content">
                    <?php foreach($instructors as $item){?>
                        <div class="col item">
                            <div class="img">
                                <a href="<?php echo $item -> href?>">
                                    <?php if ($item -> image_url){?>
            						  <img src="<?php echo $item -> image_url?>" alt="<?php echo $item -> post_title?>">
                                    <?php } else {?>
                                        <img src="<?php echo DEF_IMAGES?>no-image.png" alt="">
                                    <?php }?>
                                </a>
        					</div>
                            <div class="title-name">
                                <div class="name"><a href="<?php echo $item -> href?>"><span><?php echo $item -> post_title?></span></a></div>
                                <a href="<?php echo $item -> href?>" class="watch"><?php echo __('メッセージを読む＞', TEXTDOMAIN)?></a>
                            </div>
                        </div>
                    <?php }?>
                </div>
            </div>
        <?php }?>
        <!-- // introduction -->
        <!-- Footer content -->
        <?php 
            $footer_content = get_custom_field_by_post_id('_html_footer_content', $post -> ID);
            if ($footer_content) {
                $footer_content = apply_filters('the_content', $footer_content);
                echo $footer_content;
            }
        ?>
        <!-- // Footer content -->
        <!-- social -->
        <?php echo get_template_part(TEMPLATES_PARTS, 'share');?>
        <!-- // social -->
    </div>
    <!-- //Container -->
</div>
<script type="text/javascript">
    jQuery(document).ready(function(){
        var currentUrl = window.location.href;
        if (!currentUrl) {
            return;
        }
        currentUrl = currentUrl.split('#');
        if (currentUrl.length < 2) {
            return;
        }
        console.log(currentUrl[1]);
        if (currentUrl[1] !== 'introduction') {
            return;
        }
        var header = jQuery('#header');
        var introduction = jQuery('.introduction');
        var offsetT = introduction.offset().top - header.outerHeight();
        $('html, body').animate({scrollTop: offsetT}, 600);
    });
</script>
<!-- //Harai -->
<?php get_footer();?>