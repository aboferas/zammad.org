<? snippet('header') ?>

<div class="header hasSubnav">
  <div class="wrapper">
    <h1><?= $page->title() ?></h1>
    <div class="subtitle"><?= $page->subtitle()->kirbytext() ?></div>
    <nav class="subnav">
      <span class="label">Categories:</span>
      <? foreach($categories as $cat): ?>
      <a<?= e($cat == $category, ' class="active"') ?> href="<?= $page->url() . '/category:' . $cat ?>"><?= html($cat) ?></a>
      <? endforeach ?>
      <? if($category): ?>
      <a class="all-categories" href="<?= $page->url() ?>">All</a>
      <? endif ?>
    </nav>
  </div>
</div>
<div class="wrapper">
  <main>
    <? foreach($articles as $article): ?>
    <article>
      <h2><a href="<?= $article->url() ?>"><?= $article->title() ?></a></h2>
      <?= $article->text()->kirbytext() ?>
      <? if($author = $pages->find('authors/' . $article->author()) ): ?>
      <div class="post-author">
        <? if($avatar = $author->images()->first() ): ?>
        <div class="avatar" style="background-image: url(<?= $avatar->url() ?>)"></div>
        <? endif ?>
        <span class="author-name"><?= $author->displayName() ?></span> 
        posted this <?= $article->date('Y-m-d') ?> 
        in <? snippet('categories', array('page' => $article)) ?>
      </div>
      <? endif ?>
    </article>
    <? endforeach ?>
    <nav class="pagination clearfix">
      <? if($pagination->hasPrevPage()): ?>
      <a class="label left" href="<?= $pagination->prevPageUrl() ?>">previous posts</a>
      <? endif ?>

      <? if($pagination->hasNextPage()): ?>
      <a class="label right" href="<?= $pagination->nextPageUrl() ?>">next posts</a>
      <? endif ?>
    </nav>
  </main>
</div>

<? snippet('footer') ?>