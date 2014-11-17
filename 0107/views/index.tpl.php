<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $this->keys['seo_title'];?></title>
<meta name="keywords" content="<?php echo $this->keys['seo_keys'];?>" />
<meta name="description" content="<?php echo $this->keys['seo_desc'];?>">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0;">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<link rel="shortcut icon" href="<?php echo $this->keys['global_favicon_ico'];?>">
<link href="<?php echo $this->keys['global_logo_app'];?>" rel="apple-touch-icon">
<link href="<?php echo $this->keys['global_logo_app'];?>?imageView2/2/w/114/h/114" rel="apple-touch-icon" sizes="114x114">
<link href="<?php echo $this->keys['global_logo_app'];?>?imageView2/2/w/120/h/120" rel="apple-touch-icon" sizes="120x120">
<link rel="stylesheet" href="assets/css/reset.css">
<link rel="stylesheet" href="assets/swiper/style.css">
<link rel="stylesheet" href="assets/css/app.css">
</head>
<body style="background-color:<?php echo $this->keys['global_bg_color'];?>;background-image:url('<?php echo $this->keys['global_bg_image'];?>');">

<div class="wrap">
    <header style="background-image:url('<?php echo $this->keys['header_image'];?>');"></header>
    <div class="main">
        <div class="works">
            <ul class="ul items">
                <?php foreach($this->items as $item):?>
                <li><a href="#<?php echo $item['id'];?>" data-id="<?php echo $item['id'];?>"><img src="<?php echo $item['image_path'];?>/<?php echo $item['image'];?>"></a></li>
                <?php endforeach;?>
            </ul>
            <ul class="ul pages">
                <?php echo $this->pagebar;?>
            </ul>
            <div class="open">
                <div id="is-wrapper">
            		<div id="is-scroller">
            		    <div class="box">
                    		<div class="slider">
                    			<a class="arrow-left"><i class="icon-arrow-left"></i></a>
                                <a class="arrow-right"><i class="icon-arrow-right"></i></a>
                                <div class="swiper-container">
                                	<div class="swiper-wrapper"></div>
                                </div>
                    		</div>
                    		<div class="info">
                    		    <a href="#" class="close"><i class="icon-close"></i></a>
                    			<h2>这是标题</h2>
                    			<p>这是描述</p>
                    		</div>
                    		<div class="share">
                                <div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
                                <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
                    		</div>
                		</div>
            		</div>
            	</div>
        	</div>
        </div>
        <form class="message">
            <input type="text" id="uname" value="" placeholder="姓名">
            <input type="email" id="email" value="" placeholder="邮箱">
            <textarea id="content" placeholder="留言内容"></textarea>
            <div class="btn"><button type="button" id="message_send">发 送</button></div>
        </form>
    </div>
</div>
<script src="assets/js/iscroll.js"></script>
<script data-main="assets/js/main" src="assets/require.js"></script>
<?php echo htmlspecialchars_decode($this->keys['tongji_code']);?>
</body>
</html>