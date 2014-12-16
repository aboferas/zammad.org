<?php

if(!defined('DS')) define('DS', DIRECTORY_SEPARATOR);

// load the cms bootstrapper
include(__DIR__ . DS . 'kirby' . DS . 'bootstrap.php');

load(array(

  // libs
  'twitteroauth'      => __DIR__ . DS . 'lib' . DS . 'twitteroauth.php',
  'forumuser'         => __DIR__ . DS . 'lib' . DS . 'forumuser.php',

  // models
  'reply'             => __DIR__ . DS . 'models' . DS . 'reply.php',
  'topic'             => __DIR__ . DS . 'models' . DS . 'topic.php',
  'index'             => __DIR__ . DS . 'models' . DS . 'index.php',

  // controllers
  'authcontroller'    => __DIR__ . DS . 'controllers' . DS . 'auth.php',
  'searchcontroller'  => __DIR__ . DS . 'controllers' . DS . 'search.php',
  'userscontroller'   => __DIR__ . DS . 'controllers' . DS . 'users.php',
  'topicscontroller'  => __DIR__ . DS . 'controllers' . DS . 'topics.php',
  'repliescontroller' => __DIR__ . DS . 'controllers' . DS . 'replies.php',
  'indexcontroller'   => __DIR__ . DS . 'controllers' . DS . 'index.php',

));

// load the forum class
require_once(__DIR__ . DS . 'forum.php');

// html cleaner
require_once(__DIR__ . DS . 'lib' . DS . 'htmlawed.php');

// load the helpers
require_once(__DIR__ . DS . 'helpers.php');

