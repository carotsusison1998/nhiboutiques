<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * asign data for insert, update
 * @param array $tbl_structure
 * @param array $data
 * @return string|boolean
 */
if (!function_exists('assign_data')) {
    function assign_data($tbl_structure, $data) {
        if(!$tbl_structure || !$data) return;
        $data=convert_object_to_array($data);
        foreach ($tbl_structure as $key => $val) {
            if (isset($data[$key])) {
                $tbl_structure[$key] = trim($data[$key]);
                if (is_blank($tbl_structure[$key])) {
                    $tbl_structure[$key] = $val;
                }
            } else { 
                unset($tbl_structure[$key]);
            }
        }
        return $tbl_structure;
    }
}
/**
 * convert object to array
 * @param array $data
 * @return multitype:|unknown
 */
if (!function_exists('convert_object_to_array')) {
    function convert_object_to_array($data) {
        if (is_object($data)) {
            $data = get_object_vars($data);
        }
        if (is_array($data)) {
            return $data;
        }
        else {
            return $data;
        }
    }
}
/**
 * Function for basic field validation (present and neither empty nor only white space)
 * @param unknown $var
 * @return boolean
 */
if (!function_exists('is_blank')) {
    function is_blank($var){
        return (!isset($var) || trim($var)==='');
    }
}
/**
 * return json result using ajax
 * @param string $status
 * @param unknown $mess
 * @param unknown $data
 * @param number $total_row
 * @return string
 */
if (!function_exists('return_json_result')) {
    function return_json_result($status = false, $mess = null, $data = null, $total_row = 0){
        $result["status"]=$status;
        $result["mess"]=$mess;
        $result["data"]=$data;
        $result["total_row"]=$total_row;
        return json_encode($result);
    }
}

/**
 * Get the folder name according to the path
 * @param string $base_dir
 * @param int $level
 * @return int[][]|string[][]|NULL[][]|unknown[][]
 */
if (!function_exists('expand_directories_matrix')) {
    function expand_directories_matrix($base_dir, $level = 0) {
        $directories = array();
        foreach(scandir($base_dir) as $file) {
            if($file == '.' || $file == '..') continue;
            $dir = $base_dir.DIRECTORY_SEPARATOR.$file;
            if(is_dir($dir)) {
                $directories[]= array(
                'level' => $level,
                'name' => $file,
                'path' => $dir,
                    'children' => expand_directories_matrix($dir, $level +1)
                );
            }
        }
        return $directories;
    }
}

/**
 * Get the directory list
 * @param array $list
 * @param array $parent
 * @param string $prefix
 */
if (!function_exists('show_directories_list')) {
    function show_directories_list($list, $parent = array(), &$output = array(), $sepector = "/")
    {
        foreach ($list as $directory){
            $parent_name = count($parent) ? $parent['name'] : '';
            $prefix = str_repeat($sepector, $directory['level']);
            $folder_name = $parent_name."$prefix{$directory['name']}";
            array_push($output, $folder_name);
            if(count($directory['children'])){
                // list the children directories
                show_directories_list($directory['children'], $directory, $output, $sepector);
            }
        }
        return $output;
    }
}

/**
 * Get timestamp to day
 *
 * @return string
 */
if (!function_exists('timestamp')) {
    function timestamp() {
        $date = date('Y-m-d H:i:s');
        return strtotime($date);
    }
}

/**
* Get the file extension
*
* @param string $fileName
* @return string
*/
if (!function_exists('get_file_extension')) {
    function get_file_extension($file_name) {
        return pathinfo($file_name, PATHINFO_EXTENSION);
    }
}

/**
* Replace apostrophe in string
*
* @param string $str
* @return string
*/
if (!function_exists('replace_apostrophe')) {
    function replace_apostrophe($str) {
        //$plain_text = preg_replace("/\\\\+'/", "'",$plain_text);
        $str=preg_replace('/(\\\\\\\\\\\\\')|(\\\\\')/',"'" ,$str);
        $str=preg_replace('/(\\\\\\\\\\\\\")|(\\\\\")/', '"' ,$str);
        return $str;
    }
}

