<?php declare(strict_types=1);
include '../vendor/autoload.php';
include '../ImageResizer.php';

use ClickMeetingRecruitmentTask\ImageResizer;
use ClickMeetingRecruitmentTask\PathManager;
use PHPUnit\Framework\TestCase;

final class ImageResizerTest extends TestCase
{


    public function testIsImageAfterResize(): void
    {
        $options = [
            "f" => "emptyDir/",
            "d" => "testImages2/ak49.jpeg"
        ];
        $pm = new PathManager($options);

        $originalFile = '../testImages/ak47.jpeg';
        $resizedFile = 'tests/destinationDir/imageresized.jpeg';

        ImageResizer::Resize($originalFile, $resizedFile, 150);
        
        $this->assertEquals(
            $pm->isImage($resizedFile),
            true
        );

    }
}
