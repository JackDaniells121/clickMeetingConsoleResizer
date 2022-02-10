
# Installation

git clone ...
cd clickMeetingResizer
composer install

Set script permissions to be executable
chmod +x script
./script

# Run

./script -f testImages/ak47.jpeg -d testImages/ak47resized.jpeg

## For multiple files 

 ./script -f testImages -d destFolder

 Any destination folder should exist. If not operation will fail.

## Upload files on FTP

./script -f testImages -d destFolder -h host -l login -p password

In this case destFolder can be ommited, files will be created in temp folder and deleted after operation ends. 

## Options

 - -f input file name or folder name
 - -d output file name or destination folder
 - -h remote host name ex. domain.com
 - -l login to ftp account 
 - -p password to ftp account