/**
* Check for comparison values that exist in the array
*
* @param array $arr ex:     [1,3,5,...]
* @param object $value      comparison value exists in an array
* @param boolean $is_index  Get index in the array
* @return boolean
*/
if (!function_exists('check_value_exist_in_array')) {
    function check_value_exist_in_array($arr, $value, $is_index = false) {
        if (!$arr || !$value) {
            return null;
        }
        if($is_position) {
            return array_search($value, $arr);
        } else if(in_array($value, $arr)) {
            return true;
        }
        return null;
    }
}

/**
* Get elements in arrays by key and value
*
* @param array $array
* @param string $index  key in array
* @param string $value  value in array
* @return boolean
*/
if (!function_exists('search_results_array')) {
    function search_results_array($array, $index, $value) {
        if (!$array || is_blank($index) || is_blank($value)) {
            return null;
        }
        foreach($array as $arrayInf) {
            if(isset($arrayInf[$index]) && $arrayInf[$index] == $value) {
                return $arrayInf;
            }
        }
        return null;
    }
}

/**
* Check email
*
* @param string $email  Email address
* @return boolean
*/
if (!function_exists('check_validate_email')) {
    function check_validate_email($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }
}

/**
 * Create post type
 * $data = array(
 *    'post_type' => post type name,
 *    'post_type_slug' => slug post type,
 *    'taxonomy_cat' => Post type category
 *    'taxonomy_list' => List of taxonomies currently displayed in post type (array)
 *    'post_type_name' => //Plural post type name,
 *    'post_type_singular_name' => //Post type singular name,
 *    )
 */
if ( ! function_exists( 'create_custom_post_type' ) ) {
    function create_custom_post_type($data = array(), $text_domain = 'ezloc')
    {
        if(!$data) return;
        if(empty($data['post_type'])) return;
        //__( $data['post_type_name'], $text_domain)
        $label = array(
            'name' => $data['post_type_name'],
            'singular_name' => __( $data['post_type_singular_name'], $text_domain ) 
        );
        $rewrite = array(
            'slug'                  => (isset($data['taxonomy_cat'])) ? __($data['post_type_slug'].'/%'.$data['taxonomy_cat'].'%','slug', $text_domain) : $data['post_type_slug'],
            'with_front'            => false,
            'pages'                 => true,
            'feeds'                 => true,
        );
        $support_diff = (isset($data['support_diff'])) ? $data['support_diff'] : null;
        $support = array(
            'title',
            'editor',
            'excerpt',
            'author',
            'thumbnail',
            'comments',
            'trackbacks',
            'revisions',
            'custom-fields'
        );
        if($support_diff)
            $support = array_diff($support, $support_diff);
        $args = array(
            'labels' => $label, //Call the labels in the variable $ label above
            'description' => __( (!empty($data['desc'])) ? $data['desc'] : '', $text_domain), //Description of post type
            'supports' => $support, //Features supported in post type
            'taxonomies' => (isset($data['taxonomy_list'])) ? $data['taxonomy_list'] : array() , //Taxonomies are allowed to be used to classify content
            'hierarchical' => (empty($data['is_hierarchical'])) ? false : true, //Allow hierarchy, if false, then post type is the same as Post, true is the same as Page
            'public' => (!isset($data['is_public']) || $data['is_public']) ? true : false, //Enabling post type: false will hide Permalink when creating posts
            'show_ui' => true, //Display admin pane like Post / Page
            'show_in_menu' => true, //Display on Admin Menu (left hand)
            'show_in_nav_menus' => true, //Display in Appearance -> Menus
            'show_in_admin_bar' => true, //Displayed in the black Admin bar.
            'menu_position' => (empty($data['menu_position'])) ? 5 : $data['menu_position'], //Order of position displayed in the menu (left hand)
            'menu_icon' => (empty($data['menu_icon'])) ? '' : $data['menu_icon'], //The path to the icon will be displayed
            'can_export' => true, //Content can be exported using Tools -> Export
            'has_archive' => true, //Allow archive (month, date, year)
            'exclude_from_search' => (empty($data['is_from_search'])) ? false : true, //Removed from search results
            'publicly_queryable' => true, //To display parameters in the query, must be set to true
            'capability_type' => 'post', //
            'rewrite' => $rewrite,
            'publicly_queryable'  => true,
            'query_var'           => true,
            'capabilities' => array(
                'create_posts' => (!isset($data['is_create_posts']) || $data['is_create_posts']) ? true : false, // Removes support for the "Add New" function ( use 'do_not_allow' instead of false for multisite set ups )
            ),
            'map_meta_cap' => (empty($data['is_map_meta_cap'])) ? true : false, // Set to `false`, if users are not allowed to edit/delete existing posts
        );
        register_post_type($data['post_type'], $args);
    }
}

