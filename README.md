
## About this project

Php Cli script that resizes :sunrise_over_mountains: images with ftp option. Max side size after resize is set to 150 px.

## :wrench::bulb: Installation
```
git clone https://github.com/JackDaniells121/clickMeetingConsoleResizer.git
```
```
cd clickMeetingConsoleResizer
```
```
composer install
```

Set script permissions to be executable
```
chmod +x script
```

## :runner: Run 
```
./script
```

```
./script -f testImages/ak47.jpeg -d testImages/ak47resized.jpeg
```

## :floppy_disk::1234: For multiple files 

```
./script -f sourceFolder -d destFolder
```

:warning: Any destination folder should exist. If not operation will fail.


## :computer::satellite: Resize & Upload files on FTP

```
./script -f testImages -d destFolder -h host -l login -p password
```

In this case destFolder can be ommited, files will be created in temp folder and deleted after operation ends. 


## Options

 - -f       - input file name or folder name
 - -d       - output file name or destination folder
 - -h       - remote host name ex. domain.com
 - -l       - login to ftp account 
 - -p       - password to ftp account

## Thanks for Your time : )

:snowboarder::pizza::gem: