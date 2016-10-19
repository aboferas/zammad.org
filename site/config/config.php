<?php

/*

---------------------------------------
License Setup
---------------------------------------

Please add your license key, which you've received
via email after purchasing Kirby on http://getkirby.com/buy

It is not permitted to run a public website without a
valid license key. Please read the End User License Agreement
for more information: http://getkirby.com/license

*/

c::set('license', 'K2-PERSONAL-6e4d2a2df5aa8ed859eeff3e8e222abc');

/*

---------------------------------------
Kirby Configuration
---------------------------------------

By default you don't have to configure anything to
make Kirby work. For more fine-grained configuration
of the system, please check out http://getkirby.com/docs/advanced/options

*/

c::set('debug', true);
c::set('timezone', 'Europe/Berlin');
c::set('url', 'https://zammad.org');

c::set('routes', array(
  array(
    'pattern' => 'documentation',
    'action'  => function() {
      $first_category = page('documentation')->children()->visible()->first();
      $first_entry = $first_category->children()->visible()->first();
      return go($first_entry->url());
    }
  ),
  array(
    'pattern' => 'forum',
    'action' => function() {
      return go('//forum.zammad.org');
    }
  )
));
