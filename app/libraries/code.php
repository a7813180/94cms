<?php
 
  class Code{

      public function get_code($w=80,$h=30,$length=4,$key){
        header('Content-Type:image/png' );
        //生成一个画布
        $image  = @ imagecreatetruecolor ($w, $h ) or die( 'GD库未开启!' );
        //背景颜色
        $bj  =  imagecolorallocate ($image,225,225,225);
        //字体颜色随机
        $text_color = imagecolorallocate($image, rand(0,60), rand(20,100), rand(50,150));
        //填充矩形来填充画布
        imagefilledrectangle($image, 0, 0, $w, $h,$bj);
        //随机数
        $val = $this->get_random_val($key,$length); 
        $fontfile = dirname(__FILE__).DS.'ahronbd.ttf';
   
        for($i=0;$i<5;$i++){
           $color = imagecolorallocate($image, rand(50,90), rand(80,180), rand(150,240));
           imageline($image,mt_rand(0,$w-1),mt_rand(0,$h-1),mt_rand(0,$w-1),mt_rand(0,$h-1),$color);
        }
 
        for($i=0;$i<$length;$i++){
           $size  = mt_rand($h-12,$h-8);
           $angle = mt_rand(-6,15);
           $x = $i*$size;
           $y = mt_rand($h-10,$h-2);
           $color = imagecolorallocate($image, rand(50,90), rand(80,180), rand(150,240));
           $text = substr($val, $i,1);
           imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text);
        } 

    
        //生成图片
        imagepng ($image);
        //销毁图片
        imagedestroy ($image);
       }


    /**
     * 获取随机数值
     * @return string  返回转换后的字符串
    */
    function get_random_val($key,$length) {
       
        $returnStr='';
        $pattern = '23456789zxcvbnmasdfghjklqwertyuipABCDEFGHIJKLMNPQRSTUVWXYZ';
        for($i = 0; $i < $length; $i ++) {
        $returnStr .= $pattern {mt_rand ( 0, 34 )}; //生成php随机数
        }
        $authnum=$returnStr;
        session_start();
        $_SESSION[$key] = StrToLower($authnum);
        return $authnum;
    }
    
    //验证验证码

    public function checkCode($code,$key){
        session_start();
        if ($_SESSION[$key] == StrToLower($code)) return true;
        return false;
    }


  }

 