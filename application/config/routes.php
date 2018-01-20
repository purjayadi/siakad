<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['login'] = "Auth";
$route['mahasiswa'] = "mahasiswa/dashboard";
$route['logout'] = "auth/logout";
$route['administrator/(:any)']  = 'admin/$1';
$route['administrator/koas/(:any)'] = "admin/koas/$1";
$route['administrator/mahasiswa/(:any)'] = "admin/mahasiswa/$1";
$route['administrator/blok/(:any)'] = "admin/blok/$1";
$route['administrator/dosen/(:any)'] = "admin/dosen/$1";
$route['administrator/entry_khs/(:any)'] = "admin/entry_khs/$1";
$route['administrator/jurusan/(:any)'] = "admin/jurusan/$1";
$route['administrator/khs/(:any)'] = "admin/khs/$1";
$route['administrator/kurikulum/(:any)'] = "admin/kurikulum/$1";
$route['administrator/matakuliah/(:any)'] = "admin/matakuliah/$1";
$route['administrator/mksyarat/(:any)'] = "admin/mksyarat/$1";
$route['administrator/nilai/(:any)'] = "admin/nilai/$1";
$route['administrator/qmatakuliah/(:any)'] = "admin/qmatakuliah/$1";
$route['administrator/qnilai/(:any)'] = "admin/qnilai/$1";
$route['administrator/semester/(:any)'] = "admin/semester/$1";
$route['administrator/semester_sekarang/(:any)'] = "admin/semester_sekarang/$1";
$route['administrator/stase/(:any)'] = "admin/stase/$1";
$route['administrator/stase_besar/(:any)'] = "admin/stase_besar/$1";
$route['administrator/stase_kecil/(:any)'] = "admin/stase_kecil/$1";
$route['administrator/tahun_ajaran/(:any)'] = "admin/tahun_ajaran/$1";
$route['administrator/ukmppd/(:any)'] = "admin/ukmppd/$1";
$route['administrator/user/(:any)'] = "admin/user/$1";