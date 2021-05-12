<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Checkout\HomeController;
use App\Http\Controllers\Checkout\RestaurantController;

use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\AdminRestaruantController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);

Route::get('/checkout/login', [HomeController::class, 'showlogin'])->name('showlogin');
Route::get('/checkout/register', [HomeController::class, 'showregister']);

Route::get('/checkout/user', [HomeController::class, 'welcome'])->name('welcome');
Route::get('/checkout/signout', [HomeController::class, 'signout']);

Route::post('/checkout/signup', [HomeController::class, 'register']);
Route::post('/checkout/signin', [HomeController::class, 'signin']);

Route::get('/checkout/admin', [MainController::class, 'index']);
Route::get('/checkout/restaurant_detail', [RestaurantController::class, 'showDetail'])->name('restaurant_detail');
Route::get('/checkout/admin/login', [LoginController::class, 'showlogin'])->name('admin.login');
Route::get('/checkout/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');
Route::get('/checkout/admin/dashboard', [MainController::class, 'index'])->name('admin.dashboard');
Route::get('/checkout/admin/restaruant', [AdminRestaruantController::class, 'index'])->name('admin.restaruant');
Route::get('/checkout/admin/add_restaruant', [AdminRestaruantController::class, 'append'])->name('admin.add_restaruant');
Route::get('/checkout/admin/find_restaruant', [AdminRestaruantController::class, 'find'])->name('admin.find_restaruant');
Route::get('/checkout/view_registermenu/{id}', [AdminRestaruantController::class, 'viewregistermenu'])->name('admin.view_registermenu');
Route::get('/checkout/view_restaruant/{id}', [AdminRestaruantController::class, 'viewresults'])->name('admin.view_restaruant');
Route::get('/checkout/admin/showregister/{param}/{id}', [AdminRestaruantController::class, 'show_register'])->name('admin.show_register_restaruant');
Route::get('/checkout/admin/showMenu', [AdminRestaruantController::class, 'show_menu'])->name('admin.show_menu');
Route::get('/checkout/admin/category/datatables', [CategoryController::class, 'datatables'])->name('admin.category.datatables');
Route::get('/checkout/admin/add_category', [CategoryController::class, 'append'])->name('admin.add_category');
Route::post('/checkout/admin/category/add', [CategoryController::class, 'create'])->name('admin-category-add');
Route::get('/checkout/admin/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin-category-edit');
Route::post('/checkout/admin/category/update/{id}', [CategoryController::class, 'update'])->name('admin-category-update');
Route::get('/checkout/admin/category/resdelete/{id}', [CategoryController::class, 'resdelete'])->name('admin-category-delete');
Route::get('/checkout/admin/restaruant/datatables', [AdminRestaruantController::class, 'datatables'])->name('admin.restaruants.datatables');
Route::get('/checkout/admin/restaruant/results/{id}', [AdminRestaruantController::class, 'results'])->name('admin.restaruants.results');
Route::get('/checkout/admin/restaruant/edit/{id}', [AdminRestaruantController::class, 'edit'])->name('admin-restaruant-edit');
Route::post('/checkout/admin/restaruant/update/{id}', [AdminRestaruantController::class, 'update'])->name('admin-restaruant-update');
Route::get('/checkout/admin/restaruant/resdelete/{id}', [AdminRestaruantController::class, 'resdelete'])->name('admin-restaruant-delete');
Route::get('/checkout/admin/restaruant/firedelete/{id}', [AdminRestaruantController::class, 'firedelete'])->name('admin-restaruant-deletefire');
Route::get('/checkout/admin/restaruant/resphone/{id}/{code}', [AdminRestaruantController::class, 'phoneget'])->name('admin-resphone-get');
Route::get('/checkout/admin/restaruant/status/{id1}/{id2}', [AdminRestaruantController::class, 'status'])->name('admin-restaruant-status');

