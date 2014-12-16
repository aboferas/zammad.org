<?php

class User extends UserAbstract {

  public function __construct($username) {
    $this->username = str::lower($username);
  }

  public function url() {
    return url('user/' . $this->username());
  }

  public function twitter() {
    return 'https://twitter.com/' . $this->username();
  }

  public function fetchAvatar() {

    if(!$this->isCurrent()) false;

    $connection = new TwitterOAuth(
      c::get('forum.twitter.key'),
      c::get('forum.twitter.secret'),
      s::get('oauth_token'),
      s::get('oauth_token_secret')
    );

    $account = $connection->get('users/show', array('screen_name' => $this->username()));

    if(!empty($accounts->errors)) return false;

    // fetch the avatar url from the account info
    $avatar = $account->profile_image_url;

    if(!$avatar) return false;

    if($oldAvatar = $this->avatar()) {
      // remove the old avatar
      $oldAvatar->delete();
    }

    $avatar    = str_replace('_normal', '', $avatar);
    $extension = f::extension($avatar);
    $download  = @file_get_contents($avatar);

    if(!$download) return false;

    $file = kirby()->roots()->avatars() . DS . $this->username() . '.' . $extension;
    $file = rtrim($file, '.');

    f::write($file, $download);

    if(empty($extension)) {
      $mime = f::mime($file);
      $ext  = f::mimeToExtension($mime);
      f::move($file, $file . '.' . $ext);
    }

    return true;

  }

  public function isAdmin() {
    return in_array($this->username(), c::get('forum.users.admins', array()));
  }

  public function isOwner($item) {
    return $this->isAdmin() or $item->user()->is($this) ? true : false;
  }

  public function may($task, $item) {

    switch($task) {
      case 'edit':
        return $this->isOwner($item);
        break;
      case 'delete':

        // the admin may delete anything
        if($this->isAdmin()) return true;

        // if this is not the owner, go away
        if(!$this->isOwner($item)) return false;

        // topics can only be deleted if there are no replies
        if($item->type() == 'topic') {
          return !$item->hasChildren();
        // replies can only be deleted if there's no next reply
        } else if($item->type() == 'reply') {
          return !$item->next();
        }

        break;
      default:
        return false;
        break;
    }

  }

  static public function sanitize($data, $mode = 'insert') {
    return $data;
  }

  static public function validate($data = array(), $mode = 'insert') {

    if($mode == 'insert') {

      if(empty($data['username'])) {
        throw new Exception('Invalid username');
      }

    }

  }

  public function login($password = null) {

    $token = $this->generateToken();
    $key   = $this->generateKey($token);

    try {
      $this->update(array(
        'token' => $token
      ));
    } catch(Exception $e) {
      throw new Exception('The authentication token could not be stored.');
    }

    cookie::set('key', $key);
    return true;

  }

  static public function authenticate($request, $status) {

    // on callbacks
    if($status == 'callback') {

      // If the oauth_token is old redirect to the connect page.
      if(a::get($request, 'oauth_token') !== s::get('oauth_token')) {
        throw new Exception('Invalid token');
      }

      // Create TwitteroAuth object with app key/secret and token key/secret from default phase
      $connection = new TwitterOAuth(
        c::get('forum.twitter.key'),
        c::get('forum.twitter.secret'),
        s::get('oauth_token'),
        s::get('oauth_token_secret')
      );

      // Request access tokens from twitter
      $access = $connection->getAccessToken(a::get($request, 'oauth_verifier'));

      // If HTTP response is 200 continue otherwise send to connect page to retry
      if($connection->http_code != 200) {
        throw new Exception('Invalid callback');
      }

      // get the username
      $username = str::lower($access['screen_name']);

      if(in_array($username, c::get('forum.users.banned', array()))) {
        throw new Exception('Your account is banned');
      }

      s::set('oauth_token', $access['oauth_token']);
      s::set('oauth_token_secret', $access['oauth_token_secret']);

      // check for an existing user
      $user = site()->user($username);

      if(empty($user)) {
        // create a new user entry
        $user = User::create(array(
          'username' => $username,
          'added'    => date('Y-m-d H:i:s')
        ));
      }

      // try to login the user
      $user->login();

      // try to load the avatar
      if(!$user->avatar()) {
        $user->fetchAvatar();
      }

      // check for a valid redirect url to send to after everything went fine
      if(preg_match('!^' . preg_quote(url()) . '!i', a::get($request, 'redirect'))) {
        $redirect = urldecode(a::get($request, 'redirect'));
      } else {
        $redirect = url();
      }

      // go back to the forum homepage
      go($redirect);

    } else {

      // Build TwitterOAuth object with client credentials
      $connection = new TwitterOAuth(
        c::get('forum.twitter.key'),
        c::get('forum.twitter.secret')
      );

      // get the referer to maybe link back
      $referer = server::get('http_referer');

      if(preg_match('!^' . preg_quote(url()) . '!i', $referer)) {
        $redirect = '?redirect=' . urlencode($referer);
      } else {
        $redirect = false;
      }

      // Get temporary credentials and set the callback url
      $request = $connection->getRequestToken(url() . '/login/status:callback' . $redirect);

      // Save temporary credentials to session.
      s::set('oauth_token', $request['oauth_token']);
      s::set('oauth_token_secret', $request['oauth_token_secret']);

      // If last connection failed don't display authorization link.
      if($connection->http_code != 200) {
        throw new Exception('Could not connect to Twitter. Refresh the page or try again later.');
      }

      // go to twitter to authenticate
      go($connection->getAuthorizeURL(s::get('oauth_token')));

    }

  }

}