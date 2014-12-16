<?php

class IndexController {

  static public function update($token) {

    if($token !== c::get('forum.token')) go('error');

    $items = index::update();

    forum::notification($items . ' items have been added to the index');

    go();

  }

}