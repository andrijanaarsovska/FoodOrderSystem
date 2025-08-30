<?php

use App\Http\Controllers\Admin\ManageController;
use App\Http\Controllers\Admin\ManageOrderController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\Client\RestaurantController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\FilterController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [UserController::class, 'Index'])->name('index');


Route::get('/dashboard', function () {
    return view('frontend.dashboard.profile');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::post('/profile/store', [UserController::class, 'ProfileStore'])->name('profile.store');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('/user/password/update', [UserController::class, 'UserPasswordUpdate'])->name('user.password.update');

    Route::controller(ManageOrderController::class)->group(function () {
        Route::get('/user/order-list', 'UserOrderListManage')->name('user.order.list');
        Route::get('/user/order-details/{id}', 'UserOrderDetailsManage')->name('user.order_details');
        Route::get('/user/invoice-download/{id}', 'UserInvoiceDownload')->name('user.invoice.download');
    });
});

require __DIR__ . '/auth.php';

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');

});

Route::post('/admin/login_submit', [AdminController::class, 'AdminLoginSubmit'])->name('admin.login_submit');

Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');

Route::get('/admin/forget_password', [AdminController::class, 'AdminForgetPassword'])->name('admin.forget_password');

Route::post('/admin/password_submit', [AdminController::class, 'AdminPasswordSubmit'])->name('admin.password_submit');

Route::post('/admin/reset_password_submit', [AdminController::class, 'AdminResetPasswordSubmit'])->name('admin.reset_password_submit');

Route::get('/admin/reset_password/{token}/{email}', [AdminController::class, 'AdminResetPassword']);


// These routes are for CLIENT


////// client/profile/store da se napravi
Route::middleware('client')->group(function () {
    Route::get('/client/dashboard', [ClientController::class, 'ClientDashboard'])->name('client.dashboard');
    Route::get('/client/profile', [ClientController::class, 'ClientProfile'])->name('client.profile');
    Route::post('/client/profile/store', [ClientController::class, 'ClientProfileStore'])->name('client.profile.store');
    Route::get('/client/change/password', [ClientController::class, 'ClientChangePassword'])->name('client.change.password');
    Route::post('/client/password/update', [ClientController::class, 'ClientPasswordUpdate'])->name('client.password.update');

});


Route::get('/client/login', [ClientController::class, 'ClientLogin'])->name('client.login');
Route::post('/client/login_submit', [ClientController::class, 'ClientLoginSubmit'])->name('client.login_submit');

Route::get('/client/register', [ClientController::class, 'ClientRegister'])->name('client.register');
Route::post('/client/register/submit', [ClientController::class, 'ClientRegisterSubmit'])->name('client.register.submit');
Route::get('/client/forget_password', [ClientController::class, 'ClientForgetPassword'])->name('client.forget_password');
Route::post('/client/password_submit', [ClientController::class, 'ClientPasswordSubmit'])->name('client.password_submit');
Route::post('/client/reset_password_submit', [ClientController::class, 'ClientResetPasswordSubmit'])->name('client.reset_password_submit');
Route::get('/client/reset_password/{token}/{email}', [ClientController::class, 'ClientResetPassword']);
Route::get('/client/logout', [ClientController::class, 'ClientLogout'])->name('client.logout');

