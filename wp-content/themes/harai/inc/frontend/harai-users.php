<?php

/*
* Processing to save information and send email notifications of forgotten password to users
*
*/
add_action('wp_ajax_nopriv_harai_forgot_password', 'fn_harai_forgot_password');
add_action('wp_ajax_harai_forgot_password', 'fn_harai_forgot_password');
if ( ! function_exists( 'fn_harai_forgot_password' ) ){
    function fn_harai_forgot_password(){
        global $wpdb;
        $tbl_users_reset_password = $wpdb->prefix . 'users_reset_password';
        $email = trim($_POST['email']);
        if (empty($email)) {
            $mess_error = __("メールアドレスを入力してください。", TEXTDOMAIN);
            echo return_json_result(false, $mess_error);
            exit();
        }
        //check email is exist
        if (!get_harai_user_by_email($email)) {
            $mess_error = __("メールアドレスでは登録されていません。もう一度入力してください。", TEXTDOMAIN);
            echo return_json_result(false, $mess_error);
            exit();
        }
        $is_new = true;
        $check_email_reset = check_email_reset_exist($email);
        if($check_email_reset)
        {
            $is_new = false;
        }
        //random password
        $password = fl_random_string(6, 1);
        $user_key = fl_random_string(15);
        if($is_new)
        {
            $build_data['email'] = $email;
            $build_data['password'] = md5($password);
            $build_data['user_key'] = $user_key;
            $build_data['created_date'] = date('Y-m-d H:i:s');
            $wpdb->insert($tbl_users_reset_password, $build_data);
        } else {
            $build_data['password'] = md5($password);
            $build_data['user_key'] = $user_key;
            $build_data['created_date'] = date('Y-m-d H:i:s');
            $wpdb->update($tbl_users_reset_password, $build_data, array('email' => $email));
        }
        $change_pass_page_url = '';
        $change_pass_page = get_page_by_page_template('page-template/template-change-password.php');
        if ($change_pass_page) {
            $change_pass_page_url = $change_pass_page -> url;
        }
        $email_data['email'] = $email;
        $email_data['password'] = $password;
        $email_data['url'] = $change_pass_page_url.'?key='.$user_key;
        harai_forgot_password_send_mail($email_data);
        ob_start();
        include( get_template_directory().'/template-parts/pages/content-forgot-password-success.php' );
        $content_success = ob_get_clean();
        echo return_json_result(true, '', $content_success);
        exit();
    }
}

/*
* Send mail to admin
*
* @return object
*/
if ( ! function_exists( 'harai_forgot_password_send_mail' ) ){
    function harai_forgot_password_send_mail($data = null){
        if (!$data) {
            return;
        }
        ob_start();
        include( get_template_directory().'/inc/frontend/email/forgot-password-email-template.php' );
        $content_mail = ob_get_clean();
        //$from_mail_title = "パスワード再設定のお知らせ - Harai";
        $subject = "パスワード再設定のお知らせ";
        //Email header
        $mail_headers[] = 'Content-Type: text/html; charset=UTF-8';
        $email = $data['email'];
        //Send mail
        wp_mail($email, $subject, $content_mail, $mail_headers);
    }
}

/*
* Change password when clicking on the link from the email message
*
*/
add_action('wp_ajax_nopriv_harai_change_password', 'fn_harai_change_password');
add_action('wp_ajax_harai_change_password', 'fn_harai_change_password');
if ( ! function_exists( 'fn_harai_change_password' ) ){
    function fn_harai_change_password(){
        global $wpdb;
        $tbl_users_reset_password = $wpdb->prefix . 'users_reset_password';
        $tbl_register = $wpdb->prefix . 'register';
        $password = trim($_POST['password']);
        $new_password = trim($_POST['new_password']);
        $new_password_confirm = trim($_POST['new_password_confirm']);
        if (empty($password) || empty($new_password) || empty($new_password_confirm)) {
            $mess_error = __("システムエラーが発生しました。担当者にお問い合わせください。", TEXTDOMAIN);
            echo return_json_result(false, $mess_error);
            exit();
        }
        $password = md5($password);
        $user_reset_detail = harai_get_user_reset_pass($password);
        //check password
        if (!$user_reset_detail) {
            $mess_error = __("間違ったパスワードです。", TEXTDOMAIN);
            echo return_json_result(false, $mess_error);
            exit();
        }
        if ($new_password !== $new_password_confirm) {
            $mess_error = __("新しいパスワードと新しいパスワードの確認は同じではありません。", TEXTDOMAIN);
            echo return_json_result(false, $mess_error);
            exit();
        }
        //Update user
        $user_data_update['password'] = md5($new_password);
        $wpdb->update($tbl_register, $user_data_update, array('email' => $user_reset_detail -> email));
        //Update reset user
        $user_reset_data_update['user_key'] = "";
        $wpdb->update($tbl_users_reset_password, $user_reset_data_update, array('email' => $user_reset_detail -> email));
        ob_start();
        include( get_template_directory().'/template-parts/pages/content-change-password-success.php' );
        $content_success = ob_get_clean();
        echo return_json_result(true, '', $content_success);
        exit();
    }
}

function harai_get_user_reset_pass($password = null) {
    global $wpdb;
    $tbl_users_reset_password = $wpdb->prefix . 'users_reset_password';
    if (empty($password)) {
        return false;
    }
    $qry = "
        SELECT
            *
        FROM
            $tbl_users_reset_password
        WHERE
            password = '{$password}'
    ";
    $result = $wpdb->get_results($qry);
    if (!$result) {
        return false;
    }
    return $result[0];
}
function check_user_reset_by_user_key($user_key = null) {
    global $wpdb;
    $tbl_users_reset_password = $wpdb->prefix . 'users_reset_password';
    if (empty($user_key)) {
        return false;
    }
    $qry = "
        SELECT
            *
        FROM
            $tbl_users_reset_password
        WHERE
            user_key = '{$user_key}'
    ";
    $result = $wpdb->get_results($qry);
    if (!$result) {
        return false;
    }
    return true;
}