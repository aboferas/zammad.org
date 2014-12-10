<? 
  $categories = str::split($page->categories());
  foreach($categories as $i => $category):
?>
<? if($i > 0): ?>, <? endif ?><a href="<?= url("news/category:".$category) ?>"><?= $category ?></a><? endforeach ?>