<?php
function is_logged_in()
{
  $ci = get_instance();
  if (!$ci->session->userdata('email')) {
    redirect('auth');
  } else {
    $role = $ci->session->userdata('id_user');
  }
}
