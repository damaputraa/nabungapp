<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
*/

// ================================================================
// DEFAULT ROUTE - LANDING PAGE
// ================================================================
$route['default_controller'] = 'landing';

// ================================================================
// AUTH ROUTES
// ================================================================
$route['auth/login'] = 'auth/login';
$route['auth/register'] = 'auth/register';
$route['auth/logout'] = 'auth/logout';

// ================================================================
// DASHBOARD ROUTES
// ================================================================
$route['dashboard'] = 'dashboard/index';

// ================================================================
// TRANSACTION ROUTES
// ================================================================
$route['transactions'] = 'transactions/index';
$route['transactions/add'] = 'transactions/add';
$route['transactions/edit/(:num)'] = 'transactions/edit/$1';
$route['transactions/delete/(:num)'] = 'transactions/delete/$1';

// ================================================================
// SAVINGS ROUTES
// ================================================================
$route['savings'] = 'savings/index';
$route['savings/add'] = 'savings/add';
$route['savings/delete/(:num)'] = 'savings/delete/$1';
$route['savings/leaderboard'] = 'savings/leaderboard';
$route['savings/view_user/(:num)'] = 'savings/view_user/$1';

// ================================================================
// ADMIN ROUTES
// ================================================================
$route['admin/login'] = 'admin/login';
$route['admin/logout'] = 'admin/logout';
$route['admin/users'] = 'admin/users';
$route['admin/add_user'] = 'admin/add_user';
$route['admin/edit_user/(:num)'] = 'admin/edit_user/$1';
$route['admin/delete_user/(:num)'] = 'admin/delete_user/$1';
$route['admin/toggle_user_status/(:num)'] = 'admin/toggle_user_status/$1';
$route['admin/reset_user_password/(:num)'] = 'admin/reset_user_password/$1';
$route['admin/targets'] = 'admin/targets';
$route['admin/set_target'] = 'admin/set_target';
$route['admin/logs'] = 'admin/logs';
$route['admin/announcements'] = 'admin/announcements';
$route['admin/add_announcement'] = 'admin/add_announcement';
$route['admin/toggle_announcement/(:num)'] = 'admin/toggle_announcement/$1';
$route['admin/delete_announcement/(:num)'] = 'admin/delete_announcement/$1';

// ================================================================
// PROFILE ROUTES
// ================================================================
$route['profile'] = 'profile/index';
$route['profile/update_password'] = 'profile/update_password';
$route['profile/upload_avatar'] = 'profile/upload_avatar';

// ================================================================
// LAPORAN & EXPORT ROUTES
// ================================================================
$route['laporan'] = 'laporan/index';
$route['laporan/pdf'] = 'laporan/pdf';
$route['export/excel'] = 'export/excel';

// ================================================================
// KANTONG IMPIAN & BUDGET ROUTES
// ================================================================
$route['goals'] = 'goals/index';
$route['goals/create'] = 'goals/create';
$route['goals/deposit'] = 'goals/deposit';
$route['goals/delete/(:num)'] = 'goals/delete/$1';

$route['budget'] = 'budget/index';
$route['budget/save'] = 'budget/save';
$route['budget/delete/(:num)'] = 'budget/delete/$1';

// ================================================================
// 404 OVERRIDE
// ================================================================
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
