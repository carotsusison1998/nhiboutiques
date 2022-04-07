<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}
class Harai_Register_Table extends WP_List_Table
{
    /**
     * Mảng chứa giá trị tổng số dòng public và trash
     *
     * @var array
     */
    public $total_items = array();

    public function __construct()
    {
        global $wpdb;
        /**
         * Constructor.
         *
         * The child class should call this constructor from its own constructor to override
         * the default $args.
         *
         * @param array|string $args {
         *     Array or string of arguments.
         *
         *     @type string $plural   Plural value used for labels and the objects being listed.
         *                            This affects things such as CSS class-names and nonces used
         *                            in the list table, e.g. 'posts'. Default empty.
         *     @type string $singular Singular label for an object being listed, e.g. 'post'.
         *                            Default empty
         *     @type bool   $ajax     Whether the list table supports Ajax. This includes loading
         *                            and sorting data, for example. If true, the class will call
         *                            the _js_vars() method in the footer to provide variables
         *                            to any scripts handling Ajax events. Default false.
         *     @type string $screen   String containing the hook name used to determine the current
         *                            screen. If left null, the current screen will be automatically set.
         *                            Default null.
         * }
         */
        parent::__construct(array(
            'ajax' => false,
        ));
    }

    /**
     *
     * @return string[]
     */
    public function get_hidden_columns()
    {
        $hidden = array('id', 'permalink');
        return $hidden;
    }

    /**
     * Prepares the items for display
     *
     * @access public
     * @since 2.0.0
     * @version 2.0.0
     * @return bool
     */
    public function prepare_items()
    {
        $columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();

        $this->process_bulk_action();

        $this->_column_headers = array($columns, $hidden, $sortable);
        $items_per_page = $this->get_items_per_page('harai_register_per_page', 10);
        $current_page = $this->get_pagenum();
        global $wpdb;
        $harai_register = $wpdb->prefix . 'register';
        $qry = "
            SELECT *, DATE_FORMAT(created_date, '%d/%m/%Y') as created_date
            FROM
            	   $harai_register
        ";
        $where = " WHERE id > 0";
        $where_status = '';
        if (isset($_REQUEST['status']) && !is_blank($_REQUEST['status'])) {
            if ($_REQUEST['status'] === 'trashed') {
                $where_status .= " AND is_delete = 1";
            } else {
                $where_status .= " AND is_delete = 0";
            }
        } else {
            $where_status .= " AND is_delete = 0";
        }
        //Search by keywork
        if (!empty($_REQUEST['keyword'])) {
            $keyword = esc_sql($_REQUEST['keyword']);
            if ("" != $keyword) {
                $where .= " AND (";
                $where .= " kanji_name1 LIKE '%{$keyword}%'";
                $where .= " OR kanji_name2 LIKE '%{$keyword}%'";
                $where .= " OR sir_name LIKE '%{$keyword}%'";
                $where .= " OR first_name LIKE '%{$keyword}%'";
                $where .= " OR middle_name LIKE '%{$keyword}%'";
                $where .= " OR email LIKE '%{$keyword}%'";
                $where .= " OR phone LIKE '%{$keyword}%'";
                $where .= " )";
            }
        }
        $qry .= $where;
        $qry .= $where_status;
        //Total items
        $total_items = count($wpdb->get_results($qry));

        //Set pagination
        $this->set_pagination_args(array(
            'total_items' => (double)$total_items,
            'per_page' => $items_per_page,
        ));
        $offset = ($current_page - 1) * $items_per_page;
        $qry .= " ORDER BY id desc";
        $qry .= " LIMIT {$items_per_page}";
        $qry .= " OFFSET {$offset}";
        $this->items = $wpdb->get_results($qry, "ARRAY_A");
        //Lấy tổng số record xóa tạm hoặc chưa xóa tạm
        $total_qry = "
            SELECT 
            (SELECT COUNT(id) FROM $harai_register $where AND is_delete = 0) AS public_count,
            (SELECT COUNT(id) FROM $harai_register $where AND is_delete = 1) As trash_count
        ";
        $total_qry = $wpdb->prepare( $total_qry);
        $this -> total_items = $wpdb->get_results($total_qry)[0];
    }

    /**
     * Adds additional views
     *
     * @access public
     * @since 2.0.0
     * @version 2.0.0
     * @param mixed $views
     * @return bool
     */
    public function get_sub_views()
    {
        $public_count = 0;
        $trash_count = 0;
        if ($this -> total_items) {
            $public_count = $this -> total_items -> public_count;
            $trash_count = $this -> total_items -> trash_count;
        }
        $views = '<ul class="subsubsub">';
        $current = (!empty($_REQUEST['status']) ? $_REQUEST['status'] : 'all');
        //All link
        $class = ($current == 'all' ? ' class="current"' : '');
        $all_url = remove_query_arg('status');
        $views .= '<li class="all">';
        $views .= "<a href='{$all_url }' {$class} >" . __("All", TEXTDOMAIN).'('.$public_count.')'."</a>";
        $views .= '</li>';
        //Trashed link
        $trash_url = add_query_arg('status', 'trashed');
        $class = ($current == 'trashed' ? ' class="current"' : '');
        $views .= '<li class="all">';
        $views .= "<a href='{$trash_url}' {$class} >" . __("Trash", TEXTDOMAIN).'('.$trash_count.')'."</a>";
        $views .= '</li>';
        $views .= '</ul>';
        echo $views;
    }

