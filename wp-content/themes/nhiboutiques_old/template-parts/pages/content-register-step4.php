<div class="register-step4-group">
	<div class="intro">
		<p class="title"><?php echo __('内容確認', TEXTDOMAIN)?></p>
	</div>
	<div class="register-step register-step4">
		<!-- Item -->
		<div class="item">
			<div class="title">
				<?php echo __('漢字氏名', TEXTDOMAIN)?>
			</div>
			<div class="control">
				<?php echo (!empty($data['kanji_name1'])) ? $data['kanji_name1'] : ''?>&nbsp;&nbsp;<?php echo (!empty($data['kanji_name2'])) ? $data['kanji_name2'] : ''?>
			</div>
		</div>
		<!-- //Item -->
		<!-- Item -->
		<div class="item">
			<div class="title">
				<?php echo __('ローマ字氏名<br />（英字半角）', TEXTDOMAIN)?>
			</div>
			<div class="control">
				<?php echo (!empty($data['sir_name'])) ? $data['sir_name'] : ''?>&nbsp;&nbsp;<?php echo (!empty($data['first_name'])) ? $data['first_name'] : ''?>&nbsp;&nbsp;<?php echo (!empty($data['middle_name'])) ? $data['middle_name'] : ''?>
			</div>
		</div>
		<!-- //Item -->
		<!-- Item -->
		<div class="item">
			<div class="title">
				<?php echo __('メールアドレス<br/>（携帯以外）', TEXTDOMAIN)?>
			</div>
			<div class="control">
				<?php echo (!empty($data['email'])) ? $data['email'] : ''?>
			</div>
		</div>
		<!-- //Item -->
		<!-- Item -->
		<div class="item">
			<div class="title">
				<?php echo __('電話番号', TEXTDOMAIN)?>
			</div>
			<div class="control">
				<?php echo (!empty($data['phone'])) ? $data['phone'] : ''?>
			</div>
		</div>
		<!-- //Item -->
		<!-- Item -->
		<div class="item">
			<div class="title">
				<?php echo __('所属組織', TEXTDOMAIN)?>
			</div>
			<div class="control">
				<?php echo (!empty($data['organization'])) ? $data['organization'] : ''?>
			</div>
		</div>
		<!-- //Item -->
		<!-- Item -->
		<div class="item">
			<div class="title">
				<?php echo __('業界', TEXTDOMAIN)?>
			</div>
			<div class="control">
				<?php echo (!empty($data['big_industry_value'])) ? $data['big_industry_value'] : ''?>&nbsp;&nbsp;<?php echo (!empty($data['small_industry'])) ? $data['small_industry'] : ''?>
			</div>
		</div>
		<!-- //Item -->
		<!-- Item -->
		<div class="item">
			<div class="title">
				<?php echo __('所属部署', TEXTDOMAIN)?>
			</div>
			<div class="control">
				<?php echo (!empty($data['department'])) ? $data['department'] : ''?>
			</div>
		</div>
		<!-- //Item -->
		<!-- Item -->
		<div class="item">
			<div class="title">
				<?php echo __('役職', TEXTDOMAIN)?>
			</div>
			<div class="control">
				<?php echo (!empty($data['title'])) ? $data['title'] : ''?>
			</div>
		</div>
		<!-- //Item -->
		<!-- Item -->
		<div class="item">
			<div class="title">
				<?php echo __('職種', TEXTDOMAIN)?>
			</div>
			<div class="control">
				<?php echo (!empty($data['occupation'])) ? $data['occupation'] : ''?>
			</div>
		</div>
		<!-- //Item -->
		<!-- Item -->
		<div class="item">
			<div class="title">
				<?php echo __('人事経験年数', TEXTDOMAIN)?>
			</div>
			<div class="control">
				<?php echo (!empty($data['year_in_hr'])) ? $data['year_in_hr'] : ''?>
			</div>
		</div>
		<!-- //Item -->
		<!-- Item -->
		<div class="item">
			<div class="title">
				<?php echo __('教材など<br>送付先住所', TEXTDOMAIN)?>
			</div>
			<div class="control">
				<?php echo (!empty($data['teaching_materials'])) ? $data['teaching_materials'] : ''?>&nbsp;&nbsp;<?php echo (!empty($data['mailing_address'])) ? $data['mailing_address'] : ''?>
			</div>
		</div>
		<!-- //Item -->
		<!-- Item -->
		<div class="item">
			<div class="title">
				<?php echo __('HRAI提携<br>パートナー名<br>（紹介者）', TEXTDOMAIN)?>
			</div>
			<div class="control">
				<?php echo (!empty($data['partner'])) ? $data['partner'] : ''?>&nbsp;&nbsp;<?php echo (!empty($data['partner_referral'])) ? $data['partner_referral'] : ''?>
			</div>
		</div>
		<!-- //Item -->
		<!-- Item -->
		<div class="item">
			<div class="title">
				<?php echo __('お申し込みプラン', TEXTDOMAIN)?>
			</div>
			<div class="control">
				<?php echo (!empty($data['application_plan'])) ? $data['application_plan'] : ''?>
			</div>
		</div>
		<!-- //Item -->
		<!-- Item -->
		<div class="item">
			<div class="title">
				<?php echo __('講座ご予約日', TEXTDOMAIN)?>
			</div>
			<div class="control">
				<?php echo (!empty($data['course_reservation_date'])) ? $data['course_reservation_date'] : ''?>
			</div>
		</div>
		<!-- //Item -->
	</div>
	<!-- //Step 1 -->
	<p class="send">
		<input type="button" value="<?php echo __('登録する', TEXTDOMAIN)?>" id="send-step4">
	</p>
	<div class="desc desc-step4">
		<p>※送信後、振込先の案内が登録したメールアドレス宛に送信されます。</p>
		<p>@hr-ai.orgからのメールが受信できるように設定をお願いします。</p>
	</div>
</div>