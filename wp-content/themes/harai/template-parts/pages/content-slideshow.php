<?php
    global $wpdb, $post;
    // if (isset($_SESSION[IDOL_BANNER_ORDER_SESSION])) {
    //     $_SESSION[IDOL_BANNER_ORDER_SESSION] = !$_SESSION[IDOL_BANNER_ORDER_SESSION];
    // } else {
    //     $_SESSION[IDOL_BANNER_ORDER_SESSION] = true;
    // }
    // $banner_order = 'desc';
    // if (!empty($_SESSION[IDOL_BANNER_ORDER_SESSION])) {
    //     $banner_order = 'asc';
    // }
    // $banners = get_posts(array(
    //     'post_type' => 'banner_cpt',
    //     'showposts' => -1,
    //     'post_status'      => 'publish',
    //     'order' => $banner_order
    // ));
    $banners = get_posts(array(
        'post_type' => 'banner_cpt',
        'showposts' => -1,
        'post_status'      => 'publish',
        'orderby' => 'rand'
    ));
    $banner_items = array();
    if($banners){
        foreach( $banners  as $item ) {
            $banner_url = wp_get_attachment_url( get_post_thumbnail_id($item->ID), 'thumbnail' );
            if (!empty($banner_url)) {
                $banner_item['id'] = $item->ID;
                $banner_item['title'] = $item->post_title;
                $banner_item['image'] = $banner_url;
                array_push($banner_items, $banner_item);
            }
        }
    }
    if($banner_items && count($banner_items) > 0){
        ?>
            <!-- slideshow -->
            <div class="banner">
                <!-- container -->
                <div class="container">
                    <!-- home slideshow -->
                    <div class="jssor-slides" id="home-slideshow">
                        <!-- Loading Screen -->
                        <div data-u="loading" class="slideshow-loading">
                            <img src="<?php echo DEF_IMAGES?>spin.svg" alt="loading" />
                        </div>
                        <div data-u="slides" class="slides">
                            <?php foreach( $banner_items  as $banner ){?>
                                <?php
                                    $url = get_custom_field_by_post_id('_banner_url', $banner['id']);
                                ?>
                                <?php if (!empty($url)){?>
                                    <div><a href="<?php echo $url?>" target="_blank"><img data-u="image" src="<?php echo $banner['image']?>" alt="<?php echo $banner['title']?>" /></a></div>
                                <?php } else {?>
                                    <div><img data-u="image" src="<?php echo $banner['image']?>" alt="<?php echo $banner['title']?>" /></div>
                                <?php }?>
                            <?php }?>
                        </div>
                        <?php if ($banner_items && count($banner_items) > 1) {?>
                            <!-- Bullet Navigator -->
                            <div data-u="navigator" class="nav-slides" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
                                <div data-u="prototype" class="i"></div>
                            </div>
                            <!-- //Bullet Navigator -->
                            <!-- Arrow Navigator -->
                            <!-- <div data-u="arrowleft" class="slide-arrow slide-arrow-prev" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
                                <svg viewbox="0 0 16000 16000">
                                    <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                                    <polyline class="a" points="7777.8,6080 5857.8,8000 7777.8,9920 "></polyline>
                                    <line class="a" x1="10142.2" y1="8000" x2="5857.8" y2="8000"></line>
                                </svg>
                            </div>
                            <div data-u="arrowright" class="slide-arrow slide-arrow-next" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
                                <svg viewbox="0 0 16000 16000">
                                    <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                                    <polyline class="a" points="8222.2,6080 10142.2,8000 8222.2,9920 "></polyline>
                                    <line class="a" x1="5857.8" y1="8000" x2="10142.2" y2="8000"></line>
                                </svg>
                            </div> -->
                            <!-- //Arrow Navigator -->
                        <?php }?>
                    </div>
                    <!-- //home slideshow -->
                </div>
                <!-- //container -->
            </div>
            <!-- //slideshow -->
        <?php
    }
?>