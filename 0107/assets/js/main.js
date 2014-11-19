require.config({
	baseUrl: 'assets/js',
	paths: {},
	shim: {
		'longdialog':['jquery']
	},
	urlArgs: "v=20141013"
});
require(['longdialog'], function() {
	
	$('.items a').hover(
		function() {
			var title = $(this).find('img').attr('alt');
			$(this).append('<div class="mask">'+title+'</div>');
		}, function() {
			$(this).find('.mask').remove();
		}
	);
	
	$('#show_item iframe').css('height',document.body.clientHeight+'px');

	$('.items a').on('click', function(){
		var id = $(this).data('id');
		$('#show_item iframe').attr('src','item.php?id='+id);
	});
	
	$(".overlay").longDialog({openButton: $(".items a"),mainContainer: $(".wrap")});
	
	if( $('#message_send').length ) {
		$('#message_send').click(function(){
			
			var token = $('#token').val();
			var title = $('#title').val();
			var email = $('#email').val();
			var content = $('#content').val();
			
			if( !title ) {
				alert('请填写您的姓名！');
				$('#title').focus();
				return false;
			}

			if (!email) {
				alert('请填写邮箱地址！');
				$('#email').focus();
				return false;
			} else {
				if (!/^\w+@\w+.\w+$/.test(email)) {
					alert('填写的邮箱地址格式不正确！');
					$('#email').focus();
					return false;
				}
			}
			
			if( !content ) {
				alert('请填写留言内容！');
				$('#content').focus();
				return false;
			}
			
			$(this).attr('disabled',true).css('background','#707070').text('请稍候...');
			
			$.post('forms/message.php',{'title':title,'email':email,'content':content,'token':token},function(json){
				if( json.result=='success' ) {
					alert('留言成功，感谢您的支持！');
					location.reload();
				} else {
					alert('留言失败，请稍候再试！');
					$('#message_send').attr('disabled',false).css('background','#846F50').text('提 交');
				}
			},'JSON');
		});
	}
	
});


		

