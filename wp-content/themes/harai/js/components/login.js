(function (global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
  typeof define === 'function' && define.amd ? define(factory) :
  (global = global || self, global.login = factory());
}(this, function () {
    'use strict';
    var login = {
        haraiLogin: function() {
            try {
                var url = ajaxUrl+'harai_login';
                FLHttp.post(url, 'harai-login').success(function(res){
                    //console.log(res);
                    var error = $('.login-error');
                    if (!res.status) {
                        error.empty().html(res.mess);
                        return;
                    }
                    window.location.href= res.data;
                });
            } catch (e) {
            }
        },
        onPasswordKeyUp: function(ev){
            var keycode = (ev.keyCode ? ev.keyCode : ev.which);
            if (keycode == '13') {
                self.haraiLogin();
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
                [$('#harai-login'), {click: self.haraiLogin}],
                [$('#harai-login input[type="password"]'), {keyup: self.onPasswordKeyUp}],
            ];
            Libs.buildEvents._attachEvents(evs);
        }  
    }
    var self = login;
    jQuery(document).ready(function(){
        //Call events
        buildEvents._buildEvents();
    });
    /* Export: */
    return login;
}));
