<article class="reply" id="<?= $reply->uid() ?>">
  <header class="reply-header clearfix">
    <? snippet('user', array('parent' => $reply, 'class' => 'reply-user')) ?>
    <div class="reply-meta">
    <time class="date reply-date">
      <a href="<?= $reply->parent()->url() . '/#' . $reply->uid() ?>"><?= $reply->date('d.m.Y - H:i') ?></a>
    </time>
    </div>
  </header>
  <div class="reply-body">
    <div class="text reply-body-text">
      <?= $reply->text()->clean() ?>
    </div>

    <? if($user = $site->user() and $user->isOwner($reply)): ?>
    <nav class="options">
      <? if($user->may('edit', $reply)): ?>
      <a class="btn btn--small btn--muted" href="<?= $reply->url('edit') ?>">Edit Reply</a>
      <? endif ?>
      <? if($user->may('delete', $reply)): ?>
      <a class="btn btn--small btn--muted" href="<?= $reply->url('delete') ?>" onclick="return confirm('Do you really want to delete this reply?')">Delete Reply</a>
      <? endif ?>
    </nav>
    <? endif ?>

  </div>
</article>