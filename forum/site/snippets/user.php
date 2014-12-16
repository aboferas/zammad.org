<? if($user = isset($user) ? $user : $parent->user()): ?>
<div class="user <?= $class ?>" title="@<?= html($user->username()) ?>">
  <a class="user-avatar" href="<?= $user->url() ?>">
    <? if($avatar = $user->avatar()): ?>
    <img src="<?= thumb($avatar, array('width' => 100, 'height' => 100, 'crop' => true))->url() ?>">
    <? else: ?>
    <img src="<?= url('assets/images/avatar.png') ?>">
    <? endif ?>
  </a>
  <div class="user-username">
    <a href="<?= $user->url() ?>"><?= html($user->username()) ?></a>
  </div>
</div>
<? endif ?>