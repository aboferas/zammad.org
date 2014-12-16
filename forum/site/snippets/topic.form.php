<form class="form topic-form" method="post">

  <? if(!empty($alert)): ?>
  <fieldset class="alert">
    <?= kirbytext($alert) ?>
  </fieldset>
  <? endif ?>

  <div class="field">
    <h3><label>Title</label></h3>
    <input class="input" type="text" maxlength="140" name="title" value="<?= html(get('title', $topic->title())) ?>" autofocus required>
  </div>
  <div class="field">
    <h3><label>Text</label></h3>
    <textarea class="input" name="text" required><?= html(get('text', $topic->text())) ?></textarea>
  </div>
  <div class="buttons clearfix">
    <a href="<?= $cancel ?>" class="left btn btn-cancel">Cancel</a>
    <input class="btn right btn--success" type="submit" name="submit" value="Post Topic">
  </div>

</form>