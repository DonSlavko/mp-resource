<?php

use Illuminate\Support\Facades\Route;
Route::get('/', 'Auth\LoginController@showLoginForm')->name('home');
Route::post('/exists', 'Auth\RegisterController@checkIfExists');


Route::post('webhooks', 'Frontend\PaymentController@handleWebhookNotification')->name('webhooks');



Route::namespace('Frontend')->group(function () {
    Route::get('/agb', 'LandingController@agb')->name('inc.agb');
    Route::get('/datenschutzerklaerung', 'LandingController@dat')->name('inc.dat');
    Route::get('/impressum', 'LandingController@imp')->name('inc.imp');
});

Auth::routes(['verify' => true]);

Route::middleware(['auth','verified'])->group(function () {

    Route::namespace('Frontend')->name('user.')->group(function () {
        Route::get('neuigkeiten', 'UserController@news')->name('news');
        Route::get('shop', 'UserController@shop')->name('shop');
        Route::get('shop/product/{product}', 'UserController@product')->name('shop.product');
        Route::get('vorbestellungen/my-pre-orders', 'UserController@preorder')->name('preorder');
        Route::get('warenkorb', 'UserController@cart')->name('cart');
        Route::get('dashboard', 'UserDashboardController@index')->name('dashboard');
        Route::get('delete-account', 'UserDashboardController@delete')->name('delete.account');
        Route::post('user/update', 'UserDashboardController@update')->name('profile.update');
        Route::post('add_to_newsletter','UserController@add_to_newsletter')->name('add_to_newsletter');

        Route::get('payment', 'PaymentController@preparePayment')->name('payment');
        Route::get('payment_success', 'PaymentController@orderSuccess')->name('order.success');
    });

    Route::middleware(['isAdmin'])->group(function () {
        Route::namespace('Frontend\Admin')->prefix('admin')->name('admin.')->group(function () {
            Route::resource('product', 'ProductController');
            Route::resource('attribute', 'AttributeController');
            Route::resource('attribute-value','AttributeValueController');
            Route::resource('variation', 'VariationController');
            Route::resource('brand','BrandController');
            Route::resource('variation-value', 'VariationValueController');
            Route::resource('user', 'UserController');
            Route::resource('order', 'OrderController');
            Route::get('newsletterindex','NewsletterController@index')->name('newsletterindex');
            Route::get('newsletter_list','NewsletterController@list')->name('newsletter_list');
            Route::post('SendNewsletterEmail','NewsletterController@SendNewsletterEmail')->name('SendNewsletterEmail');
            Route::resource('category', 'CategoryController');

            Route::get('call-service', 'CallServiceController@index')->name('call-service');

        });

        Route::namespace('Backend')->prefix('back')->name('back.')->group(function () {
            Route::resource('users', 'UserController');
            Route::resource('categories', 'CategoryController');
            Route::resource('variations', 'VariationController');
            Route::resource('variation-values', 'VariationValueController');
            Route::resource('attributes', 'AttributeController');
            Route::resource('attribute-values', 'AttributeValueController');
            Route::resource('products', 'ProductController');
            Route::resource('brands','BrandController');
            Route::resource('orders', 'OrderController');

            Route::post('orders/{order}/approve', 'OrderController@approve');
            Route::post('orders/{order}/denied', 'OrderController@denied');

            route::get('call-service', 'CallServiceController@index');
            route::post('call-service', 'CallServiceController@store');

            Route::post('update-products/{id?}', 'ProductController@update')->name('update.product');
            Route::delete('products-delete/{id}','ProductController@destroy')->name('products-delete');
            Route::post('users/{user}/activate', 'UserController@activate');
            Route::post('users/{user}/deactivate', 'UserController@deactivate');
            Route::get('deleteUsers', 'UserController@deleteAllUsers');
            Route::post('users/{user}/delete', 'UserController@delete');
            Route::get('declinedUsers', 'UserController@declinedUsers');
            Route::post('update-products/{id?}', 'ProductController@update')->name('update.product');
            Route::delete('products-delete/{id}','ProductController@destroy')->name('products-delete');
            Route::post('users/{user}/activate', 'UserController@activate');
            Route::post('users/{user}/deactivate', 'UserController@deactivate');
            Route::post('multiselect','FilterController@multiselect')->name('multiselect');
        });
    });

    Route::namespace('Backend')->prefix('back')->name('back.')->group(function () {
        Route::get('shop', 'ShopController@index');
        Route::get('brandfilter','FilterController@brandfilter');
        Route::get('categories_filter','FilterController@categories_filter');
        Route::get('variation_list','FilterController@variation_list');
        Route::get('filterproduct/{id}','FilterController@filterproduct');
        Route::get('category_filter/{id}','FilterController@category_filter');
        Route::get('variation_filter/{id}','FilterController@variation_filter');
        Route::get('sorting/{value}','FilterController@sorting');
        Route::get('views_sorting/{value}','FilterController@views_sorting');
        Route::get('getcount','ShopController@getcount');
        Route::get('shop/{product}', 'ShopController@show');
        Route::get('in-cart', 'ShopController@inCart');
        Route::post('add-to-cart', 'ShopController@addToCart');
        Route::delete('remove-from-cart/{cart}', 'ShopController@removeFromCart');
        Route::post('make-order', 'ShopController@makeOrder');
        Route::get('get-orders', 'ShopController@getOrders');

        Route::get('user/orders', 'UserController@userOrders');
        Route::get('user/payments', 'UserController@userPaymentStatus');

        Route::post('move-to-order', 'ShopController@moveToOrder');
    });
});