Route::get('/checkout/admin/staffindex', [StaffController::class, 'index'])->name('admin.staff.index');
Route::get('/checkout/admin/staffdatatables', [StaffController::class, 'datatables'])->name('admin.staff.datatables');
Route::get('/checkout/admin/addstaff', [StaffController::class, 'addstaff'])->name('admin-staff-create');
Route::get('/checkout/admin/staffedit/{id}', [StaffController::class, 'editstaff'])->name('admin-staff-edit');
Route::get('/checkout/admin/staffdelete/{id}', [StaffController::class, 'deletestaff'])->name('admin-staff-delete');
Route::get('/checkout/admin/staffshow/{id}', [StaffController::class, 'showstaff'])->name('admin-staff-show');
Route::post('/checkout/admin/storestaff', [StaffController::class, 'storestaff'])->name('admin-staff-store');
Route::post('/checkout/admin/updatestaff/{id}', [StaffController::class, 'updatestaff'])->name('admin-staff-update');
Route::get('/checkout/admin/staffhistorydatatables', [StaffController::class, 'historydatatables'])->name('admin.staffhistory.datatables');
Route::get('/checkout/admin/staffhistory', [StaffController::class, 'showhistory'])->name('admin.staff.history');

Route::get('/checkout/admin/restaruant/editmenus/{id}', [AdminRestaruantController::class, 'editmenu'])->name('admin-restaruant-editmenus');


Route::post('/checkout/admin/restaurant/search', [AdminRestaruantController::class, 'search']);
Route::post('/checkout/admin/restaurant/searchlocation', [AdminRestaruantController::class, 'searchlocation']);
Route::post('/checkout/admin/restaurant/register', [AdminRestaruantController::class, 'register'])->name('admin.register_res');
Route::post('/checkout/admin/restaurant/registermenu', [AdminRestaruantController::class, 'registermenu'])->name('admin.register_menu');
Route::post('/checkout/admin/restaurant/savemenu', [AdminRestaruantController::class, 'savemenu'])->name('admin.save_menu');
Route::post('/checkout/admin/restaurant/updatemenu', [AdminRestaruantController::class, 'updatemenu'])->name('admin.update_menu');
Route::post('/checkout/admin/loginsubmit', [LoginController::class, 'login'])->name('admin.login.submit');

Route::get('/checkout/view_importmenu/{resid}/{id}/{code}', [AdminRestaruantController::class, 'viewimportmenu'])->name('admin.view_importmenu');
Route::get('/checkout/admin/restaruant/importview/{id}/{code}', [AdminRestaruantController::class, 'importview'])->name('admin-restaurant-importview');
Route::post('/checkout/admin/restaurant/importmenu/{id}/{code}', [AdminRestaruantController::class, 'importmenu'])->name('admin.import_menu');

Route::get('/checkout/view_clonemenu/{id}/{res_id}', [AdminRestaruantController::class, 'viewclonemenu'])->name('admin.view_clonemenu');
Route::get('/checkout/admin/restaruant/clone/{id}', [AdminRestaruantController::class, 'clone'])->name('admin-restaruant-clone');
Route::post('/checkout/admin/restaruant/clonemenu/{id}', [AdminRestaruantController::class, 'clonemenu'])->name('admin-restaruant-clonemenu');
Route::post('/checkout/admin/restaurant/clonemenusave', [AdminRestaruantController::class, 'clonemenusave'])->name('admin.clone_menu');

Route::get('/checkout/admin/restaruant/transferapp/{id}', [AdminRestaruantController::class, 'sendToApp'])->name('admin-restaruant-transferapp');

Route::get('/checkout/admin/restaruant/findstr', [AdminRestaruantController::class, 'findstr'])->name('admin-restaruant-findstr');

//change image
Route::get('/checkout/admin/restaruant/showimage/{id}', [AdminRestaruantController::class, 'showimage'])->name('admin-restaruant-image');
Route::post('/checkout/admin/restaruant/changeimage/{id}', [AdminRestaruantController::class, 'changeimage'])->name('admin.changeimage');


// route for seeding one particular menu
Route::get('/checkout/admin/particular', [AdminRestaruantController::class, 'recoverOneRestaurant']);







