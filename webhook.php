<?php
define('TGKEY', '461381865:AAE-ySus48Ht6n76bSIGvujPFEzNJLUm3GA');
include_once('tg.class.php');

$body = file_get_contents('php://input');
$arr = json_decode($body, true); 

$tg = new tg(TGKEY);

$tg_id = $arr['message']['chat']['id'];
$rez_kb = array();

$message_text = $arr['message']['text'];
//$tg->sendChatAction($tg_id);
$sms_rev='';
 if (substr($message_text,0,1)=='/'){
	switch($message_text){
		case '/start':
			$sms_rev = "Здравствуйте, Вас приветсвует Простейший Бот Telegram!";
		break;
		case '/help':
			$sms_rev = "Я могу выполнить следующюю функцию:	/rev - переворачиваею строку наоборот.";	
		break;
		case '/rev':
			$sms_rev = strrev($message_text);	
		break;
		case 'огурец':
			$sms_rev = "YES!";	
		break;
		case '/s':
			$sms_rev = " Yarr!!!";	
		break;
		default:
			$sms_rev ="Команда не распознана";
		break;	
	}
 }
$tg->send($tg_id, $sms_rev, $rez_kb);
exit('ok'); // говорим телеге, что все окей
?>