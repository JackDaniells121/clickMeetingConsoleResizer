<?php
namespace ClickMeetingRecruitmentTask;

include 'vendor/autoload.php';

use \Gumlet\ImageResize;

class ImageResizer {

    public static function Resize($source, $destination, $longSideSize) 
    {
        $image = new ImageResize($source);
        $image->resizeToLongSide($longSideSize);
        $image->save($destination);
    }
}