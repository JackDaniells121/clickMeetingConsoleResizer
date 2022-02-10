<?php
namespace ClickMeetingRecruitmentTask;

use Exception;

class FtpManager {
    protected $options;
    public $ftpConnection = false;
    public $loginResult = false;
    public $tempDir;

    function __construct($options, $tempDirectory)
    {
        $this->options = $options;
        $this->connect();
        $this->tempDir = $tempDirectory;
    }

    function connect()
    {
        $host = $this->options['h'];
        $login = $this->options['l'];
        $password = $this->options['p'];

        if ($host != '' && $login != '' && $password != '') {         
            
            $this->ftpConnection = ftp_connect($host);
            $this->loginResult = ftp_login($this->ftpConnection, $login, $password);
           
            if ($this->loginResult) {
                ftp_pasv($this->ftpConnection, true);
            }
            else {
                throw new Exception('Connection to remote host failed');
            } 
        }
    }

    function saveFileOnFtp($file, $destination): bool
    {
        if ($this->ftpConnection && $this->loginResult) {
            
            if (ftp_put($this->ftpConnection, $destination, $file, FTP_BINARY)) {
                return true;
            } 
            else {
                return false;
            }
        }
        return false;
    }

    function createTempDir()
    {
        if ($this->ftpConnection && $this->loginResult) {
            
            $this->tempDir = 'temp/temp'.time();
            mkdir($this->tempDir, 0777, true);
        }
    }

    function __destruct()
    {
        if ($this->ftpConnection) {
            ftp_close($this->ftpConnection);
        }
    }
}