<?php
/**
* Template Name: Register Page
*/
?>
<?php get_header();?>
<?php
	//業界
	$industry = get_custom_field_by_post_id('register_industry', $post -> ID);
	$industry_data = array();
	if ($industry && count($industry) > 0) {
		$i = 1;
		foreach($industry as $item) {
			$industry_detail['id'] = $i;
			$industry_detail['name'] = $item['title'];
			$industry_detail['child'] = array();
			//Child list
			$childs = $item['child'];
			if ($childs && count($childs) > 0) {
				foreach($childs as $child) {
					array_push($industry_detail['child'], $child['title']);
				}
			}
			array_push($industry_data, $industry_detail);
			$i ++;
		}
	}
	//HRAI提携パートナー名（紹介者）
	$partners = get_custom_field_by_post_id('register_harai_partner', $post -> ID);
	//人事経験年数
	$year_in_hr = get_custom_field_by_post_id('register_year_in_hr', $post -> ID);
	$is_user_login = false;
	if(!empty($_SESSION[HARAI_USER])) {
        $is_user_login = true;
    }
?>
<!-- register -->
<div class="harai-register contact">
	<!-- Container -->
	<div class="container register-container">
		<div class="step <?php echo ($is_user_login) ? ' step3' : ''?>"></div>
		<form id="frm-register">
			<?php if($is_user_login){?>
				<?php
			        ob_start();
		            include( get_template_directory().'/template-parts/pages/content-register-step3.php' );
		            echo ob_get_clean();
				?>
			<?php }else{?>
				<!-- Step 1 -->
				<div class="register-step1-group">
					<?php
				        ob_start();
			            include( get_template_directory().'/template-parts/pages/content-register-step1.php' );
			            echo ob_get_clean();
					?>
				</div>
				<!-- Step 1 -->
			<?php }?>
		</form>
		<!-- social -->
        <?php echo get_template_part(TEMPLATES_PARTS, 'share');?>
        <!-- // social -->
	</div>
	<!-- //Container -->
</div>
<!-- //register -->
<?php
	wp_enqueue_script('def-js-register', DEF_SCRIPTS. 'components/register.js', array(), date('YmdHis'));
?>
<script type="text/javascript">
    jQuery(document).ready(function(){
    	var registerObject = {
            industry_data: '<?php echo base64_encode(json_encode($industry_data))?>'
        };
        register.onPageLoad(registerObject);
    });
</script>
<?php get_footer();?>