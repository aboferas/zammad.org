<?

return function($site, $pages, $page) {

  // fetch the basic set of pages
  $articles = $page->children()->visible()->flip();

  // fetch all tags
  $categories = $articles->pluck('categories', ',', true);

  // add the category filter
  if($category = param('category')) {
    $articles = $articles->filterBy('categories', $category, ',');
  }

  // apply pagination
  $articles   = $articles->paginate(2);
  $pagination = $articles->pagination();

  return compact('articles', 'categories', 'category', 'pagination');
};

?>