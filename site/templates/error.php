<? snippet('header') ?>

<div class="header">
  <div class="wrapper">
    <h1><?= $page->title() ?></h1>
  </div>
</div>
<div class="wrapper">
  <main>
    <div class="error-image"></div>
    <?= $page->text()->kirbytext() ?>
  </main>
</div>

<? snippet('footer') ?>