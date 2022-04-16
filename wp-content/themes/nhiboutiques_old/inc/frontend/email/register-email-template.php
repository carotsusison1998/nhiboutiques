<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
global $localelabel;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang = "ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Email</title>
<style type="text/css">
	table{border-collapse: collapse;}
	table thead th,table tbody td{border: 0.3pt solid #ccc;}
</style>
</head>
<body>
<p>ご担当者様</p>
<p>お世話になります。</p>
<p>>講座申し込みフォームから会員様登録がございましたので、ご確認のほどよろしくお願いいたします。</p>
<p>ご入力頂いた登録せ内容は下記の通りです。</p>
<table style="border-collapse: collapse;">
	<thead>
		<tr>
			<th colspan="2" style="text-align: center;"><b>講座申し込みフォーム</b></th>
		</tr>
	</thead>
    <tbody>
        <tr>
            <td width="170">
                <b><?php echo __('漢字氏名*', TEXTDOMAIN)?></b>
            </td>
            <td>
                <?php echo (!empty($data['kanji_name1'])) ? $data['kanji_name1'] : ''?>&nbsp;&nbsp;<?php echo (!empty($data['kanji_name2'])) ? $data['kanji_name2'] : ''?>
            </td>
        </tr>
        <tr>
            <td width="170">
                <b><?php echo __('ローマ字氏名<br />（英字半角）', TEXTDOMAIN)?></b>
            </td>
            <td>
                <?php echo (!empty($data['sir_name'])) ? $data['sir_name'] : ''?>&nbsp;&nbsp;<?php echo (!empty($data['first_name'])) ? $data['first_name'] : ''?>&nbsp;&nbsp;<?php echo (!empty($data['middle_name'])) ? $data['middle_name'] : ''?>
            </td>
        </tr>
        <tr>
            <td width="170">
                <?php echo __('メールアドレス<br/>（携帯以外）', TEXTDOMAIN)?>
            </td>
            <td>
                <?php echo (!empty($data['email'])) ? $data['email'] : ''?>
            </td>
        </tr>
        <tr>
            <td width="170">
                <?php echo __('電話番号', TEXTDOMAIN)?>
            </td>
            <td>
                <?php echo (!empty($data['phone'])) ? $data['phone'] : ''?>
            </td>
        </tr>
        <tr>
            <td width="170">
               <?php echo __('所属組織', TEXTDOMAIN)?>
            </td>
            <td>
                <?php echo (!empty($data['organization'])) ? $data['organization'] : ''?>
            </td>
        </tr>
        <tr>
            <td width="170">
               <?php echo __('業界', TEXTDOMAIN)?>
            </td>
            <td>
                <?php echo (!empty($data['big_industry_value'])) ? $data['big_industry_value'] : ''?>&nbsp;&nbsp;<?php echo (!empty($data['small_industry'])) ? $data['small_industry'] : ''?>
            </td>
        </tr>
        <tr>
            <td width="170">
               <?php echo __('所属部署', TEXTDOMAIN)?>
            </td>
            <td>
                <?php echo (!empty($data['department'])) ? $data['department'] : ''?>
            </td>
        </tr>
        <tr>
            <td width="170">
               <?php echo __('役職', TEXTDOMAIN)?>
            </td>
            <td>
                <?php echo (!empty($data['title'])) ? $data['title'] : ''?>
            </td>
        </tr>
        <tr>
            <td width="170">
               <?php echo __('職種', TEXTDOMAIN)?>
            </td>
            <td>
                <?php echo (!empty($data['occupation'])) ? $data['occupation'] : ''?>
            </td>
        </tr>
        <tr>
            <td width="170">
               <?php echo __('人事経験年数', TEXTDOMAIN)?>
            </td>
            <td>
                <?php echo (!empty($data['year_in_hr'])) ? $data['year_in_hr'] : ''?>
            </td>
        </tr>
        <tr>
            <td width="170">
               <?php echo __('教材など<br>送付先住所', TEXTDOMAIN)?>
            </td>
            <td>
                <?php echo (!empty($data['teaching_materials'])) ? $data['teaching_materials'] : ''?>&nbsp;&nbsp;<?php echo (!empty($data['mailing_address'])) ? $data['mailing_address'] : ''?>
            </td>
        </tr>
        <tr>
            <td width="170">
               <?php echo __('HRAI提携<br>パートナー名<br>（紹介者）', TEXTDOMAIN)?>
            </td>
            <td>
                <?php echo (!empty($data['partner'])) ? $data['partner'] : ''?>&nbsp;&nbsp;<?php echo (!empty($data['partner_referral'])) ? $data['partner_referral'] : ''?>
            </td>
        </tr>
        <tr>
            <td width="170">
               <?php echo __('お申し込みプラン', TEXTDOMAIN)?>
            </td>
            <td>
                <?php echo (!empty($data['application_plan'])) ? $data['application_plan'] : ''?>
            </td>
        </tr>
        <tr>
            <td width="170">
               <?php echo __('講座ご予約日', TEXTDOMAIN)?>
            </td>
            <td>
                <?php echo (!empty($data['course_reservation_date'])) ? $data['course_reservation_date'] : ''?>
            </td>
        </tr>
    </tbody>
</table>
<p>&nbsp;</p>
<p>***************************************************************************</p>

<p>-般社団法人 人事資格認定機構 Human Resource Accreditation Institute</p>

<p>代表理事 華園ふみ江 Fumie Hanazono, Chair of Executive Board</p>
<p>（HRAI運営組織／SHRM公認パートナー）ASTAR LLP</p>

<p>President & CEO 華園ふみ江　Fumie Hanazono</p>

<p>所在地 〒106-0032 東京都港区六本木１－７－２４　Address 1-7-24 Roppongi, Minato, Tokyo, Japan (zip code:106-0032)</p>
<p>https://hr-ai.org/</p>
<p>***************************************************************************</p>
</body>
</html>