<?php

/**
 * ServerInfo
 *
 * Plugin that displays some basic server info.
 * It is also possible to add custom fields and use dynamic variables.
 *
 * @date 2009-11-06
 * @author Axel Sjostedt
 * @url http://axel.sjostedt.no/misc/dev/roundcube/
 * @licence GNU GPL
 */

class serverinfo extends rcube_plugin
{
	public $task = 'settings';

	function init()
	{
    	$rcmail = rcmail::get_instance();
		$this->add_texts('localization/', array('serverinfo'));
		$this->register_action('plugin.serverinfo', array($this, 'infostep'));
	    $this->include_script('serverinfo.js');
		$this->include_stylesheet('serverinfo.css');
	}
	
	private function _load_config()
	{
		
		$fpath_config_dist	= $this->home . '/config.inc.php.dist';
		$fpath_config 		= $this->home . '/config.inc.php';
		
		if (is_file($fpath_config_dist) and is_readable($fpath_config_dist))
			$found_config_dist = true;
		if (is_file($fpath_config) and is_readable($fpath_config))
			$found_config = true;
		
		if ($found_config_dist or $found_config) {
			ob_start();

			if ($found_config_dist) {
				include($fpath_config_dist);
				$serverinfo_config_dist = $serverinfo_config;
			}
			if ($found_config) {
				include($fpath_config);
			}
			
			$config_array = array_merge($serverinfo_config_dist, $serverinfo_config);
			$this->config = $config_array;
			ob_end_clean();
		} else {
			raise_error(array(
				'code' => 527,
				'type' => 'php',
				'message' => "Failed to load ServerInfo plugin config"), true, true);
		}
	} 

	function infostep()
	{
		
		$this->register_handler('plugin.body', array($this, 'infohtml'));
		
		$rcmail = rcmail::get_instance();
		$rcmail->output->set_pagetitle($this->gettext('serverinformation'));
	    $rcmail->output->send('plugin');
	
	}
  
