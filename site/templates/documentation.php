<? snippet('header') ?>
<? $documentation = $pages->find('documentation') ?>

<div class="header">
  <div class="wrapper">
    <h1><?= $documentation->header() != '' ? $documentation->header() : $documentation->title() ?></h1>
    <div class="subtitle"><?= $documentation->subtitle()->kirbytext() ?></div>
  </div>
</div>
<div class="wrapper wrapper--sidebar">
  <div class="sidebar">
    <nav>
    <? foreach($documentation->children()->visible() as $category): ?>
      <div class="label"><?= $category->title()->html() ?></div>
      <? foreach($category->children()->visible() as $entry): ?>
        <a <? e($entry->isOpen(), ' class="active"') ?> href="<?= $entry->url() ?>"><?= $entry->title()->html() ?></a>
      <? endforeach ?>
    <? endforeach ?>
    </nav>
  </div>
  <article>
    <h2><?= $page->title()->html() ?></h2>
    <?= $page->text()->kirbytext() ?>
  </article>
</div>

<? snippet('footer') ?>