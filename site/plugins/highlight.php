<?php

require_once('highlight/geshi.php');

kirbytext::$pre[] = function($kirbytext, $value) {

  return preg_replace_callback('!```(.*?)```!is', function($code){
    
    $code = @$code[1];
    $lines = explode("\n", $code);
    $first = trim(array_shift($lines));
    $code  = implode("\n", $lines);
    $code  = trim($code);

    $result  = '<pre class="highlight ' . $first . '">';
    $result .= '<code>';
    $result .= highlight($code, (empty($first)) ? 'php-html' : $first);
    $result .= '</code>';
    $result .= '</pre>';
    
    return $result;
    
  }, $value);

};

function highlight($code, $lang) {

  if($lang == 'php-html') {
    return smartHighlight($code);
  }

  $geshi = new GeSHi($code, $lang);
  $geshi->set_header_type(GESHI_HEADER_NONE);
  $geshi->enable_classes();
  $geshi->enable_keyword_links(false);
  $code  = $geshi->parse_code();
  return '<span class="' . $lang . '">' . $code . '</span>';

};

function smartHighlight($code) {

  // find all php stuff
  preg_match_all('!\<\?.*?\?\>!i', $code, $array);
    
  $result = '';
  $php = array();
  
  // replace php within html with placeholders
  foreach($array[0] as $key => $found) {
    $key = '____' . $key . '____';
    $php[$key] = highlight($found, 'php');
    $code = str_replace($found, $key, $code);  
  }
  // now highlight the plain html  
  $code = highlight($code, 'html5');
        
  // put the highlighted php back in  
  foreach($php as $key => $p) {
    $code = str_replace($key, $p, $code);
  }
  
  return $code;

}