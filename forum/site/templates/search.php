<? snippet('header') ?>

<? snippet('forum-header') ?>
<div class="wrapper">
  <main>
    <form class="form field search-form">
      <input class="input" type="search" name="q" placeholder="Search the forum…" value="<?= htmlspecialchars(get('q')) ?>" autofocus required>
      <input class="btn" type="submit" value="Search">
    </form>
    <hr>
  <? if(!get('q')): ?>
    <p class="search-message"><i>Please enter your search…</i></p>
  <? elseif(!$items->count()): ?>
    <p class="search-message"><i>There are unfortunately no results for your search :(</i></p>
  <? else: ?>
    <? foreach($items as $item) snippet('searchresult', compact('item')); ?>
  <? endif ?>

  <? if($pagination) snippet('pagination') ?>
  </main>
</div>

<? snippet('footer') ?>