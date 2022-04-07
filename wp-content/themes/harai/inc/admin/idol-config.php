<?php
add_action('admin_menu', 'idol_config_menu');
function idol_config_menu() {
    add_menu_page('Idol config', 'Idol config', 'administrator', 'idol_config', 'idol_config_load_page', 'dashicons-admin-generic', 12);
    /**
     * Show admin interface
     */
    function idol_config_load_page() {
        view_idol_config();
    }

    /**
     * Idol config layout
     */
    function view_idol_config(){
        global $wpdb;
        $data = $_POST;
        $save_message = '';
        $tbl_config= $wpdb->prefix . 'idol_config';
        if (!$select) {
            $select = "*";
        }
        //Lấy danh sách cấu hình
        $config_list = idol_get_configs();
        //Save data
        if ($data && count($data) > 0) {
            foreach ($data as $key => $value) {
                $build_data['value'] = $value;
                $wpdb->update($tbl_config, $build_data, array('key' => $key));
            }
            $save_message = 'Save successfully.';
            //Load lại danh sách cấu hình
            $config_list = idol_get_configs();
        }
        //Thẻ mở viết html
        ?>
        <!-- Wrap -->
        <div class="wrap">
            <!-- Col container-->
            <div id="col-container">
                <?php if ($save_message ){?>
                    <hr class="wp-header-end">
                    <div id="message" class="updated notice <?php echo $class_name?>"><p><?php echo $save_message?></p></div>
                <?php }?>
                <form method="post" action="">
                    <div id="poststuff">
                        <!-- metabox-holder -->
                        <div class="metabox-holder">
                            <!-- meta-box-sortables -->
                            <div class="meta-box-sortables">
                                <!-- postbox -->
                                <div class="postbox">
                                    <h2 class="hndle"><span><?php echo __('Idol config', TEXTDOMAIN)?></span></h2>
                                    <!-- inside -->
                                    <div class="inside">
                                        <?php if ($config_list && count($config_list) > 0) {?>
                                            <?php foreach ($config_list as $item) {?>
                                            <!-- Table -->
                                                <table class="fl-wp-table">
                                                    <thead>
                                                        <tr>
                                                            <th><label><?php echo $item -> name?></label></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <?php if ($item -> field_type == 0) {?>
                                                                    <?php if ($item -> field_format == 1) {?>
                                                                        <input class="field-col-full" type="text" name="<?php echo $item -> key?>" value="<?php echo $item -> value?>" onkeypress="Libs.fncInputNumberAllowComma(event);" maxlength="<?php echo $item -> max_length?>" autocomplete="off" />
                                                                    <?php } else {?>
                                                                        <input class="field-col-full" type="text" name="<?php echo $item -> key?>" value="<?php echo $item -> value?>" maxlength="<?php echo $item -> max_length?>" autocomplete="off" />
                                                                    <?php }?>
                                                                <?php } else {?>
                                                                    <textarea class="field-col-full" rows="3" maxlength="<?php echo $item -> max_length?>" name="<?php echo $item -> key?>"><?php echo $item -> value?></textarea>
                                                                <?php }?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            <?php }?>
                                            <!-- End table -->
                                        <?php }?>
                                    </div>
                                    <!-- End inside -->
                                </div>
                                <!-- End postbox -->
                            </div>
                            <!-- End meta-box-sortables -->
                        </div>
                        <!-- End metabox-holder -->
                    </div>
                    <input type="submit" class="button button-primary button-large" value="Save">
                </form>
            </div>
            <!-- End col container-->
        </div>
        <!-- End wrap -->
        <?php
        //Thẻ đóng viết html
    }
}
/**
 * Get config list
 *
 * @return array
 */
if (!function_exists('idol_get_configs')) {
    function idol_get_configs($key = null) {
        global $wpdb;
        $tbl_config= $wpdb->prefix . 'idol_config';
        $where = '';
        if ($key) {
            $where = " WHERE `key` = '{$key}'";
        }
        $qry = "
            SELECT
            `name`,
            `key`,
            `value`,
            `field_type`,
            `field_format`,
            `max_length`
            FROM $tbl_config
            $where
        ";
        $results = $wpdb->get_results($qry);
        if (!$results) {
            return;
        }
        if ($key) {
            return $results[0] -> value;    
        }
        return $results;
    }
}
?>
