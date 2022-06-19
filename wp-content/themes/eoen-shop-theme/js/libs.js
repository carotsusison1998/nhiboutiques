(function (global, factory) {
    typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
    typeof define === 'function' && define.amd ? define(factory) :
    (global = global || self, global.Libs = factory());
  }(this, function () {
      'use strict';
      //screen size on mobile
      var breakPoint = 768;
      //Sidebar width on mobile
      var leftPosition = 250;
      var Libs = {};
  
      /**
      * Get url
      *
      * @param {string} pagePath
      * @return {string} url
      */
      Libs.url = function(pagePath)
      {
          if(Libs.isBlank(pagePath)) return baseUrl;
          return baseUrl+pagePath;
      }
  
      /**
       * Get param string by form id
       *
       * @param {string} formid: form id
       * @returns {string} string params
       */
       Libs.getParamString = function(formid) {
  
          if(Libs.isBlank(formid)) return "";
          var frm = document.getElementById(formid);
          if(Libs.isBlank(frm)) return "";
  
          var param = "";
          for (var i = 0; i < frm.length; i++) {
              var element = frm.elements[i];
              if (element.tagName.toLowerCase() == "input"
                  || element.tagName.toLowerCase() == "select"
                  || element.tagName.toLowerCase() == "textarea") {
                  if (frm.elements[i].type.toLowerCase() == "checkbox"
                      || frm.elements[i].type.toLowerCase() == "radio") {
                      if (frm.elements[i].checked) {
                          if (param == "")
                              param = frm.elements[i].name + "="
                                  + Libs.encodeURL(frm.elements[i].value);
                          else
                              param += "&" + frm.elements[i].name + "="
                                  + Libs.encodeURL(frm.elements[i].value);
                      }
                  } else if (element.type.toLowerCase() != "file") {
                      if (param == "")
                          param = frm.elements[i].name + "="
                              + Libs.encodeURL(frm.elements[i].value);
                      else
                          param += "&" + frm.elements[i].name + "="
                              + Libs.encodeURL(frm.elements[i].value);
                  }
              }
          }
          return param;
      };
  
      /**
       * Reset form
       *
       * @param {string} formid
       * @param {array} dataArray
       * @return void
       */
      Libs.resetForm = function(formid, dataArray) {
        var frm = document.getElementById(formid);
        for (var i = 0; i < frm.length; i++) {
          var element = frm.elements[i];
          if (element.tagName.toLowerCase() == "input"
              || element.tagName.toLowerCase() == "select"
              || element.tagName.toLowerCase() == "textarea") {
            if (frm.elements[i].type.toLowerCase() == "checkbox"
                || frm.elements[i].type.toLowerCase() == "radio") {
              frm.elements[i].checked = false;
  
            } else {
              if(dataArray && dataArray.length > 0){
                for(var j = 0; j < dataArray.length; j++){
                  if(frm.elements[i].name != dataArray[j])
                    frm.elements[i].value = "";
                }
              }else{
                frm.elements[i].value = "";
              }
            }
          }
        }
      };
  
      /**
       * Encode URL
       *
       * @param {string} result
       * @return {string} url encode
       */
      Libs.encodeURL = function(result) {
          var encodeString = encodeURI(result);
          encodeString = encodeString.replace('!', '%21');
          encodeString = encodeString.replace('#', '%23');
          encodeString = encodeString.replace('$', '%24');
          encodeString = encodeString.replace(/&/g, '%26');
          encodeString = encodeString.replace('(', '%28');
          encodeString = encodeString.replace(')', '%29');
          encodeString = encodeString.replace('?', '%3F');
          encodeString = encodeString.replace('?', '%3F');
          encodeString = encodeString.replace(/\+/g, '%2B');
          encodeString = encodeString.replace(/\"/g, '%22');
          encodeString = encodeString.replace(/\'/g, '%27');
          return encodeString;
      };
  
      Libs.safeTrim = function(str){
          try {
              return (typeof str === 'string') ? str.trim() : str.toString();
          } catch (e) {
              return "";
          }
      };
  
      Libs.safeString = function(str){
          try {
              if(Libs.isBlank(str)) return "";
              return str;
          } catch (e) {
              return "";
          }
      };
  
      Libs.rEnter = function(event){
          var _this = $(event.target);
          if (event.which === 13) {
              var sign = event.shiftKey ? -1 : 1;
              event.preventDefault();
              var fields = _this.parents('form:eq(0),body').find('input,textarea');
              var index = fields.index(_this);
              if (index > -1 && (index + 1 * sign) < fields.length)
                  fields.eq(index + 1 * sign).focus();
          }
      }
  
      /**
       * conver string to date
       */
      Libs.checkEmail = function (str) {
          if (Libs.isBlank(str)) return false;
          var filter = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          if (filter.test(str)) {
              return true;
          }
          return false;
      }
      /**
       * Check blank object or string
       *
       * @param str
       * @returns {boolean}
       */
      Libs.isBlank = function(str){
          if (typeof str === undefined || str == null || Libs.safeTrim(str) === "") {
              return true;
          }
          return false;
      }
  
      /**
       * Checks whether an array exists and has data
       *
       * @param Array arr
       * @return {boolean}
       */
      Libs.isArrayData = function(arr) {
          if (Libs.isBlank(arr)) return false;
          if (!Array.isArray(arr) || arr.length <= 0) return false;
          return true;
      }
  
      /**
       * Get param by key
       *
       * @param {string} k: param name
       * @return param value
       */
      Libs.getSearchParams = function(k){
          var p={};
          location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi,function(s,k,v){p[k]=v});
          if(Libs.isBlank(p[k])) return '';
          return k?p[k]:p;
      }
  
      /**
       * Get param by key
       *
       * @param {string} k: param name
       * @return param value
       */
      Libs.getParamsOnUrl = function(){
          var params = window.location.href.split('/');
          return params;
      }
  
      /**
       * Convert html entity string to html
       *
       * @param {string} text: html entity
       * @return {string} html
       */
      Libs.decodeHTMLEntities = function(text) {
          var entities = [
              ['amp', '&'],
              ['apos', '\''],
              ['#x27', '\''],
              ['#x2F', '/'],
              ['#39', '\''],
              ['#47', '/'],
              ['lt', '<'],
              ['gt', '>'],
              ['nbsp', ' '],
              ['quot', '"']
          ];
          for (var i = 0, max = entities.length; i < max; ++i)
              text = text.replace(new RegExp('&'+entities[i][0]+';', 'g'), entities[i][1]);
  
          return text;
      }
  
      /**
       * Insert param to url
       *
       * @param {string} key param key
       * @return {string} new url
       */
      Libs.insertParam = function(key, value) {
          if (history.pushState) {
              var currentUrl = window.location.href;
              //remove any param for the same key
              var currentUrl = Libs.removeURLParameter(currentUrl, key);
  
              //figure out if we need to add the param with a ? or a &
              var queryStart;
              if(currentUrl.indexOf('?') !== -1){
                  queryStart = '&';
              } else {
                  queryStart = '?';
              }
  
              var newurl = currentUrl + queryStart + key + '=' + value
              window.history.pushState({path:newurl},'',newurl);
          }
      }
  
      /**
       * Remove url param
       *
       * @param {string} url
       * @param {string} key param key
       * @return {string} new url
       */
      Libs.removeURLParameter = function(url, key) {
          //better to use l.search if you have a location/link object
          var urlparts= url.split('?');
          if (urlparts.length>=2) {
  
              var prefix= encodeURIComponent(key)+'=';
              var pars= urlparts[1].split(/[&;]/g);
  
              //reverse iteration as may be destructive
              for (var i= pars.length; i-- > 0;) {
                  //idiom for string.startsWith
                  if (pars[i].lastIndexOf(prefix, 0) !== -1) {
                      pars.splice(i, 1);
                  }
              }
  
              url= urlparts[0] + (pars.length > 0 ? '?' + pars.join('&') : "");
              return url;
          } else {
              return url;
          }
      }
  
      /**
      * Check is number
      *
      * @param int number
      * @return boolean
      */
      Libs.isNumeric = function (number) {
          if (Libs.isBlank(number)) {
              return false;
          }
          return $.isNumeric(number);
      }
  
      /**
       * @description Tạo chuỗi mã hóa 8 ký tự bao gồm chữ và số 
       * @author: Luyen Nguyen
       * @return str
       */
      Libs.strRandom = function (chr) {
          if (!Libs.isNumeric(chr)) {
              chr = 6;
          }
          var numberChr = '0x'+Math.pow(10, chr);
          return Math.floor((1 + Math.random()) * numberChr).toString(16).substring(1);
      }
  
      Libs.fncInputNumberAllowComma = function(e) { // IE,FireFox
          if (window.event) {
              if (e.keyCode < 40 || e.keyCode > 57 || e.keyCode == 47
                  || e.keyCode == 44 || e.keyCode == 42 || e.keyCode == 43) {
                  // if(e.keyCode != 59)
                  Libs.fncNonInput(e);
                  return false;
              }
          } else {
              if (e.which == 8 || e.which == 0 || e.which == 13) {
                  return true;
              }
              if (e.which < 40 || e.which > 57 || e.which == 47 || e.which == 44
                  || e.which == 42 || e.which == 43) {
                  // if(e.which != 59)
                  Libs.fncNonInput(e);
                  return false;
              }
          }
          return true;
      }
  
      Libs.fncInputOnlyNumberAllowComma = function(e) { // IE,FireFox
          if (window.event) {
              if (e.keyCode == 46) {
                  Libs.fncNonInput(e);
                  return false;
              }
              if (e.keyCode < 40 || e.keyCode > 57 || e.keyCode == 47
                  || e.keyCode == 44 || e.keyCode == 190 || e.keyCode == 42
                  || e.keyCode == 43) {
                  // if(e.keyCode != 59)
                  Libs.fncNonInput(e);
                  return false;
              }
          } else {
              if (e.which == 46) {
                  Libs.fncNonInput(e);
                  return false;
              }
              if (e.which == 8 || e.which == 0 || e.which == 13) {
                  return true;
              }
              if (e.which < 40 || e.which > 57 || e.which == 47 || e.which == 44
                  || e.which == 42 || e.which == 43) {
                  // if(e.which != 59)
                  Libs.fncNonInput(e);
                  return false;
              }
          }
          return true;
      }
      Libs.fncOnlyDitgit = function(e) { // IE,FireFox
          if (window.event) {
              if (e.keyCode == 46) {
                  Libs.fncNonInput(e);
                  return false;
              }
              if (e.keyCode < 40 || e.keyCode > 57 || e.keyCode == 47
                  || e.keyCode == 44 || e.keyCode == 190 || e.keyCode == 42
                  || e.keyCode == 43 || e.keyCode == 45 || e.keyCode == 219
                  || e.keyCode == 221) {
                  // if(e.keyCode != 59)
                  Libs.fncNonInput(e);
                  return false;
              }
          } else {
              if (e.which == 46) {
                  Libs.fncNonInput(e);
                  return false;
              }
              if (e.which == 8 || e.which == 0 || e.which == 13) {
                  return true;
              }
              if (e.which < 40 || e.which > 57 || e.which == 47 || e.which == 44
                  || e.which == 42 || e.which == 43 || e.which == 45
                  || e.keyCode == 219 || e.keyCode == 221) {
                  // if(e.which != 59)
                  Libs.fncNonInput(e);
                  return false;
              }
          }
          return true;
      }
  
      Libs.fncNonInput = function(ev) { // IE/Firefox
          if (window.event) {
              ev.returnValue = false;
              ev.cancelBubble = true;
              ev.preventDefault();
          } else {
              ev.preventDefault();
              ev.stopPropagation();
          }
      }
      Libs.convert2Money = function(price) {
          var price_str = price + " ";
          var dot_index = price_str.indexOf(".");
          
          var odd_umbers = "";
          var even_numbers = price+"";
          if(dot_index >= 0) {
              odd_umbers = price_str.slice(dot_index, -1);
              odd_umbers = odd_umbers.substring(0, 3);
              even_numbers = price_str.substring(0, dot_index);
          }
          
          // Convert phan nguyen ra dang tien:
          var result = "";
          if(price == 0) return "0";
          var price_temp = even_numbers+"";
          var max = even_numbers.length;
          var flag = max-3;
          if(flag < 0)flag = 0;
          for(var i=max; i > 0; i -= 3) {                 
              var a = price_temp.substring(flag, i);          
              result = a +","+result;
              if(i < 0)i = 0;
              flag -= 3;
              if(flag < 0)flag = 0;
          }
          return result.substring(0, result.length-1) + odd_umbers;
          //return result.substring(0, result.length-1);
      }
  
      /**
       * Find objects in the array by value and field
       *
       * @param array items
       * @param string field
       * @param string value
       * @return boolean|object
       */
      Libs.find = function (items, field, value, isIndex) {
          if (!items)
              return null;
          for (var i = 0; i < items.length; i++) {
              if (value == items[i][field]) {
                  if (Libs.isBlank(isIndex)) {
                      return items[i];
                  }
                  return i;
              }
          }
          return null;
      };
  
      /**
       * Get coutn item in object
       *
       * @param object obj
       * @return int
       */
      Libs.getCountObject = function(obj)
      {
          if(Libs.isEmptyObject(obj)) return 0;
          return Object.keys(obj).length;
      }
  
      /**
       * Check is object
       *
       * @param object obj
       * @return boolean
       */
      Libs.isEmptyObject = function(obj){
          return typeof obj !== "object" || Libs.isBlank(obj);
      }
  
      /**
      * Split String with white space
      *
      * @param string str
      * @return string
      */
      Libs.strSplitSpace = function(str){
          if(Libs.isBlank(str)) return;
          return str.split(/[\s ]+/);
      }
  
      /**
      * Replace validation message
      *
      * @param string str
      * @param string srtInput
      * @param string strReplace
      * @return string
      */
      Libs.strReplace = function(str, srtInput, strReplace){
  
          if(Libs.isBlank(str) || Libs.isBlank(srtInput)) return;
          return str.replace(strReplace, srtInput);
      }
  
      /**
      * Replace line breaks
      *
      * @param string str
      * @param string strReplace  Character wants to replace to
      * @return string
      */
      Libs.strReplaceLineBreaks = function(str, strReplace){
  
          if(Libs.isBlank(str)) return;
          if (Libs.isBlank(strReplace)) {
              strReplace = " ";
          }
          return str.replace(new RegExp('\r?\n|&nbsp;','g'), strReplace);
      }
  
      /**
      * Get ascii character in string
      *
      * @param string str
      * @param string strReplace  Character wants to replace to
      * @return string
      */
      Libs.getASCIIChar = function(str, strReplace){
  
          if (Libs.isBlank(str)) {
              return "";
          }
          if (Libs.isBlank(strReplace)) {
              strReplace = " ";
          }
          str = Libs.strTrim(str);
          // UNICODE RANGE : DESCRIPTION
          // 
          // 3000-303F : punctuation
          // 3040-309F : hiragana
          // 30A0-30FF : katakana
          // FF00-FFEF : Full-width roman + half-width katakana
          // 4E00-9FAF : Common and uncommon kanji
          // 
          // Non-Japanese punctuation/formatting characters commonly used in Japanese text
          // 2605-2606 : Stars
          // 2190-2195 : Arrows
          // u203B     : Weird asterisk thing
          var regex = /[\u3000-\u303F]|[\u3040-\u309F]|[\u30A0-\u30FF]|[\uFF00-\uFFEF]|[\u4E00-\u9FAF]|[\u2605-\u2606]|[\u2190-\u2195]|\u203B/g; 
          return str.replace(regex, strReplace);
          //return str.replace(/[^\x00-\xFF]/g, strReplace);
      }
  
      /**
      * Get non ascii character in string
      *
      * @param string str
      * @return string
      */
      Libs.getNonASCIIChars = function(str){
  
          if (Libs.isBlank(str)) {
              return "";
          }
          str = Libs.strTrim(str);
          // UNICODE RANGE : DESCRIPTION
          // 
          // 3000-303F : punctuation
          // 3040-309F : hiragana
          // 30A0-30FF : katakana
          // FF00-FFEF : Full-width roman + half-width katakana
          // 4E00-9FAF : Common and uncommon kanji
          // 
          // Non-Japanese punctuation/formatting characters commonly used in Japanese text
          // 2605-2606 : Stars
          // 2190-2195 : Arrows
          // u203B     : Weird asterisk thing
          var regex = /[\u3000-\u303F]|[\u3040-\u309F]|[\u30A0-\u30FF]|[\uFF00-\uFFEF]|[\u4E00-\u9FAF]|[\u2605-\u2606]|[\u2190-\u2195]|\u203B/g; 
          return str.match(regex);
          //return str.match(/[^\x00-\xFF]/g);
      }
  
  
      /**
      * Remove white spaces in string
      *
      * @param string str
      * @return string
      */
      Libs.strTrim = function(str){
          return str.replace(/^\s+|\s+$/gm,'');
      }
  
      /**
      * Replace multiple spaces with a single space
      *
      * @param string str
      * @return string
      */
      Libs.strSingleSpace = function(str){
          if (Libs.isBlank(str)) {
              return "";
          }
          return str.replace(/^\s+|\s+$|\s+(?=\s)/g, "");
      }
  
      /**
      * Remove all white spaces in an array
      *
      * @param array arr
      * @return array
      */
      Libs.trimArraySpaces = function(arr){
          if(undefined === arr || null == arr) return;
          $.each( arr, function( key, value ) {
              if (typeof value === 'string' || value instanceof String)
              {
                  arr[key] = Libs.strTrim(value);
              }
          });
          return arr;
      }
  
      /**
      * Line Breaks in Strings
      *
      * @param string str
      * @param boolean is_xhtml
      *
      * example 1: nl2br('Kevin\nvan\nZonneveld');
      * returns 1: 'Kevin<br />\nvan<br />\nZonneveld'
      * example 2: nl2br("\nOne\nTwo\n\nThree\n", false);
      * returns 2: '<br>\nOne<br>\nTwo<br>\n<br>\nThree<br>\n'
      * example 3: nl2br("\nOne\nTwo\n\nThree\n", true);
      * returns 3: '<br />\nOne<br />\nTwo<br />\n<br />\nThree<br />\n'
      * @return string
      */
      Libs.nl2br = function (str, is_xhtml) {
          var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br ' + '/>' : '<br>';
          return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
      }
  
      /**
      * Check startDate <= endDate
      *
      * @param string startDate  format yyyy/mm/dd or yyyy-mm-dd
      * @param string endDate  format yyyy/mm/dd or yyyy-mm-dd
      * @param string formatStartDate
      * @param string formatEndDate
      * @return array
      */
      Libs.checkStartEndDate = function (startDate, endDate, formatStartDate, formatEndDate) {
          var d1 = startDate;
          var d2 = endDate;
          if (typeof (startDate) === 'string') {
              formatStartDate = formatStartDate || Libs.getDateTimeFormat();
              d1 = Date.parse(startDate, formatStartDate);
          }
          if (typeof (endDate) === 'string') {
              formatEndDate = formatEndDate || Libs.getDateTimeFormat();
              d2 = Date.parse(endDate, formatEndDate);
          }
          return d1 <= d2;
      };
  
      /**
       * Get date format
       */
      Libs.getDateFormat = function (format) {
          if(!Libs.isBlank(format)){
              return format;
          }
          return 'yyyy.mm.dd';
      }
  
       /**
       * Get date format
       */
      Libs.getDateTimeFormat = function (format) {
          if(!Libs.isBlank(format)){
              return format;
          }
          return 'yyyy.mm.dd H:i:s';
      }
  
      Libs.getTime = function () {
          var d = new Date();
          return d.getTime();
      }
  
      /**
       * conver string to date
       */
      Libs.strToDateYYYMMDD = function (str) {
          var arr = str.split('.');
          if(arr.length == 3){
              return new Date(arr[0], arr[1], arr[2]);
          }
          return null;
      }
  
      /**
      * Set height item group 
      *
      * @param string str
      * @return string
      */
      Libs.setContentHeight = function (options){
          var opts = jQuery.extend({
              elem: null,
              isInnerHeight: true,
              rowNumber: 3,
              breakLine: 768,
              minBreakLine: 549,
              totalCol: 100,
              minHeight: false
          }, options);
          Libs.setContentHeightByRow(opts);
          jQuery(window).resize(function(){
              Libs.setContentHeightByRow(opts);
          });
      }
      Libs.setContentHeightByRow = function(opts){
          if(!opts.elem) return;
          var newItem = [];
          var childItem = [];
          var rowIndex = 0;
          var rowItemClass='row-item';
          var screenW = window.innerWidth;
          if (screenW <= opts.minBreakLine) {
              if (opts.minHeight) {
                  jQuery(opts.elem).css({'min-height':'auto'});
              } else {
                  jQuery(opts.elem).css({'height':'auto'});
              }
              return;
          }
          var rowNumber = opts.rowNumber;
          if (screenW <= opts.breakLine) {
              rowNumber = 2;
          }
          for (var i=0; i<opts.totalCol; i++) {
              var className = rowItemClass+i;
              if (jQuery('.'+className).length <= 0) {
                  break;
              }
              jQuery('body').find('.'+className).removeClass(className);
          }
          jQuery(opts.elem).each(function(index, item) {
              if (index > 0 && index % rowNumber ==0) {
                  newItem.push(childItem);
                  childItem = [];
                  rowIndex ++;
              }
              jQuery(item).addClass(rowItemClass+rowIndex);
              childItem.push(rowIndex);
          });
          newItem.push(childItem);
          if (newItem.length > 0) {
              for(var i=0; i<newItem.length; i++) {
                  var currentClassName = '.'+rowItemClass+i;
                  if (opts.minHeight) {
                      jQuery(currentClassName).css({'min-height':'auto'});    
                  } else {
                      jQuery(currentClassName).css({'height':'auto'});
                  }
                  var maxH = Libs.getMaxHeightElement(currentClassName, opts.isInnerHeight);
                  if (opts.minHeight) {
                      jQuery(currentClassName).css({'min-height': maxH});
                  } else {
                      jQuery(currentClassName).css({'height': maxH});
                  }
              }
          }
      }
  
      Libs.getMaxHeightElement = function(ele, isInnerHeight){
          var arrH = [];
          jQuery(ele).each(function() {
              var itemH =  parseInt(jQuery( this ).height());
              if (isInnerHeight)
              {
                  itemH = parseInt(jQuery( this ).innerHeight());
              }
              arrH.push(itemH);
          });
          return Math.max.apply(Math, arrH);
      }
      /**
       * Submit form
       *
       * @param string url
       * @param string formData
       * @returns void
       */
      var frmID = 0;
      Libs.submitFormAction = function(url, formData) {
          var form = document.createElement('form'),
              hiddenToken = document.createElement("input"),
              hiddenEle = document.createElement("input");
          //Token
          hiddenToken.setAttribute("type", "hidden");
          hiddenToken.setAttribute("name", "_token");
          hiddenToken.setAttribute("value", $('meta[name="csrf-token"]').attr('content'));
          //data input
          hiddenEle.setAttribute("type", "hidden");
          hiddenEle.setAttribute("name", "form_data");
          hiddenEle.setAttribute("value", formData);
          form.setAttribute("name", "hdn_frm_submit"+ ++frmID);
          form.setAttribute("action", url);
          form.setAttribute("method", "post");
          form.appendChild(hiddenToken);
          form.appendChild(hiddenEle);
          document.body.appendChild(form);
          form.submit();
          form.remove();
      }
  
      /**
       *Create popup
       *
       * @param string title          Modal title
       * @param string data           html or text
       * @param function funCallback  Call the event after close modal
       * @param string className
       * @return String html
       */
      var globalID = 0;
      Libs.openModal = function(title, data, funCallback, className){
          var popupTpl = jQuery('<div></div>');
          popupTpl.attr("id", "fl-modal" + ++globalID);
          popupTpl.attr("class", "fl-modal "+(className ? className : ''));
          if (Libs.isBlank(title)) {
              title='';
          }
          var screen_height = window.innerHeight, html = jQuery('html');
          var modalHtml = '<div class="fl-modal-inner">';
              modalHtml += '<div class="fl-modal-title">'+title+'</div>';
              modalHtml += '<div class="fl-modal-close"></div>',
              modalHtml +='<div class="fl-modal-content"> ' +data+'</div><div class="fl-modal-backdrop"></div>';
              modalHtml += '</div>';
          jQuery(document.body).append(popupTpl);
          popupTpl.html(modalHtml);
          var _this = popupTpl;
          var screenW = window.innerWidth;
          var screenH = window.innerHeight - 100;
          var popupW = popupTpl.outerWidth();
          var popupH = popupTpl.outerHeight();
          var titleH = popupTpl.find('.fl-modal-title').outerHeight();
          popupTpl.find('.fl-modal-content').css({
              top: titleH
          });
          var modalContentH = popupTpl.find('.fl-modal-content').outerHeight();
          var modalH = titleH + modalContentH;
          if (modalH > screenH) {
              modalH = screenH;
              popupTpl.find('.fl-modal-content').css({bottom: 15});
          }
          popupTpl.css({
              height: modalH,
              top: '50%',
              marginTop: -(modalH/2)
          });
          jQuery('.fl-modal-close, .fl-modal-backdrop').on('click',
          function () {
              globalID--;
              _this.remove();
              if (typeof funCallback ===  'function') {
                  funCallback();
              }
          });
          return _this;
      }
  
      /**
       * Get format file size
       *
       * @param int bytes
       * @param int decimalPoint
       * @returns string
       */
      Libs.formatFileSize = function(bytes, decimalPoint) {
         if(bytes == 0) return '0 Bytes';
         var k = 1000,
             dm = (Libs.isBlank(decimalPoint)) ? 2 : decimalPoint,
             sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
             i = Math.floor(Math.log(bytes) / Math.log(k));
         return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
      }
  
      /**
      * Get the file extension
      *
      * @param  string fileName
      * @return string
      */
      Libs.getExtensionFile = function (fileName) {
          if (fileName === 'undefined' || fileName == null) return;
          var ext = fileName.substr((fileName.lastIndexOf('.') + 1));
          return ext;
      }
      Libs.imagesLoaded = function(elem, options) {
          var images = $(elem).find("img"), 
              loadedImages = [];
          if (images.length <= 0) {
              return;
          }
          images.each(function(i, image) {
              function loaded() {
                  loadedImages.push($(this));
                  if(options.imageLoaded) {
                      options.imageLoaded(this);    
                  }
                  if(loadedImages.length == images.length) {
                      if(options.complete) {
                          options.complete(loadedImages);    
                      }
                  }
              }
              if(image.complete || image.complete === undefined) {
                  // Image is already loaded
                  loaded.call(image);               
              } else {
                  // Image is not loaded yet, bind event
                  $(image).on('load',loaded);
              }
          });
      }
      Libs.getCurrentDate = function () {
          let date = new Date();
          let year = date.getFullYear().toString();
          let month = (date.getMonth() + 1).toString().padStart(2, "0");
          let day = date.getDate().toString().padStart(2, "0");
          return year + "/" + month + "/" + day;
      }
  
      Libs.getCurrentDatetime = function (format) {
          let date = new Date();
          let year = date.getFullYear().toString();
          let month = (date.getMonth() + 1).toString().padStart(2, "0");
          let day = date.getDate().toString().padStart(2, "0");
          let hour = date.getHours().toString().padStart(2, "0");
          let mi = date.getMinutes().toString().padStart(2, "0");
          let ss = date.getSeconds().toString().padStart(2, "0");
          if (Libs.isBlank(format)) {
              format = '/';
          }
          return year + format + month + format + day + " " + hour + ":" + mi;
      }
  
      /**
      * Check the upload file extension
      *
      * @param  string fileName
      * @param  array extArr  array containing file extensions
      * @return boolean
      */
      Libs.checkExtensionFile = function (fileName, extArr) {
          if (Libs.isBlank(fileName)) {
              return;
          }
          var extFileRequired = ['docx', 'xls', 'xlsx'];
          if (Libs.isArrayData(extArr)) {
              extFileRequired = extArr;
          }
          fileName = fileName.toLowerCase();
          var ext = fileName.substr((fileName.lastIndexOf('.') + 1));
          for (var i = 0; i < extFileRequired.length; i++) {
              if (ext === extFileRequired[i]) {
                  return true;
              }
          }
          return false;
      }
  
      /**
      * Get day name by date
      *
      * @param  string dateInput format: yyyy-mm-dd
      * @return string day name
      */
      Libs.getDayNameByDate = function (dateInput) {
          var date = new Date(dateInput);
          var currentDay = date.getDay();
          var dayName = '';
          switch (currentDay) {
              case 0:
                  dayName = "Sun";
                  break;
              case 1:
                  dayName = "Mon";
                  break;
              case 2:
                  dayName = "Tue";
                  break;
              case 3:
                  dayName = "Wed";
                  break;
              case 4:
                  dayName = "Thu";
                  break;
              case 5:
                  dayName = "Fri";
                  break;
              case 6:
                  dayName = "Sat";
          }
          return dayName;
      }
  
      /**
      * Check for comparison values that exist in the array
      *
      * @param array arr ex: [1,3,5,...]
      * @param object value comparison value exists in an array
      * @return boolean
      */
      Libs.checkValueExistInArray = function (arr, value) {
          if (!Libs.isArrayData(arr)) {
              return;
          }
          return $.inArray( value, arr )*1 !== -1;
      }
  
      /**
      * Check scroll bottom by element
      *
      * @param object elem            The html tag to scroll to the bottom
      * @param function fnCalback     Call back function when scrolling to the bottom
      * @param int offset             he scroll distance is close to the bottom
      * @return void
      */
      var lastScrollTop = 0, st= 0;
      Libs.scrollBottom = function (elem, fnCalback, offset) {
          if (!offset) {
              offset = 10;
          }
          if (Libs.isBlank(elem) || jQuery(elem).length <= 0) {
              jQuery(window).on("scroll", function(e) {
                  st = $(window).scrollTop();
                  if(st < lastScrollTop) {
                      return;
                  }
                  //get height of the (browser) window aka viewport
                  var scrollHeight = jQuery(document).height();
                  // get height of the document 
                  var scrollPosition = jQuery(window).height() + st;
                  //console.log(scrollHeight, scrollPosition, scrollHeight - scrollPosition);
                  //if ((scrollHeight - scrollPosition) / scrollHeight === 0) {
                  if ((scrollHeight - scrollPosition) <= offset) {
                      if (typeof fnCalback === 'function') {
                          fnCalback();
                      }
                  }
                  lastScrollTop = st;
              });
          } else {
              jQuery(elem).on('scroll', function() {
                  st = $(this).scrollTop();
                  if(st < lastScrollTop) {
                      return;
                  }
                  lastScrollTop = st;
                  if(Math.round($(this).scrollTop() + $(this).innerHeight(), 10) >= Math.round($(this)[0].scrollHeight, 10) - offset) {
                      if (typeof fnCalback === 'function') {
                          fnCalback();
                      }
                  }
              });
          }
      }
  
      /*
      * Navbar with a side bar when viewed in mobile
      *
      * @return void
      */
      var isOpen = true;
      Libs.spMenuToggle = function()
      {
          var selector = jQuery('.navbar-toggler'),
              sidebar = jQuery('.nav-menu');
          if(!selector.length || !sidebar.length) return;
          selector.on('click', function(e){
              var own = $(this);
              e.preventDefault();
              e.stopPropagation();
              if (isOpen) {
                  own.addClass('open');
                  sidebar.css({'display': 'inline-block'});
                  //topmenu.css({'display': 'flex'});
                  if (!jQuery('.menu-backdrop').length) {
                     jQuery('#header .container').append('<div class="menu-backdrop">&nbsp;</div>').ready(function(){
                          jQuery('.menu-backdrop').on('click', function(e){
                              jQuery('.menu-backdrop').remove();
                              sidebar.css({'display': 'none'});
                              //topmenu.css({'display': 'none'});
                              own.removeClass('open');
                              isOpen = !isOpen;
                          });
                     });
                  }
              } else {
                  own.removeClass('open');
                  sidebar.css({'display': 'none'});
                  //topmenu.css({'display': 'none'});
                  jQuery('.menu-backdrop').remove();
              }
              isOpen = !isOpen;
          });
      }
  
      /*
       * show loadding
       *
       */
      Libs.showLoading = function() {
          var loadingHtml = '<div class="fl-loading" style="position: fixed; z-index: 9999999; top: 0; bottom: 0; left: 0; right: 0;">'
                  +'<div style="position: absolute; left: 50%; top: 50%; margin-left: -30px; margin-top: -30px;border: 5px solid #f3f3f3; border-radius: 50%;border-top: 5px solid #1d1f54;width: 60px;height: 60px;-webkit-animation: spin 1s linear infinite;animation: spin 1s linear infinite;"></div>'
                  +'<style>@-webkit-keyframes spin {0% { -webkit-transform: rotate(0deg); }100% { -webkit-transform: rotate(360deg); }}@keyframes spin {0% { transform: rotate(0deg); }100% { transform: rotate(360deg);}}</style></div>';
          jQuery('body').append(loadingHtml);
      };
  
      /*
       * remove loadding
       *
       */
      Libs.removeLoading = function() {
          if(jQuery('.fl-loading').length > 0){
              jQuery('.fl-loading').remove();
          }
      };
  
      Libs.scrollTop = function()
      {
        var page_top = $('.btn-scroll-top');
        if(!page_top.length) return;
          page_top.hide();
          $(window).scroll(function () {
              if ($(this).scrollTop() > 200) {
                  page_top.fadeIn();
              } else {
                  page_top.fadeOut();
              }
              page_top.off('click').on('click', function(){
                  $('html, body').animate({scrollTop: 0}, 500);
              });
          });
      }
  
      Libs.setItemHeight = function(ele, isInnerHeight) {
          if (Libs.isBlank(isInnerHeight)) {
              isInnerHeight = false;
          } else {
              isInnerHeight = true;
          }
          var heightArr = [];
          $(ele).css({'height': 'auto'});
          $(ele).each(function() {
              var itemH =  parseInt($( this ).height());
              if (isInnerHeight) {
                  itemH = parseInt($( this ).innerHeight());
              }
              heightArr.push(itemH);
          });
          var maxH = Math.max.apply(Math, heightArr);
          $(ele).css({'height':maxH});
      }
  
      /**
      * Build events for html elements
      *
      * @returns void
      */
      Libs.buildEvents = {
          /**
          * Apply events for html elements
          *
          * @param array evs  Array contains the list of events 
          *                   ex: [[element1, {click: function(e){}}], [element2, {mousedown: function(e){}}]]
          * @returns void
          */
          _applyEvents: function(evs){
              for (var i=0, el, ch, ev; i < evs.length; i++) {
                  el = evs[i][0];
                  if (evs[i].length === 2){
                      ch = undefined;
                      ev = evs[i][1];
                  } else if (evs[i].length === 3){
                      ch = evs[i][1];
                      ev = evs[i][2];
                  }
                  el.on(ev, ch);
              }
          },
          _unapplyEvents: function(evs){
              for (var i=0, el, ev, ch; i < evs.length; i++) {
                  el = evs[i][0];
                  if (evs[i].length === 2){
                      ch = undefined;
                      ev = evs[i][1];
                  } else if (evs[i].length === 3){
                      ch = evs[i][1];
                      ev = evs[i][2];
                  }
                  el.off(ev, ch);
              }
          },
          _attachEvents: function(evs){
              this._detachEvents(evs);
              this._applyEvents(evs);
          },
          _detachEvents: function(evs){
              this._unapplyEvents(evs);
          }   
      }
  
      /* Export: */
      return Libs;
  }));
  