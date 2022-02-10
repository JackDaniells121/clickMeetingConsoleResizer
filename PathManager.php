<?php
namespace ClickMeetingRecruitmentTask;

use Exception;

class PathManager {
    protected $options;
    public $sourcePath = null;
    public $files = null;
    public $destination = null;
    public $destIsDir = false;
    public $destFileExists = false;
    public $throwErrorsOnFiles;

    public $allowedExtensions = ['png','jpeg','jpg','bmp'];

    function __construct($options, $throwErrorsOnFiles = false)
    {
        $this->throwErrorsOnFiles = $throwErrorsOnFiles;
        $this->options = $options;
        $this->checkSourcePath();
        $this->checkDestinationPath();
    }
    /**
     * Check if given path is directory
     * if yes then add all files 
     * if no add path to this one file
     */
    function checkSourcePath()
    {
        $filePath = $this->options["f"];
        
        if ($filePath != '') {

            $this->sourcePath = $filePath;

            if (is_dir($filePath)) {
                
                $this->checkiIsDirEmpty($filePath);

                foreach(scandir($filePath) as $i=> $file) {
                    if ($file == "." or $file == "..") {
                        continue;
                    }
                    if($this->isImage($this->sourcePath.'/'.$file)) {
                        $this->files[] = $this->sourcePath.'/'.$file;
                    }
                }
            }
            else {
                if(! $this->isImage($filePath)) {
                    throw new Exception('Source image is not an image!');
                }
                $this->files[] = $this->sourcePath;
            }
        }
    }

    /**
     * Check if destination path is directory
     * or it is single file, 
     * checks also if destination file exists
     */
    function checkDestinationPath()
    {
        $destPath = $this->options['d'];
        
        if ($destPath != '') {        
            
            if (is_dir($destPath)) {
                $this->destIsDir = true;
                chmod($destPath, 0777);
            }
            elseif (file_exists($destPath)){
                $this->destFileExists = true;   
            }
            $this->destination = $destPath;
        }     
    }

    function isImage($filename): bool
    {
        $size = getimagesize($filename);
        if ($size === false) {
            if ($this->throwErrorsOnFiles) {
                throw new Exception("{$filename}: Invalid image.");
            }
            return false;
        }
        if ($size[0] > 2500 || $size[1] > 2500) {
            if ($this->throwErrorsOnFiles) {
                throw new Exception("{$filename}: Image too large.");
            }
            return false;
        }

        if (!$img = @imagecreatefromstring(file_get_contents($filename))) {
            if ($this->throwErrorsOnFiles) {
                throw new Exception("{$filename}: Invalid image content.");
            }
            return false;
        }
        return true;
    }

    function checkiIsDirEmpty($dir)
    {
        $isDirEmpty = !(new \FilesystemIterator($dir))->valid();
        if ($isDirEmpty) {
            throw new Exception('Source directory is empty !');
        }
    }
}