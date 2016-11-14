<? snippet('header') ?>

<div class="hero" style="background-image: url(<?= $page->images()->find('background.jpg')->url() ?>)">
  <div class="wrapper">
    <div class="header">

      <a class="subtitle" href="https://zammad.com/news" style="color: hsl(146,51%,50%); text-decoration: underline;">Note: Zammad 1.1 has been released (read more)</a>

      <h1><?= $page->header() ?></h1>
      <div class="subtitle"><?= $page->subtitle()->kirbytext() ?></div>
    </div>

    <div class="downloads">
      <h2><?= $page->downloadtitle() ?></h2>
      <div class="subtitle"><?= $page->downloadsubtitle() ?></div>

      <div class="columns columns--flexible">
      <? foreach($page->downloads()->yaml() as $download): ?>
        <div class="column" style="width: 25%;">
          <div class="label"><?= $download['intro'] ?></div>
          <div class="os"><?= $download['platform'] ?></div>
          <div class="version"><?= kirbytext($download['version']) ?></div>
          <a class="btn btn--success" href="<?= $download['download'] ?>"><?= $download['downloadText'] ?></a>
        </div>
      <? endforeach ?>
      </div>
    </div>

    <div class="hint">
      <?= $page->hint()->kirbytext() ?>
    </div>
  </div>
</div>
<!--
<div class="sections wrapper columns columns--2">
  <div class="column">
    <?= $page->section1()->kirbytext() ?>
  </div>
  <div class="column">
    <?= $page->section2()->kirbytext() ?>
  </div>
</div>
-->
<? snippet('footer') ?>