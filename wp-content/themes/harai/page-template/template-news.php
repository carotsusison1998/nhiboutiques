<?php
/**
* template-news.php
* Template Name: 新着コラム Page
*/
?>
<?php get_header();?>
<?php
	$post_list = get_post_list();
	$news = harai_get_news_list();
	//Total news list
	$total_current_article = harai_get_total_news_list();
	$total_article_limit = TOTAL_ARTICLE_LIMIT;
?>
<!-- News -->
<div class="news-page">
	<!-- Container -->
	<div class="container">
		<div id="articles">
			<?php if ($post_list && count($post_list) > 0){?>
				<?php $i=0; foreach($post_list as $item){?>
					<?php
			            $content = wp_strip_all_tags($item -> post_content, true);
			            $content = wp_trim_words($content, CHAR_LIMIT, '');
			            $post_thumbnail = $item -> image_url;
                        if (empty($item -> image_url)) {
                            $post_thumbnail = DEF_IMAGES.'no-image.png';
                        }
                        $background = ' style="background-image: url('.$post_thumbnail.')"';
			        ?>
			        <a class="item" href="<?php echo $item -> href?>">
			            <div class="item-inner">
			            	<h3><?php echo $item -> post_title?></h3>
			                <div class="item-img" <?php echo $background?>></div>
			                <div class="desc"><?php echo ($content) ? $content.'<span class="more">...'.__('続きを読む', TEXTDOMAIN).'</span>' : ''?></div>
			                <p class="date"><?php echo get_the_date('Y/m/d', $item -> post_id)?></p>
			            </div>
			        </a>
				<?php $i++; }?>
			<?php }?>
			<?php
	            ob_start();
	            include_once(get_template_directory() . '/template-parts/pages/content-news-items.php');
	            echo ob_get_clean();
			?>
		</div>
		<?php if ($total_current_article*1 > $total_article_limit) {?>
			<p class="read-more"><a href="javascript:void(0);"><?php echo __('READ　MORE', TEXTDOMAIN)?></a></p>
		<?php }?>
		<!-- social -->
        <?php echo get_template_part(TEMPLATES_PARTS, 'share');?>
        <!-- // social -->
	</div>
	<!-- //Container -->
</div>
<!-- //News -->
<?php
	wp_enqueue_script('def-js-news', DEF_SCRIPTS. 'components/news.js', array(), date('YmdHis'));
?>
<?php get_footer();?>