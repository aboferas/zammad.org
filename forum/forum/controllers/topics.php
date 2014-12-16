<?php

class TopicsController {

  static public function create($lang, $thread) {

    // don't let unauthenticated users visit this page
    if(!site()->user()) go('error');

    $thread = page($lang .'/'. $thread);
    $alert  = null;

    if(!$thread) go('error');

    // create an empty topic mock to make the form fallback nicely
    $topic = new Obj(array('title' => null, 'text' => null));

    // submit the form
    if(get('submit')) {

      try {

        $topic = topic::create($thread, array(
          'title' => get('title'),
          'text'  => get('text'),
          'date'  => date('Y-m-d H:i:s'),
          'user'  => site()->user()->username()
        ));

        if(!$topic) throw new Exception('The topic could not be created');

        go($topic->url());

      } catch(Exception $e) {
        $alert = $e->getMessage();
      }

    }

    return array('topic/create', array(
      'thread' => $thread,
      'lang'   => $lang,
      'topic'  => $topic,
      'alert'  => $alert
    ));

  }

  static public function show($lang, $thread, $day, $topic) {

    $uri   = $lang . '/' . $thread . '/' . $day . '/' . $topic;
    $page  = site()->visit($uri);
    $users = array();
    $alert = null;

    if(!$page or $page->template() != 'topic') return $page;

    foreach($page->children()->pluck('user') as $user) {
      $users[$user->username()] = array(
        'name'    => $user->avatar() ? $user->avatar()->url() : url('assets/images/avatar.png'),
        'content' => $user->username(),
      );
    }

    $users = array_values($users);

    if(get('submit') and site()->user()) {

      try {

        $reply = reply::create($page, array(
          'date' => date('Y-m-d H:i:s'),
          'user' => site()->user()->username(),
          'text' => get('reply')
        ));

        go($page->url() . '/#' . $reply->uid());

      } catch(Exception $e) {
        $alert = $e->getMessage();
      }

    }

    return array($uri, array(
      'users' => $users,
      'alert' => $alert
    ));

  }

  static public function edit($lang, $thread, $day, $topic) {

    site()->visit('edit');

    $uri   = $lang .'/'. $thread . '/' . $day . '/' . $topic;
    $topic = page($uri);
    $alert = null;

    // check for a valid topic
    if(!$topic) go('error');

    // check for permissions
    if(!site()->user() or !site()->user()->may('edit', $topic)) go('error');

    // submit the form
    if(get('submit')) {

      try {

        topic::update($topic, array(
          'title' => get('title'),
          'text'  => get('text')
        ));

        forum::notification('The topic has been updated');

        go($topic->url());

      } catch(Exception $e) {
        $alert = $e->getMessage();
      }

    }

    return array('topic/edit', array(
      'topic' => $topic,
      'alert' => $alert
    ));

  }

  static public function delete($id) {

    try {

      $topic  = topic::byURI(base64_decode($id));
      $thread = $topic->parent()->parent();

      // check for access for the current user
      if(!static::hasAccess('edit', $topic)) go('error');

      // delete the topic…
      topic::delete($topic);

      // send a notification
      forum::notification('The topic has been deleted');

      // …and go back to the thread
      go($thread->url());

    } catch(Exception $e) {
      die($e->getMessage());
    }

  }

  static public function solve($id) {

    try {

      // get the topic by encoded id
      $topic = topic::byURI(base64_decode($id));

      // check for access for the current user
      if(!static::hasAccess('edit', $topic)) go('error');

      // solve the topic
      topic::solve($topic);

      // go back to the topic page
      go($topic->url());

    } catch(Exception $e) {
      die($e->getMessage());
    }

  }

  static public function unsolve($id) {

    try {

      // get the topic by encoded id
      $topic = topic::byURI(base64_decode($id));

      // check for access for the current user
      if(!static::hasAccess('edit', $topic)) go('error');

      // solve the topic
      topic::unsolve($topic);

      // go back to the topic page
      go($topic->url());

    } catch(Exception $e) {
      die($e->getMessage());
    }

  }

  static protected function hasAccess($task, $item) {

    if($user = site()->user() and $user->may($task, $item)) {
      return true;
    } else {
      return false;
    }

  }

}