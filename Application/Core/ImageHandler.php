<?php

namespace Core;

class ImageHandler
{

    public  $directories;

    private $url;
    private $save_url;
    private $name;
    private $img;
    private $img_type;

    public function __construct()
    {
        
    }

    private function convertBs64ToImg($img_bs64)
    {
        $img = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $img_bs64));
        $f = finfo_open();
        $type = finfo_buffer($f, $img, FILEINFO_MIME_TYPE);

        if($type == 'image/gif')
            $this->img_type = '.gif';

        if($type == 'image/jpeg')
            $this->img_type = '.jpeg';

        if($type == 'image/png')
            $this->img_type = '.png';

        return $img;
    }

    private function createFolder($name)
    {
        $url = $_SERVER['DOCUMENT_ROOT'] . '/download/img' . $this->directories . '/' . $name;

        if (!file_exists($url)) {
            mkdir($url, 0777, true);
        }

        $this->save_url = '/download/img' . $this->directories . '/' . $name;

        return $url;
    }

    private function createImgName()
    {
        return md5(microtime() . rand(0, 9999)) . $this->img_type;
    }

    private function createImg()
    {
        file_put_contents($this->url . '/' . $this->name, $this->img);
    }

    public function saveImg($img_bs64, $id)
    {
        if($img_bs64 == '') {
            return '';
        }
        
        $this->url  = $this->createFolder($id);
        $this->img  = $this->convertBs64ToImg($img_bs64);
        $this->name = $this->createImgName();
        $this->createImg();

        return $this->save_url . '/' . $this->name;
    }
}