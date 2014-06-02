/* Show user-info plugin script */

if (window.rcmail) {
  rcmail.addEventListener('init', function(evt) {
    // <span id="settingstabdefault" class="tablink"><roundcube:button command="preferences" type="link" label="preferences" title="editpreferences" /></span>
    var tab = $('<span>').attr('id', 'settingstabpluginserverinfo').addClass('tablink');
    
    var button = $('<a>').attr('href', rcmail.env.comm_path+'&_action=plugin.serverinfo').html(rcmail.gettext('serverinfo', 'serverinfo')).appendTo(tab);
    button.bind('click', function(e){ return rcmail.command('plugin.serverinfo', this) });
    
    // add button and register command
    rcmail.add_element(tab, 'tabs');
    rcmail.register_command('plugin.serverinfo', function(){ rcmail.goto_url('plugin.serverinfo') }, true);
  })
}

