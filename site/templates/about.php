<? snippet('header') ?>

<div class="header">
  <div class="wrapper">
    <h1><?= $page->header() != '' ? $page->header() : $page->title() ?></h1>
    <div class="subtitle"><?= $page->subtitle()->kirbytext() ?></div>
  </div>
</div>
<div class="wrapper">
  <main>
    <section>
      <?= $page->text()->kirbytext() ?>
    </section>
    <section>
      <? $organisation = $page->organisation()->yaml() ?>
      <h2><?= $organisation['title'] ?></h2>
      <table>
      <? foreach($organisation['branches'] as $branch): ?>
        <tr>
          <td><?= $branch['body'] ?>
          <td><?= kirbytext($branch['text']) ?>
      <? endforeach ?>
      </table>
    </section>
    <section class="team">
      <?= $page->team()->kirbytext() ?>
      <div class="columns columns--3">
        <? foreach($pages->find('authors')->children() as $member): ?>
        <div class="member column">
          <div class="avatar" style="background-image: url(<?= $member->images()->first()->url() ?>)"></div>
          <div class="name"><?= $member->name() ?></div>
          <div class="label"><?= $member->occupation() ?></div>
          <blockquote><?= $member->quote() ?></blockquote>
        </div>
        <? endforeach ?>
      </div>
    </section>
    <section>
      <?= $page->join()->kirbytext() ?>
    </section>
  </main>
</div>

<? snippet('footer') ?>