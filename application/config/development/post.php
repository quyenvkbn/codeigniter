<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Tables.
| -------------------------------------------------------------------------
| Database table names.
*/
$config['tables']['post']           = 'post';
$config['tables']['post_category']          = 'post_category';

/*
 | Users table column and Group table column you want to join WITH.
 |
 | Joins from post_category.id
 */
$config['join']['post_category']  = 'post_category_id';
