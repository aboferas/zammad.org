<?php

class Topic {

  static public function create($thread, $data = array()) {

    if(empty($data['title'])) throw new Exception('The title is missing');
    if(empty($data['text']))  throw new Exception('The text is missing');
    if(empty($data['date']))  throw new Exception('The date is missing');

    if(!v::max($data['title'], 140)) throw new Exception('The title is too long (max. 140 chars)');

    $ts = strtotime($data['date']);

    if(!$ts) throw new Exception('The date is invalid');

    $parentSlug = date('Ymd', $ts);
    $parentPage = $thread->children()->find($parentSlug);

    // if there's no page for the day yet, create it
    if(!$parentPage) {

      $parentPage = $thread->children()->create($parentSlug, 'day', array(
        'title' => date('Y-m-d', $ts)
      ));

      if(!$parentPage) throw new Exception('The day could not be saved');

    }

    $topicSlug = str::slug($data['title']);
    $topicNum  = date('Hi', $ts);
    $topicPage = $parentPage->children()->create($topicSlug, 'topic', array(
      'title'  => $data['title'],
      'date'   => $data['date'],
      'user'   => $data['user'],
      'solved' => 0,
      'text'   => $data['text']
    ));

    if(!$topicPage) throw new Exception('The topic could not be created');

    $topicPage->sort($topicNum);

    index::create($topicPage);

    return $topicPage;

  }

  static public function update($topic, $data = array()) {

    if(empty($data['title'])) throw new Exception('The title is missing');
    if(empty($data['text']))  throw new Exception('The text is missing');

    $topic->update(array(
      'title' => $data['title'],
      'text'  => $data['text']
    ));

    index::update($topic);

  }

  static public function byURI($uri) {

    $topic = page($uri);

    if(!$topic) throw new Exception('The topic could not be found');

    return $topic;

  }

  static public function delete($topic) {
    $topic->delete(true);
    index::delete($topic);
  }

  static public function solve($topic) {

    $topic->update(array(
      'solved' => 1
    ));

    return $topic;

  }

  static public function unsolve($topic) {

    $topic->update(array(
      'solved' => 0
    ));

    return $topic;

  }

}