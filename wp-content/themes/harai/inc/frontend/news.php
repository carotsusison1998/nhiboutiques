<?php

/*
* Get news list by post type
*
* @param int @post_type 	-1: All, 1: News, 2: Contents
* @return array news list
*/
if ( ! function_exists( 'idol_get_news_list' ) ){
    function idol_get_news_list($post_type = -1, $offset = 0){
	    global $wpdb;
        $tbl_posts = $wpdb->prefix . 'posts';
        $tbl_postmeta = $wpdb->prefix . 'postmeta';
        $where = '';
        $postmeta_join = '';
        if ($post_type > 0) {
            $where = " AND pm.meta_value='{$post_type}'";
            $postmeta_join = "LEFT JOIN $tbl_postmeta pm ON p.ID = pm.post_id AND pm.meta_key='_news_type'";
        }
        $limit = idol_get_configs(IDOL_CONFIG['TOTAL_ARTICLE_LIMIT']);
		if (empty($limit)) {
			$limit = 0;
		}
        $offset = (!empty($offset)) ? $offset*1 : 0;
        $qry = "
            SELECT
                p.ID AS post_id,
				p.post_title,
				p.guid,
				p.post_content,
				DATE_FORMAT(p.post_date, '%Y.%m.%d') as post_date,
				LEFT(DAYNAME(p.post_date), 3) as day_name
            FROM
                $tbl_posts p
            $postmeta_join
            WHERE
                p.post_type = 'news_cpt' 
                AND p.post_status = 'publish'
                $where
            ORDER BY
                p.post_date desc
            LIMIT ".$limit."
            OFFSET $offset
        ";
        //echo $qry;die();
        $results = $wpdb->get_results($qry);
        if (!$results) {
            return;
        }
        return $results;
    }
}

/*
* Get total news list by article type
*
* @param int @post_type 	-1: All, 1: News, 2: Contents
* @return array news list
*/
if ( ! function_exists( 'idol_get_total_news_list' ) ){
    function idol_get_total_news_list($post_type = -1){
	    global $wpdb;
        $tbl_posts = $wpdb->prefix . 'posts';
        $tbl_postmeta = $wpdb->prefix . 'postmeta';
        $where = '';
        $postmeta_join = '';
        if ($post_type > 0) {
            $where = " AND pm.meta_value='{$post_type}'";
            $postmeta_join = "LEFT JOIN $tbl_postmeta pm ON p.ID = pm.post_id AND pm.meta_key='_news_type'";
        }
        $qry = "
            SELECT
                count(p.ID) as count
            FROM
                $tbl_posts p
            $postmeta_join
            WHERE
                p.post_type = 'news_cpt' 
                AND p.post_status = 'publish'
                $where
        ";
        $result = $wpdb->get_results($qry);
        if (!$result) {
            return 0;
        }
        return $result[0] -> count;
    }
}

/*
* Call Ajax load the html news list by post type
*
* @param int @page_type 	-1: All, 1: News, 2: Contents
* @return json result
*/
add_action('wp_ajax_nopriv_get_news_list_by_post_type', 'fn_get_news_list_by_post_type');
add_action('wp_ajax_get_news_list_by_post_type', 'fn_get_news_list_by_post_type');
if ( ! function_exists( 'fn_get_news_list_by_post_type' ) ){
    function fn_get_news_list_by_post_type($page_type = -1){
    	//Get params
    	$post_type = (!empty($_POST['post_type'])) ? $_POST['post_type'] : -1;
    	$offset = (!empty($_POST['offset'])) ? $_POST['offset'] : 0;
    	//Get news list
    	$news = idol_get_news_list($post_type, $offset);
    	//Get total news list
    	$total_news = idol_get_total_news_list($post_type);
        ob_start();
        include( get_template_directory().'/template-parts/pages/content-news-items.php' );
        $result = ob_get_clean();
        echo return_json_result(($total_news > 0) ? true : false, '', $result, $total_news);
        exit();
    }
}