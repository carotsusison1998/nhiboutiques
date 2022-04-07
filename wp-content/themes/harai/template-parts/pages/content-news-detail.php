<!-- Page banner -->
<?php
    $page_banner = '';
    $news_page_url = '';
    $news_page = get_page_by_page_template('page-template/template-news.php');
    if ($news_page) {
        $page_banner = get_custom_field_by_post_id('page_banner', $news_page -> ID);
        $news_page_url = $news_page -> url;  
    }
    //Get date
    $post_date = explode(' ', $post -> post_date);
    $post_date = str_replace('-', '.', $post_date[0]);
    //Get name of day by date
    $name_of_day = convert_date_to_dayname($post_date[0]);
    //Get page type
    $page_type = get_custom_field_by_post_id('_news_type', $post -> ID);
?>
<?php if (!empty($page_banner['url'])) {?>
<div class="page-banner news-banner">
    <div class="container" style="background-image: url(<?php echo $page_banner['url']?>);"></div>
</div>
<?php }?>
<!-- //Page banner -->
<!-- Share -->
<?php echo get_template_part(TEMPLATES_PARTS, 'share');?>
<!-- News -->
<div class="news-page">
    <!-- Container -->
    <div class="container">
        <!-- Tab -->
        <ul class="page-tab">
            <li data-id="-1" class="all"><?php echo __('ALL', TEXTDOMAIN)?></li>
            <li data-id="1" class="news <?php echo ($page_type*1 == 1) ? ' active' : ''?>"><?php echo __('NEWS', TEXTDOMAIN)?></li>
            <li data-id="2" class="contents <?php echo ($page_type*1 == 2) ? ' active' : ''?>"><?php echo __('CONTENTS', TEXTDOMAIN)?></li>
        </ul>
        <!-- //Tab -->
        <div id="articles" class="page-posts">
        </div>
        <!-- Article detail -->
        <div class="article-detail">
            <h1 class="title break-word"><?php echo $title = $post -> post_title?></h1>
            <p class="date"><?php echo $post_date.' '.$name_of_day;?></p>
            <div class="content break-word">
                <?php
                    while ( have_posts() ) : the_post();
                        the_content();
                    endwhile;
                ?>
            </div>
        </div>
        <!-- //Article detail -->
        <p class="back-page"><a href="<?php echo $news_page_url?>"><img src="<?php echo DEF_IMAGES?>btn-news-list.png" /></a></p>
    </div>
    <!-- //Container -->
</div>
<!-- //News -->
<?php
    wp_enqueue_script('def-js-news', DEF_SCRIPTS. 'components/news.js', array(), date('YmdHis'));
?>
<script type="text/javascript">
    jQuery(document).ready(function(){
        var pageUrl = '<?php echo base64_encode(json_encode($news_page_url))?>';
        news.onPageLoad(pageUrl, true);
    });
</script>