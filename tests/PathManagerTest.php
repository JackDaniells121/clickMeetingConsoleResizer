<?php declare(strict_types=1);
include '../vendor/autoload.php';
include '../PathManager.php';

use ClickMeetingRecruitmentTask\PathManager;
use PHPUnit\Framework\TestCase;

final class PathManagerTest extends TestCase
{
    public function testIsThrownErrorOnEmptyInputDirectory(): void
    {
        $options = [
            "f" => "emptyDir/",
            "d" => "testImages2/ak49.jpeg"
        ];

        $this->expectException(Exception::class);
        $pm = new PathManager($options);
    }

    public function testOptions(): void
    {
        $options = [
            "f" => "emptyDir/",
            "d" => "testImages2/ak49.jpeg"
        ];
        $pm = new PathManager($options);

        $this->assertEquals(
            "emptyDir/",
            $pm->sourcePath
        );

        $this->assertEquals(
            "testImages2/ak49.jpeg",
            $pm->destination
        );
    }

    public function testOptionsFilesCount(): void
    {
        $options = [
            "f" => "emptyDir/",
            "d" => "testImages2/ak49.jpeg"
        ];

        $pm = new PathManager($options);

        foreach ($pm->files as $i => $file) {
            $destFileName = time() . $i . '.' . pathinfo($file, PATHINFO_EXTENSION);
            $destFileName = $pm->destIsDir ? $pm->destination . '/' . $destFileName : $pm->destination;
            ImageResizer::Resize($file, $destFileName, 150);
        }

        $this->assertEquals(
            count(scandir("testImages")),
            count($pm->$files)
        );

        foreach ($pm->files as $file) {
            unlink($file);
        }
    }

    public function testIsImage(): void
    {
        $options = [
            "f" => "emptyDir/",
            "d" => "testImages2/ak49.jpeg"
        ];

        $pm = new PathManager($options);

        $originalFile = '../testImages/ak47.jpeg';

        $this->assertEquals(
            $pm->isImage($originalFile),
            true
        );
    }

}
