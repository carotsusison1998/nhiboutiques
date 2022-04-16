<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly 
}
/**
 * Get post list
 *
 * @return Array
 */
if (!function_exists('get_post_list')) {
    function get_post_list() {
        global $wpdb;
        $tbl_posts = $wpdb->prefix . 'posts';
        $tbl_postmeta = $wpdb->prefix . 'postmeta';
        $qry = "
            SELECT
                p.ID as post_id,
                p.post_title,
                p.post_content
            FROM
                $tbl_posts p
            WHERE
                p.post_type = 'post' 
                AND p.post_status = 'publish'
            ORDER BY
                p.menu_order
        ";
        $results = $wpdb->get_results($qry);
        if (!$results) {
            return;
        }
        foreach ($results as $item) {
            $item -> description = get_custom_field_by_post_id( "_post_description", $item ->  post_id);
            $item -> image_url = wp_get_attachment_url( get_post_thumbnail_id($item->post_id), 'thumbnail' );
            $item -> href = get_permalink( $item->post_id);
        }
        return $results;
    }
}

/**
 * Get what's new list
 *
 * @return Array
 */
if (!function_exists('get_whatnew_list')) {
    function get_whatnew_list() {
        global $wpdb;
        $tbl_posts = $wpdb->prefix . 'posts';
        $tbl_postmeta = $wpdb->prefix . 'postmeta';
        $qry = "
            SELECT
                p.ID as post_id,
                p.post_title,
                DATE_FORMAT(p.post_date, '%Y.%m.%d') as created_date
            FROM
                $tbl_posts p
            WHERE
                p.post_type = 'what_news_cpt' 
                AND p.post_status = 'publish'
            ORDER BY
                date(p.post_date) desc, p.menu_order asc
        ";
        $results = $wpdb->get_results($qry);
        if (!$results) {
            return;
        }
        foreach ($results as $item) {
            $item -> href = get_permalink( $item->post_id);
        }
        return $results;
        return $results;
    }
}

/*
* Get news list by post type
*
* @return array news list
*/
if ( ! function_exists( 'harai_get_news_list' ) ){
    function harai_get_news_list($offset = 0){
        global $wpdb;
        $tbl_posts = $wpdb->prefix . 'posts';
        $tbl_postmeta = $wpdb->prefix . 'postmeta';
        $limit = 6;
        $offset = (!empty($offset)) ? $offset*1 : 0;
        $qry = "
            SELECT
                p.ID AS post_id,
                p.post_title,
                p.guid,
                p.post_content,
                DATE_FORMAT(p.post_date, '%m/%d') as post_date,
                LEFT(DAYNAME(p.post_date), 3) as day_name
            FROM
                $tbl_posts p
            WHERE
                p.post_type = 'news_cpt' 
                AND p.post_status = 'publish'
            ORDER BY
                date(p.post_date) desc, p.menu_order asc
            LIMIT ".$limit."
            OFFSET $offset
        ";
        //echo $qry;die();
        $results = $wpdb->get_results($qry);
        if (!$results) {
            return;
        }
        foreach ($results as $item) {
            $item -> description = get_custom_field_by_post_id( "_post_description", $item ->  post_id);
            $item -> image_url = wp_get_attachment_url( get_post_thumbnail_id($item->post_id), 'thumbnail' );
            $item -> href = get_permalink( $item->post_id);
        }
        return $results;
    }
}

/*
* Get total history list
*
* @return array news list
*/
if ( ! function_exists( 'harai_get_total_news_list' ) ){
    function harai_get_total_news_list(){
        global $wpdb;
        $tbl_posts = $wpdb->prefix . 'posts';
        $tbl_postmeta = $wpdb->prefix . 'postmeta';
        $qry = "
            SELECT
                count(p.ID) as count
            FROM
                $tbl_posts p
            WHERE
                p.post_type = 'news_cpt' 
                AND p.post_status = 'publish'
        ";
        $result = $wpdb->get_results($qry);
        if (!$result) {
            return 0;
        }
        return $result[0] -> count;
    }
}

/*
* Call Ajax load the html history list
*
* @return json result
*/
add_action('wp_ajax_nopriv_get_more_news_list', 'fn_get_more_news_list');
add_action('wp_ajax_get_more_news_list', 'fn_get_more_news_list');
if ( ! function_exists( 'fn_get_more_news_list' ) ){
    function fn_get_more_news_list(){
        //Get params
        $offset = (!empty($_POST['offset'])) ? $_POST['offset'] : 0;
        //Get news list
        $news = harai_get_news_list($offset);
        //Get total news list
        $total_news = harai_get_total_news_list();
        ob_start();
        include( get_template_directory().'/template-parts/pages/content-news-items.php' );
        $result = ob_get_clean();
        echo return_json_result(($total_news > 0) ? true : false, '', $result, $total_news);
        exit();
    }
}

/**
 * Get organization list
 *
 * @return Array
 */
if (!function_exists('get_organization_list')) {
    function get_organization_list() {
        global $wpdb;
        $tbl_posts = $wpdb->prefix . 'posts';
        $tbl_postmeta = $wpdb->prefix . 'postmeta';
        $qry = "
            SELECT
                p.ID as post_id,
                p.post_title,
                p.post_content
            FROM
                $tbl_posts p
            WHERE
                p.post_type = 'organization_cpt' 
                AND p.post_status = 'publish'
            ORDER BY
                p.menu_order
        ";
        $results = $wpdb->get_results($qry);
        if (!$results) {
            return;
        }
        foreach ($results as $item) {
            $item -> href = get_permalink( $item->post_id);
            $item -> image_url = wp_get_attachment_url( get_post_thumbnail_id($item->post_id), 'thumbnail' );
            // $item -> position = get_custom_field_by_post_id('position', $item -> post_id);
        }
        return $results;
        return $results;
    }
}
/**
 * Get organization list
 *
 * @return Array
 */
