<?php

class Index {

  static protected function table() {
    return forum()->database()->table('items')->fail(true);
  }

  static public function create($data) {

    try {
      return static::table()->insert(array(
        'title'   => (string)$data->title(),
        'date'    => (string)$data->date(),
        'content' => (string)$data->text(),
        'user'    => (string)$data->user(),
        'uri'     => $data->uri(),
        'type'    => $data->type()
      ));
    } catch(Exception $e) {
      return false;
    }

  }

  static public function update($data = null) {

    // update the entire index
    if(is_null($data)) {

      // kill the database first
      f::remove(site()->files()->find('index.sqlite')->root());

      static::init();

      // an error array
      $errors  = array();
      $counter = 0;

      foreach(site()->children()->visible() as $thread) {

        foreach($thread->children()->children() as $topic) {

          index::create($topic);
          $counter++;

          foreach($topic->children() as $reply) {

            index::create($reply);
            $counter++;

          }

        }

      }

      return $counter;

    } else {

      try {
        return static::table()->where(array(
          'type' => $data->type(),
          'uri'  => $data->uri()
        ))->update(array(
          'title'   => (string)$data->title(),
          'content' => (string)$data->text(),
        ));
      } catch(Exception $e) {
        return false;
      }

    }

  }

  static public function delete($data) {

    try {
      return static::table()->where(array(
        'type' => $data->type(),
        'uri'  => $data->uri()
      ))->delete();
    } catch(Exception $e) {
      return false;
    }

  }

  static public function byUsername($username, $page, $limit) {

    $items = array();
    $index = static::table()->where('user', '=', $username)
                            ->order('date desc')
                            ->page($page, $limit);

    return static::map($index);

  }

  static protected function map($index) {

    foreach($index->data as $key => $item) {
      $page = page($item->uri());

      if($page) {
        $index->data[$key] = $page;
      } else {
        unset($index->data[$key]);
      }

    }

    return $index;

  }

  static public function search($query, $page, $limit) {

    $stopwords    = array();
    $searchwords  = preg_replace('/[^\pL]/u',',', preg_quote($query));
    $searchwords  = str::split($searchwords, ',', 2);
    $searchwords  = array_diff($searchwords, $stopwords);
    $searchfields = array('title', 'content');
    $table        = static::table();

    foreach($searchwords as $searchword) {
      $table->orWhere(function($query) use($searchword, $searchfields) {
        foreach($searchfields as $searchfield) {
          $query->orWhere($searchfield, 'LIKE', '%' . $searchword . '%');
        }
      });
    }

    try {
      $result = $table->order('date desc')->page($page, $limit);
      return static::map($result);
    } catch(Exception $e) {
      return new Collection();
    }

  }

  static public function init() {

    forum()->database()->createTable('items', array(
      'id' => array(
        'type' => 'id'
      ),
      'title' => array(
        'type' => 'text'
      ),
      'content' => array(
        'type' => 'text',
      ),
      'user' => array(
        'type' => 'text',
      ),
      'uri' => array(
        'type' => 'text',
      ),
      'type' => array(
        'type' => 'text',
      ),
      'date' => array(
        'type' => 'timestamp',
      )
    ));

  }

}