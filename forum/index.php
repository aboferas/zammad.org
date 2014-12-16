<?php

define('DS', DIRECTORY_SEPARATOR);

// load the cms bootstrapper
include(__DIR__ . DS . 'forum' . DS . 'bootstrap.php');

$forum = forum();
$forum->roots->parent = new Obj();
$forum->roots->parent->index     = dirname(__DIR__);
$forum->roots->parent->site      = $forum->roots->parent->index . DS . 'site';
$forum->roots->parent->snippets  = $forum->roots->parent->site  . DS . 'snippets';
$forum->roots->parent->templates = $forum->roots->parent->site  . DS . 'templates';

// start the cms
echo $forum->launch();