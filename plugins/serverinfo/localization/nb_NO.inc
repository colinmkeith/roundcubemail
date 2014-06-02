<?php

$labels = array();

$labels['serverinfo'] = 'Serverinfo';
$labels['serverinformation'] = 'Serverinformasjon';

$labels['account'] = 'Konto';
$labels['storagequota'] = 'Plassbegrensning';
$labels['usedstorage'] = 'Benyttet plass';

$labels['webmail'] = 'Webmail';
$labels['url'] = 'Adresse';
$labels['lastlogin'] = 'Forrige innlogging';
$labels['defaultidentity'] = 'Standardidentitet';
$labels['webmailsystem'] = 'Webmailsystem';

$labels['hostname'] = 'Servernavn';
$labels['location'] = 'Serverplassering';

$labels['portnumbers'] = 'Portnumre';
$labels['portnumbersregular'] = 'vanlig tilkobling til server';
$labels['smtp'] = 'Utgående: SMTP';
$labels['imap'] = 'Inngående: IMAP';
$labels['pop'] = 'Inngående: POP';
$labels['portnumbersencrypted'] = 'kryptert tilkobling til server';
$labels['smtp-ssl'] = 'Utgående: SMTP-SSL';
$labels['imap-ssl'] = 'Inngående: IMAP-SSL';
$labels['pop-ssl'] = 'Inngående: POP-SSL';

$labels['recommended'] = 'anbefalt';
$labels['port'] = 'Port';
$labels['and'] = 'og';

$labels['authrequired'] = 'Autentisering påkrevd';
$labels['spaauthsupported'] = 'Støtte for SPA-passordkryptering';

// %s will be excanged with the appropiate "SMTP after *" below
$labels['openrelaylocal'] = 'Sending tillatt når du er på samme nettverk som server';
$labels['authrequired_local'] = 'Autentisering påkrevd, bortsett fra når du er på samme nettverk som server';
$labels['authrequired_local_smtpafter'] = 'Autentisering eller %s påkrevd, bortsett fra når du er på samme nettverk som server';
$labels['authrequired_smtpafter'] = 'Autentisering eller %s påkrevd';

// "SMTP after *" are to some extent known technical terminologies.
// For some languages it will probably be correct to not translate "after"
$labels['smtpafterpop'] = 'SMTP etter POP';
$labels['smtpafterimap'] = 'SMTP etter IMAP';
$labels['smtpafterpopimap'] = 'SMTP etter POP/IMAP';


?>