<?php
	$register_page_id = '';
    $register_page = get_page_by_page_template('page-template/template-register.php');
    if ($register_page) {
        $register_page_id = $register_page -> ID;
    }
	//お申し込みプラン
	$application_plan = get_custom_field_by_post_id('register_application_plan', $register_page_id);
	//講座ご予約日
	$course_reservation_date = get_custom_field_by_post_id('register_course_reservation_date', $register_page_id);
?>
<div class="register-step3-group">
	<div class="intro">
		<p class="title"><?php echo __('お申し込みプランと講座予約日のご指定', TEXTDOMAIN)?></p>
	</div>
	<div class="register-step register-step3">
		<!-- Item -->
		<div class="item">
			<div class="title">
				<?php echo __('お申し込みプラン', TEXTDOMAIN)?><span class="required">*</span>
			</div>
			<div class="control">
				<div class="row">
					<div class="col col-full">
						<select id="application_plan" name="application_plan">
							<option value=""><?php echo __('お申し込みプランを選択', TEXTDOMAIN)?></option>
							<?php if($application_plan && count($application_plan) > 0){?>
								<?php foreach($application_plan as $item){?>
									<option value="<?php echo $item['title']?>"><?php echo $item['title']?></option>
								<?php }?>
							<?php }?>
						</select>
					</div>
				</div>
			</div>
		</div>
		<!-- //Item -->
		<!-- Item -->
		<div class="item">
			<div class="title">
				<?php echo __('講座ご予約日', TEXTDOMAIN)?><span class="required">*</span>
			</div>
			<div class="control">
				<div class="row">
					<div class="col">
						<select id="course_reservation_date" class="full" name="course_reservation_date">
							<option value=""><?php echo __('講座ご予約日を選択', TEXTDOMAIN)?></option>
							<?php if($course_reservation_date && count($course_reservation_date) > 0){?>
								<?php foreach($course_reservation_date as $item){?>
									<option value="<?php echo $item['title']?>"><?php echo $item['title']?></option>
								<?php }?>
							<?php }?>
						</select>
					</div>
				</div>
			</div>
		</div>
		<!-- //Item -->
	</div>
	<!-- //Step 1 -->
	<p class="send">
		<input class="<?php echo (!empty($_SESSION[HARAI_USER])) ? 'user-step3-send' : ''?>" type="button" value="<?php echo __('登録する', TEXTDOMAIN)?>" id="send-step3">
	</p>
	<div class="desc">
		<p>講座ご予約確定は講座料金を銀行振込いただいてからになります。確定いたしましたらメールでお知らせいたします。</p>
	</div>
</div>