<? snippet('header') ?>

<div class="header">
  <div class="wrapper">
    <h1><?= $page->header() != '' ? $page->header() : $page->title() ?></h1>
    <div class="subtitle"><?= $page->subtitle()->kirbytext() ?></div>
  </div>
</div>
<div class="wrapper">
  <main>
    <div class="source">
    <?= $page->source()->kirbytext() ?>
    </div>
    <?= $page->text()->kirbytext() ?>
  </main>
</div>

<? snippet('footer') ?>