// all admin category  all.category
Route::middleware('admin')->group(function () {
    Route::controller(AdminCategoryController::class)->group(function () {
        Route::get('/all/category', 'AllCategory')->name('all.category')->middleware(['permission:category.all']);
        Route::get('/add/category', 'AddCategory')->name('add.category');
        Route::post('/category/store', 'StoreCategory')->name('category.store');
        Route::get('/edit/category/{id}', 'EditCategory')->name('edit.category');
        Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');
        Route::post('/category/update', 'UpdateCategory')->name('category.update');
    });   // all.cities

    Route::controller(AdminCategoryController::class)->group(function () {
        Route::get('/all/cities', 'AllCities')->name('all.cities');
        Route::post('/city/store', 'StoreCity')->name('city.store');
        Route::get('/edit/city/{id}', 'EditCity');
        Route::post('/city/update', 'UpdateCity')->name('city.update');
        Route::get('/delete/city/{id}', 'DeleteCity')->name('delete.city');
    });

    Route::controller(ManageController::class)->group(function () {
        Route::get('admin/all/product', 'AdminAllProduct')->name('admin.all.product');
        Route::get('admin/add/product', 'AdminAddProduct')->name('admin.add.product');
        Route::post('/admin/product/store', 'AdminStoreProduct')->name('admin.product.store');
        Route::get('/admin/edit/product/{id}', 'AdminEditProduct')->name('admin.edit.product');
        Route::post('/admin/product/update', 'AdminUpdateProduct')->name('admin.product.update');
        Route::get('/admin/delete/product/{id}', 'AdminDeleteProduct')->name('admin.delete.product');
    });

    Route::controller(ManageController::class)->group(function () {
        Route::get('/pending/restaurant', 'PendingRestaurant')->name('pending.restaurant');
        Route::get('/active/restaurant', 'ActiveRestaurant')->name('active.restaurant');
        Route::get('/clientChangeStatus', 'ClientChangeStatus');
    });

    Route::controller(ManageController::class)->group(function () {
        Route::get('/all/banner', 'AllBanner')->name('all.banner');
        Route::get('/edit/banner/{id}', 'EditBanner');
        Route::post('/banner/store', 'StoreBanner')->name('banner.store');
        Route::post('/banner/update', 'UpdateBanner')->name('banner.update');
        Route::get('/delete/banner/{id}', 'DeleteBanner')->name('delete.banner');
    });

    Route::controller(ManageOrderController::class)->group(function () {
        Route::get('/pending-order', 'PendingOrderManage')->name('pending.order');
        Route::get('/confirm-order', 'ConfirmOrderManage')->name('confirm.order');
        Route::get('/processing-order', 'ProcessingOrderManage')->name('processing.order');
        Route::get('/delivered-order', 'DeliveredOrderManage')->name('delivered.order');
        Route::get('/admin/order-details/{id}', 'OrderDetails')->name('admin.order_details');
    });

    Route::controller(ManageOrderController::class)->group(function () {
        Route::get('/pending-to-confirm/{id}', 'PendingToConfirmManage')->name('pending_to_confirm');
        Route::get('/confirm-to-processing/{id}', 'ConfirmToProcessManage')->name('confirm_to_processing');
        Route::get('/processing-to-deliver/{id}', 'ProcessToDeliverManage')->name('processing_to_deliver');
    });

    Route::controller(ReportController::class)->group(function () {
        Route::get('/admin/all-reports', 'AdminAllReports')->name('admin.all.reports');
        Route::post('/admin/search/by-date', 'AdminSearchByDate')->name('admin.search.date');
        Route::post('/admin/search/by-month', 'AdminSearchByMonth')->name('admin.search.month');
        Route::post('/admin/search/by-year', 'AdminSearchByYear')->name('admin.search.year');
    });

    Route::controller(RoleController::class)->group(function () {
        Route::get('/all/permissions', 'AllPermissions')->name('admin.all.permissions');
        Route::get('/add/permission', 'AddPermission')->name('add.permission');
        Route::post('/permission/store', 'StorePermission')->name('permission.store');
        Route::get('/permission/edit/{id}', 'EditPermission')->name('edit.permission');
        Route::post('/permission/update', 'UpdatePermission')->name('permission.update');
        Route::get('/permission/delete/{id}', 'DeletePermission')->name('delete.permission');
    });

    Route::controller(RoleController::class)->group(function () {
        Route::get('/all/roles', 'AllRoles')->name('admin.all.roles');
        Route::get('/add/role', 'AddRole')->name('add.role');
        Route::post('/store/role', 'StoreRole')->name('role.store');
        Route::get('/edit/role/{id}', 'EditRole')->name('edit.role');
        Route::post('/role/update', 'UpdateRole')->name('role.update');
        Route::get('/role/delete/{id}', 'DeleteRole')->name('delete.role');
    });

     Route::controller(RoleController::class)->group(function () {
         Route::get('/add/role/permission', 'AddRolesPermission')->name('admin.add.roles.permission');
         Route::post('/role/permission/store', 'RolePermissionStore')->name('role.permission.store');
         Route::get('/all/roles/permission', 'AllRolesPermission')->name('admin.all.roles.permission');
         Route::get('/admin/edit/roles/{id}', 'AdminEditRoles')->name('admin.edit.roles');
         Route::post('/admin/roles/update/{id}', 'AdminRolesUpdate')->name('admin.roles.update');
         Route::get('/admin/delete/roles/{id}', 'AdminDeleteRoles')->name('admin.delete.roles');
   });

    Route::controller(RoleController::class)->group(function () {
        Route::get('/admin/list', 'AllAdmin')->name('all.admin');
        Route::get('/add/admin', 'AddAdmin')->name('add.admin');
        Route::post('/admin/store', 'StoreAdmin')->name('admin.store');
        Route::get('/admin/edit/{id}', 'EditAdmin')->name('edit.admin');
        Route::post('/admin/update/{id}', 'UpdateAdmin')->name('admin.update');
        Route::get('/admin/delete/{id}', 'DeleteAdmin')->name('delete.admin');
   });


});

