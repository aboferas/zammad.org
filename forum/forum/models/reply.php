<?php

class Reply {

  static public function create($topic, $data = array()) {

    if(empty($data['text']))  throw new Exception('The text is missing');
    if(empty($data['date']))  throw new Exception('The date is missing');

    $ts = strtotime($data['date']);

    if(!$ts) throw new Exception('The date is invalid');

    $replySlug = str::slug(date('YmdHis', $ts));
    $replyPage = $topic->children()->create($replySlug, 'reply', array(
      'date'   => $data['date'],
      'user'   => $data['user'],
      'text'   => $data['text']
    ));

    if(!$replyPage) throw new Exception('The reply could not be created');

    index::create($replyPage);

    return $replyPage;

  }

  static public function update($reply, $data = array()) {

    if(empty($data['text'])) throw new Exception('The text is missing');

    $reply->update(array(
      'text' => $data['text']
    ));

    index::update($reply);

  }

  static public function byURI($uri) {

    $reply = page($uri);

    if(!$reply) throw new Exception('The reply could not be found');

    return $reply;

  }

  static public function delete($reply) {
    $reply->delete();
    index::delete($reply);
  }

}