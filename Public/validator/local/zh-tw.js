/*********************************
 * Themes, rules, and i18n support
 * Locale: Chinese; 中文; TW (Taiwan)
 *********************************/
(function(factory) {
    if (typeof define === 'function') {
        define(function(require, exports, module){
            var $ = require('jquery');
            $._VALIDATOR_URI = module.uri;
            require('../src/jquery.validator')($);
            factory($);
        });
    } else {
        factory(jQuery);
    }
}(function($) {
    /* Global configuration
     */
    $.validator.config({
        //stopOnError: false,
        theme: 'red_right_effect',
        defaultMsg: "{0}格式不正確",
        loadingMsg: "正在驗證...",
        timely:0,
        
        // Custom rules
        rules: {
            digits: [/^\d+$/, "請輸入數字"]
            ,letters: [/^[a-z]+$/i, "{0}只能輸入字母"]
            ,tel: [/^(?:(?:0\d{2,3}[\- ]?[1-9]\d{6,7})|(?:[48]00[\- ]?[1-9]\d{6}))$/, "電話格式不正確"]
            ,mobile: [/^1[3-9]\d{9}$/, "手機號碼格式不正確"]
            ,email: [/^[\w\+\-]+(\.[\w\+\-]+)*@[a-z\d\-]+(\.[a-z\d\-]+)*\.([a-z]{2,4})$/i, "郵箱格式不正確"]
            ,qq: [/^[1-9]\d{4,}$/, "QQ號格式不正確"]
            ,date: [/^\d{4}-\d{1,2}-\d{1,2}$/, "請輸入正確的日期,例:yyyy-mm-dd"]
            ,time: [/^([01]\d|2[0-3])(:[0-5]\d){1,2}$/, "請輸入正確的時間,例:14:30或14:30:00"]
            ,ID_card: [/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])((\d{4})|\d{3}[A-Z])$/, "請輸入正確的身份證號碼"]
            ,url: [/^(https?|ftp):\/\/[^\s]+$/i, "網址格式不正確"]
            ,postcode: [/^[1-9]\d{5}$/, "郵政編碼格式不正確"]
            ,chinese: [/^[\u0391-\uFFE5]+$/, "請輸入中文"]
            ,username: [/^\w{3,20}$/, "請輸入3-20位數字、字母、下劃線"]
            ,password: [/^[0-9a-zA-Z]{6,16}$/, "密碼由6-16位數字、字母組成"]
            ,verify: [/^[0-9a-zA-Z]{4}$/, "驗證碼由4位數字、字母組成"]
            ,zhendig:[/^[\u0391-\uFFE5a-zA-Z\d]+$/, "請輸入中文、英文字母、數字"]
            ,accept: function (element, params){
                if (!params) return true;
                var ext = params[0];
                return (ext === '*') ||
                       (new RegExp(".(?:" + (ext || "png|jpg|jpeg|gif") + ")$", "i")).test(element.value) ||
                       this.renderMsg("只接受{1}後綴", ext.replace('|', ','));
            }
        }
    });

    /* Default error messages
     */
    $.validator.config({
        messages: {
            required: "{0}不能為空",
            remote: "{0}已被使用",
            integer: {
                '*': "請輸入整數",
                '+': "請輸入正整數",
                '+0': "請輸入正整數或0",
                '-': "請輸入負整數",
                '-0': "請輸入負整數或0"
            },
            match: {
                eq: "{0}與{1}不一致",
                neq: "{0}與{1}不能相同",
                lt: "{0}必須小於{1}",
                gt: "{0}必須大於{1}",
                lte: "{0}必須小於或等於{1}",
                gte: "{0}必須大於或等於{1}"
            },
            range: {
                rg: "請輸入{1}到{2}的數",
                gte: "請輸入大於或等於{1}的數",
                lte: "請輸入小於或等於{1}的數"
            },
            checked: {
                eq: "請選擇{1}項",
                rg: "請選擇{1}到{2}項",
                gte: "請至少選擇{1}項",
                lte: "請最多選擇{1}項"
            },
            length: {
                eq: "請輸入{1}個字符",
                rg: "請輸入{1}到{2}個字符",
                gte: "請至少輸入{1}個字符",
                lte: "請最多輸入{1}個字符",
                eq_2: "",
                rg_2: "",
                gte_2: "",
                lte_2: ""
            }
        }
    });

    /* Themes
     */
    var TPL_ARROW = '<span class="n-arrow"><b>◆</b><i>◆</i></span>';
    $.validator.setTheme({
        'simple_right': {
            formClass: 'n-simple',
            msgClass: 'n-right'
        },
        'simple_bottom': {
            formClass: 'n-simple',
            msgClass: 'n-bottom'
        },
        'yellow_top': {
            formClass: 'n-yellow',
            msgClass: 'n-top',
            msgArrow: TPL_ARROW
        },
        'yellow_right': {
            formClass: 'n-yellow',
            msgClass: 'n-right',
            msgArrow: TPL_ARROW
        },
        'yellow_right_effect': {
            formClass: 'n-yellow',
            msgClass: 'n-right',
            msgArrow: TPL_ARROW,
            msgStyle: 'position:absolute;top:0;right:0',
            msgShow: function($msgbox, type){
                var $el = $msgbox.children();
                if ($el.is(':animated')) return;
                if (type === 'error') {
                    $el.css({
                        left: '20px',
                        opacity: 0
                    }).delay(100).show().stop().animate({
                        left: '-4px',
                        opacity: 1
                    }, 150).animate({
                        left: '3px'
                    }, 80).animate({
                        left: 0
                    }, 80);
                } else {
                    $el.css({
                        left: 0,
                        opacity: 1
                    }).fadeIn(200);
                }
            },
            msgHide: function($msgbox, type){
                var $el = $msgbox.children();
                $el.stop().delay(100).show().animate({
                    left: '20px',
                    opacity: 0
                }, 300, function(){
                    $msgbox.hide();
                });
            }
        },
        'red_right_effect': {
            formClass: 'n-red',
            msgClass: 'n-right',
            msgArrow: TPL_ARROW,
            msgStyle: 'position:absolute;',
            msgShow: function($msgbox, type){
                var $el = $msgbox.children();
                if ($el.is(':animated')) return;
                if (type === 'error') {
                    $el.css({
                        left: '20px',
                        opacity: 0
                    }).delay(100).show().stop().animate({
                        left: '-4px',
                        opacity: 1
                    }, 150).animate({
                        left: '3px'
                    }, 80).animate({
                        left: 0
                    }, 80);
                } else {
                    $el.css({
                        left: 0,
                        opacity: 1
                    }).fadeIn(200);
                }
            },
            msgHide: function($msgbox, type){
                var $el = $msgbox.children();
                $el.stop().delay(100).show().animate({
                    left: '20px',
                    opacity: 0
                }, 300, function(){
                    $msgbox.hide();
                });
            }
        }
    });
}));