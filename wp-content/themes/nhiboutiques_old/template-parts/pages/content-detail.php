<?php
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
         <!-- social -->
        <?php echo get_template_part(TEMPLATES_PARTS, 'share');?>
        <!-- // social -->
    </div>
</div>