//routes for ajax transfer menu editing
Route::post('/checkout/admin/createMenu', [MenuController::class, 'createMenu'])->name('admin-createMenu');
Route::post('/checkout/admin/createSection', [MenuController::class, 'createSection'])->name('admin-createSection');
Route::post('/checkout/admin/createMenuItem', [MenuController::class, 'createMenuItem'])->name('admin-createMenuItem');
Route::post('/checkout/admin/createItemOption', [MenuController::class, 'createItemOption'])->name('admin-createItemOption');
Route::post('/checkout/admin/createSuboption', [MenuController::class, 'createSuboption'])->name('admin-createSuboption');


Route::post('/checkout/admin/createItemOptionGroup', [MenuController::class, 'createItemOptionGroup'])->name('admin-createItemOptionGroup');
Route::post('/checkout/admin/updateItemOptionGroup', [MenuController::class, 'updateItemOptionGroup'])->name('admin-updateItemOptionGroup');

//update
Route::post('/checkout/admin/updateMenu', [MenuController::class, 'updateMenu'])->name('admin-updateMenu');
Route::post('/checkout/admin/updateSection', [MenuController::class, 'updateSection'])->name('admin-updateSection');
Route::post('/checkout/admin/updateMenuItem', [MenuController::class, 'updateMenuItem'])->name('admin-updateMenuItem');
Route::post('/checkout/admin/updateItemOption', [MenuController::class, 'updateItemOption'])->name('admin-updateItemOption');
Route::post('/checkout/admin/updateSuboption', [MenuController::class, 'updateSuboption'])->name('admin-updateSuboption');


//delete
Route::delete('/checkout/admin/deleteMenu', [MenuController::class, 'deleteMenu'])->name('admin-deleteMenu');
Route::delete('/checkout/admin/deleteSection', [MenuController::class, 'deleteSection'])->name('admin-deleteSection');
Route::delete('/checkout/admin/deleteMenuItem', [MenuController::class, 'deleteMenuItem'])->name('admin-deleteMenuItem');
Route::delete('/checkout/admin/deleteItemOption', [MenuController::class, 'deleteItemOption'])->name('admin-deleteItemOption');
Route::delete('/checkout/admin/deleteSuboption', [MenuController::class, 'deleteSuboption'])->name('admin-deleteSuboption');

//report
Route::get('/checkout/admin/reoport/salesreport', [ReportController::class, 'showSalesReport'])->name('admin-salesReport');

//categories
Route::get('/checkout/admin/category', [CategoryController::class, 'categories_show'])->name('admin-categories');
Route::get('/checkout/admin/category/assign_categories', [CategoryController::class, 'assign_categories_show'])->name('admin-assgincategories');
Route::get('/checkout/admin/category/assign_category_by_res/{id}', [CategoryController::class, 'assign_categories_show_res'])->name('admin-restaruant-cagegory');
Route::post('/checkout/admin/category/change_category_status', [CategoryController::class, 'change_category_status'])->name('admin-change-category-status');
Route::post('/checkout/admin/category/bulk_change_category_status', [CategoryController::class, 'bulk_change_category_status'])->name('admin-bulk-change-category-status');
//items save

Route::get('/checkout/admin/items/save', [AdminRestaruantController::class, 'saveItems'])->name('admin.save_item');
// users
Route::get('/checkout/admin/users', [UserController::class, 'index'])->name('admin.users');
Route::get('/checkout/admin/users/datatables', [UserController::class, 'datatables'])->name('admin.users.datatables');
Route::get('/checkout/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
Route::post('/checkout/admin/users/create', [UserController::class, 'saveUser'])->name('admin.users.save');
Route::get('/checkout/admin/users/{id}', [UserController::class, 'edit'])->name('admin.users.edit');
Route::post('/checkout/admin/users/{id}', [UserController::class, 'updateUser'])->name('admin.users.update');
Route::get('/checkout/admin/users/delete/{id}', [UserController::class, 'delete'])->name('admin.users.delete');