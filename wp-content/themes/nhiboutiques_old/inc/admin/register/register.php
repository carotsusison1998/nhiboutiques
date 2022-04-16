<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
// Add menu Translators to admin menu
include_once('register-table.php');
add_action('admin_menu', 'baky_orders_menu');
function baky_orders_menu() {
    add_menu_page( '講座申し込みフォーム', '講座申し込みフォーム', 'administrator', 'register', 'register_load_page', 'dashicons-media-text', 5);
    /**
     * Show admin interface
     *
     * @return void
     */
    function register_load_page() {
        $action = (!empty($_GET['action'])) ? $_GET['action'] : '';
        if ($action === 'detail') {
            //Thêm mới hoặc chỉnh sửa người dịch
            harai_register_detail();
        } else {
            //Load danh sách orders
            harai_register_list();
        }
    }

    /**
     * Load danh sách order dữ liệu được lấy từ class Harai_Register_Table
     *
     * @return html
     */
    function harai_register_list(){
        $page = esc_attr($_REQUEST['page']);
        $status = (!isset($_REQUEST['status'])) ? "" : esc_attr($_REQUEST['status']);
        $register_table = new Harai_Register_Table();
        //Thẻ mở viết html
        ?>
            <!-- Wrap -->
            <div class="wrap">
                <h1 class="wp-heading-inline">講座申し込みフォーム</h1>
                <form id="frm-orders" action method="get">
                    <input type="hidden" name="page" value="<?= esc_attr($page) ?>"/>
                    <input type='hidden' name='status' value='<?= esc_attr($status) ?>' />
                    <?php
                        //$register_table -> views();
                        $total_record = $register_table -> prepare_items();
                        $register_table -> get_sub_views();
                    ?>
                    <?php
                        $register_table->display();
                    ?>
                </form>
            </div>
            <!-- End wrap -->
        <?php
        //Thẻ đóng viết html
    }

    /**
     * Thông tin chi tiết khách hàng đăng ký
     *
     * @return html
     */
    function harai_register_detail(){
        $id = (!empty($_GET['id'])) ? $_GET['id'] : '';
        if (!$id) {
            return;
        }
        global $localelabel;
        //Lấy thông tin hóa đơn
        $register_detail_data = harai_get_register_detail($id);
        $register_detail_data_2 = harai_get_register_detail_2($id);

        print_r(count($register_detail_data_2));
        //Load html
        ob_start();
        include_once('register-detail.php');
        echo ob_get_clean();
    }
}