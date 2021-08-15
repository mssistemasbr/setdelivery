<?php

class TImagens {

    protected $image, $src_image;

    public function __construct($arrImage) {
        $this->image = $arrImage;
        $this->src_image = $this->imagecreatefromall();
    }

    protected function imagecreatefromall() {
        $ext = $this->image['type'];
        switch ($ext) {
            case 'image/pjpeg':
            case 'image/jpeg': $image = imagecreatefromjpeg($this->image['tmp_name']);
                break;
            case 'image/png': $image = imagecreatefrompng($this->image['tmp_name']);
                break;
            case 'image/gif': $image = imagecreatefromgif($this->image['tmp_name']);
                break;
        }
        return $image;
    }

    public function GetImageName() {
        return $this->image['name'];
    }

    public function GetImageSize() {
        $size['x'] = imagesx($this->src_image);
        $size['y'] = imagesy($this->src_image);
        return $size;
    }

    public function GetImageType() {
        return $this->image['type'];
    }

    public function GetFileSize() {
        return $this->image['size'];
    }

    public function ResizeImage($intX, $intY, $boolRatio = false, $boolForce = false) {
        $size = $this->GetImageSize();
        $x = $size['x'];
        $y = $size['y'];
        if ($x > $intX || $y > $intY || $boolForce) {
            if ($boolRatio) {
                $ratio = ($x / $y);
                if ($intX / $intY > $ratio) {
                    $intX = $intY * $ratio;
                } else {
                    $intY = $intX / $ratio;
                }
            }
            $image_resized = imagecreatetruecolor($intX, $intY);
            imagecopyresampled($image_resized, $this->src_image, 0, 0, 0, 0, $intX, $intY, imagesx($this->src_image), imagesy($this->src_image));
            $this->src_image = $image_resized;
        }
    }

    public function WriteImage($strFormat = 'jpeg', $strPath = NULL, $intJpegQuality = 85) {
        switch ($strFormat) {
            case 'jpeg': imagejpeg($this->src_image, $strPath, $intJpegQuality);
                break;
            case 'png': imagepng($this->src_image, $strPath);
                break;
            case 'gif': imagegif($this->src_image, $strPath);
                break;
        }
    }

}
?>