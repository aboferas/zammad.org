<? if($pagination->hasPages()): ?>
<nav class="pagination clearfix">
  <? if($pagination->hasPrevPage()): ?>
  <a class="prev" href="<?= $pagination->prevPageUrl() ?>">
    &larr; Previous Page
  </a>
  <? endif; ?>

  <? if($pagination->hasNextPage()): ?>
  <a class="next right" href="<?= $pagination->nextPageUrl() ?>">
    Next Page &rarr;
  </a>
  <? endif; ?>
</nav>
<? endif ?>