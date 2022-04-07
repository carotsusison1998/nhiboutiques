(function (global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
  typeof define === 'function' && define.amd ? define(factory) :
  (global = global || self, global.forgotPassword = factory());
}(this, function () {
    'use strict';
    var forgotPassword = {
        haraiForgotPassword: function() {
            try {
                var url = ajaxUrl+'harai_forgot_password';
                FLHttp.post(url, 'frm-forgot-password').success(function(res){
                    //console.log(res);
                    var error = $('.login-error');
                    if (!res.status) {
                        error.empty().html(res.mess);
                        return;
                    }
                    $('.member-login .login').empty().html(res.data);
                });
            } catch (e) {
            }
        },
        onEmailKeyUp: function(ev){
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
                [$('#forgot-password'), {click: self.haraiForgotPassword}],
                [$('#harai-login input[name="email"]'), {keyup: self.onEmailKeyUp}],
            ];
            Libs.buildEvents._attachEvents(evs);
        }  
    }
    var self = forgotPassword;
    jQuery(document).ready(function(){
        //Call events
        buildEvents._buildEvents();
    });
    /* Export: */
    return forgotPassword;
}));
