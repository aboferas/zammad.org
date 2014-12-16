<?php

class UsersController {

  static public function show($username) {

    site()->visit('user');

    // get the user
    $user = site()->user($username);

    if(!$user) go('error');

    $items = index::byUsername($username, param('page'), 25);

    return array('user', array(
      'user'       => $user,
      'username'   => $username,
      'items'      => $items,
      'pagination' => $items->pagination()
    ));

  }

}