    /**
     * Adds additional views
     *
     * @access public
     * @since 2.0.0
     * @version 2.0.0
     * @param mixed $views
     * @return bool
     */
    // public function get_views()
    // {
    //     $views = array();
    //     $current = (!empty($_REQUEST['status']) ? $_REQUEST['status'] : 'all');

    //     //All link
    //     $class = ($current == 'all' ? ' class="current"' : '');
    //     $all_url = remove_query_arg('status');
    //     $views['all'] = "<a href='{$all_url }' {$class} >" . __("All", TEXTDOMAIN) ."</a>";

    //     //Trashed link
    //     $trash_url = add_query_arg('status', 'trashed');
    //     $class = ($current == 'trashed' ? ' class="current"' : '');
    //     $views['trashed'] = "<a href='{$trash_url}' {$class} >" . __("Trash", TEXTDOMAIN) ."</a>";
    //     return $views;
    // }

    /**
     * Generate the table navigation above or below the table
     *
     * @since 3.1.0
     * @access protected
     * @param string $which
     */
    protected function display_tablenav($which)
    {
        if ('top' === $which) {
            wp_nonce_field('bulk-' . $this->_args['plural'], '_wpnonce', false);
        }
        ?>
        <div class="tablenav <?php echo esc_attr($which); ?>">
            <div style="display: inline-block;width: 100%; float: left;">
                <?php
                    $this->extra_tablenav($which);
                ?>
            </div>
            <?php if ($this->has_items()) {?>
                <div class="alignleft actions bulkactions">
                    <?php $this->bulk_actions($which); ?>
                </div>
            <?php }?>
            <?php
                $this->pagination($which);
            ?>
            <br class="clear"/>
        </div>
        <?php
    }

    /**
     * Adds filters to the table
     *
     * @access public
     * @since 2.0.0
     * @version 2.0.0
     * @param string $position whether top/bottom
     * @return bool
     */
    public function extra_tablenav($position)
    {
        if ('top' === $position) {
            ?>
            <div style="margin-bottom: 8px; display: inline-block; margin-left: -9px;">
                <div class="alignleft actions" style="margin: 5px 0px;">
                    <?php $this ->search_by_keyword();?>
                </div>
                <div class="alignleft actions" style="margin: 5px 0px;">
                    <?php
                    submit_button(__('Filter', TEXTDOMAIN), false, false, false);
                    ?>
                </div>
            </div>
            <?php
        }
    }


    /**
     * Displays the keywork filter
     *
     * @access public
     * @since 2.0.0
     * @version 2.0.0
     * @return bool
     */
    public function search_by_keyword() {
        $keyword = isset( $_REQUEST['keyword'] ) ? $_REQUEST['keyword'] : '';
        ?>
        <input type="text" name="keyword" value="<?php echo $keyword?>" />
    <?php
    }

    /**
     * Defines the columns to show
     *
     * @access public
     * @since 2.0.0
     * @version 2.0.0
     * @return array $columns
     */
    public function get_columns()
    {
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'kanji_name1' => __('ID', TEXTDOMAIN),
            'kanji_name2' => __('漢字氏名', TEXTDOMAIN),
            'sir_name' => __('Sir Name', TEXTDOMAIN),
            'first_name' => __('First Name', TEXTDOMAIN),
            'middle_name' => __('Middle Name', TEXTDOMAIN),
            'email' => __('メールアドレス（携帯以外）', TEXTDOMAIN),
            'created_date' => __('Created date', TEXTDOMAIN)
        );

        return $columns;
    }

