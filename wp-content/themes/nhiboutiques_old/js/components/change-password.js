(function (global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
  typeof define === 'function' && define.amd ? define(factory) :
  (global = global || self, global.changePassword = factory());
}(this, function () {
    'use strict';
    var changePassword = {
        haraiChangePassword: function() {
            try {
                if (!self.changePassValidation()) {
                    return;
                }
                var url = ajaxUrl+'harai_change_password';
                FLHttp.post(url, 'frm-change-pass').success(function(res){
                    console.log(res);
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
        /**
         * Check validation
         *
         * @return void
         */
        changePassValidation: function () {
            var frmSend = $('#frm-register');
            var valid = true;
            var inputItems = $('#frm-change-pass input[type="password"]');
            $('#frm-change-pass input[type="password"]').removeClass('error');
            if (inputItems.length > 0) {
                inputItems.each(function(index, row){
                    var item = $(row);
                    var value = item.val();
                    if (Libs.isBlank(value)) {
                        item.addClass('error');
                        valid = false;
                    }
                });
            }
            return valid;
        },
        onControlChange: function(){
            var value = $(this).val();
            if (Libs.isBlank(value)) {
                $(this).addClass('error');
            } else {
                $(this).removeClass('error');
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
                [$('#harai-user-change-pass'), {click: self.haraiChangePassword}],
                [$('#frm-change-pass input[type="password"]'), {keyup: self.onControlChange}],
            ];
            Libs.buildEvents._attachEvents(evs);
        }  
    }
    var self = changePassword;
    jQuery(document).ready(function(){
        //Call events
        buildEvents._buildEvents();
    });
    /* Export: */
    return changePassword;
}));
