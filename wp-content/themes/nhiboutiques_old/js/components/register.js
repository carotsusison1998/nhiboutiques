(function (global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
  typeof define === 'function' && define.amd ? define(factory) :
  (global = global || self, global.register = factory());
}(this, function () {
    'use strict';
    var NGlobal = {
        isSearching: false,
        industry_data: [],
        elemForm: '#frm-register'
    };
    var register = {
        onPageLoad: function(options){
            try{
                NGlobal.industry_data = $.parseJSON(Base64.decode(options.industry_data));
            } catch(e){}
        },

        setBgStepHeight: function(){
            var step = $('.harai-register .step');
            if (step.length <= 0) {
                return;
            }
            var screenW = window.innerWidth;
            var stepW = 760;
            var stepH = 130;
            var currentStepH = 130;
            if (screenW <= 414) {
                stepW = 414;
                stepH = 90;
                currentStepH = 90;
            }
            step.css({
                height: currentStepH
            });
            jQuery(window).resize(function(){
                currentStepH = (step.width() * stepH)/stepW;
                step.css({
                    height: currentStepH
                });
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
        * Go to screen step 2
        * @return void
        */
        goToStep2: function(){
            if (!self.step1Validation()) {
                return;
            }
            //Check email
            var email = $($(NGlobal.elemForm).find('input[name="email"]'));
            var emailValue = email.val();
            var error = $('.register-error');
            try {
                var url = ajaxUrl+'harai_check_email_exist';
                FLHttp.post(url, '', 'email='+emailValue).success(function(res){
                    if (res.status){
                        error.empty().html(res.mess);
                        return;
                    }
                    error.empty();
                    self.onLoadStep2Layout();
                });
            } catch (e) {
            }
        },
        /*
        * Load step2 layout
        *
        * @return void
        */
        onLoadStep2Layout: function() {
            try {
                var url = ajaxUrl+'load_step2_layout';
                FLHttp.post(url, '').success(function(res){
                    var results = Libs.decodeHTMLEntities(res.data);
                    var step2Group = $('.register-step2-group');
                    if (step2Group.length <=0 ) {
                        var step1Group = $('.register-step1-group');
                        step1Group.hide();
                        self.setStepClassName(2);
                        $(NGlobal.elemForm).append(results).ready(function(){
                            $('#step2-cancel').on('click', function(){
                                $(NGlobal.elemForm).find('.register-step2-group').remove();
                                step1Group.show();
                                self.setStepClassName(1);
                            });
                            $('#send-step2').on('click', function(){
                                self.goToStep3();
                            });
                            $('.items .ask').on('click', function(){
                                var own = $(this);
                                own.parent().find('.content').slideToggle();
                            });
                        });
                    }
                });
            } catch (e) {
            }
        },
         /*
        * Go to screen step 3
        * @return void
        */
        goToStep3: function(){
            self.onLoadStep3Layout();
        },

        /*
        * Load step2 layout
        *
        * @return void
        */
        onLoadStep3Layout: function() {
            try {
                var url = ajaxUrl+'load_step3_layout';
                FLHttp.post(url, '').success(function(res){
                    var results = Libs.decodeHTMLEntities(res.data);
                    var step3Group = $('.register-step3-group');
                    if (step3Group.length <=0 ) {
                        $(NGlobal.elemForm).find('.register-step2-group').remove();
                        self.setStepClassName(3);
                        $(NGlobal.elemForm).append(results).ready(function(){
                            $('#send-step3').on('click', function(){
                                if (!self.step3Validation()) {
                                    return;
                                }
                                self.goToStep4();
                            });
                            $(NGlobal.elemForm).find('select').on('change', function(){
                                var id = $(this).val();
                                if (Libs.isBlank(id)) {
                                    $(this).addClass('error');
                                } else {
                                    $(this).removeClass('error');
                                }
                            });
                        });
                    }
                });
            } catch (e) {
            }
        },
         /*
        * Go to screen step 3
        * @return void
        */
        goToStep4: function(){
            self.onLoadStep4Layout();
        },

        /*
        * Load step2 layout
        *
        * @return void
        */
        onLoadStep4Layout: function() {
            try {
                var url = ajaxUrl+'load_step4_layout';
                FLHttp.post(url, 'frm-register').success(function(res){
                    //console.log(res);
                    var results = Libs.decodeHTMLEntities(res.data);
                    var step4Group = $('.register-step4-group');
                    if (step4Group.length <=0 ) {
                        $(NGlobal.elemForm).find('.register-step3-group').hide();
                        self.setStepClassName(4);
                        $(NGlobal.elemForm).append(results).ready(function(){
                            $('#send-step4').on('click', function(){
                                self.onRegisterSend();
                            });
                        });
                    }
                });
            } catch (e) {
            }
        },
        onRegisterSend: function(){
            var url = ajaxUrl+'harai_register';
            FLHttp.post(url, 'frm-register').success(function(res){
                var results = Libs.decodeHTMLEntities(res.data);
                console.log(results);
                $('.step').remove();
                $(NGlobal.elemForm).remove();
                $('.harai-register .register-container').prepend(results);
            });
        },

        onBigIndustry: function() {
            var id = $(this).val();
            var optionsText = this.options[this.selectedIndex].text;
            var big_industry_value = $('#big_industry_value');
            if (Libs.isBlank(id)) {
                $(this).addClass('error');
                big_industry_value.val('');
            } else {
                $(this).removeClass('error');
                big_industry_value.val(optionsText);
            }
            var childOptionHtml = '';
            if (NGlobal.industry_data && NGlobal.industry_data.length > 0 && id*1 > 0) {
                for(var i=0; i<NGlobal.industry_data.length; i++) {
                    var item = NGlobal.industry_data[i];
                    if (item.id == id) {
                        var childs = item.child;
                        if (childs && childs.length > 0) {
                            for(var j=0; j<childs.length; j++) {
                                childOptionHtml += '<option value="'+childs[j]+'">'+childs[j]+'</option>';
                            }
                        }
                    }
                }
            }
            var industryChild = $('#child_industry');
            if (industryChild.length > 0) {
                var optionChildFirst = '<option value="">小分類Industry2</option>';
                optionChildFirst = optionChildFirst + childOptionHtml;
                industryChild.empty().html(optionChildFirst);
            }
        },
        onSelectChange: function(){
            var id = $(this).val();
            if (Libs.isBlank(id)) {
                $(this).addClass('error');
            } else {
                $(this).removeClass('error');
            }
        },
        /**
         * Check validation
         *
         * @return void
         */
        step1Validation: function () {
            var frmSend = $('#frm-register');
            var valid = true;
            var inputItems = $('#frm-register input, #frm-register select');
            $('#frm-register input, #frm-register select').removeClass('error');
            if (inputItems.length > 0) {
                inputItems.each(function(index, row){
                    var item = $(row);
                    var attr = item.attr('required');
                    var name = item.attr('name');
                    var value = item.val();
                    if (attr) {
                        if (Libs.isBlank(value)) {
                            item.addClass('error');
                            valid = false;
                        } else {
                            if (name === 'email' && !Libs.checkEmail(value)) {
                                item.addClass('error');
                                valid = false;
                            }
                        }
                    }
                });
            }
            return valid;
        },
        step3Validation: function () {
            var valid = true;
            var applicationPlan = $('#application_plan');
            var courseReservationDate = $('#course_reservation_date');
            if (Libs.isBlank(applicationPlan.val())) {
                applicationPlan.addClass('error');
                valid = false;
            }
            if (Libs.isBlank(courseReservationDate.val())) {
                courseReservationDate.addClass('error');
                valid = false;
            }
            return valid;
        },
        onControlChange: function(){
            var value = $(this).val();
            var name = $(this).attr('name');
            var attr = $(this).attr('required');
            if (attr) {
                if (Libs.isBlank(value)) {
                    $(this).addClass('error');
                } else {
                    $(this).removeClass('error');
                    if (name === 'email' && !Libs.checkEmail(value)) {
                        $(this).addClass('error');
                    }
                }
            }
        },
        setStepClassName: function(type){
            var step = $('.step');
            if(step.length <=0){
                return;
            }
            step.removeClass('step2');
            step.removeClass('step3');
            step.removeClass('step4');
            if (type == 2) {
                step.addClass('step2');
            } else if (type == 3) {
                step.addClass('step3');
            } else if (type == 4) {
                step.addClass('step4');
            }
        },
        onUserStep3Send: function(){
            if (!self.step3Validation()) {
                return;
            }
            self.goToStep4();
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
                [$('#send-step1'), {click: self.goToStep2}],
                [$('#frm-register input[type="text"], #frm-register input[type="password"]'), {keyup: self.onControlChange}],
                [$('#big_industry'), {change: self.onBigIndustry}],
                [$('#child_industry, #partner,#year_in_hr'), {change: self.onSelectChange}],
                [$('.user-step3-send'), {click: self.onUserStep3Send}],
            ];
            Libs.buildEvents._attachEvents(evs);
        }  
    }
    var self = register;
    jQuery(document).ready(function(){
        //Call events
        buildEvents._buildEvents();
        self.setBgStepHeight();
    });
    /* Export: */
    return register;
}));
