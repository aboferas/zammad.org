<? snippet('header') ?>

<? snippet('forum-header') ?>
<div class="wrapper">
  <main>
    <? snippet('notification') ?>
    <div class="columns columns--css">
      <?= $page->text()->kirbytext() ?>
    </div>
    <? foreach($pages->visible() as $languageArea): ?>
    <div class="languageArea clearfix">
      <h3 class="languageArea-label"><?= $languageArea->title() ?></h3>
      <div class="threads">
        <? foreach($languageArea->children()->visible() as $thread): ?>
        <div class="thread clearfix">
          <div class="thread-name left">
            <h3><a href="<?= $thread->url() ?>"><?= $thread->title() ?></a></h3>
            <div class="subtitle"><?= $thread->text() ?></div>
          </div>
          <small class="counter right">
            <a class="btn btn--small btn--muted" href="<?= $thread->url() ?>"><?= $thread->children()->children()->visible()->count() ?> Topics</a>
          </small>
        </div>
        <? endforeach ?>
      </div>
    </div>
    <? endforeach ?>
  </main>
</div>

<? snippet('footer') ?>