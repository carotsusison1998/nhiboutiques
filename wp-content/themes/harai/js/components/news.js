(function (global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
  typeof define === 'function' && define.amd ? define(factory) :
  (global = global || self, global.news = factory());
}(this, function () {
    'use strict';
    var NGlobal = {
        isSearching: false,
        offset: 0,
        totalRow: 0,
        elemReadMore: '.news-page .read-more',
        elemArticles: '.news-page #articles'
    };
    var news = {

        setItemHeight: function(){
            Libs.setContentHeight({
                elem: '.news-page .item h3',
                minBreakLine: 300
            });
            Libs.setContentHeight({
                elem: '.news-page .item .desc',
                minBreakLine: 300
            });
        },

        /**
        * Get total items
        *
        * @return int total items
        */
        getTotalItems: function () {
            var items = $(NGlobal.elemArticles).find('a.news-item');
            if (items.length <= 0) {
                return 0;
            }
            return items.length;
        },

        /*
        * Handling load more content by post type
        * @return void
        */
        onReadMore: function(){
            //var own = $(this);
            var offset = self.getTotalItems();
            //Load content
            self.onLoadContent(true, offset);
        },

        /*
        * Load content by tab type
        *
        * @param boolean isAppend         true: add list returns to data list, false: replace result to data list
        * @param boolean isResetOffset    true: reset offset = 0, false: keep the old value
        * @return void
        */
        onLoadContent: function(isAppend, offset) {
            try {
                if (NGlobal.isSearching) {
                    return;
                }
                NGlobal.isSearching = true;
                var url = ajaxUrl+'get_more_news_list';
                var params = 'offset='+offset;
                FLHttp.post(url, '', params).success(function(res){
                    //console.log('res: ', res);
                    // NGlobal.isSearching = false;
                    // return;
                    if (res.status) {
                        var results = Libs.decodeHTMLEntities(res.data);
                        jQuery(NGlobal.elemArticles).append(results).ready(function(){
                            self.setItemHeight();
                            self.setItemBorder();
                        });
                    }
                    setTimeout(function(){
                        var currentTotalRow = self.getTotalItems();
                        if (currentTotalRow >= res.total_row*1) {
                            if ($(NGlobal.elemReadMore).length > 0) {
                                $(NGlobal.elemReadMore).remove();
                            }
                        }
                    }, 100);                    
                    NGlobal.isSearching = false;
                });
            } catch (e) {
                NGlobal.isSearching = false;
            }
        },
        setItemBorder: function(){
            var items = $('.news-page #articles .item .item-inner');
            items.removeClass('blue');
            items.removeClass('red');
            if (items.length <=0) {
                return;
            }
            var index = 0;
            var screenW = window.innerWidth;
            for(var i=0; i<items.length; i++) {
                var item = $(items[i]);
                var className = '';
                if (screenW <= 768) {
                    if (index == 1) {
                        className = 'blue';
                    } else if (index == 2) {
                        className = 'red';
                    }
                    item.addClass(className);
                    index ++;
                    if (index == 3) {
                        index = 0;
                    }
                } else {
                    if (index == 1) {
                        className = 'blue';
                    } else if (index == 2) {
                        className = 'red';
                    } else if (index == 3) {
                        className = 'red';
                    } else if (index == 4) {
                        className = 'blue';
                    } else if (index == 5) {
                        className = '';
                    }
                    item.addClass(className);
                    index ++;
                    if (index == 6) {
                        index = 0;
                    }
                }
            }
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
                [$(NGlobal.elemReadMore).find('a'), {click: self.onReadMore}]
            ];
            Libs.buildEvents._attachEvents(evs);
        }  
    }
    var self = news;
    jQuery(document).ready(function(){
        //Call events
        buildEvents._buildEvents();
        self.setItemHeight();
        self.setItemBorder();
        jQuery(window).resize(function(){
            self.setItemBorder();
        });
    });
    /* Export: */
    return news;
}));
