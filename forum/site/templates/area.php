<? snippet('header') ?>

<? snippet('forum-header') ?>
<div class="wrapper">
  <main>
    <? snippet('breadcrumb') ?>
    <? foreach($page->children()->visible() as $thread): ?>
    <div class="thread clearfix">
      <div class="thread-name left">
        <h3><a href="<?= $thread->url() ?>"><?= $thread->title() ?></a></h3>
        <div class="subtitle"><?= $thread->text() ?></div>
      </div>
      <small class="counter right">
        <a class="btn btn--small btn--muted" href="<?= $thread->url() ?>"><?= $thread->children()->children()->count() ?> Topics</a>
      </small>
    </div>
    <? endforeach ?>
  </main>
</div>

<? snippet('footer') ?>