	function infohtml()
	{
		
		global $table;
		
		$this->_load_config();
		$rcmail = rcmail::get_instance();
		$user = $rcmail->user;
		
		// Set commalist variables from config and language file
		if ($this->config['pn_newline']) {
			$pn_newline = true;
			$pn_parentheses = false;
		} else {
			$pn_newline = false;
			$pn_parentheses = true;
		}
	
		$table = new html_table(array('cols' => 2, 'cellpadding' => 0, 'cellspacing' => 0, 'class' => 'serverinfo'));

		// ----- Account start -----

		$table->add(array('colspan' => 2, 'class' => 'headerfirst'), $this->gettext('account'));
		$table->add_row();
	
		$table->add('title', Q($this->gettext('username')));
		$table->add('value', Q($user->data['username']));
		
		
		if ($this->config['enable_quota']) {
		
			// inialize IMAP to get quota info
			$rcmail->imap_init(true);
			$imap = $rcmail->imap;
		
			$quota = $imap->get_quota();
			
			// If we found quota nfo, add table rows
			if (quota) {
				$quotatotal = show_bytes($quota['total'] * 1024);
				$quotaused = show_bytes($quota['used'] * 1024) . ' (' . $quota['percent'] . '%)';

				if ($quota && ($quota['total']==0 && $rcmail->config->get('quota_zero_as_unlimited'))) {
					$quotatotal = 'unlimited';
				}
				
				$table->add('title', Q($this->gettext('storagequota')));
				$table->add('value', $quotatotal);
				
				$table->add('title', Q($this->gettext('usedstorage')));
				$table->add('value', $quotaused);

			}
		
		}
		
		// Add custom fields
		$this->_custom_fields('customfields_account');

		// ----- Webmail start -----

		$table->add(array('colspan' => 2, 'class' => 'header'), $this->gettext('webmail'));
		$table->add_row();
		
		if (!empty($this->config['webmail_url'])) {
	
			$table->add('title', Q($this->gettext('url')));
			$table->add('value', $this->_host_replace($this->config['webmail_url']));
		}
	
		if ($this->config['display_lastlogin']) {
			$table->add('title', Q($this->gettext('lastlogin')));
			$table->add('value', Q($user->data['last_login']));
		}
		
		$identity = $user->get_identity();
		$table->add('title', Q($this->gettext('defaultidentity')));
		$table->add('value', Q($identity['name'] . ' <' . $identity['email'] . '>'));

		// Add custom fields
		$this->_custom_fields('customfields_webmail');

		// ----- Server start -----

		$table->add(array('colspan' => 2, 'class' => 'header'), $this->gettext('server'));
		$table->add_row();

		if (!empty($this->config['location'])) {
			$table->add('title', Q($this->gettext('location')));
			$table->add('value', $this->config['location']);
		}

		if (!empty($this->config['hostname'])) {
			$table->add('title', Q($this->gettext('hostname')));
			$table->add('value', $this->_host_replace($this->config['hostname']));
		}

		if (!empty($this->config['hostname_smtp'])) {
			$table->add('title', Q($this->gettext('smtp')));
			$table->add('value', $this->_host_replace($this->config['hostname_smtp']));
		}
		
		if (!empty($this->config['hostname_imap'])) {
			$table->add('title', Q($this->gettext('imap')));
			$table->add('value', $this->_host_replace($this->config['hostname_imap']));
		}
		
		if (!empty($this->config['hostname_pop'])) {
			$table->add('title', Q($this->gettext('pop')));
			$table->add('value', $this->_host_replace($this->config['hostname_pop']));
		}
		
		// Add custom fields
		$this->_custom_fields('customfields_server');
		
		// Port numbers - initial checking and generating of detailed information
		
		if ($this->config['spa_support_smtp'] and $this->config['spa_support_imap'] and $this->config['spa_support_pop']) {
		// SPA supported on all three protocols. We set this variable and will use it later to print the info on a row.
			$spa_all = true;
		} else {
		// SPA not supported on all three protocols. Instead of printing on a row we append to each supportet protocol
			if ($this->config['spa_support_smtp'])
				$smtp_notes_array_regularonly[] = $this->gettext('spaauthsupported');
			if ($this->config['spa_support_imap'])
				$imap_notes_regular = ' (' . $this->gettext('spaauthsupported') . ')';
			if ($this->config['spa_support_pop'])
				$pop_notes_regular = ' (' . $this->gettext('spaauthsupported') . ')';
		} 
		

		if ($this->config['smtp_auth_required_always']) {
			$smtp_notes_array_all[] = $this->gettext('authrequired');
		} else {
		// SMTP auth is not always enabled, we have to print something based on
		// the next config settings
		
			// Set the correct "SMTP after *" based on conf combination
			if ($this->config['smtp_after_pop'] and !$this->config['smtp_after_imap'])
				$smtp_after_text = $this->gettext('smtpafterpop');
			elseif (!$this->config['smtp_after_pop'] and $this->config['smtp_after_imap'])
				$smtp_after_text = $this->gettext('smtpafterimap');
			elseif ($this->config['smtp_after_pop'] and $this->config['smtp_after_imap'])
				$smtp_after_text = $this->gettext('smtpafterpopimap');
		
			if ($this->config['smtp_auth_required_else']) {
			// If SMTP auth is required unless something
				if ($this->config['smtp_relay_local'] and !$this->config['smtp_after_pop'] and !$this->config['smtp_after_imap']) {
					$smtp_notes_array_all[] = $this->gettext('authrequired_local');
				} else if ($this->config['smtp_relay_local'] and ($this->config['smtp_after_pop'] || !$this->config['smtp_after_imap'])) {
					$smtp_notes_array_all[] = str_replace("%s", $smtp_after_text, $this->gettext('authrequired_local_smtpafter'));
				} else if (!$this->config['smtp_relay_local'] and ($this->config['smtp_after_pop'] || !$this->config['smtp_after_imap'])) {
					$smtp_notes_array_all[] = str_replace("%s", $smtp_after_text, $this->gettext('authrequired_smtpafter'));
				}
			} else {
			// If SMTP auth is not required, but some other infp may be given
				if ($this->config['smtp_relay_local'])
					$smtp_notes_array_all[] = $this->gettext('openrelaylocal');
				if ($smtp_after_text)
					$smtp_notes_array_all[] = $smtp_after_text;
			}			
		}
		
		// We summarize the correct arrays
		$smtp_notes_array_regular = array_merge((array)$smtp_notes_array_all, (array)$smtp_notes_array_regularonly);
		$smtp_notes_array_encrypted = array_merge((array)$smtp_notes_array_all, (array)$smtp_notes_array_encryptedonly);
		
		// If we have some info in the SMTP information arrays, make them ready for printing
		if (!empty($smtp_notes_array_regular))
			$smtp_notes_regular = ucfirst($this->_separated_list($smtp_notes_array_regular, $and = false, $sentences = true, $commalist_ucfirst, $pn_parentheses, $pn_newline));
		if (!empty($smtp_notes_array_regular))
			$smtp_notes_encrypted = ucfirst($this->_separated_list($smtp_notes_array_encrypted, $and = false, $sentences = true, $commalist_ucfirst, $pn_parentheses, $pn_newline));
			
		
		// Port numbers - regular
		
		if (!empty($this->config['port_smtp']) or !empty($this->config['port_imap']) or !empty($this->config['port_pop']) or count($this->config['customfields_regularports']) > 0) {
		
			$table->add(array('colspan' => 2, 'class' => 'header'), $this->gettext('portnumbers') . ' - ' . $this->gettext('portnumbersregular'));
			$table->add_row();
			
			if ($spa_all) {	
			// SPA supported for all three protocols. We print it on a row.
				$table->add(array('colspan' => 2, 'class' => 'categorynote'), ucfirst($this->gettext('spaauthsupported')));
				$table->add_row();
			}
			
			if (!empty($this->config['port_smtp'])) {
				$table->add('title', Q($this->gettext('smtp')));
				$table->add('value', $this->gettext('port') . ' ' . $this->_separated_list($this->config['port_smtp'], $and = true) . $smtp_notes_regular);
			}
		
			if (!empty($this->config['port_imap'])) {
				$table->add('title', Q($this->gettext('imap')));
				$table->add('value', $this->gettext('port') . ' ' . $this->_separated_list($this->config['port_imap'], $and = true) . $imap_notes_regular);
			}
		
			if (!empty($this->config['port_pop'])) {
				$table->add('title', Q($this->gettext('pop')));
				$table->add('value', $this->gettext('port') . ' ' . $this->_separated_list($this->config['port_pop'], $and = true) . $pop_notes_regular);
			}
		
			// Add custom fields
			$this->_custom_fields('customfields_regularports');
		
		}
		
		// Port numbers - encrypted
		
		if (!empty($this->config['port_smtp-ssl']) or !empty($this->config['port_imap-ssl']) or !empty($this->config['port_pop-ssl']) or count($this->config['customfields_encryptedports']) > 0) {

			$portnumbers_regular_header =  $this->gettext('portnumbers') . ' - ' . $this->gettext('portnumbersencrypted');
			if ($this->config['recommendssl'])
				$portnumbers_regular_header .= ' (' . $this->gettext('recommended') . ')';

			$table->add(array('colspan' => 2, 'class' => 'header'), $portnumbers_regular_header);
			$table->add_row();
			
			if (!empty($this->config['port_smtp-ssl'])) {
				$table->add('title', Q($this->gettext('smtp-ssl')));
				$table->add('value', $this->gettext('port') . ' ' . $this->_separated_list($this->config['port_smtp-ssl'], $and = true) . $smtp_notes_encrypted);
			}
		
			if (!empty($this->config['port_imap-ssl'])) {
				$table->add('title', Q($this->gettext('imap-ssl')));
				$table->add('value', $this->gettext('port') . ' ' . $this->_separated_list($this->config['port_imap-ssl'], $and = true) . $imap_notes_encrypted);
			}
		
			if (!empty($this->config['port_pop-ssl'])) {
				$table->add('title', Q($this->gettext('pop-ssl')));
				$table->add('value', $this->gettext('port') . ' ' . $this->_separated_list($this->config['port_pop-ssl'], $and = true) . $pop_notes_encrypted);
			}

			// Add custom fields
			$this->_custom_fields('customfields_encryptedports');
			
		}
		
		// Add custom fields
		$this->_custom_fields('customfields_bottom');
	
		$out = html::div(array('class' => 'settingsbox settingsbox-serverinfo'), html::div(array('class' => 'boxtitle'), $this->gettext('serverinformation')) . html::div(array('class' => 'boxcontent'), $table->show()));

		if ($this->config['enable_custombox']) {
			
			$out .= html::div(array('class' => 'settingsbox settingsbox-serverinfo-custom'), html::div(array('class' => 'boxtitle'), $this->config['custombox_header']) . html::div(array('class' => 'boxcontent'), $this->_print_file_contents($this->config['custombox_file'])));
		}

		return $out;
		
	}
	

