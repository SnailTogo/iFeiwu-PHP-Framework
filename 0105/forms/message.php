<?php
define('START_TIME', microtime(1));
require_once '../config.inc.php';
require_once '../functions.inc.php';

$uname   = Request::post('uname');
$email   = Request::post('email');
$content = Request::post('content');

if( !$uname && !$email && !$content) {
    ajax_result('error_var');
}

$mysql  = new Mysql();
$crypt  = new Crypt();

$keys   = $mysql->get_keys('smtp_','fwy_');

$subject = $uname.'：留言反馈';
$body = "<p>客户姓名：$uname</p><p>客户邮箱:$email</p><p>建站需求：$demand</p><p>留言内容：$content</p>";

$config['smtp_from_name'] = $keys['smtp_from_name'];
$config['smtp_host'] = $keys['smtp_host'];
$config['smtp_port'] = $keys['smtp_port'];
$config['smtp_ssl'] = $keys['smtp_ssl'];
$config['smtp_user'] = $keys['smtp_user'];
$config['smtp_pass'] = $crypt->decrypt($keys['smtp_pass'],$keys['fwy_token']);
$config['smtp_from_email'] = $keys['smtp_from_email'];

$to_email = explode(',', $keys['smtp_to_email']);
$cc_email = explode(',', $keys['smtp_cc_email']);
$bcc_email = explode(',', $keys['smtp_bcc_email']);

//邮件发送
$mailer = new Mailer($config);
$mailer->set_title($subject);
$mailer->set_content($body);
$mailer->add_address($to_email);
$mailer->add_cc($cc_email);
$mailer->add_bcc($bcc_email);
$mailer->send();

//添加到数据库
$data['alias'] = 7;
$data['ctime'] = time();
$data['uname'] = $uname;
$data['email'] = $email;
$data['demand'] = $demand;
$data['content'] = $content;

$result = $mysql->db->AutoExecute(DB_PREFIX.'messages',$data,'INSERT');

if( $result!==false ) {
	ajax_result('success');
} else {
	ajax_result('error');
}