<?php
/**
 * 结合PHPMailer封装易用的E-Mail发送类
 * ==============================================
 * @author fengsimin <fengsimin@gmail.com>
 * @copyright 2014 飞屋工作室
 * @link http://www.ifeiwu.com
 */
require_once CORE_PATH . '/libs/Mailer/class.phpmailer.php';

class Mailer
{

    private $mailer;

    function __construct ($config)
    {
        $this->mailer = new PHPMailer();
        $this->mailer->CharSet = 'UTF-8';
        $this->mailer->IsSMTP();
        $this->mailer->SMTPDebug = 0;
        $this->mailer->SMTPAuth = true;
        $this->mailer->SMTPSecure = $config['smtp_ssl'];
        $this->mailer->Host = $config['smtp_host'];
        $this->mailer->Port = $config['smtp_port'];
        $this->mailer->Username = $config['smtp_user'];
        $this->mailer->Password = $config['smtp_pass'];
        $this->mailer->SetFrom($config['smtp_from_email'], 
                $config['smtp_from_name']);
        $this->mailer->SetLanguage('zh_cn');
    }
    
    // 邮件标题
    function set_title ($title)
    {
        $this->mailer->Subject = $title;
    }
    
    // 邮件内容
    function set_content ($str)
    {
        $this->mailer->MsgHTML($str);
    }
    
    // 添加收件人邮箱
    function add_address ($emails)
    {
        if (! empty($emails)) {
            if (is_array($emails)) {
                foreach ($emails as $email) {
                    $this->mailer->AddAddress($email);
                }
            } else {
                $this->mailer->AddAddress($emails);
            }
        }
    }
    
    // 添加抄送人邮箱
    function add_cc ($emails)
    {
        if (! empty($emails)) {
            if (is_array($emails)) {
                foreach ($emails as $email) {
                    $this->mailer->AddCC($email);
                }
            } else {
                $this->mailer->AddCC($emails);
            }
        }
    }
    
    // 添加密送人邮箱
    function add_bcc ($emails)
    {
        if (! empty($emails)) {
            if (is_array($emails)) {
                foreach ($emails as $email) {
                    $this->mailer->AddBCC($email);
                }
            } else {
                $this->mailer->AddBCC($emails);
            }
        }
    }
    
    // 添加附件
    function add_attachment ($files)
    {
        if (! empty($files)) {
            if (is_array($files)) {
                foreach ($files as $file) {
                    if (is_file($file)) {
                        $this->mailer->AddAttachment($file);
                    }
                }
            } else {
                $this->mailer->AddAttachment($files);
            }
        }
    }
    
    // 发送邮件
    function send ()
    {
        return $this->mailer->Send() ? true : false;
    }
}