	private function _custom_fields($arrayname)
	{
	// Add custom fields from a defines array name
		
	global $table;
	
	if (count($this->config[$arrayname]) > 0) {
			
			foreach ($this->config[$arrayname] as $key => $arrayvalue) {
				
				$coltype = $arrayvalue['type'];
				$coltext = $arrayvalue['text'];
				
			    if ($coltype == 'header' or $coltype == 'wholeline') {
					$table->add(array('colspan' => 2, 'class' => $coltype), $coltext);
					$table->add_row();
				} elseif ($coltype == 'title' or $coltype == 'value') {
					$table->add($coltype, $coltext);
				}
				
				$coltype = '';
				$coltext = '';
				
			}
		}
		
		return false;
	}
	
	
	private function _separated_list($array, $and = false, $sentences = false, $ucfirst = false, $parentheses = false, $newline = false)
	{
	// Return array as a separated list
		$str = '';
		$size = count($array);
		$i = 0;
		if ($sentences)
			$separator = ". ";
		else
			$separator = ", ";
		
		if ($parentheses and $newline)
			$str .= '<span class="fieldnote-parentheses fieldnote-newline">(';
		elseif ($parentheses)
			$str .= '<span class="fieldnote-parentheses"> (';
		elseif ($newline)
			$str .= '<span class="fieldnote-newline">';
		
		
		foreach ($array as $item) {
			if ($i == 0 and $ucfirst)
				$item = ucfirst($item);
			$str .= $item;
			$i++;
			if ($i < $size-1)
				$str .= $separator;
			elseif ($i == $size-1) {
				// final separator, and or comma?
				if ($and)
					$str .= ' ' . $this->gettext('and') . ' ';
				else 
					$str .= $separator;
				
			}
			if ($i == $size and $sentences and count($array) > 1)
				$str .= '.';
		}
		
		if ($parentheses and $newline)
			$str .= ')</span>';
		elseif ($parentheses)
			$str .= ')</span>';
		elseif ($newline)
			$str .= '</span>';
		
		return $str;
	}
	
