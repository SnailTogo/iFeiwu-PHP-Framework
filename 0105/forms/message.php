<?php
define('START_TIME', microtime(1));
require_once '../config.inc.php';
require_once '../functions.inc.php';

$title   = Request::post('title');
$email   = Request::post('email');
$content = Request::post('content');

if( !$title && !$email && !$content) {
    
}

$db     = db_get_connect();
$result = $db->insert(DB_PREFIX.'messages',array(
    'snid' => 12,
    'ctime' => time(),
    'title' => $title,
    'email' => $email,
    'content' => $content
));

if( $result )
{
    $config = db_get_keys(array(
        'AND' => array(
            'state' => 1,
            'key' => array(
                'smtp_from_name',
                'smtp_host',
                'smtp_port',
                'smtp_ssl',
                'smtp_user',
                'smtp_pass',
                'smtp_from_email',
                'smtp_to_email',
                'smtp_cc_email',
                'smtp_bcc_email',
                'smtp_isuse',
                'fwy_token'
            )
        )
    ));
    
    if( $config['smtp_isuse'] )
    {
        $crypt  = new Crypt();
        $config['smtp_pass'] = $crypt->decrypt($config['smtp_pass'],$config['fwy_token']);
        $mailer = new Mailer($config);
        $mailer->set_title($title.'：留言反馈');
        $mailer->set_content("<p>客户姓名：$title</p><p>客户邮箱: $email</p><p>留言内容：$content</p>");
        $mailer->add_address(explode(',', $config['smtp_to_email']));
        $mailer->add_cc(explode(',', $config['smtp_cc_email']));
        $mailer->add_bcc(explode(',', $config['smtp_bcc_email']));
        $mailer->send();
    }
    
    Response::json(array('result'=>'success'));
}
else
{
    Response::json(array('result'=>'error'));
}