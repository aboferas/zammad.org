<!DOCTYPE html>
<html lang="en" class="<?= $page->uid() ?>">

<meta charset="utf-8">
<link rel="shortcut icon" href="<?= url($site->homepage()->url().'/../assets/images/favicon.ico') ?>">

<title><?= $site->title()->html() ?> | <?= $page->title()->html() ?></title>
<meta name="description" content="<?= $site->description()->html() ?>">
<meta name="keywords" content="<?= $site->keywords()->html() ?>">

<?= css('assets/css/jquery.atwho.css') ?>
<link rel="stylesheet" href="<?= $site->homepage()->url() ?>/../assets/css/prism.css" />
<link rel="stylesheet" href="<?= $site->homepage()->url() ?>/../assets/css/main.css" />

<?= html::shiv() ?>

<header class="clearfix" role="banner">
  <div class="wrapper">
    <a class="logo" href="<?= $site->homepage()->url() ?>/../">
      <img src="<?= $site->homepage()->url() ?>/../assets/images/zammad community logo.svg" alt="Zammad Community" />
    </a>
    <nav role="navigation">
      <a href="<?= $site->homepage()->url() ?>/../">Home &amp; Downlod</a>
      <a href="<?= $site->homepage()->url() ?>/../screenshots">Screenshots</a>
      <a href="<?= $site->homepage()->url() ?>/../news">News</a>
      <a href="<?= $site->homepage()->url() ?>/../participate">Be part of it!</a>
      <a class="active" href="<?= $site->homepage()->url() ?>/../forums">Forum</a>
      <a href="<?= $site->homepage()->url() ?>/../documentation">Documentation</a>
    </nav>
  </div>
</header>
<!--[if lte IE 9]>
<div class="browserupdate">
  You are using an obsolete browser which can harm your experience and cause security trouble. Please <a href="http://browsehappy.com/" target="_blank">update your browser!</a>
</div>
<![endif]-->