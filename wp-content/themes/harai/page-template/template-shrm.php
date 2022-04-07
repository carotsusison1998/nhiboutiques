<?php
/**
* Template Name: SHRMの資格認定 Page
*/
?>
<?php get_header();?>
<?php
    $essentials_programs = get_custom_field_by_post_id('shrm_essentials_programs', $post -> ID);
    $group1 = $essentials_programs['group_1'];
    $group2 = $essentials_programs['group_2'];
    $group3 = $essentials_programs['group_3'];
    $group4 = $essentials_programs['group_4'];
    $google_calendar = get_custom_field_by_post_id('google_calendar', $post -> ID);
    //Register page
    $register_page_url = '';
    $register_page = get_page_by_page_template('page-template/template-register.php');
    if ($register_page) {
        $register_page_url = $register_page -> url;
    }
    //Register page
    $harai_page_url = '';
    $harai_page = get_page_by_page_template('page-template/template-harai.php');
    if ($harai_page) {
        $harai_page_url = $harai_page -> url;
    }
?>
<!-- Hrai_Shrm Page -->
<div class="hrai_shrm">
    <!-- Container -->
    <div class="container">
        <?php
            while ( have_posts() ) : the_post();
                the_content();
            endwhile;
        ?>
        <!-- essential primary -->
        <div class="essential-bottom">
            <div class="row">
                <div class="col left">
                    <span><?php echo (!empty($group1['title'])) ? $group1['title'] : ''?></span>
                    <h2 class="title"><?php echo (!empty($group1['program'])) ? nl2br($group1['program']) : ''?></h2>
                    <div class="description">
                        <p><?php echo (!empty($group1['fee'])) ? nl2br($group1['fee']) : ''?></p>
                    </div>
                </div>
                <div class="col middle intro">
                    <div class="col-inner">
                        <p><?php echo (!empty($group1['training_course'])) ? nl2br($group1['training_course']) : ''?></p>
                    </div>
                </div>
                <div class="col right intro">
                    <div class="col-inner">
                        <p><?php echo (!empty($group1['training_course_1'])) ? nl2br($group1['training_course_1']) : ''?></p>
                    </div>
                </div>
            </div>
            <?php if ($group1['fee_1']){?>
                <div class="content">
                    <?php echo nl2br($group1['fee_1'])?>
                </div>
            <?php }?>
            <div class="row button-parent">
                <div class="button">
                    <a href="<?php echo $register_page_url?>"><?php echo __('お申し込み ＞', TEXTDOMAIN)?></a>
                    <p><?php echo (!empty($group1['note'])) ? nl2br($group1['note']) : ''?></p>
                </div>
            </div>
        </div>
        <!-- //essential primary -->
        <!-- title essential-other-one -->
        <h2 class="title essential-other"><?php echo __('その他の', TEXTDOMAIN)?><span> <?php echo __('SHRM ESSENTIALS プログラム', TEXTDOMAIN)?></span></h2>
        <!-- //title essential-other-one -->
        <!-- essential-other-one -->
        <div class="essential-bottom essential-other-one">
            <div class="row">
                <div class="col left">
                    <span><?php echo (!empty($group2['title'])) ? $group2['title'] : ''?></span>
                    <h2 class="title"><?php echo (!empty($group2['program'])) ? nl2br($group2['program']) : ''?></h2>
                    <div class="description">
                        <p><?php echo (!empty($group2['fee'])) ? nl2br($group2['fee']) : ''?></p>
                    </div>
                </div>
                <div class="col middle intro">
                    <div class="col-inner">
                        <p><?php echo (!empty($group2['training_course'])) ? nl2br($group2['training_course']) : ''?></p>
                    </div>
                </div>
                <div class="col right intro">
                    <div class="col-inner">
                        <p><?php echo (!empty($group2['training_course_1'])) ? nl2br($group2['training_course_1']) : ''?></p>
                    </div>
                </div>
            </div>
            <?php if ($group2['fee_1']){?>
                <div class="content">
                    <?php echo nl2br($group2['fee_1'])?>
                </div>
            <?php }?>
            <div class="row button-parent">
                <div class="button">
                    <a href="<?php echo $register_page_url?>"><?php echo __('お申し込み ＞', TEXTDOMAIN)?></a>
                    <p><?php echo (!empty($group2['note'])) ? nl2br($group2['note']) : ''?></p>
                </div>
            </div>
        </div>
        <!-- //essential-other-one -->
        <!-- essential-other-two -->
        <div class="essential-bottom essential-other-two">
            <div class="row">
                <div class="col left">
                    <span><?php echo (!empty($group3['title'])) ? $group3['title'] : ''?></span>
                    <h2 class="title"><?php echo (!empty($group3['program'])) ? nl2br($group3['program']) : ''?></h2>
                    <div class="description">
                        <p><?php echo (!empty($group3['fee'])) ? nl2br($group3['fee']) : ''?></p>
                    </div>
                </div>
                <div class="col middle intro">
                    <div class="col-inner">
                        <p><?php echo (!empty($group3['training_course'])) ? nl2br($group3['training_course']) : ''?></p>
                    </div>
                </div>
                <div class="col right intro">
                    <div class="col-inner">
                        <p><?php echo (!empty($group3['training_course_1'])) ? nl2br($group3['training_course_1']) : ''?></p>
                    </div>
                </div>
            </div>
            <?php if ($group3['fee_1']){?>
                <div class="content">
                    <?php echo nl2br($group3['fee_1'])?>
                </div>
            <?php }?>
            <div class="row button-parent">
                <div class="button">
                    <a href="<?php echo $register_page_url?>"><?php echo __('お申し込み ＞', TEXTDOMAIN)?></a>
                    <p><?php echo (!empty($group3['note'])) ? nl2br($group3['note']) : ''?></p>
                </div>
            </div>
        </div>
        <!-- //essential-other-two -->
        <!-- essential-other-three -->
        <div class="essential-bottom essential-other-three">
            <div class="row">
                <div class="col left">
                    <span><?php echo (!empty($group4['title'])) ? $group4['title'] : ''?></span>
                    <h2 class="title"><?php echo (!empty($group4['program'])) ? nl2br($group4['program']) : ''?></h2>
                    <div class="description">
                        <p><?php echo (!empty($group4['fee'])) ? nl2br($group4['fee']) : ''?></p>
                    </div>
                </div>
                <div class="col middle intro">
                    <div class="col-inner">
                        <p><?php echo (!empty($group4['training_course'])) ? nl2br($group4['training_course']) : ''?></p>
                    </div>
                </div>
                <div class="col right intro">
                    <div class="col-inner">
                        <p><?php echo (!empty($group4['training_course_1'])) ? nl2br($group4['training_course_1']) : ''?></p>
                    </div>
                </div>
            </div>
            <?php if ($group4['fee_1']){?>
                <div class="content">
                    <?php echo nl2br($group4['fee_1'])?>
                </div>
            <?php }?>
            <div class="row button-parent">
                <div class="button">
                    <a href="<?php echo $register_page_url?>"><?php echo __('お申し込み ＞', TEXTDOMAIN)?></a>
                    <p><?php echo (!empty($group4['note'])) ? nl2br($group4['note']) : ''?></p>
                </div>
            </div>
        </div>
        <!-- //essential-other-three -->
        <?php if ($google_calendar){?>
            <div class="google-calendar">
                <h2 class="title"><?php echo __('講座カレンダー', TEXTDOMAIN)?></h2>
                <?php echo apply_filters('the_content', $google_calendar)?>
            </div>
        <?php }?>
        <!-- instructor -->
        <div class="instructor">
            <img class="pc" src="<?php echo DEF_IMAGES ?>Instructor-introduction.png" alt="インストラクター紹介" />
            <img class="sp" src="<?php echo DEF_IMAGES ?>Instructor-introduction-sp.png" alt="インストラクター紹介" />
            <a href="<?php echo $harai_page_url?>#introduction" class="button"><?php echo __('メッセージを視聴する＞', TEXTDOMAIN)?></a>
        </div>
        <!-- //instructor -->
        <!-- social -->
        <?php echo get_template_part(TEMPLATES_PARTS, 'share');?>
        <!-- // social -->
    </div>
    <!-- //Container -->
</div>
<!-- //About -->
<?php get_footer();?>