// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

/***************************************************************

    Table of Content:
    - UiKit
    - Formalize
    - imagesLoaded
    - FitVids
    - Flexslider
    - Superfish
    - hoverIntent

*****************************************************************/

/*! UIkit 2.6.0 | http://www.getuikit.com | (c) 2014 YOOtheme | MIT License */

!function(a){if("function"==typeof define&&define.amd&&define("uikit",function(){var b=a(window,window.jQuery,window.document);return b.load=function(a,c,d,e){var f,g=a.split(","),h=[],i=(e.config&&e.config.uikit&&e.config.uikit.base?e.config.uikit.base:"").replace(/\/+$/g,"");if(!i)throw new Error("Please define base path to uikit in the requirejs config.");for(f=0;f<g.length;f+=1){var j=g[f].replace(/\./g,"/");h.push(i+"/js/addons/"+j)}c(h,function(){d(b)})},b}),!window.jQuery)throw new Error("UIkit requires jQuery");window&&window.jQuery&&a(window,window.jQuery,window.document)}(function(a,b,c){"use strict";var d=b.UIkit||{},e=b("html"),f=b(window);return d.fn?d:(d.version="2.6.0",d.fn=function(a,c){var e=arguments,f=a.match(/^([a-z\-]+)(?:\.([a-z]+))?/i),g=f[1],h=f[2];return d[g]?this.each(function(){var a=b(this),f=a.data(g);f||a.data(g,f=new d[g](this,h?void 0:c)),h&&f[h].apply(f,Array.prototype.slice.call(e,1))}):(b.error("UIkit component ["+g+"] does not exist."),this)},d.support={},d.support.transition=function(){var a=function(){var a,b=c.body||c.documentElement,d={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd otransitionend",transition:"transitionend"};for(a in d)if(void 0!==b.style[a])return d[a]}();return a&&{end:a}}(),d.support.animation=function(){var a=function(){var a,b=c.body||c.documentElement,d={WebkitAnimation:"webkitAnimationEnd",MozAnimation:"animationend",OAnimation:"oAnimationEnd oanimationend",animation:"animationend"};for(a in d)if(void 0!==b.style[a])return d[a]}();return a&&{end:a}}(),d.support.requestAnimationFrame=a.requestAnimationFrame||a.webkitRequestAnimationFrame||a.mozRequestAnimationFrame||a.msRequestAnimationFrame||a.oRequestAnimationFrame||function(b){a.setTimeout(b,1e3/60)},d.support.touch="ontouchstart"in window&&navigator.userAgent.toLowerCase().match(/mobile|tablet/)||a.DocumentTouch&&document instanceof a.DocumentTouch||a.navigator.msPointerEnabled&&a.navigator.msMaxTouchPoints>0||a.navigator.pointerEnabled&&a.navigator.maxTouchPoints>0||!1,d.support.mutationobserver=a.MutationObserver||a.WebKitMutationObserver||a.MozMutationObserver||null,d.Utils={},d.Utils.debounce=function(a,b,c){var d;return function(){var e=this,f=arguments,g=function(){d=null,c||a.apply(e,f)},h=c&&!d;clearTimeout(d),d=setTimeout(g,b),h&&a.apply(e,f)}},d.Utils.removeCssRules=function(a){var b,c,d,e,f,g,h,i,j,k;a&&setTimeout(function(){try{for(k=document.styleSheets,e=0,h=k.length;h>e;e++){for(d=k[e],c=[],d.cssRules=d.cssRules,b=f=0,i=d.cssRules.length;i>f;b=++f)d.cssRules[b].type===CSSRule.STYLE_RULE&&a.test(d.cssRules[b].selectorText)&&c.unshift(b);for(g=0,j=c.length;j>g;g++)d.deleteRule(c[g])}}catch(l){}},0)},d.Utils.isInView=function(a,c){var d=b(a);if(!d.is(":visible"))return!1;var e=f.scrollLeft(),g=f.scrollTop(),h=d.offset(),i=h.left,j=h.top;return c=b.extend({topoffset:0,leftoffset:0},c),j+d.height()>=g&&j-c.topoffset<=g+f.height()&&i+d.width()>=e&&i-c.leftoffset<=e+f.width()?!0:!1},d.Utils.options=function(a){if(b.isPlainObject(a))return a;var c=a?a.indexOf("{"):-1,d={};if(-1!=c)try{d=new Function("","var json = "+a.substr(c)+"; return JSON.parse(JSON.stringify(json));")()}catch(e){}return d},d.Utils.template=function(a,b){for(var c,d,e,f,g=a.replace(/\n/g,"\\n").replace(/\{\{\{\s*(.+?)\s*\}\}\}/g,"{{!$1}}").split(/(\{\{\s*(.+?)\s*\}\})/g),h=0,i=[],j=0;h<g.length;){if(c=g[h],c.match(/\{\{\s*(.+?)\s*\}\}/))switch(h+=1,c=g[h],d=c[0],e=c.substring(c.match(/^(\^|\#|\!|\~|\:)/)?1:0),d){case"~":i.push("for(var $i=0;$i<"+e+".length;$i++) { var $item = "+e+"[$i];"),j++;break;case":":i.push("for(var $key in "+e+") { var $val = "+e+"[$key];"),j++;break;case"#":i.push("if("+e+") {"),j++;break;case"^":i.push("if(!"+e+") {"),j++;break;case"/":i.push("}"),j--;break;case"!":i.push("__ret.push("+e+");");break;default:i.push("__ret.push(escape("+e+"));")}else i.push("__ret.push('"+c.replace(/\'/g,"\\'")+"');");h+=1}f=["var __ret = [];","try {","with($data){",j?'__ret = ["Not all blocks are closed correctly."]':i.join(""),"};","}catch(e){__ret = [e.message];}",'return __ret.join("").replace(/\\n\\n/g, "\\n");',"function escape(html) { return String(html).replace(/&/g, '&amp;').replace(/\"/g, '&quot;').replace(/</g, '&lt;').replace(/>/g, '&gt;');}"].join("\n");var k=new Function("$data",f);return b?k(b):k},d.Utils.events={},d.Utils.events.click=d.support.touch?"tap":"click",b.UIkit=d,b.fn.uk=d.fn,b.UIkit.langdirection="rtl"==e.attr("dir")?"right":"left",b(function(){if(b(document).trigger("uk-domready"),d.support.mutationobserver){try{var a=new d.support.mutationobserver(d.Utils.debounce(function(){b(document).trigger("uk-domready")},300));a.observe(document.body,{childList:!0,subtree:!0})}catch(c){}d.support.touch&&d.Utils.removeCssRules(/\.uk-(?!navbar).*:hover/)}}),e.addClass(d.support.touch?"uk-touch":"uk-notouch"),d)}),function(a,b){"use strict";var c=a(window),d="resize orientationchange",e=[],f=function(g,h){var i=this,j=a(g);j.data("stackMargin")||(this.element=j,this.columns=this.element.children(),this.options=a.extend({},f.defaults,h),this.columns.length&&(c.on(d,function(){var d=function(){i.process()};return a(function(){d(),c.on("load",d)}),b.Utils.debounce(d,150)}()),a(document).on("uk-domready",function(){i.columns=i.element.children(),i.process()}),this.element.data("stackMargin",this),e.push(this)))};a.extend(f.prototype,{process:function(){var b=this;this.revert();var c=!1,d=this.columns.filter(":visible:first"),e=d.length?d.offset().top:!1;if(e!==!1)return this.columns.each(function(){var d=a(this);d.is(":visible")&&(c?d.addClass(b.options.cls):d.offset().top!=e&&(d.addClass(b.options.cls),c=!0))}),this},revert:function(){return this.columns.removeClass(this.options.cls),this}}),f.defaults={cls:"uk-margin-small-top"},b.stackMargin=f,a(document).on("uk-domready",function(){a("[data-uk-margin]").each(function(){var c,d=a(this);d.data("stackMargin")||(c=new f(d,b.Utils.options(d.attr("data-uk-margin"))))})}),a(document).on("uk-check-display",function(){e.forEach(function(a){a.element.is(":visible")&&a.process()})})}(jQuery,jQuery.UIkit),function(a){function b(a,b,c,d){return Math.abs(a-b)>=Math.abs(c-d)?a-b>0?"Left":"Right":c-d>0?"Up":"Down"}function c(){j=null,l.last&&(l.el.trigger("longTap"),l={})}function d(){j&&clearTimeout(j),j=null}function e(){g&&clearTimeout(g),h&&clearTimeout(h),i&&clearTimeout(i),j&&clearTimeout(j),g=h=i=j=null,l={}}function f(a){return a.pointerType==a.MSPOINTER_TYPE_TOUCH&&a.isPrimary}var g,h,i,j,k,l={},m=750;a(function(){var n,o,p,q=0,r=0;"MSGesture"in window&&(k=new MSGesture,k.target=document.body),a(document).bind("MSGestureEnd",function(a){var b=a.originalEvent.velocityX>1?"Right":a.originalEvent.velocityX<-1?"Left":a.originalEvent.velocityY>1?"Down":a.originalEvent.velocityY<-1?"Up":null;b&&(l.el.trigger("swipe"),l.el.trigger("swipe"+b))}).on("touchstart MSPointerDown",function(b){("MSPointerDown"!=b.type||f(b.originalEvent))&&(p="MSPointerDown"==b.type?b:b.originalEvent.touches[0],n=Date.now(),o=n-(l.last||n),l.el=a("tagName"in p.target?p.target:p.target.parentNode),g&&clearTimeout(g),l.x1=p.pageX,l.y1=p.pageY,o>0&&250>=o&&(l.isDoubleTap=!0),l.last=n,j=setTimeout(c,m),k&&"MSPointerDown"==b.type&&k.addPointer(b.originalEvent.pointerId))}).on("touchmove MSPointerMove",function(a){("MSPointerMove"!=a.type||f(a.originalEvent))&&(p="MSPointerMove"==a.type?a:a.originalEvent.touches[0],d(),l.x2=p.pageX,l.y2=p.pageY,q+=Math.abs(l.x1-l.x2),r+=Math.abs(l.y1-l.y2))}).on("touchend MSPointerUp",function(c){("MSPointerUp"!=c.type||f(c.originalEvent))&&(d(),l.x2&&Math.abs(l.x1-l.x2)>30||l.y2&&Math.abs(l.y1-l.y2)>30?i=setTimeout(function(){l.el.trigger("swipe"),l.el.trigger("swipe"+b(l.x1,l.x2,l.y1,l.y2)),l={}},0):"last"in l&&(isNaN(q)||30>q&&30>r?h=setTimeout(function(){var b=a.Event("tap");b.cancelTouch=e,l.el.trigger(b),l.isDoubleTap?(l.el.trigger("doubleTap"),l={}):g=setTimeout(function(){g=null,l.el.trigger("singleTap"),l={}},250)},0):l={},q=r=0))}).on("touchcancel MSPointerCancel",e),a(window).on("scroll",e)}),["swipe","swipeLeft","swipeRight","swipeUp","swipeDown","doubleTap","tap","singleTap","longTap"].forEach(function(b){a.fn[b]=function(c){return a(this).on(b,c)}})}(jQuery),function(a,b){"use strict";var c=function(b,d){var e=this;this.options=a.extend({},c.defaults,d),this.element=a(b),this.element.data("alert")||(this.element.on("click",this.options.trigger,function(a){a.preventDefault(),e.close()}),this.element.data("alert",this))};a.extend(c.prototype,{close:function(){function a(){b.trigger("closed").remove()}var b=this.element.trigger("close");this.options.fade?b.css("overflow","hidden").css("max-height",b.height()).animate({height:0,opacity:0,"padding-top":0,"padding-bottom":0,"margin-top":0,"margin-bottom":0},this.options.duration,a):a()}}),c.defaults={fade:!0,duration:200,trigger:".uk-alert-close"},b.alert=c,a(document).on("click.alert.uikit","[data-uk-alert]",function(d){var e=a(this);if(!e.data("alert")){var f=new c(e,b.Utils.options(e.data("uk-alert")));a(d.target).is(e.data("alert").options.trigger)&&(d.preventDefault(),f.close())}})}(jQuery,jQuery.UIkit),function(a,b){"use strict";var c=function(b,d){var e=this,f=a(b);f.data("buttonRadio")||(this.options=a.extend({},c.defaults,d),this.element=f.on("click",this.options.target,function(b){b.preventDefault(),f.find(e.options.target).not(this).removeClass("uk-active").blur(),f.trigger("change",[a(this).addClass("uk-active")])}),this.element.data("buttonRadio",this))};a.extend(c.prototype,{getSelected:function(){this.element.find(".uk-active")}}),c.defaults={target:".uk-button"};var d=function(b,c){var e=a(b);e.data("buttonCheckbox")||(this.options=a.extend({},d.defaults,c),this.element=e.on("click",this.options.target,function(b){b.preventDefault(),e.trigger("change",[a(this).toggleClass("uk-active").blur()])}),this.element.data("buttonCheckbox",this))};a.extend(d.prototype,{getSelected:function(){this.element.find(".uk-active")}}),d.defaults={target:".uk-button"};var e=function(b,c){var d=this,f=a(b);f.data("button")||(this.options=a.extend({},e.defaults,c),this.element=f.on("click",function(a){a.preventDefault(),d.toggle(),f.trigger("change",[f.blur().hasClass("uk-active")])}),this.element.data("button",this))};a.extend(e.prototype,{options:{},toggle:function(){this.element.toggleClass("uk-active")}}),e.defaults={},b.button=e,b.buttonCheckbox=d,b.buttonRadio=c,a(document).on("click.buttonradio.uikit","[data-uk-button-radio]",function(d){var e=a(this);if(!e.data("buttonRadio")){var f=new c(e,b.Utils.options(e.attr("data-uk-button-radio")));a(d.target).is(f.options.target)&&a(d.target).trigger("click")}}),a(document).on("click.buttoncheckbox.uikit","[data-uk-button-checkbox]",function(c){var e=a(this);if(!e.data("buttonCheckbox")){var f=new d(e,b.Utils.options(e.attr("data-uk-button-checkbox")));a(c.target).is(f.options.target)&&a(c.target).trigger("click")}}),a(document).on("click.button.uikit","[data-uk-button]",function(){var b=a(this);if(!b.data("button")){{new e(b,b.attr("data-uk-button"))}b.trigger("click")}})}(jQuery,jQuery.UIkit),function(a,b){"use strict";var c=!1,d=function(e,f){var g=this,h=a(e);h.data("dropdown")||(this.options=a.extend({},d.defaults,f),this.element=h,this.dropdown=this.element.find(".uk-dropdown"),this.centered=this.dropdown.hasClass("uk-dropdown-center"),this.justified=this.options.justify?a(this.options.justify):!1,this.boundary=a(this.options.boundary),this.boundary.length||(this.boundary=a(window)),"click"==this.options.mode||b.support.touch?this.element.on("click",function(b){var d=a(b.target);d.parents(".uk-dropdown").length||((d.is("a[href='#']")||d.parent().is("a[href='#']"))&&b.preventDefault(),d.blur()),g.element.hasClass("uk-open")?(d.is("a")||!g.element.find(".uk-dropdown").find(b.target).length)&&(g.element.removeClass("uk-open"),c=!1):g.show()}):this.element.on("mouseenter",function(){g.remainIdle&&clearTimeout(g.remainIdle),g.show()}).on("mouseleave",function(){g.remainIdle=setTimeout(function(){g.element.removeClass("uk-open"),g.remainIdle=!1,c&&c[0]==g.element[0]&&(c=!1)},g.options.remaintime)}).on("click",function(b){var c=a(b.target);g.remainIdle&&clearTimeout(g.remainIdle),(c.is("a[href='#']")||c.parent().is("a[href='#']"))&&b.preventDefault(),g.show()}),this.element.data("dropdown",this))};a.extend(d.prototype,{remainIdle:!1,show:function(){c&&c[0]!=this.element[0]&&c.removeClass("uk-open"),this.checkDimensions(),this.element.addClass("uk-open"),c=this.element,this.registerOuterClick()},registerOuterClick:function(){var b=this;a(document).off("click.outer.dropdown"),setTimeout(function(){a(document).on("click.outer.dropdown",function(d){!c||c[0]!=b.element[0]||!a(d.target).is("a")&&b.element.find(".uk-dropdown").find(d.target).length||(c.removeClass("uk-open"),a(document).off("click.outer.dropdown"))})},10)},checkDimensions:function(){if(this.dropdown.length){var b=this.dropdown.css("margin-"+a.UIkit.langdirection,"").css("min-width",""),c=b.show().offset(),d=b.outerWidth(),e=this.boundary.width(),f=this.boundary.offset()?this.boundary.offset().left:0;if(this.centered&&(b.css("margin-"+a.UIkit.langdirection,-1*(parseFloat(d)/2-b.parent().width()/2)),c=b.offset(),(d+c.left>e||c.left<0)&&(b.css("margin-"+a.UIkit.langdirection,""),c=b.offset())),this.justified&&this.justified.length){var g=this.justified.outerWidth();if(b.css("min-width",g),"right"==a.UIkit.langdirection){var h=e-(this.justified.offset().left+g),i=e-(b.offset().left+b.outerWidth());b.css("margin-right",h-i)}else b.css("margin-left",this.justified.offset().left-c.left);c=b.offset()}d+(c.left-f)>e&&(b.addClass("uk-dropdown-flip"),c=b.offset()),c.left<0&&b.addClass("uk-dropdown-stack"),b.css("display","")}}}),d.defaults={mode:"hover",remaintime:800,justify:!1,boundary:a(window)},b.dropdown=d;var e=b.support.touch?"click":"mouseenter";a(document).on(e+".dropdown.uikit","[data-uk-dropdown]",function(c){var f=a(this);if(!f.data("dropdown")){var g=new d(f,b.Utils.options(f.data("uk-dropdown")));("click"==e||"mouseenter"==e&&"hover"==g.options.mode)&&g.show(),g.element.find(".uk-dropdown").length&&c.preventDefault()}})}(jQuery,jQuery.UIkit),function(a,b){"use strict";var c=a(window),d="resize orientationchange",e=[],f=function(g,h){var i=this,j=a(g);j.data("gridMatchHeight")||(this.options=a.extend({},f.defaults,h),this.element=j,this.columns=this.element.children(),this.elements=this.options.target?this.element.find(this.options.target):this.columns,this.columns.length&&(c.on(d,function(){var d=function(){i.match()};return a(function(){d(),c.on("load",d)}),b.Utils.debounce(d,150)}()),a(document).on("uk-domready",function(){i.columns=i.element.children(),i.elements=i.options.target?i.element.find(i.options.target):i.columns,i.match()}),this.element.data("gridMatchHeight",this),e.push(this)))};a.extend(f.prototype,{match:function(){this.revert();var b=this.columns.filter(":visible:first");if(b.length){var c=Math.ceil(100*parseFloat(b.css("width"))/parseFloat(b.parent().css("width")))>=100?!0:!1,d=this;if(!c)return this.options.row?(this.element.width(),setTimeout(function(){var b=!1,c=[];d.elements.each(function(){var e=a(this),f=e.offset().top;f!=b&&c.length&&(d.matchHeights(a(c)),c=[],f=e.offset().top),c.push(e),b=f}),c.length&&d.matchHeights(a(c))},0)):this.matchHeights(this.elements),this}},revert:function(){return this.elements.css("min-height",""),this},matchHeights:function(b){if(!(b.length<2)){var c=0;b.each(function(){c=Math.max(c,a(this).outerHeight())}).each(function(){var b=a(this),d=c-(b.outerHeight()-b.height());b.css("min-height",d+"px")})}}}),f.defaults={target:!1,row:!1};var g=function(c,d){var e=a(c);if(!e.data("gridMargin")){this.options=a.extend({},g.defaults,d);var f=new b.stackMargin(e,this.options);e.data("gridMargin",f)}};g.defaults={cls:"uk-grid-margin"},b.gridMatchHeight=f,b.gridMargin=g,a(document).on("uk-domready",function(){a("[data-uk-grid-match],[data-uk-grid-margin]").each(function(){var c,d=a(this);d.is("[data-uk-grid-match]")&&!d.data("gridMatchHeight")&&(c=new f(d,b.Utils.options(d.attr("data-uk-grid-match")))),d.is("[data-uk-grid-margin]")&&!d.data("gridMargin")&&(c=new g(d,b.Utils.options(d.attr("data-uk-grid-margin"))))})}),a(document).on("uk-check-display",function(){e.forEach(function(a){a.element.is(":visible")&&a.match()})})}(jQuery,jQuery.UIkit),function(a,b,c){"use strict";function d(b,c){return c?("object"==typeof b?(b=b instanceof jQuery?b:a(b),b.parent().length&&(c.persist=b,c.persist.data("modalPersistParent",b.parent()))):b=a("<div></div>").html("string"==typeof b||"number"==typeof b?b:"$.UIkitt.modal Error: Unsupported data type: "+typeof b),b.appendTo(c.element.find(".uk-modal-dialog")),c):void 0}var e=!1,f=a("html"),g=function(c,d){var e=this;this.element=a(c),this.options=a.extend({},g.defaults,d),this.transition=b.support.transition,this.dialog=this.element.find(".uk-modal-dialog"),this.scrollable=function(){var a=e.dialog.find(".uk-overflow-container:first");return a.length?a:!1}(),this.element.on("click",".uk-modal-close",function(a){a.preventDefault(),e.hide()}).on("click",function(b){var c=a(b.target);c[0]==e.element[0]&&e.options.bgclose&&e.hide()})};a.extend(g.prototype,{scrollable:!1,transition:!1,toggle:function(){return this[this.isActive()?"hide":"show"]()},show:function(){if(!this.isActive())return e&&e.hide(!0),this.element.removeClass("uk-open").show(),this.resize(),e=this,f.addClass("uk-modal-page").height(),this.element.addClass("uk-open").trigger("uk.modal.show"),this},hide:function(a){if(this.isActive()){if(!a&&b.support.transition){var c=this;this.element.one(b.support.transition.end,function(){c._hide()}).removeClass("uk-open")}else this._hide();return this}},resize:function(){var a="padding-"+("left"==b.langdirection?"right":"left");if(this.scrollbarwidth=window.innerWidth-f.width(),f.css(a,this.scrollbarwidth),this.element.css(a,""),this.dialog.offset().left>this.scrollbarwidth&&this.element.css(a,this.scrollbarwidth-(this.element[0].scrollHeight==window.innerHeight?0:this.scrollbarwidth)),this.scrollable){this.scrollable.css("height",0);var c=Math.abs(parseInt(this.dialog.css("margin-top"),10)),d=this.dialog.outerHeight(),e=window.innerHeight,g=e-2*(20>c?20:c)-d;this.scrollable.css("height",g<this.options.minScrollHeight?"":g)}},_hide:function(){this.element.hide().removeClass("uk-open"),f.removeClass("uk-modal-page").css("padding-"+("left"==b.langdirection?"right":"left"),""),e===this&&(e=!1),this.element.trigger("uk.modal.hide")},isActive:function(){return e==this}}),g.dialog={tpl:'<div class="uk-modal"><div class="uk-modal-dialog"></div></div>'},g.defaults={keyboard:!0,show:!1,bgclose:!0,minScrollHeight:150};var h=function(b,c){var d=this,e=a(b);e.data("modal")||(this.options=a.extend({target:e.is("a")?e.attr("href"):!1},c),this.element=e,this.modal=new g(this.options.target,c),e.on("click",function(a){a.preventDefault(),d.show()}),a.each(["show","hide","isActive"],function(a,b){d[b]=function(){return d.modal[b]()}}),this.element.data("modal",this))};h.dialog=function(b,c){var e=new g(a(g.dialog.tpl).appendTo("body"),c);return e.element.on("uk.modal.hide",function(){e.persist&&(e.persist.appendTo(e.persist.data("modalPersistParent")),e.persist=!1),e.element.remove()}),d(b,e),e},h.alert=function(b,c){h.dialog(['<div class="uk-margin uk-modal-content">'+String(b)+"</div>",'<div class="uk-modal-buttons"><button class="uk-button uk-button-primary uk-modal-close">Ok</button></div>'].join(""),a.extend({bgclose:!1,keyboard:!1},c)).show()},h.confirm=function(b,c,d){c=a.isFunction(c)?c:function(){};var e=h.dialog(['<div class="uk-margin uk-modal-content">'+String(b)+"</div>",'<div class="uk-modal-buttons"><button class="uk-button uk-button-primary js-modal-confirm">Ok</button> <button class="uk-button uk-modal-close">Cancel</button></div>'].join(""),a.extend({bgclose:!1,keyboard:!1},d));e.element.find(".js-modal-confirm").on("click",function(){c(),e.hide()}),e.show()},h.Modal=g,b.modal=h,a(document).on("click.modal.uikit","[data-uk-modal]",function(c){var d=a(this);if(d.is("a")&&c.preventDefault(),!d.data("modal")){var e=new h(d,b.Utils.options(d.attr("data-uk-modal")));e.show()}}),a(document).on("keydown.modal.uikit",function(a){e&&27===a.keyCode&&e.options.keyboard&&(a.preventDefault(),e.hide())}),c.on("resize orientationchange",b.Utils.debounce(function(){e&&e.resize()},150))}(jQuery,jQuery.UIkit,jQuery(window)),function(a,b){"use strict";var c,d=a(window),e=a(document),f={show:function(b){if(b=a(b),b.length){var g=a("html"),h=b.find(".uk-offcanvas-bar:first"),i="right"==a.UIkit.langdirection,j=(h.hasClass("uk-offcanvas-bar-flip")?-1:1)*(i?-1:1),k=-1==j&&d.width()<window.innerWidth?window.innerWidth-d.width():0;c={x:window.scrollX,y:window.scrollY},b.addClass("uk-active"),g.css({width:window.innerWidth,height:window.innerHeight}).addClass("uk-offcanvas-page"),g.css(i?"margin-right":"margin-left",(i?-1:1)*(h.outerWidth()-k)*j).width(),h.addClass("uk-offcanvas-bar-show").width(),b.off(".ukoffcanvas").on("click.ukoffcanvas swipeRight.ukoffcanvas swipeLeft.ukoffcanvas",function(b){var c=a(b.target);if(!b.type.match(/swipe/)&&!c.hasClass("uk-offcanvas-close")){if(c.hasClass("uk-offcanvas-bar"))return;if(c.parents(".uk-offcanvas-bar:first").length)return}b.stopImmediatePropagation(),f.hide()}),e.on("keydown.ukoffcanvas",function(a){27===a.keyCode&&f.hide()})}},hide:function(b){var d=a("html"),f=a(".uk-offcanvas.uk-active"),g="right"==a.UIkit.langdirection,h=f.find(".uk-offcanvas-bar:first");f.length&&(a.UIkit.support.transition&&!b?(d.one(a.UIkit.support.transition.end,function(){d.removeClass("uk-offcanvas-page").attr("style",""),f.removeClass("uk-active"),window.scrollTo(c.x,c.y)}).css(g?"margin-right":"margin-left",""),setTimeout(function(){h.removeClass("uk-offcanvas-bar-show")},50)):(d.removeClass("uk-offcanvas-page").attr("style",""),f.removeClass("uk-active"),h.removeClass("uk-offcanvas-bar-show"),window.scrollTo(c.x,c.y)),f.off(".ukoffcanvas"),e.off(".ukoffcanvas"))}},g=function(b,c){var d=this,e=a(b);e.data("offcanvas")||(this.options=a.extend({target:e.is("a")?e.attr("href"):!1},c),this.element=e,e.on("click",function(a){a.preventDefault(),f.show(d.options.target)}),this.element.data("offcanvas",this))};g.offcanvas=f,b.offcanvas=g,e.on("click.offcanvas.uikit","[data-uk-offcanvas]",function(c){c.preventDefault();var d=a(this);if(!d.data("offcanvas")){{new g(d,b.Utils.options(d.attr("data-uk-offcanvas")))}d.trigger("click")}})}(jQuery,jQuery.UIkit),function(a,b){"use strict";function c(b){var c=a(b),d="auto";if(c.is(":visible"))d=c.outerHeight();else{var e={position:c.css("position"),visibility:c.css("visibility"),display:c.css("display")};d=c.css({position:"absolute",visibility:"hidden",display:"block"}).outerHeight(),c.css(e)}return d}var d=function(b,c){var e=this,f=a(b);f.data("nav")||(this.options=a.extend({},d.defaults,c),this.element=f.on("click",this.options.toggle,function(b){b.preventDefault();var c=a(this);e.open(c.parent()[0]==e.element[0]?c:c.parent("li"))}),this.element.find(this.options.lists).each(function(){var b=a(this),c=b.parent(),d=c.hasClass("uk-active");b.wrap('<div style="overflow:hidden;height:0;position:relative;"></div>'),c.data("list-container",b.parent()),d&&e.open(c,!0)}),this.element.data("nav",this))};a.extend(d.prototype,{open:function(b,d){var e=this.element,f=a(b);this.options.multiple||e.children(".uk-open").not(b).each(function(){a(this).data("list-container")&&a(this).data("list-container").stop().animate({height:0},function(){a(this).parent().removeClass("uk-open")})}),f.toggleClass("uk-open"),f.data("list-container")&&(d?f.data("list-container").stop().height(f.hasClass("uk-open")?"auto":0):f.data("list-container").stop().animate({height:f.hasClass("uk-open")?c(f.data("list-container").find("ul:first")):0}))}}),d.defaults={toggle:">li.uk-parent > a[href='#']",lists:">li.uk-parent > ul",multiple:!1},b.nav=d,a(document).on("uk-domready",function(){a("[data-uk-nav]").each(function(){var c=a(this);if(!c.data("nav")){new d(c,b.Utils.options(c.attr("data-uk-nav")))}})})}(jQuery,jQuery.UIkit),function(a,b,c){"use strict";var d,e,f=function(b,c){var d=this,e=a(b);e.data("tooltip")||(this.options=a.extend({},f.defaults,c),this.element=e.on({focus:function(){d.show()},blur:function(){d.hide()},mouseenter:function(){d.show()},mouseleave:function(){d.hide()}}),this.tip="function"==typeof this.options.src?this.options.src.call(this.element):this.options.src,this.element.attr("data-cached-title",this.element.attr("title")).attr("title",""),this.element.data("tooltip",this))};a.extend(f.prototype,{tip:"",show:function(){if(e&&clearTimeout(e),this.tip.length){d.stop().css({top:-2e3,visibility:"hidden"}).show(),d.html('<div class="uk-tooltip-inner">'+this.tip+"</div>");var b=this,c=a.extend({},this.element.offset(),{width:this.element[0].offsetWidth,height:this.element[0].offsetHeight}),f=d[0].offsetWidth,g=d[0].offsetHeight,h="function"==typeof this.options.offset?this.options.offset.call(this.element):this.options.offset,i="function"==typeof this.options.pos?this.options.pos.call(this.element):this.options.pos,j={display:"none",visibility:"visible",top:c.top+c.height+g,left:c.left},k=i.split("-");"left"!=k[0]&&"right"!=k[0]||"right"!=a.UIkit.langdirection||(k[0]="left"==k[0]?"right":"left");var l={bottom:{top:c.top+c.height+h,left:c.left+c.width/2-f/2},top:{top:c.top-g-h,left:c.left+c.width/2-f/2},left:{top:c.top+c.height/2-g/2,left:c.left-f-h},right:{top:c.top+c.height/2-g/2,left:c.left+c.width+h}};a.extend(j,l[k[0]]),2==k.length&&(j.left="left"==k[1]?c.left:c.left+c.width-f);var m=this.checkBoundary(j.left,j.top,f,g);if(m){switch(m){case"x":i=2==k.length?k[0]+"-"+(j.left<0?"left":"right"):j.left<0?"right":"left";break;case"y":i=2==k.length?(j.top<0?"bottom":"top")+"-"+k[1]:j.top<0?"bottom":"top";break;case"xy":i=2==k.length?(j.top<0?"bottom":"top")+"-"+(j.left<0?"left":"right"):j.left<0?"right":"left"}k=i.split("-"),a.extend(j,l[k[0]]),2==k.length&&(j.left="left"==k[1]?c.left:c.left+c.width-f)}j.left-=a("body").position().left,e=setTimeout(function(){d.css(j).attr("class","uk-tooltip uk-tooltip-"+i),b.options.animation?d.css({opacity:0,display:"block"}).animate({opacity:1},parseInt(b.options.animation,10)||400):d.show(),e=!1},parseInt(this.options.delay,10)||0)}},hide:function(){this.element.is("input")&&this.element[0]===document.activeElement||(e&&clearTimeout(e),d.stop(),this.options.animation?d.fadeOut(parseInt(this.options.animation,10)||400):d.hide())},content:function(){return this.tip},checkBoundary:function(a,b,d,e){var f="";return(0>a||a-c.scrollLeft()+d>window.innerWidth)&&(f+="x"),(0>b||b-c.scrollTop()+e>window.innerHeight)&&(f+="y"),f}}),f.defaults={offset:5,pos:"top",animation:!1,delay:0,src:function(){return this.attr("title")}},b.tooltip=f,a(function(){d=a('<div class="uk-tooltip"></div>').appendTo("body")}),a(document).on("mouseenter.tooltip.uikit focus.tooltip.uikit","[data-uk-tooltip]",function(){var c=a(this);if(!c.data("tooltip")){{new f(c,b.Utils.options(c.attr("data-uk-tooltip")))}c.trigger("mouseenter")}})}(jQuery,jQuery.UIkit,jQuery(window)),function(a,b){"use strict";var c=function(b,d){var e=this,f=a(b);if(!f.data("switcher")){if(this.options=a.extend({},c.defaults,d),this.element=f.on("click",this.options.toggle,function(a){a.preventDefault(),e.show(this)}),this.options.connect){this.connect=a(this.options.connect).find(".uk-active").removeClass(".uk-active").end();var g=this.element.find(this.options.toggle),h=g.filter(".uk-active");h.length?this.show(h):(h=g.eq(this.options.active),this.show(h.length?h:g.eq(0)))}this.element.data("switcher",this)}};a.extend(c.prototype,{show:function(b){b=isNaN(b)?a(b):this.element.find(this.options.toggle).eq(b);var c=b;if(!c.hasClass("uk-disabled")){if(this.element.find(this.options.toggle).filter(".uk-active").removeClass("uk-active"),c.addClass("uk-active"),this.options.connect&&this.connect.length){var d=this.element.find(this.options.toggle).index(c);this.connect.children().removeClass("uk-active").eq(d).addClass("uk-active")}this.element.trigger("uk.switcher.show",[c]),a(document).trigger("uk-check-display")}}}),c.defaults={connect:!1,toggle:">*",active:0},b.switcher=c,a(document).on("uk-domready",function(){a("[data-uk-switcher]").each(function(){var d=a(this);if(!d.data("switcher")){new c(d,b.Utils.options(d.attr("data-uk-switcher")))}})})}(jQuery,jQuery.UIkit),function(a,b){"use strict";var c=function(b,d){var e=this,f=a(b);if(!f.data("tab")){if(this.element=f,this.options=a.extend({},c.defaults,d),this.options.connect&&(this.connect=a(this.options.connect)),window.location.hash){var g=this.element.children().filter(window.location.hash);g.length&&this.element.children().removeClass("uk-active").filter(g).addClass("uk-active")}var h=a('<li class="uk-tab-responsive uk-active"><a href="javascript:void(0);"></a></li>'),i=h.find("a:first"),j=a('<div class="uk-dropdown uk-dropdown-small"><ul class="uk-nav uk-nav-dropdown"></ul><div>'),k=j.find("ul");i.html(this.element.find("li.uk-active:first").find("a").text()),this.element.hasClass("uk-tab-bottom")&&j.addClass("uk-dropdown-up"),this.element.hasClass("uk-tab-flip")&&j.addClass("uk-dropdown-flip"),this.element.find("a").each(function(b){var c=a(this).parent(),d=a('<li><a href="javascript:void(0);">'+c.text()+"</a></li>").on("click",function(){e.element.data("switcher").show(b)});a(this).parents(".uk-disabled:first").length||k.append(d)}),this.element.uk("switcher",{toggle:">li:not(.uk-tab-responsive)",connect:this.options.connect,active:this.options.active}),h.append(j).uk("dropdown",{mode:"click"}),this.element.append(h).data({dropdown:h.data("dropdown"),mobilecaption:i}).on("uk.switcher.show",function(a,b){h.addClass("uk-active"),i.html(b.find("a").text())}),this.element.data("tab",this)}};c.defaults={connect:!1,active:0},b.tab=c,a(document).on("uk-domready",function(){a("[data-uk-tab]").each(function(){var d=a(this);if(!d.data("tab")){new c(d,b.Utils.options(d.attr("data-uk-tab")))}})})}(jQuery,jQuery.UIkit),function(a,b){"use strict";var c=a(window),d=[],e=function(){for(var a=0;a<d.length;a++)b.support.requestAnimationFrame.apply(window,[d[a].check])},f=function(c,e){var g=a(c);if(!g.data("scrollspy")){this.options=a.extend({},f.defaults,e),this.element=a(c);var h,i,j,k=this,l=function(){var a=b.Utils.isInView(k.element,k.options);a&&!i&&(h&&clearTimeout(h),j||(k.element.addClass(k.options.initcls),k.offset=k.element.offset(),j=!0,k.element.trigger("uk-scrollspy-init")),h=setTimeout(function(){a&&k.element.addClass("uk-scrollspy-inview").addClass(k.options.cls).width()},k.options.delay),i=!0,k.element.trigger("uk.scrollspy.inview")),!a&&i&&k.options.repeat&&(k.element.removeClass("uk-scrollspy-inview").removeClass(k.options.cls),i=!1,k.element.trigger("uk.scrollspy.outview"))};l(),this.element.data("scrollspy",this),this.check=l,d.push(this)}};f.defaults={cls:"uk-scrollspy-inview",initcls:"uk-scrollspy-init-inview",topoffset:0,leftoffset:0,repeat:!1,delay:0},b.scrollspy=f;var g=[],h=function(){for(var a=0;a<g.length;a++)b.support.requestAnimationFrame.apply(window,[g[a].check])},i=function(d,e){var f=a(d);if(!f.data("scrollspynav")){this.element=f,this.options=a.extend({},i.defaults,e);var h,j=[],k=this.element.find("a[href^='#']").each(function(){j.push(a(this).attr("href"))}),l=a(j.join(",")),m=this,n=function(){h=[];for(var a=0;a<l.length;a++)b.Utils.isInView(l.eq(a),m.options)&&h.push(l.eq(a));if(h.length){var d=c.scrollTop(),e=function(){for(var a=0;a<h.length;a++)if(h[a].offset().top>=d)return h[a]}();if(!e)return;m.options.closest?k.closest(m.options.closest).removeClass(m.options.cls).end().filter("a[href='#"+e.attr("id")+"']").closest(m.options.closest).addClass(m.options.cls):k.removeClass(m.options.cls).filter("a[href='#"+e.attr("id")+"']").addClass(m.options.cls)}};this.options.smoothscroll&&b.smoothScroll&&k.each(function(){new b.smoothScroll(this,m.options.smoothscroll)}),n(),this.element.data("scrollspynav",this),this.check=n,g.push(this)
}};i.defaults={cls:"uk-active",closest:!1,topoffset:0,leftoffset:0,smoothscroll:!1},b.scrollspynav=i;var j=function(){e(),h()};c.on("scroll",j).on("resize orientationchange",b.Utils.debounce(j,50)),a(document).on("uk-domready",function(){a("[data-uk-scrollspy]").each(function(){var c=a(this);if(!c.data("scrollspy")){new f(c,b.Utils.options(c.attr("data-uk-scrollspy")))}}),a("[data-uk-scrollspy-nav]").each(function(){var c=a(this);if(!c.data("scrollspynav")){new i(c,b.Utils.options(c.attr("data-uk-scrollspy-nav")))}})})}(jQuery,jQuery.UIkit),function(a,b){"use strict";var c=function(b,d){var e=this,f=a(b);f.data("smoothScroll")||(this.options=a.extend({},c.defaults,d),this.element=f.on("click",function(){{var b=a(a(this.hash).length?this.hash:"body"),c=b.offset().top-e.options.offset,d=a(document).height(),f=a(window).height();b.outerHeight()}return c+f>d&&(c=d-f),a("html,body").stop().animate({scrollTop:c},e.options.duration,e.options.transition),!1}),this.element.data("smoothScroll",this))};c.defaults={duration:1e3,transition:"easeOutExpo",offset:0},b.smoothScroll=c,a.easing.easeOutExpo||(a.easing.easeOutExpo=function(a,b,c,d,e){return b==e?c+d:d*(-Math.pow(2,-10*b/e)+1)+c}),a(document).on("click.smooth-scroll.uikit","[data-uk-smooth-scroll]",function(){var d=a(this);if(!d.data("smoothScroll")){{new c(d,b.Utils.options(d.attr("data-uk-smooth-scroll")))}d.trigger("click")}})}(jQuery,jQuery.UIkit),function(a,b,c){var d=function(a,c){var e=this,f=b(a);f.data("toggle")||(this.options=b.extend({},d.defaults,c),this.totoggle=this.options.target?b(this.options.target):[],this.element=f.on("click",function(a){a.preventDefault(),e.toggle()}),this.element.data("toggle",this))};b.extend(d.prototype,{toggle:function(){this.totoggle.length&&(this.totoggle.toggleClass(this.options.cls),"uk-hidden"==this.options.cls&&b(document).trigger("uk-check-display"))}}),d.defaults={target:!1,cls:"uk-hidden"},c.toggle=d,b(document).on("uk-domready",function(){b("[data-uk-toggle]").each(function(){var a=b(this);if(!a.data("toggle")){new d(a,c.Utils.options(a.attr("data-uk-toggle")))}})})}(this,jQuery,jQuery.UIkit);

/*
  Formalize - version 1.2

  Note: This file depends on the jQuery library.
*/

// Module pattern:
// http://yuiblog.com/blog/2007/06/12/module-pattern
var FORMALIZE = (function($, window, document, undefined) {
  // Internet Explorer detection.
  function IE(version) {
    var b = document.createElement('b');
    b.innerHTML = '<!--[if IE ' + version + ']><br><![endif]-->';
    return !!b.getElementsByTagName('br').length;
  }

  // Private constants.
  var PLACEHOLDER_SUPPORTED = 'placeholder' in document.createElement('input');
  var AUTOFOCUS_SUPPORTED = 'autofocus' in document.createElement('input');
  var IE6 = IE(6);
  var IE7 = IE(7);

  // Expose innards of FORMALIZE.
  return {
    // FORMALIZE.go
    go: function() {
      var i, j = this.init;

      for (i in j) {
        j.hasOwnProperty(i) && j[i]();
      }
    },
    // FORMALIZE.init
    init: {
      // FORMALIZE.init.disable_link_button
      disable_link_button: function() {
        $(document.documentElement).on('click', 'a.button_disabled', function() {
          return false;
        });
      },
      // FORMALIZE.init.full_input_size
      full_input_size: function() {
        if (!IE7 || !$('textarea, input.input_full').length) {
          return;
        }

        // This fixes width: 100% on <textarea> and class="input_full".
        // It ensures that form elements don't go wider than container.
        $('textarea, input.input_full').wrap('<span class="input_full_wrap"></span>');
      },
      // FORMALIZE.init.ie6_skin_inputs
      ie6_skin_inputs: function() {
        // Test for Internet Explorer 6.
        if (!IE6 || !$('input, select, textarea').length) {
          // Exit if the browser is not IE6,
          // or if no form elements exist.
          return;
        }

        // For <input type="submit" />, etc.
        var button_regex = /button|submit|reset/;

        // For <input type="text" />, etc.
        var type_regex = /date|datetime|datetime-local|email|month|number|password|range|search|tel|text|time|url|week/;

        $('input').each(function() {
          var el = $(this);

          // Is it a button?
          if (this.getAttribute('type').match(button_regex)) {
            el.addClass('ie6_button');

            /* Is it disabled? */
            if (this.disabled) {
              el.addClass('ie6_button_disabled');
            }
          }
          // Or is it a textual input?
          else if (this.getAttribute('type').match(type_regex)) {
            el.addClass('ie6_input');

            /* Is it disabled? */
            if (this.disabled) {
              el.addClass('ie6_input_disabled');
            }
          }
        });

        $('textarea, select').each(function() {
          /* Is it disabled? */
          if (this.disabled) {
            $(this).addClass('ie6_input_disabled');
          }
        });
      },
      // FORMALIZE.init.autofocus
      autofocus: function() {
        if (AUTOFOCUS_SUPPORTED || !$(':input[autofocus]').length) {
          return;
        }

        var el = $('[autofocus]')[0];

        if (!el.disabled) {
          el.focus();
        }
      },
      // FORMALIZE.init.placeholder
      placeholder: function() {
        if (PLACEHOLDER_SUPPORTED || !$(':input[placeholder]').length) {
          // Exit if placeholder is supported natively,
          // or if page does not have any placeholder.
          return;
        }

        FORMALIZE.misc.add_placeholder();

        $(':input[placeholder]').each(function() {
          // Placeholder obscured in older browsers,
          // so there's no point adding to password.
          if (this.type === 'password') {
            return;
          }

          var el = $(this);
          var text = el.attr('placeholder');

          el.focus(function() {
            if (el.val() === text) {
              el.val('').removeClass('placeholder_text');
            }
          }).blur(function() {
            FORMALIZE.misc.add_placeholder();
          });

          // Prevent <form> from accidentally
          // submitting the placeholder text.
          el.closest('form').submit(function() {
            if (el.val() === text) {
              el.val('').removeClass('placeholder_text');
            }
          }).on('reset', function() {
            setTimeout(FORMALIZE.misc.add_placeholder, 50);
          });
        });
      }
    },
    // FORMALIZE.misc
    misc: {
      // FORMALIZE.misc.add_placeholder
      add_placeholder: function() {
        if (PLACEHOLDER_SUPPORTED || !$(':input[placeholder]').length) {
          // Exit if placeholder is supported natively,
          // or if page does not have any placeholder.
          return;
        }

        $(':input[placeholder]').each(function() {
          // Placeholder obscured in older browsers,
          // so there's no point adding to password.
          if (this.type === 'password') {
            return;
          }

          var el = $(this);
          var text = el.attr('placeholder');

          if (!el.val() || el.val() === text) {
            el.val(text).addClass('placeholder_text');
          }
        });
      }
    }
  };
// Alias jQuery, window, document.
})(jQuery, this, this.document);

// Automatically calls all functions in FORMALIZE.init
jQuery(document).ready(function() {
  FORMALIZE.go();
});

/*!
 * imagesLoaded PACKAGED v3.1.6
 * JavaScript is all like "You images are done yet or what?"
 * MIT License
 */


/*!
 * EventEmitter v4.2.6 - git.io/ee
 * Oliver Caldwell
 * MIT license
 * @preserve
 */

(function () {
    

    /**
     * Class for managing events.
     * Can be extended to provide event functionality in other classes.
     *
     * @class EventEmitter Manages event registering and emitting.
     */
    function EventEmitter() {}

    // Shortcuts to improve speed and size
    var proto = EventEmitter.prototype;
    var exports = this;
    var originalGlobalValue = exports.EventEmitter;

    /**
     * Finds the index of the listener for the event in it's storage array.
     *
     * @param {Function[]} listeners Array of listeners to search through.
     * @param {Function} listener Method to look for.
     * @return {Number} Index of the specified listener, -1 if not found
     * @api private
     */
    function indexOfListener(listeners, listener) {
        var i = listeners.length;
        while (i--) {
            if (listeners[i].listener === listener) {
                return i;
            }
        }

        return -1;
    }

    /**
     * Alias a method while keeping the context correct, to allow for overwriting of target method.
     *
     * @param {String} name The name of the target method.
     * @return {Function} The aliased method
     * @api private
     */
    function alias(name) {
        return function aliasClosure() {
            return this[name].apply(this, arguments);
        };
    }

    /**
     * Returns the listener array for the specified event.
     * Will initialise the event object and listener arrays if required.
     * Will return an object if you use a regex search. The object contains keys for each matched event. So /ba[rz]/ might return an object containing bar and baz. But only if you have either defined them with defineEvent or added some listeners to them.
     * Each property in the object response is an array of listener functions.
     *
     * @param {String|RegExp} evt Name of the event to return the listeners from.
     * @return {Function[]|Object} All listener functions for the event.
     */
    proto.getListeners = function getListeners(evt) {
        var events = this._getEvents();
        var response;
        var key;

        // Return a concatenated array of all matching events if
        // the selector is a regular expression.
        if (typeof evt === 'object') {
            response = {};
            for (key in events) {
                if (events.hasOwnProperty(key) && evt.test(key)) {
                    response[key] = events[key];
                }
            }
        }
        else {
            response = events[evt] || (events[evt] = []);
        }

        return response;
    };

    /**
     * Takes a list of listener objects and flattens it into a list of listener functions.
     *
     * @param {Object[]} listeners Raw listener objects.
     * @return {Function[]} Just the listener functions.
     */
    proto.flattenListeners = function flattenListeners(listeners) {
        var flatListeners = [];
        var i;

        for (i = 0; i < listeners.length; i += 1) {
            flatListeners.push(listeners[i].listener);
        }

        return flatListeners;
    };

    /**
     * Fetches the requested listeners via getListeners but will always return the results inside an object. This is mainly for internal use but others may find it useful.
     *
     * @param {String|RegExp} evt Name of the event to return the listeners from.
     * @return {Object} All listener functions for an event in an object.
     */
    proto.getListenersAsObject = function getListenersAsObject(evt) {
        var listeners = this.getListeners(evt);
        var response;

        if (listeners instanceof Array) {
            response = {};
            response[evt] = listeners;
        }

        return response || listeners;
    };

    /**
     * Adds a listener function to the specified event.
     * The listener will not be added if it is a duplicate.
     * If the listener returns true then it will be removed after it is called.
     * If you pass a regular expression as the event name then the listener will be added to all events that match it.
     *
     * @param {String|RegExp} evt Name of the event to attach the listener to.
     * @param {Function} listener Method to be called when the event is emitted. If the function returns true then it will be removed after calling.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.addListener = function addListener(evt, listener) {
        var listeners = this.getListenersAsObject(evt);
        var listenerIsWrapped = typeof listener === 'object';
        var key;

        for (key in listeners) {
            if (listeners.hasOwnProperty(key) && indexOfListener(listeners[key], listener) === -1) {
                listeners[key].push(listenerIsWrapped ? listener : {
                    listener: listener,
                    once: false
                });
            }
        }

        return this;
    };

    /**
     * Alias of addListener
     */
    proto.on = alias('addListener');

    /**
     * Semi-alias of addListener. It will add a listener that will be
     * automatically removed after it's first execution.
     *
     * @param {String|RegExp} evt Name of the event to attach the listener to.
     * @param {Function} listener Method to be called when the event is emitted. If the function returns true then it will be removed after calling.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.addOnceListener = function addOnceListener(evt, listener) {
        return this.addListener(evt, {
            listener: listener,
            once: true
        });
    };

    /**
     * Alias of addOnceListener.
     */
    proto.once = alias('addOnceListener');

    /**
     * Defines an event name. This is required if you want to use a regex to add a listener to multiple events at once. If you don't do this then how do you expect it to know what event to add to? Should it just add to every possible match for a regex? No. That is scary and bad.
     * You need to tell it what event names should be matched by a regex.
     *
     * @param {String} evt Name of the event to create.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.defineEvent = function defineEvent(evt) {
        this.getListeners(evt);
        return this;
    };

    /**
     * Uses defineEvent to define multiple events.
     *
     * @param {String[]} evts An array of event names to define.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.defineEvents = function defineEvents(evts) {
        for (var i = 0; i < evts.length; i += 1) {
            this.defineEvent(evts[i]);
        }
        return this;
    };

    /**
     * Removes a listener function from the specified event.
     * When passed a regular expression as the event name, it will remove the listener from all events that match it.
     *
     * @param {String|RegExp} evt Name of the event to remove the listener from.
     * @param {Function} listener Method to remove from the event.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.removeListener = function removeListener(evt, listener) {
        var listeners = this.getListenersAsObject(evt);
        var index;
        var key;

        for (key in listeners) {
            if (listeners.hasOwnProperty(key)) {
                index = indexOfListener(listeners[key], listener);

                if (index !== -1) {
                    listeners[key].splice(index, 1);
                }
            }
        }

        return this;
    };

    /**
     * Alias of removeListener
     */
    proto.off = alias('removeListener');

    /**
     * Adds listeners in bulk using the manipulateListeners method.
     * If you pass an object as the second argument you can add to multiple events at once. The object should contain key value pairs of events and listeners or listener arrays. You can also pass it an event name and an array of listeners to be added.
     * You can also pass it a regular expression to add the array of listeners to all events that match it.
     * Yeah, this function does quite a bit. That's probably a bad thing.
     *
     * @param {String|Object|RegExp} evt An event name if you will pass an array of listeners next. An object if you wish to add to multiple events at once.
     * @param {Function[]} [listeners] An optional array of listener functions to add.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.addListeners = function addListeners(evt, listeners) {
        // Pass through to manipulateListeners
        return this.manipulateListeners(false, evt, listeners);
    };

    /**
     * Removes listeners in bulk using the manipulateListeners method.
     * If you pass an object as the second argument you can remove from multiple events at once. The object should contain key value pairs of events and listeners or listener arrays.
     * You can also pass it an event name and an array of listeners to be removed.
     * You can also pass it a regular expression to remove the listeners from all events that match it.
     *
     * @param {String|Object|RegExp} evt An event name if you will pass an array of listeners next. An object if you wish to remove from multiple events at once.
     * @param {Function[]} [listeners] An optional array of listener functions to remove.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.removeListeners = function removeListeners(evt, listeners) {
        // Pass through to manipulateListeners
        return this.manipulateListeners(true, evt, listeners);
    };

    /**
     * Edits listeners in bulk. The addListeners and removeListeners methods both use this to do their job. You should really use those instead, this is a little lower level.
     * The first argument will determine if the listeners are removed (true) or added (false).
     * If you pass an object as the second argument you can add/remove from multiple events at once. The object should contain key value pairs of events and listeners or listener arrays.
     * You can also pass it an event name and an array of listeners to be added/removed.
     * You can also pass it a regular expression to manipulate the listeners of all events that match it.
     *
     * @param {Boolean} remove True if you want to remove listeners, false if you want to add.
     * @param {String|Object|RegExp} evt An event name if you will pass an array of listeners next. An object if you wish to add/remove from multiple events at once.
     * @param {Function[]} [listeners] An optional array of listener functions to add/remove.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.manipulateListeners = function manipulateListeners(remove, evt, listeners) {
        var i;
        var value;
        var single = remove ? this.removeListener : this.addListener;
        var multiple = remove ? this.removeListeners : this.addListeners;

        // If evt is an object then pass each of it's properties to this method
        if (typeof evt === 'object' && !(evt instanceof RegExp)) {
            for (i in evt) {
                if (evt.hasOwnProperty(i) && (value = evt[i])) {
                    // Pass the single listener straight through to the singular method
                    if (typeof value === 'function') {
                        single.call(this, i, value);
                    }
                    else {
                        // Otherwise pass back to the multiple function
                        multiple.call(this, i, value);
                    }
                }
            }
        }
        else {
            // So evt must be a string
            // And listeners must be an array of listeners
            // Loop over it and pass each one to the multiple method
            i = listeners.length;
            while (i--) {
                single.call(this, evt, listeners[i]);
            }
        }

        return this;
    };

    /**
     * Removes all listeners from a specified event.
     * If you do not specify an event then all listeners will be removed.
     * That means every event will be emptied.
     * You can also pass a regex to remove all events that match it.
     *
     * @param {String|RegExp} [evt] Optional name of the event to remove all listeners for. Will remove from every event if not passed.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.removeEvent = function removeEvent(evt) {
        var type = typeof evt;
        var events = this._getEvents();
        var key;

        // Remove different things depending on the state of evt
        if (type === 'string') {
            // Remove all listeners for the specified event
            delete events[evt];
        }
        else if (type === 'object') {
            // Remove all events matching the regex.
            for (key in events) {
                if (events.hasOwnProperty(key) && evt.test(key)) {
                    delete events[key];
                }
            }
        }
        else {
            // Remove all listeners in all events
            delete this._events;
        }

        return this;
    };

    /**
     * Alias of removeEvent.
     *
     * Added to mirror the node API.
     */
    proto.removeAllListeners = alias('removeEvent');

    /**
     * Emits an event of your choice.
     * When emitted, every listener attached to that event will be executed.
     * If you pass the optional argument array then those arguments will be passed to every listener upon execution.
     * Because it uses `apply`, your array of arguments will be passed as if you wrote them out separately.
     * So they will not arrive within the array on the other side, they will be separate.
     * You can also pass a regular expression to emit to all events that match it.
     *
     * @param {String|RegExp} evt Name of the event to emit and execute listeners for.
     * @param {Array} [args] Optional array of arguments to be passed to each listener.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.emitEvent = function emitEvent(evt, args) {
        var listeners = this.getListenersAsObject(evt);
        var listener;
        var i;
        var key;
        var response;

        for (key in listeners) {
            if (listeners.hasOwnProperty(key)) {
                i = listeners[key].length;

                while (i--) {
                    // If the listener returns true then it shall be removed from the event
                    // The function is executed either with a basic call or an apply if there is an args array
                    listener = listeners[key][i];

                    if (listener.once === true) {
                        this.removeListener(evt, listener.listener);
                    }

                    response = listener.listener.apply(this, args || []);

                    if (response === this._getOnceReturnValue()) {
                        this.removeListener(evt, listener.listener);
                    }
                }
            }
        }

        return this;
    };

    /**
     * Alias of emitEvent
     */
    proto.trigger = alias('emitEvent');

    /**
     * Subtly different from emitEvent in that it will pass its arguments on to the listeners, as opposed to taking a single array of arguments to pass on.
     * As with emitEvent, you can pass a regex in place of the event name to emit to all events that match it.
     *
     * @param {String|RegExp} evt Name of the event to emit and execute listeners for.
     * @param {...*} Optional additional arguments to be passed to each listener.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.emit = function emit(evt) {
        var args = Array.prototype.slice.call(arguments, 1);
        return this.emitEvent(evt, args);
    };

    /**
     * Sets the current value to check against when executing listeners. If a
     * listeners return value matches the one set here then it will be removed
     * after execution. This value defaults to true.
     *
     * @param {*} value The new value to check for when executing listeners.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.setOnceReturnValue = function setOnceReturnValue(value) {
        this._onceReturnValue = value;
        return this;
    };

    /**
     * Fetches the current value to check against when executing listeners. If
     * the listeners return value matches this one then it should be removed
     * automatically. It will return true by default.
     *
     * @return {*|Boolean} The current value to check for or the default, true.
     * @api private
     */
    proto._getOnceReturnValue = function _getOnceReturnValue() {
        if (this.hasOwnProperty('_onceReturnValue')) {
            return this._onceReturnValue;
        }
        else {
            return true;
        }
    };

    /**
     * Fetches the events object and creates one if required.
     *
     * @return {Object} The events storage object.
     * @api private
     */
    proto._getEvents = function _getEvents() {
        return this._events || (this._events = {});
    };

    /**
     * Reverts the global {@link EventEmitter} to its previous value and returns a reference to this version.
     *
     * @return {Function} Non conflicting EventEmitter class.
     */
    EventEmitter.noConflict = function noConflict() {
        exports.EventEmitter = originalGlobalValue;
        return EventEmitter;
    };

    // Expose the class either via AMD, CommonJS or the global object
    if (typeof define === 'function' && define.amd) {
        define('eventEmitter/EventEmitter',[],function () {
            return EventEmitter;
        });
    }
    else if (typeof module === 'object' && module.exports){
        module.exports = EventEmitter;
    }
    else {
        this.EventEmitter = EventEmitter;
    }
}.call(this));

/*!
 * eventie v1.0.4
 * event binding helper
 *   eventie.bind( elem, 'click', myFn )
 *   eventie.unbind( elem, 'click', myFn )
 */

/*jshint browser: true, undef: true, unused: true */
/*global define: false */

( function( window ) {



var docElem = document.documentElement;

var bind = function() {};

function getIEEvent( obj ) {
  var event = window.event;
  // add event.target
  event.target = event.target || event.srcElement || obj;
  return event;
}

if ( docElem.addEventListener ) {
  bind = function( obj, type, fn ) {
    obj.addEventListener( type, fn, false );
  };
} else if ( docElem.attachEvent ) {
  bind = function( obj, type, fn ) {
    obj[ type + fn ] = fn.handleEvent ?
      function() {
        var event = getIEEvent( obj );
        fn.handleEvent.call( fn, event );
      } :
      function() {
        var event = getIEEvent( obj );
        fn.call( obj, event );
      };
    obj.attachEvent( "on" + type, obj[ type + fn ] );
  };
}

var unbind = function() {};

if ( docElem.removeEventListener ) {
  unbind = function( obj, type, fn ) {
    obj.removeEventListener( type, fn, false );
  };
} else if ( docElem.detachEvent ) {
  unbind = function( obj, type, fn ) {
    obj.detachEvent( "on" + type, obj[ type + fn ] );
    try {
      delete obj[ type + fn ];
    } catch ( err ) {
      // can't delete window object properties
      obj[ type + fn ] = undefined;
    }
  };
}

var eventie = {
  bind: bind,
  unbind: unbind
};

// transport
if ( typeof define === 'function' && define.amd ) {
  // AMD
  define( 'eventie/eventie',eventie );
} else {
  // browser global
  window.eventie = eventie;
}

})( this );

/*!
 * imagesLoaded v3.1.6
 * JavaScript is all like "You images are done yet or what?"
 * MIT License
 */

( function( window, factory ) { 
  // universal module definition

  /*global define: false, module: false, require: false */

  if ( typeof define === 'function' && define.amd ) {
    // AMD
    define( [
      'eventEmitter/EventEmitter',
      'eventie/eventie'
    ], function( EventEmitter, eventie ) {
      return factory( window, EventEmitter, eventie );
    });
  } else if ( typeof exports === 'object' ) {
    // CommonJS
    module.exports = factory(
      window,
      require('eventEmitter'),
      require('eventie')
    );
  } else {
    // browser global
    window.imagesLoaded = factory(
      window,
      window.EventEmitter,
      window.eventie
    );
  }

})( this,

// --------------------------  factory -------------------------- //

function factory( window, EventEmitter, eventie ) {



var $ = window.jQuery;
var console = window.console;
var hasConsole = typeof console !== 'undefined';

// -------------------------- helpers -------------------------- //

// extend objects
function extend( a, b ) {
  for ( var prop in b ) {
    a[ prop ] = b[ prop ];
  }
  return a;
}

var objToString = Object.prototype.toString;
function isArray( obj ) {
  return objToString.call( obj ) === '[object Array]';
}

// turn element or nodeList into an array
function makeArray( obj ) {
  var ary = [];
  if ( isArray( obj ) ) {
    // use object if already an array
    ary = obj;
  } else if ( typeof obj.length === 'number' ) {
    // convert nodeList to array
    for ( var i=0, len = obj.length; i < len; i++ ) {
      ary.push( obj[i] );
    }
  } else {
    // array of single index
    ary.push( obj );
  }
  return ary;
}

  // -------------------------- imagesLoaded -------------------------- //

  /**
   * @param {Array, Element, NodeList, String} elem
   * @param {Object or Function} options - if function, use as callback
   * @param {Function} onAlways - callback function
   */
  function ImagesLoaded( elem, options, onAlways ) {
    // coerce ImagesLoaded() without new, to be new ImagesLoaded()
    if ( !( this instanceof ImagesLoaded ) ) {
      return new ImagesLoaded( elem, options );
    }
    // use elem as selector string
    if ( typeof elem === 'string' ) {
      elem = document.querySelectorAll( elem );
    }

    this.elements = makeArray( elem );
    this.options = extend( {}, this.options );

    if ( typeof options === 'function' ) {
      onAlways = options;
    } else {
      extend( this.options, options );
    }

    if ( onAlways ) {
      this.on( 'always', onAlways );
    }

    this.getImages();

    if ( $ ) {
      // add jQuery Deferred object
      this.jqDeferred = new $.Deferred();
    }

    // HACK check async to allow time to bind listeners
    var _this = this;
    setTimeout( function() {
      _this.check();
    });
  }

  ImagesLoaded.prototype = new EventEmitter();

  ImagesLoaded.prototype.options = {};

  ImagesLoaded.prototype.getImages = function() {
    this.images = [];

    // filter & find items if we have an item selector
    for ( var i=0, len = this.elements.length; i < len; i++ ) {
      var elem = this.elements[i];
      // filter siblings
      if ( elem.nodeName === 'IMG' ) {
        this.addImage( elem );
      }
      // find children
      // no non-element nodes, #143
      var nodeType = elem.nodeType;
      if ( !nodeType || !( nodeType === 1 || nodeType === 9 || nodeType === 11 ) ) {
        continue;
      }
      var childElems = elem.querySelectorAll('img');
      // concat childElems to filterFound array
      for ( var j=0, jLen = childElems.length; j < jLen; j++ ) {
        var img = childElems[j];
        this.addImage( img );
      }
    }
  };

  /**
   * @param {Image} img
   */
  ImagesLoaded.prototype.addImage = function( img ) {
    var loadingImage = new LoadingImage( img );
    this.images.push( loadingImage );
  };

  ImagesLoaded.prototype.check = function() {
    var _this = this;
    var checkedCount = 0;
    var length = this.images.length;
    this.hasAnyBroken = false;
    // complete if no images
    if ( !length ) {
      this.complete();
      return;
    }

    function onConfirm( image, message ) {
      if ( _this.options.debug && hasConsole ) {
        console.log( 'confirm', image, message );
      }

      _this.progress( image );
      checkedCount++;
      if ( checkedCount === length ) {
        _this.complete();
      }
      return true; // bind once
    }

    for ( var i=0; i < length; i++ ) {
      var loadingImage = this.images[i];
      loadingImage.on( 'confirm', onConfirm );
      loadingImage.check();
    }
  };

  ImagesLoaded.prototype.progress = function( image ) {
    this.hasAnyBroken = this.hasAnyBroken || !image.isLoaded;
    // HACK - Chrome triggers event before object properties have changed. #83
    var _this = this;
    setTimeout( function() {
      _this.emit( 'progress', _this, image );
      if ( _this.jqDeferred && _this.jqDeferred.notify ) {
        _this.jqDeferred.notify( _this, image );
      }
    });
  };

  ImagesLoaded.prototype.complete = function() {
    var eventName = this.hasAnyBroken ? 'fail' : 'done';
    this.isComplete = true;
    var _this = this;
    // HACK - another setTimeout so that confirm happens after progress
    setTimeout( function() {
      _this.emit( eventName, _this );
      _this.emit( 'always', _this );
      if ( _this.jqDeferred ) {
        var jqMethod = _this.hasAnyBroken ? 'reject' : 'resolve';
        _this.jqDeferred[ jqMethod ]( _this );
      }
    });
  };

  // -------------------------- jquery -------------------------- //

  if ( $ ) {
    $.fn.imagesLoaded = function( options, callback ) {
      var instance = new ImagesLoaded( this, options, callback );
      return instance.jqDeferred.promise( $(this) );
    };
  }


  // --------------------------  -------------------------- //

  function LoadingImage( img ) {
    this.img = img;
  }

  LoadingImage.prototype = new EventEmitter();

  LoadingImage.prototype.check = function() {
    // first check cached any previous images that have same src
    var resource = cache[ this.img.src ] || new Resource( this.img.src );
    if ( resource.isConfirmed ) {
      this.confirm( resource.isLoaded, 'cached was confirmed' );
      return;
    }

    // If complete is true and browser supports natural sizes,
    // try to check for image status manually.
    if ( this.img.complete && this.img.naturalWidth !== undefined ) {
      // report based on naturalWidth
      this.confirm( this.img.naturalWidth !== 0, 'naturalWidth' );
      return;
    }

    // If none of the checks above matched, simulate loading on detached element.
    var _this = this;
    resource.on( 'confirm', function( resrc, message ) {
      _this.confirm( resrc.isLoaded, message );
      return true;
    });

    resource.check();
  };

  LoadingImage.prototype.confirm = function( isLoaded, message ) {
    this.isLoaded = isLoaded;
    this.emit( 'confirm', this, message );
  };

  // -------------------------- Resource -------------------------- //

  // Resource checks each src, only once
  // separate class from LoadingImage to prevent memory leaks. See #115

  var cache = {};

  function Resource( src ) {
    this.src = src;
    // add to cache
    cache[ src ] = this;
  }

  Resource.prototype = new EventEmitter();

  Resource.prototype.check = function() {
    // only trigger checking once
    if ( this.isChecked ) {
      return;
    }
    // simulate loading on detached element
    var proxyImage = new Image();
    eventie.bind( proxyImage, 'load', this );
    eventie.bind( proxyImage, 'error', this );
    proxyImage.src = this.src;
    // set flag
    this.isChecked = true;
  };

  // ----- events ----- //

  // trigger specified handler for event type
  Resource.prototype.handleEvent = function( event ) {
    var method = 'on' + event.type;
    if ( this[ method ] ) {
      this[ method ]( event );
    }
  };

  Resource.prototype.onload = function( event ) {
    this.confirm( true, 'onload' );
    this.unbindProxyEvents( event );
  };

  Resource.prototype.onerror = function( event ) {
    this.confirm( false, 'onerror' );
    this.unbindProxyEvents( event );
  };

  // ----- confirm ----- //

  Resource.prototype.confirm = function( isLoaded, message ) {
    this.isConfirmed = true;
    this.isLoaded = isLoaded;
    this.emit( 'confirm', this, message );
  };

  Resource.prototype.unbindProxyEvents = function( event ) {
    eventie.unbind( event.target, 'load', this );
    eventie.unbind( event.target, 'error', this );
  };

  // -----  ----- //

  return ImagesLoaded;

});

/*global jQuery */
/*jshint browser:true */
/*!
* FitVids 1.1
*
* Copyright 2013, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*
*/

(function( $ ){

  "use strict";

  $.fn.fitVids = function( options ) {
    var settings = {
      customSelector: null,
      ignore: null,
    };

    if(!document.getElementById('fit-vids-style')) {
      // appendStyles: https://github.com/toddmotto/fluidvids/blob/master/dist/fluidvids.js
      var head = document.head || document.getElementsByTagName('head')[0];
      var css = '.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}';
      var div = document.createElement('div');
      div.innerHTML = '<p>x</p><style id="fit-vids-style">' + css + '</style>';
      head.appendChild(div.childNodes[1]);
    }

    if ( options ) {
      $.extend( settings, options );
    }

    return this.each(function(){
      var selectors = [
        "iframe[src*='player.vimeo.com']",
        "iframe[src*='youtube.com']",
        "iframe[src*='youtube-nocookie.com']",
        "iframe[src*='kickstarter.com'][src*='video.html']",
        "object",
        "embed"
      ];

      if (settings.customSelector) {
        selectors.push(settings.customSelector);
      }

      var ignoreList = '.fitvidsignore';

      if(settings.ignore) {
        ignoreList = ignoreList + ', ' + settings.ignore;
      }

      var $allVideos = $(this).find(selectors.join(','));
      $allVideos = $allVideos.not("object object"); // SwfObj conflict patch
      $allVideos = $allVideos.not(ignoreList); // Disable FitVids on this video.

      $allVideos.each(function(){
        var $this = $(this);
        if($this.parents(ignoreList).length > 0) {
          return; // Disable FitVids on this video.
        }
        if (this.tagName.toLowerCase() === 'embed' && $this.parent('object').length || $this.parent('.fluid-width-video-wrapper').length) { return; }
        if ((!$this.css('height') && !$this.css('width')) && (isNaN($this.attr('height')) || isNaN($this.attr('width'))))
        {
          $this.attr('height', 9);
          $this.attr('width', 16);
        }
        var height = ( this.tagName.toLowerCase() === 'object' || ($this.attr('height') && !isNaN(parseInt($this.attr('height'), 10))) ) ? parseInt($this.attr('height'), 10) : $this.height(),
            width = !isNaN(parseInt($this.attr('width'), 10)) ? parseInt($this.attr('width'), 10) : $this.width(),
            aspectRatio = height / width;
        if(!$this.attr('id')){
          var videoID = 'fitvid' + Math.floor(Math.random()*999999);
          $this.attr('id', videoID);
        }
        $this.wrap('<div class="fluid-width-video-wrapper"></div>').parent('.fluid-width-video-wrapper').css('padding-top', (aspectRatio * 100)+"%");
        $this.removeAttr('height').removeAttr('width');
      });
    });
  };
// Works with either jQuery or Zepto
})( window.jQuery || window.Zepto );

/*
 * jQuery FlexSlider v2.2.2
 * Copyright 2012 WooThemes
 * Contributing Author: Tyler Smith
 */
!function(a){a.flexslider=function(b,c){var d=a(b);d.vars=a.extend({},a.flexslider.defaults,c);var j,e=d.vars.namespace,f=window.navigator&&window.navigator.msPointerEnabled&&window.MSGesture,g=("ontouchstart"in window||f||window.DocumentTouch&&document instanceof DocumentTouch)&&d.vars.touch,h="click touchend MSPointerUp",i="",k="vertical"===d.vars.direction,l=d.vars.reverse,m=d.vars.itemWidth>0,n="fade"===d.vars.animation,o=""!==d.vars.asNavFor,p={},q=!0;a.data(b,"flexslider",d),p={init:function(){d.animating=!1,d.currentSlide=parseInt(d.vars.startAt?d.vars.startAt:0,10),isNaN(d.currentSlide)&&(d.currentSlide=0),d.animatingTo=d.currentSlide,d.atEnd=0===d.currentSlide||d.currentSlide===d.last,d.containerSelector=d.vars.selector.substr(0,d.vars.selector.search(" ")),d.slides=a(d.vars.selector,d),d.container=a(d.containerSelector,d),d.count=d.slides.length,d.syncExists=a(d.vars.sync).length>0,"slide"===d.vars.animation&&(d.vars.animation="swing"),d.prop=k?"top":"marginLeft",d.args={},d.manualPause=!1,d.stopped=!1,d.started=!1,d.startTimeout=null,d.transitions=!d.vars.video&&!n&&d.vars.useCSS&&function(){var a=document.createElement("div"),b=["perspectiveProperty","WebkitPerspective","MozPerspective","OPerspective","msPerspective"];for(var c in b)if(void 0!==a.style[b[c]])return d.pfx=b[c].replace("Perspective","").toLowerCase(),d.prop="-"+d.pfx+"-transform",!0;return!1}(),d.ensureAnimationEnd="",""!==d.vars.controlsContainer&&(d.controlsContainer=a(d.vars.controlsContainer).length>0&&a(d.vars.controlsContainer)),""!==d.vars.manualControls&&(d.manualControls=a(d.vars.manualControls).length>0&&a(d.vars.manualControls)),d.vars.randomize&&(d.slides.sort(function(){return Math.round(Math.random())-.5}),d.container.empty().append(d.slides)),d.doMath(),d.setup("init"),d.vars.controlNav&&p.controlNav.setup(),d.vars.directionNav&&p.directionNav.setup(),d.vars.keyboard&&(1===a(d.containerSelector).length||d.vars.multipleKeyboard)&&a(document).bind("keyup",function(a){var b=a.keyCode;if(!d.animating&&(39===b||37===b)){var c=39===b?d.getTarget("next"):37===b?d.getTarget("prev"):!1;d.flexAnimate(c,d.vars.pauseOnAction)}}),d.vars.mousewheel&&d.bind("mousewheel",function(a,b){a.preventDefault();var f=0>b?d.getTarget("next"):d.getTarget("prev");d.flexAnimate(f,d.vars.pauseOnAction)}),d.vars.pausePlay&&p.pausePlay.setup(),d.vars.slideshow&&d.vars.pauseInvisible&&p.pauseInvisible.init(),d.vars.slideshow&&(d.vars.pauseOnHover&&d.hover(function(){d.manualPlay||d.manualPause||d.pause()},function(){d.manualPause||d.manualPlay||d.stopped||d.play()}),d.vars.pauseInvisible&&p.pauseInvisible.isHidden()||(d.vars.initDelay>0?d.startTimeout=setTimeout(d.play,d.vars.initDelay):d.play())),o&&p.asNav.setup(),g&&d.vars.touch&&p.touch(),(!n||n&&d.vars.smoothHeight)&&a(window).bind("resize orientationchange focus",p.resize),d.find("img").attr("draggable","false"),setTimeout(function(){d.vars.start(d)},200)},asNav:{setup:function(){d.asNav=!0,d.animatingTo=Math.floor(d.currentSlide/d.move),d.currentItem=d.currentSlide,d.slides.removeClass(e+"active-slide").eq(d.currentItem).addClass(e+"active-slide"),f?(b._slider=d,d.slides.each(function(){var b=this;b._gesture=new MSGesture,b._gesture.target=b,b.addEventListener("MSPointerDown",function(a){a.preventDefault(),a.currentTarget._gesture&&a.currentTarget._gesture.addPointer(a.pointerId)},!1),b.addEventListener("MSGestureTap",function(b){b.preventDefault();var c=a(this),e=c.index();a(d.vars.asNavFor).data("flexslider").animating||c.hasClass("active")||(d.direction=d.currentItem<e?"next":"prev",d.flexAnimate(e,d.vars.pauseOnAction,!1,!0,!0))})})):d.slides.on(h,function(b){b.preventDefault();var c=a(this),f=c.index(),g=c.offset().left-a(d).scrollLeft();0>=g&&c.hasClass(e+"active-slide")?d.flexAnimate(d.getTarget("prev"),!0):a(d.vars.asNavFor).data("flexslider").animating||c.hasClass(e+"active-slide")||(d.direction=d.currentItem<f?"next":"prev",d.flexAnimate(f,d.vars.pauseOnAction,!1,!0,!0))})}},controlNav:{setup:function(){d.manualControls?p.controlNav.setupManual():p.controlNav.setupPaging()},setupPaging:function(){var f,g,b="thumbnails"===d.vars.controlNav?"control-thumbs":"control-paging",c=1;if(d.controlNavScaffold=a('<ol class="'+e+"control-nav "+e+b+'"></ol>'),d.pagingCount>1)for(var j=0;j<d.pagingCount;j++){if(g=d.slides.eq(j),f="thumbnails"===d.vars.controlNav?'<img src="'+g.attr("data-thumb")+'"/>':"<a>"+c+"</a>","thumbnails"===d.vars.controlNav&&!0===d.vars.thumbCaptions){var k=g.attr("data-thumbcaption");""!=k&&void 0!=k&&(f+='<span class="'+e+'caption">'+k+"</span>")}d.controlNavScaffold.append("<li>"+f+"</li>"),c++}d.controlsContainer?a(d.controlsContainer).append(d.controlNavScaffold):d.append(d.controlNavScaffold),p.controlNav.set(),p.controlNav.active(),d.controlNavScaffold.delegate("a, img",h,function(b){if(b.preventDefault(),""===i||i===b.type){var c=a(this),f=d.controlNav.index(c);c.hasClass(e+"active")||(d.direction=f>d.currentSlide?"next":"prev",d.flexAnimate(f,d.vars.pauseOnAction))}""===i&&(i=b.type),p.setToClearWatchedEvent()})},setupManual:function(){d.controlNav=d.manualControls,p.controlNav.active(),d.controlNav.bind(h,function(b){if(b.preventDefault(),""===i||i===b.type){var c=a(this),f=d.controlNav.index(c);c.hasClass(e+"active")||(d.direction=f>d.currentSlide?"next":"prev",d.flexAnimate(f,d.vars.pauseOnAction))}""===i&&(i=b.type),p.setToClearWatchedEvent()})},set:function(){var b="thumbnails"===d.vars.controlNav?"img":"a";d.controlNav=a("."+e+"control-nav li "+b,d.controlsContainer?d.controlsContainer:d)},active:function(){d.controlNav.removeClass(e+"active").eq(d.animatingTo).addClass(e+"active")},update:function(b,c){d.pagingCount>1&&"add"===b?d.controlNavScaffold.append(a("<li><a>"+d.count+"</a></li>")):1===d.pagingCount?d.controlNavScaffold.find("li").remove():d.controlNav.eq(c).closest("li").remove(),p.controlNav.set(),d.pagingCount>1&&d.pagingCount!==d.controlNav.length?d.update(c,b):p.controlNav.active()}},directionNav:{setup:function(){var b=a('<ul class="'+e+'direction-nav"><li><a class="'+e+'prev" href="#">'+d.vars.prevText+'</a></li><li><a class="'+e+'next" href="#">'+d.vars.nextText+"</a></li></ul>");d.controlsContainer?(a(d.controlsContainer).append(b),d.directionNav=a("."+e+"direction-nav li a",d.controlsContainer)):(d.append(b),d.directionNav=a("."+e+"direction-nav li a",d)),p.directionNav.update(),d.directionNav.bind(h,function(b){b.preventDefault();var c;(""===i||i===b.type)&&(c=a(this).hasClass(e+"next")?d.getTarget("next"):d.getTarget("prev"),d.flexAnimate(c,d.vars.pauseOnAction)),""===i&&(i=b.type),p.setToClearWatchedEvent()})},update:function(){var a=e+"disabled";1===d.pagingCount?d.directionNav.addClass(a).attr("tabindex","-1"):d.vars.animationLoop?d.directionNav.removeClass(a).removeAttr("tabindex"):0===d.animatingTo?d.directionNav.removeClass(a).filter("."+e+"prev").addClass(a).attr("tabindex","-1"):d.animatingTo===d.last?d.directionNav.removeClass(a).filter("."+e+"next").addClass(a).attr("tabindex","-1"):d.directionNav.removeClass(a).removeAttr("tabindex")}},pausePlay:{setup:function(){var b=a('<div class="'+e+'pauseplay"><a></a></div>');d.controlsContainer?(d.controlsContainer.append(b),d.pausePlay=a("."+e+"pauseplay a",d.controlsContainer)):(d.append(b),d.pausePlay=a("."+e+"pauseplay a",d)),p.pausePlay.update(d.vars.slideshow?e+"pause":e+"play"),d.pausePlay.bind(h,function(b){b.preventDefault(),(""===i||i===b.type)&&(a(this).hasClass(e+"pause")?(d.manualPause=!0,d.manualPlay=!1,d.pause()):(d.manualPause=!1,d.manualPlay=!0,d.play())),""===i&&(i=b.type),p.setToClearWatchedEvent()})},update:function(a){"play"===a?d.pausePlay.removeClass(e+"pause").addClass(e+"play").html(d.vars.playText):d.pausePlay.removeClass(e+"play").addClass(e+"pause").html(d.vars.pauseText)}},touch:function(){function r(f){d.animating?f.preventDefault():(window.navigator.msPointerEnabled||1===f.touches.length)&&(d.pause(),g=k?d.h:d.w,i=Number(new Date),o=f.touches[0].pageX,p=f.touches[0].pageY,e=m&&l&&d.animatingTo===d.last?0:m&&l?d.limit-(d.itemW+d.vars.itemMargin)*d.move*d.animatingTo:m&&d.currentSlide===d.last?d.limit:m?(d.itemW+d.vars.itemMargin)*d.move*d.currentSlide:l?(d.last-d.currentSlide+d.cloneOffset)*g:(d.currentSlide+d.cloneOffset)*g,a=k?p:o,c=k?o:p,b.addEventListener("touchmove",s,!1),b.addEventListener("touchend",t,!1))}function s(b){o=b.touches[0].pageX,p=b.touches[0].pageY,h=k?a-p:a-o,j=k?Math.abs(h)<Math.abs(o-c):Math.abs(h)<Math.abs(p-c);var f=500;(!j||Number(new Date)-i>f)&&(b.preventDefault(),!n&&d.transitions&&(d.vars.animationLoop||(h/=0===d.currentSlide&&0>h||d.currentSlide===d.last&&h>0?Math.abs(h)/g+2:1),d.setProps(e+h,"setTouch")))}function t(){if(b.removeEventListener("touchmove",s,!1),d.animatingTo===d.currentSlide&&!j&&null!==h){var k=l?-h:h,m=k>0?d.getTarget("next"):d.getTarget("prev");d.canAdvance(m)&&(Number(new Date)-i<550&&Math.abs(k)>50||Math.abs(k)>g/2)?d.flexAnimate(m,d.vars.pauseOnAction):n||d.flexAnimate(d.currentSlide,d.vars.pauseOnAction,!0)}b.removeEventListener("touchend",t,!1),a=null,c=null,h=null,e=null}function u(a){a.stopPropagation(),d.animating?a.preventDefault():(d.pause(),b._gesture.addPointer(a.pointerId),q=0,g=k?d.h:d.w,i=Number(new Date),e=m&&l&&d.animatingTo===d.last?0:m&&l?d.limit-(d.itemW+d.vars.itemMargin)*d.move*d.animatingTo:m&&d.currentSlide===d.last?d.limit:m?(d.itemW+d.vars.itemMargin)*d.move*d.currentSlide:l?(d.last-d.currentSlide+d.cloneOffset)*g:(d.currentSlide+d.cloneOffset)*g)}function v(a){a.stopPropagation();var c=a.target._slider;if(c){var d=-a.translationX,f=-a.translationY;return q+=k?f:d,h=q,j=k?Math.abs(q)<Math.abs(-d):Math.abs(q)<Math.abs(-f),a.detail===a.MSGESTURE_FLAG_INERTIA?(setImmediate(function(){b._gesture.stop()}),void 0):((!j||Number(new Date)-i>500)&&(a.preventDefault(),!n&&c.transitions&&(c.vars.animationLoop||(h=q/(0===c.currentSlide&&0>q||c.currentSlide===c.last&&q>0?Math.abs(q)/g+2:1)),c.setProps(e+h,"setTouch"))),void 0)}}function w(b){b.stopPropagation();var d=b.target._slider;if(d){if(d.animatingTo===d.currentSlide&&!j&&null!==h){var f=l?-h:h,k=f>0?d.getTarget("next"):d.getTarget("prev");d.canAdvance(k)&&(Number(new Date)-i<550&&Math.abs(f)>50||Math.abs(f)>g/2)?d.flexAnimate(k,d.vars.pauseOnAction):n||d.flexAnimate(d.currentSlide,d.vars.pauseOnAction,!0)}a=null,c=null,h=null,e=null,q=0}}var a,c,e,g,h,i,j=!1,o=0,p=0,q=0;f?(b.style.msTouchAction="none",b._gesture=new MSGesture,b._gesture.target=b,b.addEventListener("MSPointerDown",u,!1),b._slider=d,b.addEventListener("MSGestureChange",v,!1),b.addEventListener("MSGestureEnd",w,!1)):b.addEventListener("touchstart",r,!1)},resize:function(){!d.animating&&d.is(":visible")&&(m||d.doMath(),n?p.smoothHeight():m?(d.slides.width(d.computedW),d.update(d.pagingCount),d.setProps()):k?(d.viewport.height(d.h),d.setProps(d.h,"setTotal")):(d.vars.smoothHeight&&p.smoothHeight(),d.newSlides.width(d.computedW),d.setProps(d.computedW,"setTotal")))},smoothHeight:function(a){if(!k||n){var b=n?d:d.viewport;a?b.animate({height:d.slides.eq(d.animatingTo).height()},a):b.height(d.slides.eq(d.animatingTo).height())}},sync:function(b){var c=a(d.vars.sync).data("flexslider"),e=d.animatingTo;switch(b){case"animate":c.flexAnimate(e,d.vars.pauseOnAction,!1,!0);break;case"play":c.playing||c.asNav||c.play();break;case"pause":c.pause()}},uniqueID:function(b){return b.find("[id]").each(function(){var b=a(this);b.attr("id",b.attr("id")+"_clone")}),b},pauseInvisible:{visProp:null,init:function(){var a=["webkit","moz","ms","o"];if("hidden"in document)return"hidden";for(var b=0;b<a.length;b++)a[b]+"Hidden"in document&&(p.pauseInvisible.visProp=a[b]+"Hidden");if(p.pauseInvisible.visProp){var c=p.pauseInvisible.visProp.replace(/[H|h]idden/,"")+"visibilitychange";document.addEventListener(c,function(){p.pauseInvisible.isHidden()?d.startTimeout?clearTimeout(d.startTimeout):d.pause():d.started?d.play():d.vars.initDelay>0?setTimeout(d.play,d.vars.initDelay):d.play()})}},isHidden:function(){return document[p.pauseInvisible.visProp]||!1}},setToClearWatchedEvent:function(){clearTimeout(j),j=setTimeout(function(){i=""},3e3)}},d.flexAnimate=function(b,c,f,h,i){if(d.vars.animationLoop||b===d.currentSlide||(d.direction=b>d.currentSlide?"next":"prev"),o&&1===d.pagingCount&&(d.direction=d.currentItem<b?"next":"prev"),!d.animating&&(d.canAdvance(b,i)||f)&&d.is(":visible")){if(o&&h){var j=a(d.vars.asNavFor).data("flexslider");if(d.atEnd=0===b||b===d.count-1,j.flexAnimate(b,!0,!1,!0,i),d.direction=d.currentItem<b?"next":"prev",j.direction=d.direction,Math.ceil((b+1)/d.visible)-1===d.currentSlide||0===b)return d.currentItem=b,d.slides.removeClass(e+"active-slide").eq(b).addClass(e+"active-slide"),!1;d.currentItem=b,d.slides.removeClass(e+"active-slide").eq(b).addClass(e+"active-slide"),b=Math.floor(b/d.visible)}if(d.animating=!0,d.animatingTo=b,c&&d.pause(),d.vars.before(d),d.syncExists&&!i&&p.sync("animate"),d.vars.controlNav&&p.controlNav.active(),m||d.slides.removeClass(e+"active-slide").eq(b).addClass(e+"active-slide"),d.atEnd=0===b||b===d.last,d.vars.directionNav&&p.directionNav.update(),b===d.last&&(d.vars.end(d),d.vars.animationLoop||d.pause()),n)g?(d.slides.eq(d.currentSlide).css({opacity:0,zIndex:1}),d.slides.eq(b).css({opacity:1,zIndex:2}),d.wrapup(q)):(d.slides.eq(d.currentSlide).css({zIndex:1}).animate({opacity:0},d.vars.animationSpeed,d.vars.easing),d.slides.eq(b).css({zIndex:2}).animate({opacity:1},d.vars.animationSpeed,d.vars.easing,d.wrapup));else{var r,s,t,q=k?d.slides.filter(":first").height():d.computedW;m?(r=d.vars.itemMargin,t=(d.itemW+r)*d.move*d.animatingTo,s=t>d.limit&&1!==d.visible?d.limit:t):s=0===d.currentSlide&&b===d.count-1&&d.vars.animationLoop&&"next"!==d.direction?l?(d.count+d.cloneOffset)*q:0:d.currentSlide===d.last&&0===b&&d.vars.animationLoop&&"prev"!==d.direction?l?0:(d.count+1)*q:l?(d.count-1-b+d.cloneOffset)*q:(b+d.cloneOffset)*q,d.setProps(s,"",d.vars.animationSpeed),d.transitions?(d.vars.animationLoop&&d.atEnd||(d.animating=!1,d.currentSlide=d.animatingTo),d.container.unbind("webkitTransitionEnd transitionend"),d.container.bind("webkitTransitionEnd transitionend",function(){clearTimeout(d.ensureAnimationEnd),d.wrapup(q)}),clearTimeout(d.ensureAnimationEnd),d.ensureAnimationEnd=setTimeout(function(){d.wrapup(q)},d.vars.animationSpeed+100)):d.container.animate(d.args,d.vars.animationSpeed,d.vars.easing,function(){d.wrapup(q)})}d.vars.smoothHeight&&p.smoothHeight(d.vars.animationSpeed)}},d.wrapup=function(a){n||m||(0===d.currentSlide&&d.animatingTo===d.last&&d.vars.animationLoop?d.setProps(a,"jumpEnd"):d.currentSlide===d.last&&0===d.animatingTo&&d.vars.animationLoop&&d.setProps(a,"jumpStart")),d.animating=!1,d.currentSlide=d.animatingTo,d.vars.after(d)},d.animateSlides=function(){!d.animating&&q&&d.flexAnimate(d.getTarget("next"))},d.pause=function(){clearInterval(d.animatedSlides),d.animatedSlides=null,d.playing=!1,d.vars.pausePlay&&p.pausePlay.update("play"),d.syncExists&&p.sync("pause")},d.play=function(){d.playing&&clearInterval(d.animatedSlides),d.animatedSlides=d.animatedSlides||setInterval(d.animateSlides,d.vars.slideshowSpeed),d.started=d.playing=!0,d.vars.pausePlay&&p.pausePlay.update("pause"),d.syncExists&&p.sync("play")},d.stop=function(){d.pause(),d.stopped=!0},d.canAdvance=function(a,b){var c=o?d.pagingCount-1:d.last;return b?!0:o&&d.currentItem===d.count-1&&0===a&&"prev"===d.direction?!0:o&&0===d.currentItem&&a===d.pagingCount-1&&"next"!==d.direction?!1:a!==d.currentSlide||o?d.vars.animationLoop?!0:d.atEnd&&0===d.currentSlide&&a===c&&"next"!==d.direction?!1:d.atEnd&&d.currentSlide===c&&0===a&&"next"===d.direction?!1:!0:!1},d.getTarget=function(a){return d.direction=a,"next"===a?d.currentSlide===d.last?0:d.currentSlide+1:0===d.currentSlide?d.last:d.currentSlide-1},d.setProps=function(a,b,c){var e=function(){var c=a?a:(d.itemW+d.vars.itemMargin)*d.move*d.animatingTo,e=function(){if(m)return"setTouch"===b?a:l&&d.animatingTo===d.last?0:l?d.limit-(d.itemW+d.vars.itemMargin)*d.move*d.animatingTo:d.animatingTo===d.last?d.limit:c;switch(b){case"setTotal":return l?(d.count-1-d.currentSlide+d.cloneOffset)*a:(d.currentSlide+d.cloneOffset)*a;case"setTouch":return l?a:a;case"jumpEnd":return l?a:d.count*a;case"jumpStart":return l?d.count*a:a;default:return a}}();return-1*e+"px"}();d.transitions&&(e=k?"translate3d(0,"+e+",0)":"translate3d("+e+",0,0)",c=void 0!==c?c/1e3+"s":"0s",d.container.css("-"+d.pfx+"-transition-duration",c),d.container.css("transition-duration",c)),d.args[d.prop]=e,(d.transitions||void 0===c)&&d.container.css(d.args),d.container.css("transform",e)},d.setup=function(b){if(n)d.slides.css({width:"100%","float":"left",marginRight:"-100%",position:"relative"}),"init"===b&&(g?d.slides.css({opacity:0,display:"block",webkitTransition:"opacity "+d.vars.animationSpeed/1e3+"s ease",zIndex:1}).eq(d.currentSlide).css({opacity:1,zIndex:2}):d.slides.css({opacity:0,display:"block",zIndex:1}).eq(d.currentSlide).css({zIndex:2}).animate({opacity:1},d.vars.animationSpeed,d.vars.easing)),d.vars.smoothHeight&&p.smoothHeight();else{var c,f;"init"===b&&(d.viewport=a('<div class="'+e+'viewport"></div>').css({overflow:"hidden",position:"relative"}).appendTo(d).append(d.container),d.cloneCount=0,d.cloneOffset=0,l&&(f=a.makeArray(d.slides).reverse(),d.slides=a(f),d.container.empty().append(d.slides))),d.vars.animationLoop&&!m&&(d.cloneCount=2,d.cloneOffset=1,"init"!==b&&d.container.find(".clone").remove(),p.uniqueID(d.slides.first().clone().addClass("clone").attr("aria-hidden","true")).appendTo(d.container),p.uniqueID(d.slides.last().clone().addClass("clone").attr("aria-hidden","true")).prependTo(d.container)),d.newSlides=a(d.vars.selector,d),c=l?d.count-1-d.currentSlide+d.cloneOffset:d.currentSlide+d.cloneOffset,k&&!m?(d.container.height(200*(d.count+d.cloneCount)+"%").css("position","absolute").width("100%"),setTimeout(function(){d.newSlides.css({display:"block"}),d.doMath(),d.viewport.height(d.h),d.setProps(c*d.h,"init")},"init"===b?100:0)):(d.container.width(200*(d.count+d.cloneCount)+"%"),d.setProps(c*d.computedW,"init"),setTimeout(function(){d.doMath(),d.newSlides.css({width:d.computedW,"float":"left",display:"block"}),d.vars.smoothHeight&&p.smoothHeight()},"init"===b?100:0))}m||d.slides.removeClass(e+"active-slide").eq(d.currentSlide).addClass(e+"active-slide"),d.vars.init(d)},d.doMath=function(){var a=d.slides.first(),b=d.vars.itemMargin,c=d.vars.minItems,e=d.vars.maxItems;d.w=void 0===d.viewport?d.width():d.viewport.width(),d.h=a.height(),d.boxPadding=a.outerWidth()-a.width(),m?(d.itemT=d.vars.itemWidth+b,d.minW=c?c*d.itemT:d.w,d.maxW=e?e*d.itemT-b:d.w,d.itemW=d.minW>d.w?(d.w-b*(c-1))/c:d.maxW<d.w?(d.w-b*(e-1))/e:d.vars.itemWidth>d.w?d.w:d.vars.itemWidth,d.visible=Math.floor(d.w/d.itemW),d.move=d.vars.move>0&&d.vars.move<d.visible?d.vars.move:d.visible,d.pagingCount=Math.ceil((d.count-d.visible)/d.move+1),d.last=d.pagingCount-1,d.limit=1===d.pagingCount?0:d.vars.itemWidth>d.w?d.itemW*(d.count-1)+b*(d.count-1):(d.itemW+b)*d.count-d.w-b):(d.itemW=d.w,d.pagingCount=d.count,d.last=d.count-1),d.computedW=d.itemW-d.boxPadding},d.update=function(a,b){d.doMath(),m||(a<d.currentSlide?d.currentSlide+=1:a<=d.currentSlide&&0!==a&&(d.currentSlide-=1),d.animatingTo=d.currentSlide),d.vars.controlNav&&!d.manualControls&&("add"===b&&!m||d.pagingCount>d.controlNav.length?p.controlNav.update("add"):("remove"===b&&!m||d.pagingCount<d.controlNav.length)&&(m&&d.currentSlide>d.last&&(d.currentSlide-=1,d.animatingTo-=1),p.controlNav.update("remove",d.last))),d.vars.directionNav&&p.directionNav.update()},d.addSlide=function(b,c){var e=a(b);d.count+=1,d.last=d.count-1,k&&l?void 0!==c?d.slides.eq(d.count-c).after(e):d.container.prepend(e):void 0!==c?d.slides.eq(c).before(e):d.container.append(e),d.update(c,"add"),d.slides=a(d.vars.selector+":not(.clone)",d),d.setup(),d.vars.added(d)},d.removeSlide=function(b){var c=isNaN(b)?d.slides.index(a(b)):b;d.count-=1,d.last=d.count-1,isNaN(b)?a(b,d.slides).remove():k&&l?d.slides.eq(d.last).remove():d.slides.eq(b).remove(),d.doMath(),d.update(c,"remove"),d.slides=a(d.vars.selector+":not(.clone)",d),d.setup(),d.vars.removed(d)},p.init()},a(window).blur(function(){focused=!1}).focus(function(){focused=!0}),a.flexslider.defaults={namespace:"flex-",selector:".slides > li",animation:"fade",easing:"swing",direction:"horizontal",reverse:!1,animationLoop:!0,smoothHeight:!1,startAt:0,slideshow:!0,slideshowSpeed:7e3,animationSpeed:600,initDelay:0,randomize:!1,thumbCaptions:!1,pauseOnAction:!0,pauseOnHover:!1,pauseInvisible:!0,useCSS:!0,touch:!0,video:!1,controlNav:!0,directionNav:!0,prevText:"Previous",nextText:"Next",keyboard:!0,multipleKeyboard:!1,mousewheel:!1,pausePlay:!1,pauseText:"Pause",playText:"Play",controlsContainer:"",manualControls:"",sync:"",asNavFor:"",itemWidth:0,itemMargin:0,minItems:1,maxItems:0,move:0,allowOneSlide:!0,start:function(){},before:function(){},after:function(){},end:function(){},added:function(){},removed:function(){},init:function(){}},a.fn.flexslider=function(b){if(void 0===b&&(b={}),"object"==typeof b)return this.each(function(){var c=a(this),d=b.selector?b.selector:".slides > li",e=c.find(d);1===e.length&&b.allowOneSlide===!0||0===e.length?(e.fadeIn(400),b.start&&b.start(c)):void 0===c.data("flexslider")&&new a.flexslider(this,b)});var c=a(this).data("flexslider");switch(b){case"play":c.play();break;case"pause":c.pause();break;case"stop":c.stop();break;case"next":c.flexAnimate(c.getTarget("next"),!0);break;case"prev":case"previous":c.flexAnimate(c.getTarget("prev"),!0);break;default:"number"==typeof b&&c.flexAnimate(b,!0)}}}(jQuery);

/*
 * jQuery Superfish Menu Plugin - v1.7.4
 * Copyright (c) 2013 Joel Birch
 *
 * Dual licensed under the MIT and GPL licenses:
 *  http://www.opensource.org/licenses/mit-license.php
 *  http://www.gnu.org/licenses/gpl.html
 */

;(function(e){"use strict";var s=function(){var s={bcClass:"sf-breadcrumb",menuClass:"sf-js-enabled",anchorClass:"sf-with-ul",menuArrowClass:"sf-arrows"},o=function(){var s=/iPhone|iPad|iPod/i.test(navigator.userAgent);return s&&e(window).load(function(){e("body").children().on("click",e.noop)}),s}(),n=function(){var e=document.documentElement.style;return"behavior"in e&&"fill"in e&&/iemobile/i.test(navigator.userAgent)}(),t=function(e,o){var n=s.menuClass;o.cssArrows&&(n+=" "+s.menuArrowClass),e.toggleClass(n)},i=function(o,n){return o.find("li."+n.pathClass).slice(0,n.pathLevels).addClass(n.hoverClass+" "+s.bcClass).filter(function(){return e(this).children(n.popUpSelector).hide().show().length}).removeClass(n.pathClass)},r=function(e){e.children("a").toggleClass(s.anchorClass)},a=function(e){var s=e.css("ms-touch-action");s="pan-y"===s?"auto":"pan-y",e.css("ms-touch-action",s)},l=function(s,t){var i="li:has("+t.popUpSelector+")";e.fn.hoverIntent&&!t.disableHI?s.hoverIntent(u,p,i):s.on("mouseenter.superfish",i,u).on("mouseleave.superfish",i,p);var r="MSPointerDown.superfish";o||(r+=" touchend.superfish"),n&&(r+=" mousedown.superfish"),s.on("focusin.superfish","li",u).on("focusout.superfish","li",p).on(r,"a",t,h)},h=function(s){var o=e(this),n=o.siblings(s.data.popUpSelector);n.length>0&&n.is(":hidden")&&(o.one("click.superfish",!1),"MSPointerDown"===s.type?o.trigger("focus"):e.proxy(u,o.parent("li"))())},u=function(){var s=e(this),o=d(s);clearTimeout(o.sfTimer),s.siblings().superfish("hide").end().superfish("show")},p=function(){var s=e(this),n=d(s);o?e.proxy(f,s,n)():(clearTimeout(n.sfTimer),n.sfTimer=setTimeout(e.proxy(f,s,n),n.delay))},f=function(s){s.retainPath=e.inArray(this[0],s.$path)>-1,this.superfish("hide"),this.parents("."+s.hoverClass).length||(s.onIdle.call(c(this)),s.$path.length&&e.proxy(u,s.$path)())},c=function(e){return e.closest("."+s.menuClass)},d=function(e){return c(e).data("sf-options")};return{hide:function(s){if(this.length){var o=this,n=d(o);if(!n)return this;var t=n.retainPath===!0?n.$path:"",i=o.find("li."+n.hoverClass).add(this).not(t).removeClass(n.hoverClass).children(n.popUpSelector),r=n.speedOut;s&&(i.show(),r=0),n.retainPath=!1,n.onBeforeHide.call(i),i.stop(!0,!0).animate(n.animationOut,r,function(){var s=e(this);n.onHide.call(s)})}return this},show:function(){var e=d(this);if(!e)return this;var s=this.addClass(e.hoverClass),o=s.children(e.popUpSelector);return e.onBeforeShow.call(o),o.stop(!0,!0).animate(e.animation,e.speed,function(){e.onShow.call(o)}),this},destroy:function(){return this.each(function(){var o,n=e(this),i=n.data("sf-options");return i?(o=n.find(i.popUpSelector).parent("li"),clearTimeout(i.sfTimer),t(n,i),r(o),a(n),n.off(".superfish").off(".hoverIntent"),o.children(i.popUpSelector).attr("style",function(e,s){return s.replace(/display[^;]+;?/g,"")}),i.$path.removeClass(i.hoverClass+" "+s.bcClass).addClass(i.pathClass),n.find("."+i.hoverClass).removeClass(i.hoverClass),i.onDestroy.call(n),n.removeData("sf-options"),void 0):!1})},init:function(o){return this.each(function(){var n=e(this);if(n.data("sf-options"))return!1;var h=e.extend({},e.fn.superfish.defaults,o),u=n.find(h.popUpSelector).parent("li");h.$path=i(n,h),n.data("sf-options",h),t(n,h),r(u),a(n),l(n,h),u.not("."+s.bcClass).superfish("hide",!0),h.onInit.call(this)})}}}();e.fn.superfish=function(o){return s[o]?s[o].apply(this,Array.prototype.slice.call(arguments,1)):"object"!=typeof o&&o?e.error("Method "+o+" does not exist on jQuery.fn.superfish"):s.init.apply(this,arguments)},e.fn.superfish.defaults={popUpSelector:"ul,.sf-mega",hoverClass:"sfHover",pathClass:"overrideThisToUse",pathLevels:1,delay:800,animation:{opacity:"show"},animationOut:{opacity:"hide"},speed:"normal",speedOut:"fast",cssArrows:!0,disableHI:!1,onInit:e.noop,onBeforeShow:e.noop,onShow:e.noop,onBeforeHide:e.noop,onHide:e.noop,onIdle:e.noop,onDestroy:e.noop},e.fn.extend({hideSuperfishUl:s.hide,showSuperfishUl:s.show})})(jQuery);

/**
 * hoverIntent is similar to jQuery's built-in "hover" method except that
 * instead of firing the handlerIn function immediately, hoverIntent checks
 * to see if the user's mouse has slowed down (beneath the sensitivity
 * threshold) before firing the event. The handlerOut function is only
 * called after a matching handlerIn.
 *
 * hoverIntent r7 // 2013.03.11 // jQuery 1.9.1+
 * http://cherne.net/brian/resources/jquery.hoverIntent.html
 *
 * You may use hoverIntent under the terms of the MIT license. Basically that
 * means you are free to use hoverIntent as long as this header is left intact.
 * Copyright 2007, 2013 Brian Cherne
 *
 * // basic usage ... just like .hover()
 * .hoverIntent( handlerIn, handlerOut )
 * .hoverIntent( handlerInOut )
 *
 * // basic usage ... with event delegation!
 * .hoverIntent( handlerIn, handlerOut, selector )
 * .hoverIntent( handlerInOut, selector )
 *
 * // using a basic configuration object
 * .hoverIntent( config )
 *
 * @param  handlerIn   function OR configuration object
 * @param  handlerOut  function OR selector for delegation OR undefined
 * @param  selector    selector OR undefined
 * @author Brian Cherne <brian(at)cherne(dot)net>
 **/
(function($) {
    $.fn.hoverIntent = function(handlerIn,handlerOut,selector) {

        // default configuration values
        var cfg = {
            interval: 100,
            sensitivity: 7,
            timeout: 0
        };

        if ( typeof handlerIn === "object" ) {
            cfg = $.extend(cfg, handlerIn );
        } else if ($.isFunction(handlerOut)) {
            cfg = $.extend(cfg, { over: handlerIn, out: handlerOut, selector: selector } );
        } else {
            cfg = $.extend(cfg, { over: handlerIn, out: handlerIn, selector: handlerOut } );
        }

        // instantiate variables
        // cX, cY = current X and Y position of mouse, updated by mousemove event
        // pX, pY = previous X and Y position of mouse, set by mouseover and polling interval
        var cX, cY, pX, pY;

        // A private function for getting mouse position
        var track = function(ev) {
            cX = ev.pageX;
            cY = ev.pageY;
        };

        // A private function for comparing current and previous mouse position
        var compare = function(ev,ob) {
            ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
            // compare mouse positions to see if they've crossed the threshold
            if ( ( Math.abs(pX-cX) + Math.abs(pY-cY) ) < cfg.sensitivity ) {
                $(ob).off("mousemove.hoverIntent",track);
                // set hoverIntent state to true (so mouseOut can be called)
                ob.hoverIntent_s = 1;
                return cfg.over.apply(ob,[ev]);
            } else {
                // set previous coordinates for next time
                pX = cX; pY = cY;
                // use self-calling timeout, guarantees intervals are spaced out properly (avoids JavaScript timer bugs)
                ob.hoverIntent_t = setTimeout( function(){compare(ev, ob);} , cfg.interval );
            }
        };

        // A private function for delaying the mouseOut function
        var delay = function(ev,ob) {
            ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
            ob.hoverIntent_s = 0;
            return cfg.out.apply(ob,[ev]);
        };

        // A private function for handling mouse 'hovering'
        var handleHover = function(e) {
            // copy objects to be passed into t (required for event object to be passed in IE)
            var ev = jQuery.extend({},e);
            var ob = this;

            // cancel hoverIntent timer if it exists
            if (ob.hoverIntent_t) { ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t); }

            // if e.type == "mouseenter"
            if (e.type == "mouseenter") {
                // set "previous" X and Y position based on initial entry point
                pX = ev.pageX; pY = ev.pageY;
                // update "current" X and Y position based on mousemove
                $(ob).on("mousemove.hoverIntent",track);
                // start polling interval (self-calling timeout) to compare mouse coordinates over time
                if (ob.hoverIntent_s != 1) { ob.hoverIntent_t = setTimeout( function(){compare(ev,ob);} , cfg.interval );}

                // else e.type == "mouseleave"
            } else {
                // unbind expensive mousemove event
                $(ob).off("mousemove.hoverIntent",track);
                // if hoverIntent state is true, then call the mouseOut function after the specified delay
                if (ob.hoverIntent_s == 1) { ob.hoverIntent_t = setTimeout( function(){delay(ev,ob);} , cfg.timeout );}
            }
        };

        // listen for mouseenter and mouseleave
        return this.on({'mouseenter.hoverIntent':handleHover,'mouseleave.hoverIntent':handleHover}, cfg.selector);
    };
})(jQuery);