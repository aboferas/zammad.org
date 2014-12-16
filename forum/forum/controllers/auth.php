<?php

class AuthController {

  static public function login() {

    $alert = null;

    // logout the current user first
    if($user = site()->user()) $user->logout();

    try {
      user::authenticate(get(), param('status'));
    } catch(Exception $e) {
      $alert = $e->getMessage();
    }

    return array('login', array(
      'alert' => $alert
    ));

  }

  static public function logout() {

    if($user = site()->user()) {
      $user->logout();
      go();
    }

  }

}