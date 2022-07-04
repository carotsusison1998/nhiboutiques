(function (global, factory) {
    typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
    typeof define === 'function' && define.amd ? define(factory) :
    (global = global || self, global.common = factory());
    }(this, function () {
        'use strict';
    
        var common = {
            // bannerSlideshow: function(){
            //     var selector = $('#home-slideshow');
            //     if(selector.length <= 0) return;
            //     var slideshowTransitions = [
            //         {$Duration:800,x:0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}
            //     ];
            //     var slideOptions = {
            //         $AutoPlay: 1,
            //         //$StartIndex: 0,
            //         $Idle: 5000,
            //         $SlideshowOptions: {
            //             $Class: $JssorSlideshowRunner$,
            //             $Transitions: slideshowTransitions,
            //             $TransitionsOrder: 0
            //         },
            //         // $ArrowNavigatorOptions: {
            //         //     $Class: $JssorArrowNavigator$
            //         // },
            //         $BulletNavigatorOptions: {
            //             $Class: $JssorBulletNavigator$,
            //             $SpacingX: 16,
            //             $SpacingY: 16
            //         },
            //     };
            //     // var elemSlider = new $JssorSlider$("home-slideshow", slideOptions);
            //     var options = { $AutoPlay: 1 };
            //         var jssor1_slider = new $JssorSlider$("home-slideshow", options);
            //     /*#region responsive code begin*/
            //     var MAX_WIDTH = 1200;
            //     function ScaleSlider() {
            //         // var containerElement = elemSlider.$Elmt.parentNode;
            //         // var containerWidth = containerElement.clientWidth;
            //         // if (containerWidth) {
            //         //     var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);
            //         //     elemSlider.$ScaleWidth(expectedWidth);
            //         // }
            //         // else {
            //         //     window.setTimeout(ScaleSlider, 30);
            //         // }
            //     }
            //     ScaleSlider();
            //     $Jssor$.$AddEvent(window, "load", ScaleSlider);
            //     $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            //     $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            //     // $('.slide-arrow-next').on('click', function(){
                    
            //     // });
            // },
            productItemHeight: function(){
                // if ($('.new-products .products .product h2.woocommerce-loop-product__title').length <=0) {
                //   return;
                // }
                Libs.setContentHeight({
                    elem: '.product-new h2.woocommerce-loop-product__title',
                    breakLine: 300,
                    rowNumber: 6,
                    minBreakLine: 300
                });
            },
            productItemHeightOrder: function(){
                // if ($('.new-products .products .product h2.woocommerce-loop-product__title').length <=0) {
                //   return;
                // }
                Libs.setContentHeight({
                    elem: 'product-order h2.woocommerce-loop-product__title',
                    breakLine: 300,
                    rowNumber: 6,
                    minBreakLine: 300
                });
            },
            spLide: function(){
                var splide = new Splide( '.splide', {
                    type   : 'loop',
                    perPage: 5,
                    focus  : 'center',
                    pagination: false,
                    autoplay: true
                } );
                splide.mount();
            }
        }
        /**
         * Define events for all screens
         *
         * @return void
         */
        var buildEvents = {
    
            /**
             * Build events according to the screen
             *
             * @return void
             */
            _buildEvents: function(){
                var evs = [
                    [$('.harai-logout'), {click: self.haraiLogout}]
                ];
                Libs.buildEvents._attachEvents(evs);
            }  
        }
        var self = common;
        jQuery(document).ready(function(){
            // Libs.scrollTop();
            //Open the menu for a smartphone monitor
            // Libs.spMenuToggle();
            self.productItemHeight();
            self.productItemHeightOrder();
            self.spLide();
            //Call events
            buildEvents._buildEvents();
        });
        /* Export: */
        return common;
    }));
    