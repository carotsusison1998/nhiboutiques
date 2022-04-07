<?php
add_action('admin_menu', 'idol_online_menu');
function idol_online_menu() {
    add_menu_page('47idolオンライン', '47idolオンライン', 'administrator', 'idol_online', 'idol_online_load_page', 'dashicons-calendar-alt', 6);
    /**
     * Show admin interface
     */
    function idol_online_load_page() {
        view_idol_online();
    }
    /**
     * ----------------------------------------------------------------------------------------
     * Thêm js và css đến cho trang admin
     * ----------------------------------------------------------------------------------------
     */
    if (!function_exists('idol_online_admin_enqueue_scripts')) {
        function idol_online_admin_enqueue_scripts() {
            if (is_admin()) {
                wp_enqueue_style('idol-admin-css-jquery-confirm', DEF_VENDOR. 'jquery.confirm/jquery-confirm.css', array());
                wp_enqueue_style('idol-admin-css-fullcalendar.min', DEF_VENDOR. 'fullcalendar/css/fullcalendar.min.css', array());
                wp_enqueue_style('idol-admin-css-fl-dialog', DEF_STYLE. 'fl-dialog.css', array(), date('YmdHis'));
                wp_enqueue_style('idol-admin-style', DEF_STYLE. 'admin-style.css', array(), date('YmdHis'));
                //Add script
                wp_enqueue_script('idol-admin-js-moment.min', DEF_VENDOR. 'fullcalendar/js/moment.min.js');
                wp_enqueue_script('idol-admin-js-fullcalendar.min', DEF_VENDOR. 'fullcalendar/js/fullcalendar.min.js');
                wp_enqueue_script('idol-admin-js-jquery.confirm', DEF_VENDOR. 'jquery.confirm/jquery-confirm.js');
                wp_enqueue_script('idol-admin-admin-online', DEF_SCRIPTS. 'admin/online.js', array());
            }
        }
        add_action('admin_enqueue_scripts', 'idol_online_admin_enqueue_scripts');
    }
    /**
     * Idol online layout
     */
    function view_idol_online(){
        global $wpdb;
        //Thẻ mở viết html
        ?>
        <!-- Wrap -->
        <div class="wrap">
            <!-- Col container-->
            <div id="col-container">
                <div id="poststuff">
                    <!-- metabox-holder -->
                    <div class="metabox-holder">
                        <!-- meta-box-sortables -->
                        <div class="meta-box-sortables">
                            <!-- postbox -->
                            <div class="postbox">
                                <h2 class="hndle"><span><?php echo __('47idolオンライン', TEXTDOMAIN)?></span></h2>
                                <!-- inside -->
                                <div class="inside">
                                    <div id="calendar"></div>
                                </div>
                                <!-- End inside -->
                            </div>
                            <!-- End postbox -->
                        </div>
                        <!-- End meta-box-sortables -->
                    </div>
                    <!-- End metabox-holder -->
                </div>
            </div>
            <!-- End col container-->
        </div>
        <!-- End wrap -->
        <?php
        //Thẻ đóng viết html
    }
}

/*
* Call Ajax save schedule
*
* @return json result
*/
add_action('wp_ajax_nopriv_idol_save_schedule', 'fn_idol_save_schedule');
add_action('wp_ajax_idol_save_schedule', 'fn_idol_save_schedule');
if ( ! function_exists( 'fn_idol_save_schedule' ) ){
    function fn_idol_save_schedule(){
        global $wpdb;
        $data = $_POST;
        $error_msg = 'A server error has occurred. Please contact your system administrator.';
        if (empty($data)) {
            echo return_json_result(false, $error_msg);
            exit();    
        }
        //User login info
        $current_user = wp_get_current_user();
        $tbl_online = $wpdb->prefix . 'online_schedule';
        $id = (!empty($data['id'])) ? $data['id'] : '';
        $build_data['title'] = (!empty($data['title'])) ? $data['title'] : '';
        $build_data['description'] = (!empty($data['description'])) ? $data['description'] : '';
        $build_data['from_time'] = (!empty($data['from_time'])) ? $data['from_time'] : '';
        $build_data['to_time'] = (!empty($data['to_time'])) ? $data['to_time'] : '';
        $build_data['schedule_date'] = (!empty($data['schedule_date'])) ? $data['schedule_date'] : '';
        $build_data['is_active'] = (!empty($data['is_active'])) ? 1 : 0;
        $build_data['created_by'] = $current_user->user_login;

        //Save data
        if (empty($id)) {
            $build_data['created_date'] = date('Y-m-d H:i:s');
            $result = $wpdb->insert($tbl_online, $build_data);
            //get last id insert
            $schedule_data['id'] = $wpdb->insert_id;
        //Update data
        } else {
            $build_data['updated_date'] = date('Y-m-d H:i:s');
            $result = $wpdb->update($tbl_online, $build_data, array('id' => $id));
            $schedule_data['id'] = $id;
        }
        if (!$result) {
            echo return_json_result(false, $error_msg);
            exit(); 
        }
        //Build data after insert
        $schedule_data['title'] = $build_data['title'];
        $schedule_data['description'] = $build_data['description'];
        $schedule_data['from_time'] = $build_data['from_time'];
        $schedule_data['to_time'] = $build_data['to_time'];
        $schedule_data['schedule_date'] = $build_data['schedule_date'];
        $schedule_data['start'] = $build_data['schedule_date'].' '.$build_data['from_time'];
        $schedule_data['end'] = $build_data['schedule_date'].' '.$build_data['to_time'];
        $schedule_data['is_active'] = $build_data['is_active'];
        echo return_json_result(true, '', $schedule_data);
        exit();
    }
}

