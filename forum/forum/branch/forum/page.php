<?php

class Page extends PageAbstract {

  /**
   * Fetch the related user object
   * if the page has a user: field with the username
   */
  public function user() {

    $username = (string)$this->content()->get('user');

    if(empty($username)) return null;

    return $this->site->user($username);

  }

  public function url() {

    $task = a::first((array)func_get_args());
    $apid = $this->apid();

    $registry = array(
      'topic' => array(
        'solve'   => 'api/topic/' . $apid . '/solve',
        'unsolve' => 'api/topic/' . $apid . '/unsolve',
        'delete'  => 'api/topic/' . $apid . '/delete',
        'edit'    => $this->uri() . '/edit',
      ),
      'reply' => array(
        'delete' => 'api/reply/' . $apid . '/delete',
        'edit'   => '',
      )
    );

    if(!is_null($task)) {
      if($url = @$registry[$this->intendedTemplate()][$task]) {
        return url($url);
      }
    }

    return parent::url();

  }

  public function isSolved() {
    if($this->template() != 'topic') return false;
    return $this->solved() == '1' ? true : false;
  }

  public function apid() {
    return base64_encode($this->uri());
  }

  public function type() {
    return $this->intendedTemplate();
  }

}