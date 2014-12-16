<? snippet('header') ?>

<? snippet('forum-header') ?>

<div class="wrapper">
  <main>
    <? snippet('notification') ?>
    <? snippet('breadcrumb', array('action' => true)) ?>
    <? foreach($topics as $topic): ?>

    <article class="topic<? e($topic->isSolved(), ' topic-is-solved') ?>">
      <header class="topic-header clearfix">

        <? snippet('user', array('parent' => $topic, 'class' => 'topic-user')) ?>

        <h3 class="topic-headline"><a href="<?= $topic->url() ?>"><?= widont(html($topic->title(), false)) ?></a></h3>

        <div class="topic-meta">

          <time class="date topic-date">
            <a href="<?= $topic->url() ?>"><?= $topic->date('d.m.Y - H:i') ?></a>
          </time>

          <small class="counter topic-reply-counter">
            <a class="btn btn--small btn--muted" href="<?= $topic->url() ?>"><?= $topic->children()->count() ?> Replies</a>
          </small>

        </div>

      </header>
    </article>

    <? endforeach ?>
    <? if($topics->pagination()->hasPages()): ?>
    <? snippet('pagination') ?>
    <? endif ?>
  </main>
</div>
<? snippet('footer') ?>