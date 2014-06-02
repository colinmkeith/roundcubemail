<?php

// Polish translation by Tomasz Krynicki

$labels = array();

$labels['serverinfo'] = 'Serwer Info.';
$labels['serverinformation'] = 'Informacje o serwerze';

$labels['account'] = 'Konto';
$labels['storagequota'] = 'Przestrzeń dyskowa';
$labels['usedstorage'] = 'Użyte miejce';

$labels['webmail'] = 'Webmail';
$labels['url'] = 'URL';
$labels['lastlogin'] = 'Ostatnie logowanie';
$labels['defaultidentity'] = 'Domyślna tożsamość';
$labels['webmailsystem'] = 'Webmail system';

$labels['hostname'] = 'Nazwa Hosta';
$labels['location'] = 'Lokalizacja serwera';

$labels['portnumbers'] = 'Numery portów';
$labels['portnumbersregular'] = 'standardowe połączenia';
$labels['smtp'] = 'Wychodzące: SMTP';
$labels['imap'] = 'Przychodzące: IMAP';
$labels['pop'] = 'Przychodzące: POP';
$labels['portnumbersencrypted'] = 'szyfrowane połączenia';
$labels['smtp-ssl'] = 'Wychodzące: SMTP-SSL';
$labels['imap-ssl'] = 'Przychodzące: IMAP-SSL';
$labels['pop-ssl'] = 'Przychodzące: POP-SSL';

$labels['recommended'] = 'zalecane';
$labels['port'] = 'Port';
$labels['and'] = 'oraz';

$labels['authrequired'] = 'Wymaga uwierzytelnienia';
$labels['spaauthsupported'] = 'Wspierane bezpieczne uwierzytelnianie hasła';

// %s will be excanged with the appropiate "SMTP after *" below
$labels['openrelaylocal'] = 'Można wysyłać, gdy w tej samej sieci co serwer';
$labels['authrequired_local'] = 'Wymaga uwierzytelnienia, z wyjątkiem tej samej sieci co serwer';
$labels['authrequired_local_smtpafter'] = 'Wymaga uwierzytelnienia lub %s, z wyjątkiem tej samej sieci co serwer';
$labels['authrequired_smtpafter'] = 'Wymaga uwierzytelnienia lub %s';

// "SMTP after *" are to some extent known technical terminologies.
// For some languages it will probably be correct to not translate "after"
$labels['smtpafterpop'] = 'SMTP po POP';
$labels['smtpafterimap'] = 'SMTP po IMAP';
$labels['smtpafterpopimap'] = 'SMTP po POP/IMAP';

?>