<!-- Posts -->
<?php if ($news && count($news) > 0) {?>
    <!-- item -->
    <?php foreach($news as $item) {?>
        <?php
            $content = wp_strip_all_tags($item -> post_content, true);
            $content = wp_trim_words($content, CHAR_LIMIT, '');
            $post_thumbnail = $item -> image_url;
            if (empty($item -> image_url)) {
                $post_thumbnail = DEF_IMAGES.'no-image.png';
            }
            $background = ' style="background-image: url('.$post_thumbnail.')"';
        ?>
        <a class="item news-item" href="<?php echo $item -> href?>">
            <div class="item-inner">
                <h3><?php echo $item -> post_title?></h3>
                <div class="item-img" <?php echo $background?>></div>
                <div class="desc"><?php echo ($content) ? $content.'<span class="more">...'.__('続きを読む', TEXTDOMAIN).'</span>' : ''?></div>
                <p class="date"><?php echo get_the_date('Y/m/d', $item -> post_id)?></p>
            </div>
        </a>
    <?php }?>
    <!-- //item -->
<?php }?>
<!-- //Posts -->