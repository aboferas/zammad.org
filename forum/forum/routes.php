<?php

return array(

  // user profiles
  array(
    'pattern' => 'user/(:any?)',
    'action'  => function($username) {
      return userscontroller::show($username);
    }
  ),

  // login
  array(
    'pattern' => 'login',
    'action'  => function() {
      return authcontroller::login();
    }
  ),

  // logout
  array(
    'pattern' => 'logout',
    'action'  => function() {
      return authcontroller::logout();
    }
  ),

  // search
  array(
    'pattern' => 'search',
    'method'  => 'GET|POST',
    'action'  => function() {
      return searchcontroller::search();
    }
  ),

  // topic::create
  array(
    'pattern' => '(:any)/(:any)/create',
    'method'  => 'GET|POST',
    'action'  => function($lang, $thread) {
      return topicscontroller::create($lang, $thread);
    }
  ),

  // topic::day
  array(
    'pattern' => '(:any)/(:any)/(:num)',
    'method'  => 'GET',
    'action'  => function($lang, $thread, $day) {
      $uri  = $lang . '/'. $thread . '/' . $day;
      $page = page($uri);

      // check for invalid urls
      if(!$page) go('error');

      // check for invalid templates
      if($page->intendedTemplate() != 'day') return $page;

      // redirect to the thread page
      go($page->parent()->url());

    }
  ),

  // topic::show
  array(
    'pattern' => '(:any)/(:any)/(:num)/(:any)',
    'method'  => 'GET|POST',
    'action'  => function($lang, $thread, $day, $topic) {
      return topicscontroller::show($lang, $thread, $day, $topic);
    }
  ),

  // topic::edit
  array(
    'pattern' => '(:any)/(:any)/(:num)/(:any)/edit',
    'method'  => 'GET|POST',
    'action'  => function($lang, $thread, $day, $topic) {
      return topicscontroller::edit($lang, $thread, $day, $topic);
    }
  ),

  // topic::delete
  array(
    'pattern' => 'api/topic/(:any)/delete',
    'action'  => function($id) {
      return topicscontroller::delete($id);
    }
  ),

  // topic::solve
  array(
    'pattern' => 'api/topic/(:any)/solve',
    'action'  => function($id) {
      return topicscontroller::solve($id);
    }
  ),

  // topic::unsolve
  array(
    'pattern' => 'api/topic/(:any)/unsolve',
    'action'  => function($id) {
      return topicscontroller::unsolve($id);
    }
  ),

  // reply::edit
  array(
    'pattern' => '(:any)/(:any)/(:num)/(:any)/(:num)',
    'method'  => 'GET|POST',
    'action'  => function($lang, $thread, $day, $topic, $reply) {
      return repliescontroller::edit($lang, $thread, $day, $topic, $reply);
    }
  ),

  // reply::delete
  array(
    'pattern' => 'api/reply/(:any)/delete',
    'action'  => function($id) {
      return repliescontroller::delete($id);
    }
  ),

  // index::update
  array(
    'pattern' => 'api/index/update/(:any)',
    'action'  => function($token) {
      return indexcontroller::update($token);
    }
  ),

);