<? snippet('header') ?>
<? snippet('forum-header') ?>

<div class="wrapper">
  <main>
    <? snippet('notification') ?>
    <? snippet('breadcrumb') ?>
    <div class="topic topic-details<? e($page->isSolved(), ' topic-is-solved') ?>">
      <header class="topic-header clearfix">
        <? snippet('user', array('parent' => $page, 'class' => 'topic-user')) ?>
        <h3 class="topic-headline"><?= widont(html($page->title(), false)) ?></h3>
        <div class="topic-meta">
          <time class="date topic-date">
            <a href="<?= $page->url() ?>"><?= $page->date('d.m.Y - H:i') ?></a>
          </time>
        </div>
      </header>

      <div class="topic-body">

        <div class="text topic-body-text">
          <?= $page->text()->clean() ?>
        </div>

        <? if($user = $site->user() and $user->isOwner($page)): ?>
        <nav class="options">

          <? if($user->may('edit', $page)): ?>
            <a class="btn btn--small btn--muted" href="<?= $page->url('edit') ?>">Edit Topic</a>
            <? if($page->isSolved()): ?>
            <a class="btn btn--small btn--muted" href="<?= $page->url('unsolve') ?>">
              Mark as unsolved
            </a>
            <? else: ?>
            <a class="btn btn--small btn--muted" href="<?= $page->url('solve') ?>">
              Mark as solved
            </a>
            <? endif ?>
          <? endif ?>

          <? if($user->may('delete', $page)): ?>
          <a class="btn btn--small btn--muted" onclick="return confirm('Do you really want to delete this topic?')" href="<?= $page->url('delete') ?>">Delete Topic</a>
          <? endif ?>

        </nav>
        <? endif ?>

      </div>
    </div>

    <div class="replies">

      <header class="replies-header">
        <h3 class="replies-headline"><?= $page->children()->count() ?> Replies</h3>
      </header>

      <? foreach($page->children() as $reply): ?>
      <? snippet('reply', array('reply' => $reply)) ?>
      <? endforeach ?>

      <? if($site->user()): ?>
      <div class="reply-form grid">
        <? snippet('reply.form') ?>
      </div>
      <? else: ?>
      <div class="reply-body">
        <div class="text">
          <p>Please <a href="<?= url('login') ?>">sign in via Twitter</a> to reply</p>
        </div>
      </div>
      <? endif ?>

    </div>

  </main>
</div>

<script>
window.users = <?= json_encode($users) ?>;
</script>

<? snippet('footer') ?>