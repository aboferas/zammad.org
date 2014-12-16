<? snippet('header') ?>

<? snippet('forum-header') ?>

<div class="wrapper">
  <main>
    <nav class="breadcrumb clearfix">
      <span class="breadcrumb-link" data-separator="&rarr;">Reply to: </span>
      <a class="breadcrumb-link" data-separator="&rarr;" href="<?= $page->parent()->url() ?>"><?= html($page->parent()->title()) ?></a>
    </nav>
    <div class="page-body">
      <? snippet('reply.form', array('text' => $page->text(), 'autofocus' => true, 'cancel' => $page->parent()->url())) ?>
    </div>
  </main>
</div>

<? snippet('footer') ?>