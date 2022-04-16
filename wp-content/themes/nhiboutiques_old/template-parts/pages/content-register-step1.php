<div class="intro">
	<p class="title"><?php echo __('講座申し込みフォーム', TEXTDOMAIN)?></p>
	<p><?php echo __('※SHRMに登録される氏名です。お間違え無いよう再度ご確認ください。', TEXTDOMAIN)?></p>
	<p><?php echo __('＊Your name to be registered in SHRM as you type (please check its accuracy again)', TEXTDOMAIN)?></p>
</div>
<div class="register-step register-step1">
	<!-- Item -->
	<div class="item">
		<div class="title">
			<?php echo __('漢字氏名', TEXTDOMAIN)?><span class="required">*</span>
		</div>
		<div class="control">
			<div class="row">
				<div class="col">
					<input maxlength="100" type="text" name="kanji_name1" placeholder="<?php echo __('姓', TEXTDOMAIN)?>" required/>
				</div>
				<div class="col">
					<input maxlength="100" type="text" name="kanji_name2" placeholder="<?php echo __('名', TEXTDOMAIN)?>" required />
				</div>
			</div>
		</div>
	</div>
	<!-- //Item -->
	<!-- Item -->
	<div class="item">
		<div class="title">
			<?php echo __('ローマ字氏名<br />（英字半角）', TEXTDOMAIN)?><span class="required">*</span>
		</div>
		<div class="control">
			<div class="row">
				<div class="col">
					<input maxlength="100" type="text" name="sir_name" placeholder="<?php echo __('Sir Name', TEXTDOMAIN)?>" required />
				</div>
				<div class="col">
					<input maxlength="50" type="text" name="first_name" placeholder="<?php echo __('First Name', TEXTDOMAIN)?>" required />
				</div>
				<div class="col">
					<input maxlength="50" type="text" name="middle_name" placeholder="<?php echo __('Middle Name', TEXTDOMAIN)?>" />
				</div>
			</div>
		</div>
	</div>
	<!-- //Item -->
	<!-- Item -->
	<div class="item">
		<div class="title">
			<?php echo __('メールアドレス<br/>（携帯以外）', TEXTDOMAIN)?><span class="required">*</span>
		</div>
		<div class="control">
			<input maxlength="70" type="text" name="email" placeholder="<?php echo __('Email Address', TEXTDOMAIN)?>" required />
		</div>
	</div>
	<!-- //Item -->
	<!-- Item -->
	<div class="item">
		<div class="title">
			<?php echo __('電話番号', TEXTDOMAIN)?><span class="required">*</span>
		</div>
		<div class="control">
			<div class="row">
				<div class="col medium">
					<input maxlength="20" type="text" name="phone" placeholder="<?php echo __('Emergency contact (phone Number)', TEXTDOMAIN)?>" required />
				</div>
			</div>
		</div>
	</div>
	<!-- //Item -->
	<!-- Item -->
	<div class="item">
		<div class="title">
			<?php echo __('所属組織', TEXTDOMAIN)?><span class="required">*</span>
		</div>
		<div class="control">
			<div class="row">
				<div class="col medium">
					<input maxlength="200" type="text" name="organization" placeholder="<?php echo __('Organization', TEXTDOMAIN)?>" required />
				</div>
			</div>
		</div>
	</div>
	<!-- //Item -->
	<!-- Item -->
	<div class="item">
		<div class="title">
			<?php echo __('業界', TEXTDOMAIN)?><span class="required">*</span>
		</div>
		<div class="control">
			<div class="row">
				<div class="col">
					<select id="big_industry" name="big_industry" required>
						<option value=""><?php echo __('大分類Industry', TEXTDOMAIN)?></option>
						<?php if($industry_data && count($industry_data) > 0){?>
							<?php foreach($industry_data as $item){?>
								<option value="<?php echo $item['id']?>"><?php echo $item['name']?></option>
							<?php }?>
						<?php }?>
					</select>
				</div>
				<div class="col">
					<select id="child_industry" name="small_industry" required>
						<option value=""><?php echo __('小分類Industry2', TEXTDOMAIN)?></option>
					</select>
				</div>
			</div>
		</div>
	</div>
	<!-- //Item -->
	<!-- Item -->
	<div class="item">
		<div class="title">
			<?php echo __('所属部署', TEXTDOMAIN)?><span class="required">*</span>
		</div>
		<div class="control">
			<div class="row">
				<div class="col medium">
					<input maxlength="100" type="text" name="department" placeholder="<?php echo __('Department', TEXTDOMAIN)?>" required />
				</div>
			</div>
		</div>
	</div>
	<!-- //Item -->
	<!-- Item -->
	<div class="item">
		<div class="title">
			<?php echo __('役職', TEXTDOMAIN)?><span class="required">*</span>
		</div>
		<div class="control">
			<div class="row">
				<div class="col medium">
					<input maxlength="150" type="text" name="title" placeholder="<?php echo __('Title', TEXTDOMAIN)?>" required />
				</div>
			</div>
		</div>
	</div>
	<!-- //Item -->
	<!-- Item -->
	<div class="item">
		<div class="title">
			<?php echo __('職種', TEXTDOMAIN)?><span class="required">*</span>
		</div>
		<div class="control">
			<div class="row">
				<div class="col medium">
					<input maxlength="150" type="text" name="occupation" placeholder="<?php echo __('Occupation', TEXTDOMAIN)?>" required />
				</div>
			</div>
		</div>
	</div>
	<!-- //Item -->
	<!-- Item -->
	<div class="item">
		<div class="title">
			<?php echo __('人事経験年数', TEXTDOMAIN)?><span class="required">*</span>
		</div>
		<div class="control">
			<div class="row">
				<div class="col medium year">
					<select id="year_in_hr" class="medium" name="year_in_hr" required>
						<option value=""><?php echo __('Years in HR', TEXTDOMAIN)?></option>
						<?php if($year_in_hr && count($year_in_hr) > 0){?>
								<?php foreach($year_in_hr as $item){?>
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
			<?php echo __('教材など<br>送付先住所', TEXTDOMAIN)?><span class="required">*</span>
		</div>
		<div class="control">
			<div class="row">
				<div class="col">
					<input maxlength="150" type="text" name="teaching_materials" placeholder="<?php echo __('〒', TEXTDOMAIN)?>" required />
				</div>
				<div class="col col-lg">
					<input maxlength="150" type="text" name="mailing_address" placeholder="<?php echo __('Mailing Address', TEXTDOMAIN)?>" required />
				</div>
			</div>
		</div>
	</div>
	<!-- //Item -->
	<!-- Item -->
	<div class="item item-group">
		<div class="group-item group1">
			<div class="title">
				<?php echo __('HRAI提携<br>パートナー名<br>（紹介者）', TEXTDOMAIN)?><span class="required">*</span>
			</div>
			<div class="control control1">
				<div class="row">
					<div class="col">
						<select id="partner" name="partner" required>
							<option value="" selected><?php echo __('HRAI Partner<br>(Referral)', TEXTDOMAIN)?></option>
							<?php if($partners && count($partners) > 0){?>
								<?php foreach($partners as $item){?>
									<option value="<?php echo $item['title']?>"><?php echo $item['title']?></option>
								<?php }?>
							<?php }?>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="group-item group2">
			<div class="title title1">
				<?php echo __('その他の場合は<br>こちらに記入', TEXTDOMAIN)?>
			</div>
			<div class="control control2">
				<div class="row">
					<div class="col">
						<input maxlength="150" type="text" name="partner_referral" placeholder="<?php echo __('HRAI Partner (Referral)', TEXTDOMAIN)?>" />
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- //Item -->
	<!-- Item -->
	<div class="item">
		<div class="title">
			<?php echo __('Password', TEXTDOMAIN)?><span class="required">*</span>
		</div>
		<div class="control">
			<input maxlength="20" type="password" name="password" placeholder="<?php echo __('Password', TEXTDOMAIN)?>" required />
		</div>
	</div>
	<!-- //Item -->
	<!-- Step 1 -->
</div>
<input type="hidden" name="big_industry_value" id="big_industry_value" value="" />
<!-- //Step 1 -->
<p class="register-error required"></p>
<p class="send">
	<input type="button" value="<?php echo __('登録する', TEXTDOMAIN)?>" id="send-step1">
</p>
<div class="desc">
	<p>個人情報の保護について</p>
	<p>インターネットを通じて当ウェブサイトの「お問い合わせ」をご利用いただいた際に、必要な情報の元となるお客様の個人情報の取扱いを行いますが、お客様の個人情報を、お客様の同意なしに第三者に開示することはありません。</p>
</div>