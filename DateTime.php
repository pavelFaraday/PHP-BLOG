<?php 
date_default_timezone_set('Asia/Dubai');

// strftime() function shows hours uncorrectly. Because it's not showen directly from our computer time - it is time from XAMPP server.. !!! so, we use *** date_default_timezone_set('Asia/Dubai') *** function..
// https://www.php.net/manual/en/timezones.php

$CurrenTime=time(); // Shows CURRENT time in seconds, so we cant't read it correctly..
// $DateTime=strftime("%Y-%m-%d %H:%M:%S",$CurrenTime); 
// echo $DateTime;  // 2019-11-17 09:27:22. 
$DateTime=strftime("%d-%B-%Y %H:%M:%S",$CurrenTime);   
echo $DateTime;  //  17-November-2019 12:58:13





?>