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

    $.fw.modal = function ( el, selector, options ) {
    	
        var base = this;

        base.$el = $(el);
        base.el = el;

        base.$el.data( "fw.modal" , base );

        base.init = function () {
            base.selector = selector;
            base.options = $.extend({},$.fw.modal.defaultOptions, options);
            
            if( base.selector!='' ) { //实现动态绑定页面元素
            	base.$el.on('click', base.selector, function (e) {
            		e.preventDefault();
            		if ( typeof base.options.open=='function' ) {
	            		base.options.open( e );
	            	}
	            	base.open();
            	});
            } else {
            	//所有选择元素添加单击事件
	            $.each( base.$el, function ( i, el ) {
	            	$(el).on('click', function ( e ) {
		            	e.preventDefault();
		            	if ( typeof base.options.open=='function' ) {
		            		base.options.open( e );
		            	}
		            	base.open();
		            });
	            });
            }
            
            //单击关闭弹出层按钮事件
            $('.fw_modal-close').click(function ( e ) {
        		e.preventDefault();
        		if ( typeof base.options.close=='function' ) {
            		base.options.close( e );
            	}
        		base.close();
        	});
        };

        base.open = function () {
        	base.scrollTop = $(window).scrollTop();
        	$(".fw_modal").fadeIn(300,"linear", function () {
        		$("html, body").css("overflow", "hidden");
        		$('.fw_modal-body').css('visibility', 'visible');
        	});
        };
        
        base.close = function () {
    		$(".fw_modal").fadeOut(300,"linear", function () {
        		$("html, body").css("overflow", "");
        		$("html, body").animate({"scrollTop":base.scrollTop},300);
        	});
        }
        
        base.init();
    };

    $.fw.modal.defaultOptions = {
        width: "",
        height: "",
        open: "",
        close: ""
    };

    $.fn.fw_modal = function ( selector, options ) {
    	var _modal;
        this.each(function () {
            _modal = new $.fw.modal(this, selector, options);
        });
        return _modal;
    };
    
})( jQuery );