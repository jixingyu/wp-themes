<?php
if (!session_id()) session_start();
class xy_captcha
{
    private $expire = 1800;
    private $charset = 'abcdefghkmnprstuvwxyzABCDEFGHKMNPRSTUVWXYZ23456789';
    private $code;
    private $codelen = 4;
    private $width = 100;
    private $height = 30;
    private $img;
    private $font;
    private $fontsize = 16;
    private $fontcolor;

    private function createCode() {
        $_len = strlen($this->charset)-1;
        for ($i=0;$i<$this->codelen;$i++) {
            $this->code .= $this->charset[mt_rand(0,$_len)];
        }
    }

    private function createBg() {
        $this->img = imagecreatetruecolor($this->width, $this->height);
        $color = imagecolorallocate($this->img, mt_rand(157,255), mt_rand(157,255), mt_rand(157,255));
        imagefilledrectangle($this->img,0,$this->height,$this->width,0,$color);
    }

    private function createFont() {
        $_x = $this->width / $this->codelen;
        for ($i=0;$i<$this->codelen;$i++) {
            $this->fontcolor = imagecolorallocate($this->img,mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));
            imagettftext($this->img,$this->fontsize,mt_rand(-30,30),$_x*$i+mt_rand(1,5),$this->height / 1.4,$this->fontcolor,$this->font,$this->code[$i]);
        }
    }

    private function createLine() {
        for ($i=0;$i<6;$i++) {
            $color = imagecolorallocate($this->img,mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));
            imageline($this->img,mt_rand(0,$this->width),mt_rand(0,$this->height),mt_rand(0,$this->width),mt_rand(0,$this->height),$color);
        }

        for ($i=0;$i<100;$i++) {
            $color = imagecolorallocate($this->img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
            imagestring($this->img,mt_rand(1,5),mt_rand(0,$this->width),mt_rand(0,$this->height),'*',$color);
        }
    }

    private function outPut() {
        header('Content-type:image/png');
        imagepng($this->img);
        imagedestroy($this->img);
    }

    public function doimg($key) {
        $this->createBg();
        $this->createCode();
        $this->createLine();
        $this->createFont();
        $_SESSION['captcha_word_' . $key] = array(
            'word' => $this->getCode(),
            'expire' => time() + $this->expire,
        );
        $this->outPut();
    }

    public function getCode() {
        return strtolower($this->code);
    }

    public function __construct()
    {
        $this->font = ABSPATH . 'wp-content/themes/mingtang/AdobeGothicStd-Bold.otf';
    }

    public function verify($key, $check_word)
    {
        $check_word = strtolower($check_word);
        $word = $_SESSION['captcha_word_' . $key];
        if (!$word) {
            return '图片验证码不正确';
        }
        if ($word['expire'] < time()) {
            return '图片验证码已过期';
        }
        if ($word['word'] != $check_word) {
            return '图片验证码不正确';
        } else {
            return true;
        }
    }
}