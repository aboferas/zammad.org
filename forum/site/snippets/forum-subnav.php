<nav class="subnav" role="navigation">
  <? foreach($site->find('home', 'search') as $item): ?>
  <a<? e($item->isOpen(), ' class="active"') ?> href="<?= $item->url() ?>"><?= html($item->title()) ?></a>
  <? endforeach ?>
  <? if($user = $site->user()): ?>
  <a<? e(url::current() == site()->user()->url(), ' class="active"') ?> href="<?= $user->url() ?>">@<?= html($user->username()) ?></a>
  <a href="<?= url('logout') ?>">Sign out</a>
  <? else: ?>
  <a href="<?= url('login') ?>">Sign in via Twitter <span class="arrow">&rarr;</span></a>
  <? endif ?>
</nav>