/*
* Call Ajax Load the schedule list by date
*
* @return json result
*/
add_action('wp_ajax_nopriv_idol_get_schedule_list', 'fn_idol_get_schedule_list');
add_action('wp_ajax_idol_get_schedule_list', 'fn_idol_get_schedule_list');
if ( ! function_exists( 'fn_idol_get_schedule_list' ) ){
    function fn_idol_get_schedule_list(){
        global $wpdb;
        $data = $_POST;
        if (empty($data)) {
            echo return_json_result(false);
            exit();    
        }
        $results = idol_get_schedule_by_date($data['start_date'], $data['end_date']);
        echo return_json_result(($results) ? true : false, '', $results);
        exit();
    }
}

/*
* Call Ajax Load the schedule calendar
*
* @return json result
*/
add_action('wp_ajax_nopriv_idol_get_schedule_calendar', 'fn_idol_get_schedule_calendar');
add_action('wp_ajax_idol_get_schedule_calendar', 'fn_idol_get_schedule_calendar');
if ( ! function_exists( 'fn_idol_get_schedule_calendar' ) ){
    function fn_idol_get_schedule_calendar(){
        global $wpdb;
        $results = idol_get_schedule_calendar();
        $compare_dates = array();
        $schedule_date = '';
        if ($results && count($results) > 0) {
            $schedule_date = $results[0]['current_schedule_date'];
            $date_compare = '';
            $more_date = 0;
            for($i=0; $i<count($results); $i++) {
                $item = $results[$i];
                if ($i > 0 && $date_compare != $item['current_schedule_date']) {
                    $more_date ++;
                }
                $results[$i]['schedule_date'] = $schedule_date;
                $results[$i]['start'] = $schedule_date.' '.$item['from_time'].':00';
                $results[$i]['end'] = $schedule_date.' '.$item['to_time'].':00';
                $new_data = '';
                if ($schedule_date != $item['current_schedule_date']) {
                    $new_data = add_dates_by_date($schedule_date, 1, $more_date);
                    $results[$i]['start'] = $new_data.' '.$item['from_time'].':00';
                    $results[$i]['end'] = $new_data.' '.$item['to_time'].':00';
                }
                //set dates compare
                if ($date_compare != $item['current_schedule_date']) {
                    $data_compare_data['current_date'] = $item['current_schedule_date'];
                    if ($new_data) {
                        $data_compare_data['schedule_date'] = $new_data;  
                    } else {
                        $data_compare_data['schedule_date'] = $schedule_date;
                    }
                    array_push($compare_dates, $data_compare_data);
                }
                $date_compare = $item['current_schedule_date'];
            }
        }
        if ($compare_dates && count($compare_dates) > 0) {
            $total_compare_dates = count($compare_dates);
            if ($total_compare_dates < SCHEDULE_CALENDAR_DATE_LIMIT) {
                for ($i=0; $i < (SCHEDULE_CALENDAR_DATE_LIMIT - $total_compare_dates); $i++) {
                    $last_current_date = $compare_dates[$total_compare_dates-1]['current_date'];
                    $last_schedule_date = $compare_dates[$total_compare_dates-1]['schedule_date'];
                    $data_compare_data['current_date'] = add_dates_by_date($last_current_date, 1, ($i+1));
                    $data_compare_data['schedule_date'] = add_dates_by_date($last_schedule_date, 1, ($i+1));
                    array_push($compare_dates, $data_compare_data);
                }
            }
        }
        $schedule_data['schedule_data'] = $results;
        $schedule_data['compare_dates'] = $compare_dates;
        echo return_json_result(($results) ? true : false, '', $schedule_data);
        exit();
    }
}
/*
* Call Ajax Load the schedule list by date
*
* @return json result
*/
add_action('wp_ajax_nopriv_idol_delete_schedule', 'fn_idol_delete_schedule');
add_action('wp_ajax_idol_delete_schedule', 'fn_idol_delete_schedule');
if ( ! function_exists( 'fn_idol_delete_schedule' ) ){
    function fn_idol_delete_schedule(){
        global $wpdb;
        $data = $_POST;
        $error_msg = 'A server error has occurred. Please contact your system administrator.';
        if (empty($data)) {
            echo return_json_result(false, $error_msg);
            exit();    
        }
        $tbl_online = $wpdb->prefix . 'online_schedule';
        $id = $data['id'];
        $result = $wpdb->delete($tbl_online, array('id' => $id));
        echo return_json_result(($result) ? true : false, $error_msg);
        exit();
    }
}

