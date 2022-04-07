<?php

/*
* Load step2 layout
*
* @return string html
*/
add_action('wp_ajax_nopriv_load_step2_layout', 'fn_load_step2_layout');
add_action('wp_ajax_load_step2_layout', 'fn_load_step2_layout');
if ( ! function_exists( 'fn_load_step2_layout' ) ){
    function fn_load_step2_layout(){
        ob_start();
        include( get_template_directory().'/template-parts/pages/content-register-step2.php' );
        $result = ob_get_clean();
        echo return_json_result(true, '', $result);
        exit();
    }
}
/*
* Load step3 layout
*
* @return string html
*/
add_action('wp_ajax_nopriv_load_step3_layout', 'fn_load_step3_layout');
add_action('wp_ajax_load_step3_layout', 'fn_load_step3_layout');
if ( ! function_exists( 'fn_load_step3_layout' ) ){
    function fn_load_step3_layout(){
        ob_start();
        include( get_template_directory().'/template-parts/pages/content-register-step3.php' );
        $result = ob_get_clean();
        echo return_json_result(true, '', $result);
        exit();
    }
}
/*
* Load step4 layout
*
* @return string html
*/
add_action('wp_ajax_nopriv_load_step4_layout', 'fn_load_step4_layout');
add_action('wp_ajax_load_step4_layout', 'fn_load_step4_layout');
if ( ! function_exists( 'fn_load_step4_layout' ) ){
    function fn_load_step4_layout(){
        if(!empty($_SESSION[HARAI_USER])) {
            $email = $_SESSION[HARAI_USER]['email'];
            $data = get_harai_user_by_email($email);
            $data['application_plan'] = $_POST['application_plan'];
            $data['course_reservation_date'] = $_POST['course_reservation_date'];
        } else {
            $data = $_POST;
        }
        ob_start();
        include( get_template_directory().'/template-parts/pages/content-register-step4.php' );
        $result = ob_get_clean();
        echo return_json_result(true, '', $result);
        exit();
    }
}

/*
* Load step4 layout
*
* @return string html
*/
add_action('wp_ajax_nopriv_harai_register', 'fn_harai_register');
add_action('wp_ajax_harai_register', 'fn_harai_register');
if ( ! function_exists( 'fn_harai_register' ) ){
    function fn_harai_register(){
        global $wpdb;
        $tbl_register = $wpdb->prefix . 'register';
        $tbl_register_detail = $wpdb->prefix . 'register_detail';
        if(!empty($_SESSION[HARAI_USER])) {
            $email = $_SESSION[HARAI_USER]['email'];
            $data = get_harai_user_by_email($email);
            $data['application_plan'] = $_POST['application_plan'];
            $data['course_reservation_date'] = $_POST['course_reservation_date'];
            //Build data insert
            $build_data_detail['register_id'] = $data['id']*1;
            $build_data_detail['application_plan'] = $_POST['application_plan'];
            $build_data_detail['course_reservation_date'] = $_POST['course_reservation_date'];
            $build_data_detail['created_date'] = date('Y-m-d H:i:s');
            $wpdb->insert($tbl_register_detail, $build_data_detail);
        } else {
            $data = $_POST;
            //Build data
            $build_data['kanji_name1'] = $data['kanji_name1'];
            $build_data['kanji_name2'] = $data['kanji_name2'];
            $build_data['sir_name'] = $data['sir_name'];
            $build_data['first_name'] = $data['first_name'];
            $build_data['middle_name'] = $data['middle_name'];
            $build_data['email'] = $data['email'];
            $build_data['phone'] = $data['phone'];
            $build_data['organization'] = $data['organization'];
            $build_data['big_industry'] = $data['big_industry'];
            $build_data['small_industry'] = $data['small_industry'];
            $build_data['department'] = $data['department'];
            $build_data['title'] = $data['title'];
            $build_data['occupation'] = $data['occupation'];
            $build_data['year_in_hr'] = $data['year_in_hr'];
            $build_data['teaching_materials'] = $data['teaching_materials'];
            $build_data['mailing_address'] = $data['mailing_address'];
            $build_data['partner'] = $data['partner'];
            $build_data['partner_referral'] = $data['partner_referral'];
            $build_data['password'] = md5($data['password']);
            $build_data['created_date'] = date('Y-m-d H:i:s');
            $wpdb->insert($tbl_register, $build_data);
            //Data detail
            $lastid = $wpdb->insert_id;
            $build_data_detail['register_id'] = $wpdb->insert_id;
            $build_data_detail['application_plan'] = $data['application_plan'];
            $build_data_detail['course_reservation_date'] = $data['course_reservation_date'];
            $build_data_detail['created_date'] = date('Y-m-d H:i:s');
            $wpdb->insert($tbl_register_detail, $build_data_detail);
        }
        harai_register_send_mail($data);
        ob_start();
        include( get_template_directory().'/template-parts/pages/content-register-thank.php' );
        $result = ob_get_clean();
        echo return_json_result(true, '', $result);
        exit();
    }
}
/*
* Send mail to admin
*
* @return object
*/
if ( ! function_exists( 'harai_register_send_mail' ) ){
    function harai_register_send_mail($data = null){
        if (!$data) {
            return;
        }
        ob_start();
        include( get_template_directory().'/inc/frontend/email/register-email-template.php' );
        $content_mail = ob_get_clean();
        $subject = '会員登録メール送信完了';
        //Email cc đến admin
        $mail_headers[] = 'Content-Type: text/html; charset=UTF-8';
        //Send mail đến người dịch
        wp_mail(ADMIN_MAILS, $subject, $content_mail, $mail_headers);
    }
}
/*
* Login 
*
* @return string html
*/
add_action('wp_ajax_nopriv_harai_login', 'fn_harai_login');
add_action('wp_ajax_harai_login', 'fn_harai_login');
if ( ! function_exists( 'fn_harai_login' ) ){
    function fn_harai_login(){
        global $wpdb;
        $data = $_POST;
        $tbl_register = $wpdb->prefix . 'register';
        //Build data
        $email = $data['email'];
        $paddword = $data['password'];
        $message_error = 'メールアドレスまたはパスワードが正しくありません。';
        if (empty($email) || empty($paddword)) {
            echo return_json_result(false, $message_error);
            exit();
        }
        $paddword = md5($paddword);
        $user = get_harai_user_information($email, $paddword);
        if (!$user) {
            echo return_json_result(false, $message_error);
            exit();
        }
        $user_login['email'] = $user -> email;
        $user_login['sir_name'] = $user -> sir_name;
        $user_login['first_name'] = $user -> first_name;
        $user_login['middle_name'] = $user -> middle_name;
        $_SESSION[HARAI_USER] = $user_login;
        $location = get_site_url();
        echo return_json_result(true,'', $location);
        exit();
    }
}
/*
* Login
*
* @return string html
*/
add_action('wp_ajax_nopriv_harai_logout', 'fn_harai_logout');
add_action('wp_ajax_harai_logout', 'fn_harai_logout');
if ( ! function_exists( 'fn_harai_logout' ) ){
    function fn_harai_logout(){
        unset ($_SESSION[HARAI_USER]);
        $location = get_site_url();
        echo return_json_result(true,'', $location);
        exit();
    }
}