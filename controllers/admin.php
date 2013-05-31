<?php

function admin_usersAction () {
  global $smarty;
  
  $smarty->display('admin_users.tpl');
}


function admin_eventsAction () {
  global $smarty;
  
  $smarty->display('admin_events.tpl');
}
?>