/**
 * Get schedule list
 *
 * @return array
 */
if (!function_exists('idol_get_schedule_by_date')) {
    function idol_get_schedule_by_date($start_date = null, $end_date = null) {
        global $wpdb;
        $tbl_online = $wpdb->prefix . 'online_schedule';
        if (!$start_date || !$end_date) {
            return;
        }
        $qry = "
            SELECT
            `id`,
            `title`,
            `description`,
            DATE_FORMAT(schedule_date, '%Y-%m-%d') as schedule_date,
            DATE_FORMAT(schedule_date, '%Y/%m/%d') as date_title,
            `from_time`,
            `to_time`,
            is_active,
            CONCAT(DATE_FORMAT(schedule_date, '%Y-%m-%d'),' ', from_time,':00') as `start`,
            CONCAT(DATE_FORMAT(schedule_date, '%Y-%m-%d'),' ', to_time,':00') as `end`
            FROM $tbl_online
            WHERE DATE(schedule_date) >= DATE('{$start_date}')
            AND DATE(schedule_date) < DATE('{$end_date}')
        ";
        $results = $wpdb->get_results($qry, 'ARRAY_A');
        if (!$results) {
            return;
        }
        return $results;
    }
}

/**
 * Get config list
 *
 * @return array
 */
if (!function_exists('idol_get_schedule_calendar')) {
    function idol_get_schedule_calendar() {
        global $wpdb;
        $tbl_online = $wpdb->prefix . 'online_schedule';
        $qry = "
            SELECT
                `id`,
                `title`,
                `description`,
                DATE_FORMAT( schedule_date, '%Y-%m-%d' ) AS current_schedule_date,
                DATE_FORMAT( schedule_date, '%Y/%m/%d' ) AS date_title,
                `from_time`,
                `to_time`,
                is_active,
                CONCAT( DATE_FORMAT( schedule_date, '%Y-%m-%d' ), ' ', from_time, ':00' ) AS `start`,
                CONCAT( DATE_FORMAT( schedule_date, '%Y-%m-%d' ), ' ', to_time, ':00' ) AS `end` 
            FROM
                idol_online_schedule 
            WHERE
                is_active = 1 
                AND DATE( schedule_date ) >= DATE((
                    SELECT
                        MIN( tmp.schedule_date ) AS from_date 
                    FROM
                        (
                        SELECT
                            DATE_FORMAT( schedule_date, '%Y-%m-%d' ) AS schedule_date 
                        FROM
                            idol_online_schedule 
                        WHERE
                            is_active = 1 
                            AND DATE( schedule_date ) <= DATE((
                                SELECT
                                    DATE_FORMAT( MAX( schedule_date ), '%Y-%m-%d' ) AS to_date 
                                FROM
                                    idol_online_schedule 
                                )) 
                        GROUP BY
                            DATE( schedule_date ) 
                        ORDER BY DATE( schedule_date ) desc
                            LIMIT ".SCHEDULE_CALENDAR_DATE_LIMIT."
                        ) tmp 
                        ) 
                ) 
                AND DATE( schedule_date ) <= DATE((
                    SELECT
                        DATE_FORMAT( MAX( schedule_date ), '%Y-%m-%d' ) AS to_date 
                    FROM
                        idol_online_schedule 
                    )) 
            ORDER BY
                DATE( schedule_date ) ASC
        ";
        $results = $wpdb->get_results($qry, 'ARRAY_A');
        if (!$results) {
            return;
        }
        return $results;
    }
}
?>