/**
 * Create taxonomy(category)
 * $data = array(
 *    'post_type' => 'ten post type',
 *    'taxonomy' => 'ten taxonomy',
 *    'post_type_slug' => 'slug post type',
 *    'taxonomy_name' => 'taxonomys name',
 *    'taxonomy_singular_name' => 'taxonomy name',
 *    'desc' => 'Mô tả cho taxonomy',
 *    'is_hierarchical' => 'boolean' => true: allows to display this taxonomy when creating new posts, otherwise not display
 );
 */
if ( ! function_exists( 'create_custom_taxonomy' ) ) {
    function create_custom_taxonomy($data = array(), $text_domain = 'fl')
    {
        if(!$data) return;
        if(empty($data['post_type']) || empty($data['taxonomy'])) return;
        $labels = array(
            //'name'                       => _x( $data['taxonomy_name'], $text_domain ),
            'name'                       => __( (empty($data['taxonomy_name'])) ? "" : $data['taxonomy_name'], $text_domain ),
            'singular_name'              => __( (empty($data['taxonomy_singular_name'])) ? "" : $data['taxonomy_singular_name'], $text_domain ),
            'menu_name'                  => __( (empty($data['taxonomy_name'])) ? "" : $data['taxonomy_name'], $text_domain ),
            'all_items'                  => __( 'All Items', $text_domain ),
            'parent_item'                => __( 'Parent Item', $text_domain ),
            'parent_item_colon'          => __( 'Parent Item:', $text_domain ),
            'new_item_name'              => __( 'New Item Name', $text_domain ),
            'add_new_item'               => __( 'Add New Item', $text_domain ),
            'edit_item'                  => __( 'Edit Item', $text_domain ),
            'update_item'                => __( 'Update Item', $text_domain ),
            'view_item'                  => __( 'View Item', $text_domain ),
            'separate_items_with_commas' => __( 'Separate items with commas', $text_domain ),
            'add_or_remove_items'        => __( 'Add or remove items', $text_domain ),
            'choose_from_most_used'      => __( 'Choose from the most used', $text_domain ),
            'popular_items'              => __( 'Popular Items', $text_domain ),
            'search_items'               => __( 'Search Items', $text_domain ),
            'not_found'                  => __( 'Not Found', $text_domain ),
            'no_terms'                   => __( 'No items', $text_domain ),
            'items_list'                 => __( 'Items list', $text_domain ),
            'items_list_navigation'      => __( 'Items list navigation', $text_domain ),
        );
        $rewrite = array(
            'slug'                       => _x($data['post_type_slug'],'slug', $text_domain),
            'with_front'                 => true,
            'hierarchical'               => true,
        );
        
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => (!isset($data['is_hierarchical']) || $data['is_hierarchical']) ? true : false,//true: enables display to select taxonomy when creating post type
            'public'                     => (!isset($data['is_public']) || $data['is_public']) ? true : false,
            'show_ui'                    => (!isset($data['show_ui'])) ? true : false,
            'show_admin_column'          => (!isset($data['show_admin_column'])) ? true : false,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
            'rewrite'                    => (empty($data['post_type_slug'])) ? true : $rewrite,
        );
        register_taxonomy($data['taxonomy'], array( $data['post_type'] ), $args );
    }
}

