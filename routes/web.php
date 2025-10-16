<?php

use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/shop', [ShopController::class, 'index'])->name('website.shop');
Route::get('/shop/{product_slug}', [ShopController::class, 'product_details'])->name('website.shop.product.details');
Route::get('/about', [HomeController::class, 'about'])->name('website.about');
Route::get('/privacy-policy', [HomeController::class, 'privacy_policy'])->name('website.privacy.policy');
Route::get('/terms-and-conditions', [HomeController::class, 'terms_and_conditions'])->name('website.terms.and.conditions');
Route::post('/customer-feedback', [HomeController::class, 'submitFeedback'])->name('feedback.submit');
//Contact Route
Route::get('/contact-us', [HomeController::class, 'contact'])->name('website.contact');
Route::post('/contact/submit', [HomeController::class, 'contact_submit'])->name('website.contact.submit');

//Search Route
Route::get('/search', [HomeController::class, 'search'])->name('website.search');

//Cart Route
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add_to_cart'])->name('cart.add');
Route::put('/cart/increase-quantity/{rowId}', [CartController::class, 'increase_cart_quantity'])->name('cart.quantity.increase');
Route::put('/cart/decrease-quantity/{rowId}', [CartController::class, 'decrease_cart_quantity'])->name('cart.quantity.decrease');
Route::delete('/cart/cart-remove/{rowId}', [CartController::class, 'cart_remove'])->name('cart.remove');
Route::delete('/cart/empty-cart', [CartController::class, 'empty_cart'])->name('cart.empty');

//Apply Coupon Route
Route::post('/cart/apply-coupon', [CartController::class, 'apply_coupon_code'])->name('cart.coupon.apply');
Route::delete('/cart/remove-coupon', [CartController::class, 'remove_coupon_code'])->name('cart.coupon.remove');

//Wishlist Route
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/add/wishlist', [WishlistController::class, 'add_to_wishlist'])->name('wishlist.add');
Route::delete('/wishlist/remove/{rowId}', [WishlistController::class, 'remove_from_wishlist'])->name('wishlist.remove');
Route::delete('/wishlist/remove/shop/{rowId}', [ShopController::class, 'remove_from_wishlist'])->name('wishlist.remove.shop');
Route::delete('/wishlist/empty', [WishlistController::class, 'empty_wishlist'])->name('wishlist.empty');
Route::post('/wishlist/move-to-cut/{rowId}', [WishlistController::class, 'moveToCut'])->name('wishlist.moveToCut');

Route::post('/wishlist/toggle', [WishlistController::class, 'toggleWishlist'])->name('wishlist.toggle');
//Checkout Route
Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

//Order Route
Route::get('/order-confirmation', [CartController::class, 'order_confirmation'])->name('cart.order.confirmation');
Route::post('/place-an-order', [CartController::class, 'place_an_order'])->name('cart.place.an.order');


Route::middleware(['auth',])->group(function () {
    Route::get('/account-dashboard', [UserController::class, 'index'])->name('user.index');
    Route::get('/account-orders', [UserController::class, 'orders'])->name('user.orders');
    Route::get('/account-orders/{order_id}/order-details', [UserController::class, 'order_details'])->name('user.order.details');
    Route::put('/account-orders/cancel-order', [UserController::class, 'order_cancel'])->name('user.order.cancel');
    Route::get('/address', [UserController::class, 'address'])->name('user.address');
    Route::get('/address/add', [UserController::class, 'address_add'])->name('user.address.add');
    Route::put('/address/store', [UserController::class, 'address_store'])->name('user.address.store');
    Route::get('/address/edit/{id}', [UserController::class, 'address_edit'])->name('user.address.edit');
    Route::put('/address/update/{id}', [UserController::class, 'address_update'])->name('user.address.update');
    Route::put('/address/set-default/{id}', [UserController::class, 'set_default'])->name('user.address.set.default');
    Route::get('/account-details', [UserController::class, 'account_details'])->name('user.account.details');
    Route::put('/account-password/update/{id}', [UserController::class, 'account_details_update'])->name('user.account.password.update');
    Route::post('/review/store', [ReviewController::class, 'store'])->name('user.review.store');
});