if (!function_exists('get_instructor_list')) {
    function get_instructor_list() {
        global $wpdb;
        $tbl_posts = $wpdb->prefix . 'posts';
        $tbl_postmeta = $wpdb->prefix . 'postmeta';
        $qry = "
            SELECT
                p.ID as post_id,
                p.post_title
            FROM
                $tbl_posts p
            WHERE
                p.post_type = 'instructor_cpt' 
                AND p.post_status = 'publish'
            ORDER BY
                p.menu_order
        ";
        $results = $wpdb->get_results($qry);
        if (!$results) {
            return;
        }
        foreach ($results as $item) {
            $item -> href = get_permalink( $item->post_id);
            $item -> image_url = wp_get_attachment_url( get_post_thumbnail_id($item->post_id), 'thumbnail' );
        }
        return $results;
    }
}

/**
 * Get user login
 *
 * @return Array
 */
if (!function_exists('get_harai_user_information')) {
    function get_harai_user_information($email = null, $password = null) {
        global $wpdb;
        $tbl_register = $wpdb->prefix . 'register';
        if (empty($email) || empty($password)) {
            return;
        }
        $qry = "
            SELECT
                *
            FROM
                $tbl_register
            WHERE
                email = '{$email}'
                AND password='{$password}'
        ";
        $results = $wpdb->get_results($qry);
        if (!$results) {
            return;
        }
        return $results[0];
    }
}
/*
* Call Ajax check email exist
*
* @return json result
*/
add_action('wp_ajax_nopriv_harai_check_email_exist', 'fn_harai_check_email_exist');
add_action('wp_ajax_harai_check_email_exist', 'fn_harai_check_email_exist');
if ( ! function_exists( 'fn_harai_check_email_exist' ) ){
    function fn_harai_check_email_exist(){
        global $wpdb;
        $email = trim($_POST['email']);
        $is_email_exist = false;
        if (get_harai_user_by_email($email)) {
            $is_email_exist = true;
        }
        $mess_error = __("メールアドレスはすでに存在します", TEXTDOMAIN);
        echo return_json_result($is_email_exist, $mess_error);
        exit();
    }
}
/**
 * check emails exist
 *
 * @return Array
 */
if (!function_exists('get_harai_user_by_email')) {
    function get_harai_user_by_email($email = null) {
        global $wpdb;
        $tbl_register = $wpdb->prefix . 'register';
        if (empty($email)) {
            return false;
        }
        $qry = "
            SELECT
                *
            FROM
                $tbl_register
            WHERE
                email = '{$email}'
        ";
        $result = $wpdb->get_results($qry, 'ARRAY_A');
        if (!$result) {
            return false;
        }
        return $result[0];
    }
}
/**
 * check emails exist user reset pass
 *
 * @return Array
 */
if (!function_exists('check_email_reset_exist')) {
    function check_email_reset_exist($email = null) {
        global $wpdb;
        $tbl_users_reset_password = $wpdb->prefix . 'users_reset_password';
        if (empty($email)) {
            return false;
        }
        $qry = "
            SELECT
                *
            FROM
                $tbl_users_reset_password
            WHERE
                email = '{$email}'
        ";
        $result = $wpdb->get_results($qry);
        if (!$result) {
            return false;
        }
        return true;
    }
}


/**
 * Lấy thông tin chi tiết khách hàng đăng ký
 *
 * @param string $order_id    mã khách hàng
 * @return object        thông tin khách hàng
 */
if (!function_exists('harai_get_register_detail')) {
    function harai_get_register_detail($register_id = null, $is_where_by_id = false) {
        if (empty($register_id)) {
            return;
        }
        $where = " id = '{$register_id}'";
        if ($is_where_by_id) {
            $where = " id = ".$register_id;
        }
        global $wpdb;
        $tbl_register = $wpdb->prefix . 'register';
        $qry = "
            SELECT *, DATE_FORMAT(created_date, '%d/%m/%Y') as created_date
            FROM
                $tbl_register
            WHERE
                $where
                AND is_delete = 0
        ";
        //$qry = $wpdb->prepare( $qry);
        $results = $wpdb->get_results($qry);
        if (!$results) {
            return;
        }
        return $results[0];
    }
}

/**
 * Lấy thông tin chi tiết khách hàng đăng ký ở bảng harai_register_detail
 *
 * @param string $order_id    mã khách hàng
 * @return object        thông tin khách hàng
 */
if (!function_exists('harai_get_register_detail_2')) {
    function harai_get_register_detail_2($register_id = null, $is_where_by_id = false) {
        if (empty($register_id)) {
            return;
        }
        $where = " register_id = '{$register_id}'";
        if ($is_where_by_id) {
            $where = " register_id = ".$register_id;
        }
        global $wpdb;
        $tbl_register_detail = $wpdb->prefix . 'register_detail';
        $qry = "
            SELECT *, DATE_FORMAT(created_date, '%d/%m/%Y') as created_date
            FROM
                $tbl_register_detail
            WHERE
                $where
        ";
        $results = $wpdb->get_results($qry);
        
        if (!$results) {
            return;
        }
        return $results;
    }
}