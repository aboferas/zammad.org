<!DOCTYPE html>
<html lang="en" class="<?= $page->uid() ?>">

<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">

<title><?= $site->title()->html() ?> | <?= $page->title()->html() ?></title>
<meta name="description" content="<?= $site->description()->html() ?>">
<meta name="keywords" content="<?= $site->keywords()->html() ?>">

<?= css('assets/css/main.css') ?>
<?= css('assets/css/highlight.css') ?>

<header class="clearfix" role="banner">
  <div class="wrapper">
    <a class="logo" href="<?= url() ?>">
      <img src="<?= url('assets/images/zammad community logo.svg') ?>" alt="<?= $site->title()->html() ?>" />
    </a>
    <? snippet('menu') ?>
  </div>
</header>