// for restaurant
Route::middleware(['client', 'status'])->group(function () {
    Route::controller(RestaurantController::class)->group(function () {
        Route::get('/all/menu', 'AllMenu')->name('all.menu');
        Route::get('/add/menu', 'AddMenu')->name('add.menu');
        Route::post('/menu/store', 'StoreMenu')->name('menu.store');
        Route::get('/edit/menu/{id}', 'EditMenu')->name('edit.menu');
        Route::post('/menu/update', 'UpdateMenu')->name('menu.update');
        Route::get('/delete/menu/{id}', 'DeleteMenu')->name('delete.menu');

    });
    Route::controller(RestaurantController::class)->group(function () {
        Route::get('/all/product', 'AllProduct')->name('all.product');
        Route::get('/add/product', 'AddProduct')->name('add.product');
        Route::post('/product/store', 'StoreProduct')->name('product.store');
        Route::get('/edit/product/{id}', 'EditProduct')->name('edit.product');
        Route::post('/product/update', 'UpdateProduct')->name('product.update');
        Route::get('/delete/product/{id}', 'DeleteProduct')->name('delete.product');
    });

    Route::controller(RestaurantController::class)->group(function () {
        Route::get('/all/gallery', 'AllGallery')->name('all.gallery');
        Route::get('/add/gallery', 'AddGallery')->name('add.gallery');
        Route::post('/gallery/store', 'StoreGallery')->name('gallery.store');
        Route::get('/edit/gallery/{id}', 'EditGallery')->name('edit.gallery');
        Route::post('/gallery/update', 'UpdateGallery')->name('gallery.update');
        Route::get('/delete/gallery/{id}', 'DeleteGallery')->name('delete.gallery');

    });

    Route::controller(ManageOrderController::class)->group(function () {
        Route::get('/all/orders', 'AllClientOrdersManage')->name('all.client.orders');
        Route::get('/restaurant/order-details/{id}', 'ClientOrderDetailsManage')->name('client.order_details');
    });


    Route::controller(ReportController::class)->group(function () {
        Route::get('/client/all-reports', 'ClientAllReports')->name('client.all.reports');
        Route::post('/client/search/by-date', 'ClientSearchByDate')->name('client.search.date');
        Route::post('/client/search/by-month', 'ClientSearchByMonth')->name('client.search.month');
        Route::post('/client/search/by-year', 'ClientSearchByYear')->name('client.search.year');

    });
});

Route::get('/changeStatus', [RestaurantController::class, 'ChangeStatus']);

Route::controller(HomeController::class)->group(function () {
    Route::get('/restaurant/details/{id}', 'RestaurantDetails')->name('restaurant.details');
});


Route::controller(CartController::class)->group(function () {
    Route::get('/add_to_cart/{id}', 'AddToCart')->name('add_to_cart');
    Route::post('/cart/update-quantity', 'UpdateCartQuantity')->name('cart.updateQuantity');
    Route::post('/cart/remove-item', 'RemoveCartItem')->name('cart.remove');
    Route::get('/checkout', 'ShopCheckout')->name('checkout');
});


Route::controller(OrderController::class)->group(function () {
    Route::post('/cash_order', 'CashOrder')->name('cash_order');
    Route::post('/mark-notification-as-read/{notificationId}', 'MarkAsReadNotification');
    Route::post('/mark-notification-as-read-client/{notificationId}', 'MarkAsReadNotificationClient');

});


Route::controller(FilterController::class)->group(function () {
    Route::get('/restaurants', 'ListRestaurants')->name('list.restaurants');
    Route::get('/filter/products', 'FilterProducts')->name('filter.products');
});

