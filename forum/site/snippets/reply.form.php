<form class="form" id="reply" action="#reply" method="post">

  <? if(!empty($alert)): ?>
  <fieldset class="alert">
    <?= kirbytext($alert) ?>
  </fieldset>
  <? endif ?>

  <fieldset>
    <div class="field">
      <h3><label for="reply-text">Your reply</label></h3>
      <textarea class="input" id="reply-text" name="reply" required<? e(isset($autofocus) and $autofocus == true, ' autofocus') ?>><?= isset($text) ? html($text) : null ?></textarea>
    </div>
    <div class="buttons">
      <p class="reply-help text">You can use <a target="_blank" href="/docs/content/text">Markdown and Kirbytext</a> to format your content. <br>Type @ to mention other users taking part in this topic.</p>
      <div class="right">
        <? if(isset($cancel)): ?>
        <a href="<?= $cancel ?>" class="left btn btn--muted btn-cancel">Cancel</a>
        <? endif ?>
        <input class="btn left btn--success" type="submit" name="submit" value="Reply">
      </div>
    </div>
  </fieldset>
</form>