// 	/**
// 	 * Adds checkbox to each row
// 	 *
// 	 * @access public
// 	 * @since 2.0.0
// 	 * @version 2.0.0
// 	 * @param object $item
// 	 * @return mixed
// 	 */
    public function column_cb($item)
    {

        return sprintf('<input type="checkbox" name="ids[]" value="%s" />', $item['id'], $item['id']);
    }

    public function column_default($item, $column_name)
    {
        global $localelabel;
        switch ($column_name) {
            case 'kanji_name1':
                return $item['kanji_name1'];
            case 'kanji_name2':
                return $item['kanji_name2'];
            case 'sir_name':
                return $item['sir_name'];
            case 'first_name':
                return $item['first_name'];
            case 'middle_name':
                return $item['middle_name'];
            case 'email':
                return $item['email'];
            case 'created_date':
                return $item['created_date'];
            default:
                return print_r($item, true);
        }
    }

    public function get_sortable_columns()
    {
        $sortable_columns = array(
            'kanji_name1' => array('kanji_name1', true)
        );
        return $sortable_columns;
    }

    /**
     * Add bulk actions
     *
     * @access public
     * @since 2.0.0
     * @version 2.0.0
     * @return bool
     */
    public function get_bulk_actions()
    {
        $status = (!isset($_REQUEST['status'])) ? "" : $_REQUEST['status'];
        $actions = array();
        if ($status == 'trashed') {
            $actions = array(
                'delete_all' => __('Delete premanently', TEXTDOMAIN),
                'restore_all' => __('Restore', TEXTDOMAIN)
            );
        } else {
            $actions = array(
                'trash_all' => __('Trash', TEXTDOMAIN)
            );
        }
        return $actions;
    }

    /**
     * Processes bulk actions
     *
     * @access public
     * @since 2.0.0
     * @version 2.0.0
     * @return bool
     */
    public function process_bulk_action()
    {
        global $wpdb;
        $ids = array();
        if (isset($_REQUEST['ids'])) {
            //$ids = array_map('absint', $_REQUEST['ids']);
            $ids = $_REQUEST['ids'];
        }
        $id = !isset($_REQUEST['id']) ? "" : $_REQUEST['id'];
        $current_action = $this->current_action();
        $harai_register = $wpdb->prefix . "register";
        $harai_register_detail = $wpdb->prefix . "register_detail";
        $update_status_sql = "
          UPDATE $harai_register
          SET is_delete = %d
          WHERE id= '%s'
        ";
        $delete_sql = "
          DELETE FROM $harai_register
          WHERE id= '%s'
        ";
        $delete_detail_sql = "
          DELETE FROM $harai_register_detail
          WHERE register_id= '%s'
        ";
        if ($current_action === "delete_all") {
            if ($ids && count($ids) > 0) {
                foreach ($ids as $id) {
                    $wpdb->query(sprintf($delete_sql, $id));
                    $wpdb->query(sprintf($delete_detail_sql, $id));
                }
            }
        } else if ($current_action === "trash_all") {
            if ($ids && count($ids) > 0) {
                foreach ($ids as $id) {
                    $wpdb->query(sprintf($update_status_sql, 1, $id));
                }
            }
        } else if ($current_action === "restore_all") {
            if ($ids && count($ids) > 0) {
                foreach ($ids as $id) {
                    $wpdb->query(sprintf($update_status_sql, 0, $id));
                }
            }
        } else if ($current_action === "trash_detail") {
            if (!is_blank($id)) {
                $wpdb->query(sprintf($update_status_sql, 1, $id));
            }
        } else if ($current_action === "restore_detail") {
            if (!is_blank($id)) {
                $wpdb->query(sprintf($update_status_sql, 0, $id));
            }
        } else if ($current_action === "delete_detail") {
            if (!is_blank($id)) {
                $wpdb->query(sprintf($delete_sql, $id));
                $wpdb->query(sprintf($delete_detail_sql, $id));
            }
        }
    }

    /**
     * Method for name column
     *
     * @param array $item an array of DB data
     *
     * @return string
     */
    function column_kanji_name1($item)
    {
        $status = (!isset($_REQUEST['status'])) ? "" : $_REQUEST['status'];
        $actions = array();
        if ($status == 'trashed') {
            $restore_url = add_query_arg(array(
                'action' => 'restore_detail',
                'id' => $item['id']
            ));
            $delete_url = add_query_arg(array(
                'action' => 'delete_detail',
                'id' => $item['id']
            ));
            $actions['restore_detail'] = "<span class='untrash'><a href='$restore_url'>" . __("Restore", TEXTDOMAIN) . "</a></span>";
            $actions['delete_detail'] = "<span class='trash'><a href='$delete_url'>" . __("Delete premanently", TEXTDOMAIN) . "</a></span>";
        } else {
            $detail_url = add_query_arg(array(
                'action' => 'detail',
                'id' => $item['id']
            ));
            $trash_url = add_query_arg(array(
                'action' => 'trash_detail',
                'id' => $item['id']
            ));
            $actions['edit'] = "<span class='edit'><a href='$detail_url'>" . __("Detail", TEXTDOMAIN) . "</a></span>";
            $actions['trash_detail'] = "<span class='trash'><a href='$trash_url'>" . __("Trash", TEXTDOMAIN) . "</a></span>";
        }
        return sprintf('%s %s',
            $item['id'],
            $this->row_actions($actions)
        );
    }
    public function no_items()
    {
        _e('No data found.', 'harai');
    }
}