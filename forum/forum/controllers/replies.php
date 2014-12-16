<?php

class RepliesController {

  static public function edit($lang, $thread, $day, $topic, $reply) {

    $uri   = $lang .'/'. $thread . '/' . $day . '/' . $topic . '/' . $reply;
    $page  = page($uri);
    $alert = null;

    // check for a valid page object
    if(!$page or $page->template() != 'reply') return $page;

    // check for access
    if(!site()->user() or !site()->user()->may('edit', $page)) go('error');

    // if the reply form has been submitted
    if(get('submit')) {

      try {

        reply::update($page, array(
          'date' => date('Y-m-d H:i:s'),
          'user' => site()->user()->username(),
          'text' => get('reply')
        ));

        forum::notification('The reply has been updated');

        go($page->parent()->url() . '/#' . $page->uid());

      } catch(Exception $e) {
        $alert = $e->getMessage();
      }

    }

    return array($uri, array(
      'alert' => $alert
    ));

  }

  static public function delete($id) {

    try {

      $reply = reply::byURI(base64_decode($id));
      $topic = $reply->parent();

      // check for access for the current user
      if(!static::hasAccess('delete', $reply)) go('error');

      // delete the topic…
      reply::delete($reply);

      // send a notification
      forum::notification('The reply has been deleted');

      // …and go back to the thread
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