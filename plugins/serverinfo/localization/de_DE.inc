<?php

// German translation by Mike Constabel

$labels = array();

$labels['serverinfo'] = 'Serverinfo';
$labels['serverinformation'] = 'Server-Information';

$labels['account'] = 'Konto';
$labels['storagequota'] = 'Speicher-Kontingent';
$labels['usedstorage'] = 'Belegter Speicher';

$labels['webmail'] = 'Webmail';
$labels['url'] = 'Adresse';
$labels['lastlogin'] = 'Letzer Login';
$labels['defaultidentity'] = 'Standard Identität';
$labels['webmailsystem'] = 'Webmailsystem';

$labels['hostname'] = 'Hostname';
$labels['location'] = 'Server Standort';

$labels['portnumbers'] = 'Portnummern';
$labels['portnumbersregular'] = 'unverschlüsselte Verbindung zum Server';
$labels['smtp'] = 'Ausgehend: SMTP';
$labels['imap'] = 'Eingehend: IMAP';
$labels['pop'] = 'Eingehend: POP';
$labels['portnumbersencrypted'] = 'verschlüsselte Verbindung zum Server';
$labels['smtp-ssl'] = 'Ausgehend: SMTP-SSL';
$labels['imap-ssl'] = 'Eingehend: IMAP-SSL';
$labels['pop-ssl'] = 'Eingehend: POP-SSL';

$labels['recommended'] = 'empfohlen';
$labels['port'] = 'Port';
$labels['and'] = 'und';

$labels['authrequired'] = 'Anmeldung erforderlich';
$labels['spaauthsupported'] = 'SPA wird unterstützt';

// %s will be excanged with the appropiate "SMTP after *" below
$labels['openrelaylocal'] = 'Anmeldung nicht erforderlich beim senden aus dem Netz in dem sich auch der Server befindet';
$labels['authrequired_local'] = 'Anmeldung erforderlich; Anmeldung nicht erforderlich beim senden aus dem Netz in dem sich auch der Server befindet';
$labels['authrequired_local_smtpafter'] = 'Anmeldung oder %s erforderlich; Anmeldung nicht erforderlich beim senden aus dem Netz in dem sich auch der Server befindet';
$labels['authrequired_smtpafter'] = 'Anmeldung oder or %s erforderlich';

// "SMTP after *" are to some extent known technical terminologies.
// For some languages it will probably be correct to not translate "after"
$labels['smtpafterpop'] = 'SMTP after POP';
$labels['smtpafterimap'] = 'SMTP after IMAP';
$labels['smtpafterpopimap'] = 'SMTP after POP/IMAP';

?>