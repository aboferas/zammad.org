<?

if($item->type() == 'reply') {
  $title = 'Reply to: ' . $item->parent()->title();
  $url   = $item->parent()->url() . '/#' . $item->uid();
} else {
  $title = $item->title();
  $url   = $item->url();
}

?>
<article class="topic">
  <header class="topic-header clearfix">
    <? snippet('user', array('parent' => $item, 'class' => 'topic-user')) ?>
    <h3 class="topic-headline"><a href="<?= $url ?>"><?= widont(html($title, false)) ?></a></h3>

    <div class="topic-meta right">
      <time class="date topic-date">
        <a href="<?= $url ?>"><?= $item->date('d.m.Y - H:i') ?></a>
      </time>
      <a class="topic-reply-counter btn btn--small btn--muted" href="<?= $url ?>"><?= ucfirst($item->type()) ?></a>
    </div>
  </header>
</article>