/*
 * Create path for custom post type
 * @param string $permalink
 * @param array $post
 * @param string $post_type
 * @param string $taxonomy
 * @param string $text_domain
 */
function fl_custom_post_type_link($permalink = null, $post = null, $post_type = null, $taxonomy = null, $text_domain = '')
{
    if(!$permalink || !$post || !$post_type || !$taxonomy) return;

    if ( $post_type !== $post->post_type ) {
        return $permalink;
    }
    // Abort early if the placeholder rewrite tag isn't in the generated URL.
    if ( false === strpos( $permalink, '%' ) ) {
        return $permalink;
    }

    $terms = get_the_terms( $post->ID, $taxonomy );

    if ( ! empty( $terms ) ) {
        if ( function_exists( 'wp_list_sort' ) ) {
            $terms = wp_list_sort( $terms, 'term_id', 'ASC' );
        } else {
            usort( $terms, '_usort_terms_by_ID' );
        }
        $category_object = apply_filters( 'fl_custom_post_type_link_cat', $terms[0], $terms, $post );

        $category_object = get_term( $category_object, $taxonomy );
        $slug     = $category_object->slug;
        if ( $category_object->parent ) {
            $ancestors = get_ancestors( $category_object->term_id,$taxonomy );
            foreach ( $ancestors as $ancestor ) {
                $ancestor_object = get_term( $ancestor, $taxonomy );
                $slug     = $ancestor_object->slug . '/' . $slug;
            }
        }
    } else {
        // If no terms are assigned to this post, use a string instead (can't leave the placeholder there)
        $slug = _x( 'khong-phan-loai', 'slug', $text_domain );
    }
    $permalink = str_replace( '%'.$taxonomy.'%', $slug, $permalink );
    return $permalink;
}

/*
 * Get list of articles by taxonomy
 */
function list_posts_by_taxonomy( $post_type, $taxonomy, $get_terms_args = array(), $wp_query_args = array() ){
    $tax_terms = get_terms( $taxonomy, $get_terms_args );
    if( $tax_terms ){
        foreach( $tax_terms  as $tax_term ){
            $query_args = array(
                'post_type' => $post_type,
                "$taxonomy" => $tax_term->slug,
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'ignore_sticky_posts' => true
            );
            $query_args = wp_parse_args( $wp_query_args, $query_args );

            $my_query = new WP_Query( $query_args );
            if( $my_query->have_posts() ) { ?>
                <h2 id="<?php echo $tax_term->slug; ?>" class="tax_term-heading"><?php echo $tax_term->name; ?></h2>
                <ul>
                <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
                    <li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
                <?php endwhile; ?>
                </ul>
                <?php
            }
            wp_reset_query();
        }
    }
}
/**
 * Get the upload file id
 * @param unknown $file: $_FILES['file']
 * @param number $post_id
 * @param string $set_as_featured
 */
