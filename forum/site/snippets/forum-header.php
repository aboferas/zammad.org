<div class="header hasSubnav">
  <div class="wrapper">
    <h1><a href="<?= url() ?>"><?= $site->title() ?></a></h1>
    <div class="subtitle"><?= $page->subtitle()->kirbytext() ?></div>
  </div>
  <? snippet('forum-subnav') ?>
</div>