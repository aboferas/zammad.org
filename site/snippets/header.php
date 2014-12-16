<!DOCTYPE html>
<html lang="en" class="<?= $page->uid() ?>">

<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<link rel="shortcut icon" href="<?= url('assets/images/favicon.ico') ?>">

<title><?= $site->title()->html() ?> | <?= $page->title()->html() ?></title>
<meta name="description" content="<?= $site->description()->html() ?>">
<meta name="keywords" content="<?= $site->keywords()->html() ?>">

<?= css('assets/css/prism.css') ?>
<?= css('assets/css/main.css') ?>

<?= html::shiv() ?>

<header class="clearfix" role="banner">
  <div class="wrapper">
    <a class="logo" href="<?= url() ?>">
      <img src="<?= url('assets/images/zammad community logo.svg') ?>" alt="<?= $site->title()->html() ?>" />
    </a>
    <? snippet('menu') ?>
  </div>
</header>
<!--[if lte IE 9]>
<div class="browserupdate">
  You are using an obsolete browser which can harm your experience and cause security trouble. Please <a href="http://browsehappy.com/" target="_blank">update your browser!</a>
</div>
<![endif]-->