function upload_file_action( $file, $post_id = 0 , $set_as_featured = false ) {
    if(!$file) return;
    $upload = wp_upload_bits( $file['name'], null, file_get_contents( $file['tmp_name'] ) );
    $wp_filetype = wp_check_filetype( basename( $upload['file'] ), null );
    $wp_upload_dir = wp_upload_dir();
    $attachment = array(
        'guid' => $wp_upload_dir['baseurl'] .'/'. _wp_relative_upload_path( $upload['file'] ),
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => preg_replace('/\.[^.]+$/', '', basename( $upload['file'] )),
        'post_content' => '',
        'post_status' => 'inherit'
    );
    $attach_id = wp_insert_attachment( $attachment, $upload['file'], $post_id );
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata( $attach_id, $upload['file'] );
    wp_update_attachment_metadata( $attach_id, $attach_data );
    if( $set_as_featured == true ) {
        update_post_meta( $post_id, '_thumbnail_id', $attach_id );
    }
    return $attach_id;
}

/**
 * Delete the bulk action by post type
 * @param array|string $post_type: list of post type arrays
 * @param string void
 */
if (!function_exists('remove_bulk_actions')) {
    function remove_bulk_actions($post_types = array()) {
        if (!$post_types) {
            return;
        }
        if (is_string($post_types)) {
            add_filter('bulk_actions-edit-'.$post_types, '__return_empty_array');
        } else {
            for ($i=0; $i < count($post_types); $i++) {
                add_filter('bulk_actions-edit-'.$post_types[$i], '__return_empty_array');
            }
        }
    }
}

/**
 * Get custom field by post id
 * @param string $field_type   The custom filed code is generated from a custom field
 * @param int $post_id   post id
 * @param object custom field object
 */
if (!function_exists('get_custom_field_by_post_id')) {
    function get_custom_field_by_post_id($field_type = null, $post_id = null) {
        if (is_blank($field_type) || is_blank($post_id)) {
            return;
        }
        return get_field( $field_type, $post_id);
    }
}

/**
* Random string
*
* @param int $length
* @param int $type
* @return string
*/
if (!function_exists('fl_random_string')) {
    function fl_random_string($length = 10, $type = 0) {
        $chars = "";
        if ($type == 0) {
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        } elseif ($type == 1) {
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        } elseif ($type == 2) {
            $chars = "0123456789";
        } elseif ($type == 3) {
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!\"\#$%&'()*+,-./:;<=>?@[\]^_`{|}~";
        }
        if (!$chars) {
            return '';
        }
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $char = $chars[rand(0, strlen($chars) - 1)];
            $randomString .= $char;
        }
        return $randomString;
    }
}
/**
 * Check multibyte character
 *
 * @param srting $s
 * @return boolean
 */
if ( !function_exists('is_multibyte') ) {
    function is_multibyte($s)
    {
        return mb_strlen($s, 'utf-8') < strlen($s);
    }
}

/**
 * Download file
 *
 * @param srting $file_path   Path to read the file (ex: /Source/uploads/test.png)
 * @param srting $file_name   File name
 * @return string
 */
if ( !function_exists('fl_download_file') ) {
    function fl_download_file($file_path = null, $file_name = null, $is_delete = false) {
        if (!$file_path || !$file_name) {
            return;
        }
        if ( !file_exists( $file_path )) {
            return;
        }
        $file_ext = get_file_extension($file_name);
        $file_ext = strtolower($file_ext);
        $ctype = '';
        if ($file_ext == 'pdf') {
            $ctype="application/pdf";
        } else if ($file_ext == 'exe') {
            $ctype="application/octet-stream";
        } else if ($file_ext == 'exe') {
            $ctype="application/octet-stream";
        } else if ($file_ext == 'zip') {
            $ctype="application/zip";
        } else if ($file_ext == 'doc' || $file_ext == 'docx') {
            $ctype="application/msword";
        } else if ($file_ext == 'csv' || $file_ext == 'xls' || $file_ext == 'xlsx') {
            $ctype="application/vnd.ms-excel";
        } else if ($file_ext == 'ppt') {
            $ctype="application/vnd.ms-powerpoint";
        } else if ($file_ext == 'gif') {
            $ctype="image/gif";
        } else if ($file_ext == 'png') {
            $ctype="image/png";
        } else if ($file_ext == 'jpeg' || $file_ext == 'jpg') {
            $ctype="image/jpg";
        } else if ($file_ext == 'tif' || $file_ext == 'tiff') {
            $ctype="image/tiff";
        } else if ($file_ext == 'psd') {
            $ctype="image/psd";
        } else if ($file_ext == 'bmp') {
            $ctype="image/bmp";
        } else if ($file_ext == 'ico') {
            $ctype="image/vnd.microsoft.icon";
        } else {
            $ctype="application/force-download";
        }
        header("Pragma: public"); // required
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false); // required for certain browsers
        header("Content-Type: $ctype");
        header("Content-Disposition: attachment; filename=\"".$file_name."\";" );
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: ".filesize($file_path));
        ob_clean();
        flush();
        readfile( $file_path );
        if ($is_delete && file_exists( $file_path)) {
            unlink($file_path);
        }
        exit();
    }
}
/**
 * Convert date
 *
 * @param string $str_date format is date ex YYYY-mm-dd
 * @param string $format_in  ex format Y-m-d
 * @param string $format_out  ex format Y/m/d
 * @return string
 */
