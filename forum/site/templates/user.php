<? snippet('header') ?>

<? snippet('forum-header') ?>
<div class="wrapper">
  <main>
    <div class="breadcrumb">
      <span class="breadcrumb-link" data-separator="&rarr;"><?= $page->text() ?></span>
      <a class="breadcrumb-link" href="<?= $user->twitter() ?>">@<?= $user->username() ?></a>
    </div>
  <? if($items->count()): ?>
  <? foreach($items as $item) snippet('searchresult', compact('item')); ?>
  <? else: ?>
  <p class="search-message"><i><?= twitter($user->username()) ?> has not posted anything yet</i></p>
  <? endif ?>

  <? snippet('pagination') ?>
  </main>
</div>

<? snippet('footer') ?>