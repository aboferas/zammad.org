<? snippet('header') ?>

<div class="header">
  <div class="wrapper">
    <h1><?= $page->title() ?></h1>
    <div class="post-meta">
      <?= $page->date('M d, Y') ?> •
      <?= $pages->find('authors/'.$page->author())->displayName() ?> •
      in 
      <? snippet('categories') ?>
    </div>
  </div>
</div>
<div class="wrapper">
  <main>
    <article>
      <?= $page->text()->kirbytext() ?>
    </article>
  </main>
</div>

<? snippet('footer') ?>