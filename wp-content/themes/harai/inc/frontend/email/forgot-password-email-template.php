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
    <p>パスワード再設定準備が完了しました。</p>
    <p>以下のURLよりパスワードの設定をお願いいたします。</p>
    <p><?php echo $data['url']?></p>
    <p>Password: <?php echo $data['password']?></p>
    <p>&nbsp;</p>
    <p>---お問合せ先------------------------------------------------</p>-</p>
 <p>般社団法人 人事資格認定機構 Human Resource Accreditation Institute-</p>-</p>

 <p>代表理事 華園ふみ江 Fumie Hanazono, Chair of Executive Board-</p>

 <p>（HRAI運営組織／SHRM公認パートナー）ASTAR LLP-</p>

 <p>President & CEO 華園ふみ江　Fumie Hanazono-</p>

 <p>所在地 〒106-0032 東京都港区六本木１－７－２４　Address 1-7-24 Roppongi, Minato, Tokyo, Japan (zip code:106-0032)-</p>
       <p>&nbsp;</p>
    <p>＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊</p>
    <p>このメールはシステムより自動で送られています。ご返信されてもお応えできませんのでご注意ください。</p>
    <p>心当たりのない方はお手数ですがこのメールを削除していただきますよう、よろしくお願い致します。</p>
    <p>ご不明な点がございましたら、上記のご担当者様にご連絡ください。</p>
    <p>＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊</p>
    <p>***************************************************************************</p>
</body>
</html>