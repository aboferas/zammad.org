<?php

class SearchController {

  static public function search() {

    $page = site()->visit('search');

    if(get('q')) {
      $items = index::search(get('q'), param('page'), 20);
    } else {
      $items = new Collection();
    }

    return array('search', array(
      'items'      => $items,
      'pagination' => $items->pagination(),
    ));

  }

}