if ( !function_exists('convert2_datetime') ) {
    function convert2_datetime($str_date, $format_in, $format_out) {
        if (empty($str_date)) {
            return null;
        }
        $new_date = convert2_datetime($str_date, $format_in);
        if ($new_date != null) {
            return date_format($new_date, $format_out);
        }
        return null;
    }
}

/**
 * Convert string to date
 *
 * @param string $str_time format is date ex YYYY-mm-dd
 * @param string $format  ex format Y-m-d
 */
if ( !function_exists('convert2_datetime') ) {
    function convert2_datetime($str_time, $format) {
        try {
            if (empty($str_time) || empty($format)) {
                return null;
            }
            return date_create_from_format($format, $str_time);
        } catch (Exception $e) {
            return null;
        }
    }
}
/**
 * Convert date to day name
 *
 * @param string $str_date format is date ex YYYY-mm-dd
 * @return string day name
 */
if ( !function_exists('convert_date_to_dayname') ) {
    function convert_date_to_dayname($str_date) {
        if (empty($str_date)) {
            return null;
        }
       return date('D', strtotime($str_date));
    }
}

/**
 * Add days, months, years by fixed date
 *
 * @param string $string: Date input format dd/MM/YYYY or YYYY/MM/dd
 * @param string $type: 1: Add by date, 2: Add by week, 3: Add by month
 * @param string $value: Number of days or weeks or months
 * @param string $separator
 * @return boolean|string
 */
if ( !function_exists('add_dates_by_date') ) {
    function add_dates_by_date($date_input = null, $type=null, $value = null, $separator = '-', $is_format = true){
        if(empty($date_input) || empty($type) || empty($value)) return false;
        $stringArr = "";
        $day = "";
        $month = "";
        $year = "";
        $stringArr = explode ( $separator, $date_input );
        if(!$stringArr || count($stringArr) < 2) return false;
        if($is_format){
            $day = $stringArr[2];
            $month = $stringArr[1];
            $year = $stringArr[0];
        }else{
            $day = $stringArr[0];
            $month = $stringArr[1];
            $year = $stringArr[2];
        }
        if(!checkdate($month, $day, $year)) return false;
        $result = "";
        $current_date = $year."-".$month."-".$day;
        // cong them ngay
        if($type == 1){
            $result = strtotime(date("Y-m-d", strtotime($current_date)) . " +$value day");
            $result = strftime("%Y-%m-%d", $result);
        }else if($type == 2){
            $result = strtotime(date("Y-m-d", strtotime($current_date)) . " +$value week");
            $result = strftime("%Y-%m-%d", $result);
        }else if($type == 3){
            $result = strtotime(date("Y-m-d", strtotime($current_date)) . " +$value month");
            $result = strftime("%Y-%m-%d", $result);
        }
        return $result;
    }
}
?>