Route::middleware(['auth', AuthAdmin::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    //Brands Route Start
    Route::get('/admin/brands', [BrandController::class, 'brands'])->name('admin.brands');
    Route::get('/admin/brands/add', [BrandController::class, 'add_brands'])->name('admin.brands.add');
    Route::post('/admin/brands/add', [BrandController::class, 'brand_store'])->name('admin.brands.store');
    Route::delete('/admin/brands/delete/{id}', [BrandController::class, 'destroyBrands'])->name('admin.brands.delete');
    Route::get('/admin/brands/edit/{id}', [BrandController::class, 'brand_edit'])->name('admin.brands.edit');
    Route::put('/admin/brands/update/{id}', [BrandController::class, 'brand_update'])->name('admin.brands.update');




    //Categories Route Start
    Route::get('/admin/categories', [CategoryController::class, 'categories'])->name('admin.categories');
    Route::get('/admin/categories/add', [CategoryController::class, 'category_add'])->name('admin.category.add');
    Route::post('/admin/categories/store', [CategoryController::class, 'category_store'])->name('admin.category.store');
    Route::get('/admin/categoris/edit/{id}', [CategoryController::class, 'category_edit'])->name('admin.category.edit');
    Route::put('/admin/categoris/update/{id}', [CategoryController::class, 'category_update'])->name('admin.category.update');
    Route::delete('/admin/categoris/delete/{id}', [CategoryController::class, 'destroyCategory'])->name('admin.categories.delete');




    //product route
    Route::get('/admin/products', [ProductController::class, 'products'])->name('admin.products');
    Route::get('/admin/products/add', [ProductController::class, 'product_add'])->name('admin.product.add');
    Route::post('/admin/products/store', [ProductController::class, 'products_store'])->name('admin.products.store');
    Route::get('/admin/products/{id}/edit', [ProductController::class, 'product_edit'])->name('admin.product.edit');
    Route::put('/admin/products/{id}/update', [ProductController::class, 'product_update'])->name('admin.product.update');
    Route::post('/admin/products/{product}/gallery/{image}/delete', [ProductController::class, 'deleteGalleryImage'])->name('admin.product.gallery.delete');
    Route::delete('/admin/product/{id}/delete', [ProductController::class, 'destroyProduct'])->name('admin.product.destroy');



    //Coupon Code Route
    Route::get('/admin/products/coupon-code', [CouponController::class, 'coupons'])->name('admin.coupons');
    Route::get('/admin/products/coupon-code/add', [CouponController::class, 'coupon_add'])->name('admin.coupons.add');
    Route::post('/admin/products/coupon-code/store', [CouponController::class, 'coupon_store'])->name('admin.coupon.store');
    Route::get('/admin/products/coupon-code/{id}/edit', [CouponController::class, 'coupon_edit'])->name('admin.coupon.edit');
    Route::put('/admin/products/coupon-code/{id}/update', [CouponController::class, 'coupon_update'])->name('admin.coupon.update');
    Route::delete('/admin/product/coupon-code/{id}/delete', [CouponController::class, 'coupon_destroy'])->name('admin.coupon.destroy');

    //Order Route
    Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::post('/admin/{id}/order-details', [AdminController::class, 'order_details'])->name('admin.order.details');
    Route::put('/admin/order/order-update-status', [AdminController::class, 'update_order_status'])->name('admin.order.update.status');

    //Slide Route
    Route::get('/admin/slides', [SlideController::class, 'slides'])->name('admin.slides');
    Route::get('/admin/slides/add', [SlideController::class, 'slide_add'])->name('admin.slide.add');
    Route::post('/admin/slides/store', [SlideController::class, 'slide_store'])->name('admin.slide.store');
    Route::get('/admin/slides/{id}/edit', [SlideController::class, 'slide_edit'])->name('admin.slide.edit');
    Route::put('/admin/slides/{id}/update', [SlideController::class, 'slide_update'])->name('admin.slide.update');
    Route::delete('/admin/slides/{id}/delete', [SlideController::class, 'destroySlide'])->name('admin.slide.destroy');

    //Contact Route
    Route::get('/admin/contact-us', [AdminController::class, 'contact'])->name('admin.contact');
    Route::delete('/admin/contact-us/{id}/delete', [AdminController::class, 'destroyContact'])->name('admin.contact.destroy');
    Route::get('/admin/contact-us/{id}/show', [AdminController::class, 'contact_show'])->name('admin.contact.show');
    Route::delete('/admin/contact-us/{id}/delete', [AdminController::class, 'destroy_contact'])->name('admin.contact.destroy');

    //search Route
    Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');
});
