<?php

class Forum extends Kirby {

  public $database = null;

  public function __construct() {
    parent::__construct();
    $this->roots->index = dirname(__DIR__);
  }

  public function configure() {

    parent::configure();

    // Health Check
    if(!c::get('forum.twitter.key') or
       !c::get('forum.twitter.secret') or
       !c::get('forum.token') or
       !is_writable($this->roots()->accounts())) {
      require(__DIR__ . DS . 'installation.php');
      exit();
    }

    // Index Check
    if(!file_exists($this->roots()->content() . DS  . 'index.sqlite')) {
      if(!is_writable($this->roots()->content())) {
        die('The content directory must be writable');
      }
      // create the database
      index::init();
      go('api/index/update/' . c::get('forum.token'));
    }

  }

  public function branch() {
    return __DIR__ . DS . 'branch' . DS . 'forum.php';
  }

  public function extensions() {
    parent::extensions();
    require(__DIR__ . DS . 'extensions' . DS . 'methods.php');
  }

  static public function notification($notification = null) {

    if(is_null($notification)) {
      $notification = s::get('forum.notification');
      s::set('forum.notification', null);
      return $notification;
    } else {
      s::set('forum.notification', $notification);
    }

  }

  public function database() {

    if(!is_null($this->database)) return $this->database;

    // setup the database
    return $this->database = new Database(array(
      'type'     => 'sqlite',
      'database' => $this->roots()->content() . DS . 'index.sqlite'
    ));

  }

  public function routes($routes = array()) {
    return array_merge(require(__DIR__ . DS . 'routes.php'), parent::routes());
  }

}