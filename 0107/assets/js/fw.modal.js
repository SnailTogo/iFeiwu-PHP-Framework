/*!
 * 响应式支持多终端的弹出层
 * Author: @fengsimin
 * Further changes: @addyosmani
 * Licensed under the MIT license
 */

;(function ( $ ) {
    if (!$.fw) {
        $.fw = {};
    }

    $.fw.modal = function ( el, params, options ) {
    	
        var base = this;

        base.$el = $(el);
        base.el = el;

        base.$el.data( "fw.modal" , base );

        base.init = function () {
            base.params = params;
            base.options = $.extend({},$.fw.modal.defaultOptions, options);
            
            
        };

        // Sample Function, Uncomment to use
        // base.functionName = function( paramaters ){
        //
        // };
        // Run initializer
        base.init();
    };

    $.fw.modal.defaultOptions = {
        width: "",
        height: ""
    };

    $.fn.fw_modal = function ( params, options ) {
        return this.each(function () {
            (new $.fw.modal(this, params, options));
        });
    };
    
})( jQuery );