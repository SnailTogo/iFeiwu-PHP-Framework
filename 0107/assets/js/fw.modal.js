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
            $.each( base.$el, function (i,el) {console.log();
            	$(el).on('click', function ( e ) {
	            	e.preventDefault();
	            	if ( typeof base.options.onclick=='function' ) {
	            		base.options.onclick( e );
	            	}
	            	base.open();
	            });
            });
            
        };

        base.open = function () {
        	$("html, body").addClass("fw_modal-lock fw_modal-active");
        	$(".fw_modal").show();
        	$(".fw_modal-body").css("visibility","visible");
        };
        
        base.reinit = function ( select ) {
        	console.log(base);
        }
        
        base.init();
    };

    $.fw.modal.defaultOptions = {
        width: "",
        height: "",
        onclick: ""
    };

    $.fn.fw_modal = function ( params, options ) {
    	var _modal;
        this.each(function () {
            _modal = new $.fw.modal(this, params, options);
        });
        return _modal;
    };
    
})( jQuery );