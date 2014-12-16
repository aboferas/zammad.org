<? snippet('header') ?>

<? snippet('forum-header') ?>

<div class="wrapper">
  <main class="columns columns--31">
    <nav class="breadcrumb clearfix">
      <span class="breadcrumb-link" data-separator="&rarr;"><?= $page->headline() ?></span>
      <a class="breadcrumb-link" data-separator="&rarr;" href="<?= $topic->url() ?>"><?= $topic->title() ?></a>
    </nav>
    <div class="column">
      <? snippet('topic.form', array('cancel' => $topic->url())) ?>
    </div>
    <div class="column">
      <? snippet('topic.guide') ?>
    </div>
  </main>
</div>

<? snippet('footer') ?>