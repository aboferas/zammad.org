<?php

/**
 * Unmodified classes
 */
class Pages extends PagesAbstract {}
class Children extends ChildrenAbstract {}
class Content extends ContentAbstract {}
class Field extends FieldAbstract {}
class File extends FileAbstract {}
class Files extends FilesAbstract {}
class Kirbytext extends KirbytextAbstract {}
class Kirbytag extends KirbytagAbstract {}
class Role extends RoleAbstract {}
class Roles extends RolesAbstract {}
class Users extends UsersAbstract {}

/**
 * Modified classes
 */
load(array(
  'user' => __DIR__ . DS . 'forum' . DS . 'user.php',
  'page' => __DIR__ . DS . 'forum' . DS . 'page.php',
  'site' => __DIR__ . DS . 'forum' . DS . 'site.php',
));