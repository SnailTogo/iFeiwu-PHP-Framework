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
<link rel="stylesheet" href="assets/css/m_app.css">
</head>
<body>
     
<div class="wrap" style="background-color:<?php echo $this->keys['global_bg_color'];?>;">
    <img src="<?php echo $this->keys['header_image_m'];?>">
    <ul class="ul items">
        <?php include_once 'items_loading.tpl.php';?>
    </ul>
    <a id="more" href="javascript:;">More</a>
    <form class="message">
        <h2>Contact Us</h2>
        <input type="text" id="title" value="" placeholder="姓名">
        <input type="email" id="email" value="" placeholder="邮箱">
        <textarea id="content" placeholder="留言内容"></textarea>
        <button type="button" id="message_send">提 交</button>
        <input type="hidden" id="token" value="<?php echo $this->form_token;?>">
    </form>
</div>

<div class="fw_modal">
    <div class="fw_modal-body">
        <a href="javascript:;" class="fw_modal-close"></a>
        <iframe id="ifr_item" width="100%" frameborder="0"></iframe>
    </div>
</div>

<script>var is_mobile = '<?php echo $this->is_mobile;?>';</script>
<script data-main="assets/js/main" src="assets/require.js"></script>
<?php echo htmlspecialchars_decode($this->keys['tongji_code']);?>

</body>
</html>