	private function _print_file_contents($filename)
	{
	// Return contents of a file
	
	$filename = $filename;
	
		if (is_file($filename) and is_readable($filename)) {
			$handle = fopen($filename, "r");
			$contents = fread($handle, filesize($filename));
			fclose($handle);
			return $contents;
			/*include*/
		} else {
			return 'Could not output file ' . $filename;
		}
	}
	
	private function _host_replace($host) {
	// Does some replacements in a host string

		$rcmail = rcmail::get_instance();
		$user = $rcmail->user;

		$host = str_replace('%h', $user->data['mail_host'], $host);
		$host = str_replace('%s', $_SERVER['SERVER_NAME'], $host);

		if(empty($_SERVER['HTTPS']))
			$protocol = 'http';
		else 
			$protocol = 'https';	
		$host = str_replace('%p', $protocol, $host);
		
		$stripped_h_array = explode('.', $user->data['mail_host']);
		array_shift($stripped_h_array);
		$stripped_s_array = explode('.', $_SERVER['SERVER_NAME']);
		array_shift($stripped_s_array);
		$stripped_h = implode('.', $stripped_h_array);
		$stripped_s = implode('.', $stripped_s_array);
		$host = str_replace('%H', $stripped_h, $host);
		$host = str_replace('%S', $stripped_s, $host);
		
		return $host;
		
	}

}