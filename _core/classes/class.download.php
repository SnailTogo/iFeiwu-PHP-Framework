<?php

/**
 * 下载文件类
 * ==============================================
 * @author fengsimin <fengsimin@gmail.com>
 * @version SVN: $Id: class.Webpage.inc.php 412 2010-12-29 09:45:53Z Jacky672 $
 * @link http://www.ifeiwu.com
 */
class Download
{

    static function send($path, $file_name)
    {
        $file_path = $path.$file_name;
        
        if (ini_get('zlib.output_comporession')) {
            ini_set('zlib.output_compression', 'Off');
        }
        if (is_file($file_path)) {
            switch (strtolower(substr(strrchr($file_name, '.'), 1))) {
                case 'pdf':
                    $mime_type = 'application/pdf';
                    break;
                case 'zip':
                    $mime_type = 'application/zip';
                    break;
                case 'gif':
                    $mime_type = 'image/gif';
                    break;
                case 'jpeg':
                case 'jpg':
                    $mime_type = 'image/jpg';
                    break;
                default:
                    $mime_type = 'application/octet-stream';
            }
            header('Content-Description: Download');
            header('Content-Type: ' . $mime_type);
            header('Content-Disposition: attachment; filename="' . basename($file_name) . '"');
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file_path));
            header('Connection: close');
            ob_clean();
            flush();
            readfile($file_path);
            exit();
        } else {
            return false;
        }
    }
}