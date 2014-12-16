<nav role="navigation">
<? foreach($pages->filterBy('footerindex', '!=', '')->sortBy('footerindex', 'asc') as $p): ?>
  <a <? e($p->isOpen(), ' class="active"') ?> href="<?= $p->url() ?>"><?= $p->title()->html() ?></a>
<? endforeach ?>
</nav>
