<?php

$labels = array();

$labels['serverinfo'] = 'Server Info';
$labels['serverinformation'] = 'Server Information';

$labels['account'] = 'Account';
$labels['storagequota'] = 'Storage quota';
$labels['usedstorage'] = 'Used storage';

$labels['webmail'] = 'Webmail';
$labels['url'] = 'URL';
$labels['lastlogin'] = 'Last Login';
$labels['defaultidentity'] = 'Default Identity';
$labels['webmailsystem'] = 'Webmail system';

$labels['hostname'] = 'Hostname';
$labels['location'] = 'Server Location';

$labels['portnumbers'] = 'Port numbers';
$labels['portnumbersregular'] = 'regular connection to mail server';
$labels['smtp'] = 'Outgoing: SMTP';
$labels['imap'] = 'Incoming: IMAP';
$labels['pop'] = 'Incoming: POP';
$labels['portnumbersencrypted'] = 'encrypted connection to mail server';
$labels['smtp-ssl'] = 'Outgoing: SMTP-SSL';
$labels['imap-ssl'] = 'Incoming: IMAP-SSL';
$labels['pop-ssl'] = 'Incoming: POP-SSL';

$labels['recommended'] = 'recommended';
$labels['port'] = 'Port';
$labels['and'] = 'and';

$labels['authrequired'] = 'Authentication required';
$labels['spaauthsupported'] = 'SPA password encyption supported';

// %s will be excanged with the appropiate "SMTP after *" below
$labels['openrelaylocal'] = 'Permitted to send when on same network as server';
$labels['authrequired_local'] = 'Authentication required, except when on the same network as server';
$labels['authrequired_local_smtpafter'] = 'Authentication or %s required, except when on the same network as server';
$labels['authrequired_smtpafter'] = 'Authentication or %s required';

// "SMTP after *" are to some extent known technical terminologies.
// For some languages it will probably be correct to not translate "after"
$labels['smtpafterpop'] = 'SMTP after POP';
$labels['smtpafterimap'] = 'SMTP after IMAP';
$labels['smtpafterpopimap'] = 'SMTP after POP/IMAP';

?>