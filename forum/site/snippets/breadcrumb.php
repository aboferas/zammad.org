<nav class="breadcrumb clearfix">
  <div class="left">
    <a class="breadcrumb-link" data-separator="&rarr;" href="<?= url() ?>">Threads</a>
    <? foreach($site->breadcrumb()->limit(3)->not('home') AS $crumb): ?>
    <a class="breadcrumb-link<? e($crumb->isActive(), ' active') ?>" data-separator="&rarr;" href="<?= $crumb->url() ?>"><?= html($crumb->title()) ?></a>
    <? endforeach ?>
  </div>

<? if(isset($action) && $site->user()): ?> 
  <div class="right">
    <? if($page->template() == 'thread'): ?>
    <a class="btn btn--small" href="<?= $page->url() . '/create' ?>">New Topic</a>
    <? else: ?>
    <a class="btn btn--small" href="#reply">Reply</a>
    <? endif ?>
  </div>
<? endif ?>
</nav>