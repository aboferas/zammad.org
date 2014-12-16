<nav role="navigation">
<? foreach($pages->visible() as $p): ?>
  <a<? e($p->isOpen(), ' class="active"') ?> href="<?= $p->url() ?>"><?= $p->title()->html() ?></a>
<? endforeach ?>
</nav>
