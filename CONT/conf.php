<?php

define("FDOMAIN","excaleido.com");
if ($_SERVER['HTTP_HOST']==FDOMAIN) {
	define("DOMAIN",$_SERVER['HTTP_HOST']);
} else {
	exit();
}

//開発コード名
define("SYSCODE","　");

//システムタイトル
define("SYSNAME","OILLIO CMS");

//CMSディレクトリ
define("DEFDIR","OILLIO");

//salt（変更禁止）
define("SaLt","Pct4_8#L");


//ログフルフルパス
define("LOGDIR","/var/www/CONT/logs");

//Token
define("TOKEN",60*30);


//システムホームURL
define("DEFURL","https://".FDOMAIN."/".DEFDIR);

header('X-Frame-Options: SAMEORIGIN');

date_default_timezone_set('Asia/Tokyo');

//判定開始日
$kijunbi = "2022-01-29 07:32:56";
$kijunbi = "2022-03-08 07:32:56";


?>
