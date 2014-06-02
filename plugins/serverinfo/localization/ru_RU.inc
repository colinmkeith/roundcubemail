<?php

// Russian translation by Igor Alekseev

$labels = array();

$labels['serverinfo'] = 'О сервере';
$labels['serverinformation'] = 'Информация о сервере';

$labels['account'] = 'Учётная запись';
$labels['storagequota'] = 'Объём почтового ящика';
$labels['usedstorage'] = 'Используемый объём';

$labels['webmail'] = 'Web почта';
$labels['url'] = 'URL';
$labels['lastlogin'] = 'Последний заход';
$labels['defaultidentity'] = 'Учётная запись по-умолчанию';
$labels['webmailsystem'] = 'Webmail system';

$labels['hostname'] = 'Имя сервера';
$labels['location'] = 'Местонахождение сервера';

$labels['portnumbers'] = 'Номера портов';
$labels['portnumbersregular'] = 'для подключения к серверу почты';
$labels['smtp'] = 'Исходящий SMTP сервер';
$labels['imap'] = 'Входящий IMAP сервер';
$labels['pop'] = 'Входящий POP сервер';
$labels['portnumbersencrypted'] = 'для защищённого подключения к серверу почты';
$labels['smtp-ssl'] = 'Исходящий SMTP-SSL сервер';
$labels['imap-ssl'] = 'Входящий IMAP-SSL сервер';
$labels['pop-ssl'] = 'Входящий POP-SSL сервер';

$labels['recommended'] = 'рекомендуется';
$labels['port'] = 'Порт';
$labels['and'] = 'и';

$labels['authrequired'] = 'требуется аутентификация';
$labels['spaauthsupported'] = 'Поддерживается безопасная проверка пароля SPA';

// %s will be excanged with the appropiate "SMTP after *" below
$labels['openrelaylocal'] = 'Разрешена отправка для хостов, находящихся с сервером в одной подсети';
$labels['authrequired_local'] = 'Аутентификация требуется, кроме хостов, находящихся с сервером в одной подсети';
$labels['authrequired_local_smtpafter'] = 'Аутентификация требуется или %s , кроме хостов, находящихся с сервером в одной подсети';
$labels['authrequired_smtpafter'] = 'Аутентификация требуется или %s';

// "SMTP after *" are to some extent known technical terminologies.
// For some languages it will probably be correct to not translate "after"
$labels['smtpafterpop'] = 'SMTP после POP соединения';
$labels['smtpafterimap'] = 'SMTP после IMAP соединения';
$labels['smtpafterpopimap'] = 'SMTP после POP/IMAP соединения';

?>
