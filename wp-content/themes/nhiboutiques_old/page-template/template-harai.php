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