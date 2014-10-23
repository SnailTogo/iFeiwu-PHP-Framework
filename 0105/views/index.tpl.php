<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<title><?php echo $this->keys['seo_title'];?></title>
<meta name="keywords" content="<?php echo $this->keys['seo_keys'];?>" />
<meta name="description" content="<?php echo $this->keys['seo_desc'];?>">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0;">
<link rel="shortcut icon" href="<?php echo $this->keys['global_favicon_ico'];?>">
<link href="<?php echo $this->keys['global_logo_app'];?>" rel="apple-touch-icon">
<link href="<?php echo $this->keys['global_logo_app'];?>?imageView2/2/w/114/h/114" rel="apple-touch-icon" sizes="114x114">
<link href="<?php echo $this->keys['global_logo_app'];?>?imageView2/2/w/120/h/120" rel="apple-touch-icon" sizes="120x120">
<link rel="stylesheet" href="assets/css/reset.css">
<link rel="stylesheet" href="assets/iconfont/style.css">
<!--[if lt IE 8]><!-->
<link rel="stylesheet" href="assets/iconfont/ie7/ie7.css">
<!--<![endif]-->
<link rel="stylesheet" href="assets/swiper/style.css">
<link rel="stylesheet" href="assets/css/app.css">
</head>
<body style="background:url(assets/img/bg.png)">

<div class="wrap">
    <ul class="ul nav">
        <li <?php tpl_nav_active($this->pn, '');?>><a href="?"><i class="icon-home"></i></a><?php tpl_nav_arrow($this->pn, '');?></li>
        <li <?php tpl_nav_active($this->pn, 'works');?>><a href="?pn=works"><i class="icon-works"></i></a><?php tpl_nav_arrow($this->pn, 'works');?></li>
        <li <?php tpl_nav_active($this->pn, 'message');?>><a href="?pn=message"><i class="icon-message"></i></a><?php tpl_nav_arrow($this->pn, 'message');?></li>
        <li <?php tpl_nav_active($this->pn, 'weibo');?>><a href="?pn=weibo"><i class="icon-weibo"></i></a><?php tpl_nav_arrow($this->pn, 'weibo');?></li>
    </ul>
    <div class="main">
        <?php if( $this->pn=='' ):?>
        <div class="home">
            <div class="a"><img src="<?php echo $this->keys['home_left_image'];?>"></div>
            <div class="b"><img src="<?php echo $this->keys['home_right_image'];?>"></div>
        </div>
        <?php elseif( $this->pn=='works' ):?>
        <div class="works">
            <h1>作 品</h1>
            <ul class="ul items">
                <?php foreach($this->items as $item):?>
                <li><a href="#<?php echo $item['id'];?>" data-id="<?php echo $item['id'];?>"><img src="<?php echo $item['image_path'];?>/<?php echo $item['image'];?>"></a></li>
                <?php endforeach;?>
            </ul>
            <ul class="ul pages">
                <li><a href=""><i class="icon-arrow-right"></i></a></li>
                <li><a href=""><i class="icon-arrow-left"></i></a></li>
            </ul>
            <div class="open">
                <div id="is-wrapper">
            		<div id="is-scroller">
            		    <div class="box">
                    		<div class="slider">
                    			<a class="arrow-left"><i class="icon-arrow-left"></i></a>
                                <a class="arrow-right"><i class="icon-arrow-right"></i></a>
                                <div class="swiper-container">
                                	<div class="swiper-wrapper">
                                		<div class="swiper-slide"><img src="assets/img/test.jpg"></div>
                                		<div class="swiper-slide"><img src="assets/img/test.jpg"></div>
                                		<div class="swiper-slide"><img src="assets/img/test.jpg"></div>
                                	</div>
                                </div>
                    		</div>
                    		<div class="info">
                    		    <a href="#" class="close"><i class="icon-close"></i></a>
                    			<h2>W室内设计工作室logo</h2>
                    			<p>他们清晰的了解业主的居住需求，能够用同龄人的眼光去帮他们塑造居住环境。以70后的态度，80后的精神去对待每个住宅空间。他们清晰的了解业主的居住需求，能够用同龄人的眼光去帮他们塑造居住环境。以70后的态度，80后的精神去对待每个住宅空间。他们清晰的了解业主的居住需求，能够用同龄人的眼光去帮他们塑造居住环境。以70后的态度，80后的精神去对待每个住宅空间。他们清晰的了解业主的居住需求，能够用同龄人的眼光去帮他们塑造居住环境。以70后的态度，80后的精神去对待每个住宅空间。</p>
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
        <?php elseif( $this->pn=='message' ):?>
        <form id="message_form" class="message">
            <input type="text" name="uname" value="" placeholder="姓名">
            <input type="email" name="email" value="" placeholder="邮箱">
            <textarea placeholder="留言内容"></textarea>
            <div class="btn"><button type="submit" id="message_send">发 送</button></div>
        </form>
        <?php elseif( $this->pn=='weibo' ):?>
        <div class="weibo">
            <?php echo htmlspecialchars_decode($this->keys['weibo_sina_code']);?>
        </div>
        <?php endif;?>
    </div>
    <div style="clear:both"></div>
</div>
<script src="assets/js/iscroll.js"></script>
<script data-main="assets/js/main" src="assets/require.js"></script>
</body>
</html>