<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\AdvertController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DisputeController;
use App\Http\Controllers\Admin\FinanceController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SupportController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SecurityController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ShipmentController;
use App\Http\Controllers\Admin\ComplianceController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Admin\ProductAttributeController;


    Route::get('login',[LoginController::class,'showLoginForm'])->name('login');
    Route::post('login',[LoginController::class,'login'])->name('login');
    //password request and reset
    Route::post('password/email',[ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset',[ForgotPasswordController::class,'showLinkRequestForm'])->name('password.request');
    Route::post('password/reset',[ResetPasswordController::class,'reset'])->name('password.update');
    Route::get('password/reset/{token}',[ResetPasswordController::class,'showResetForm'])->name('password.reset');

    Route::group(['middleware'=> ['auth','admin']],function(){
        
        Route::get('change_password',[LoginController::class, 'force_password_change_form'] )->name('forcepasswordchange');
        Route::post('changed_password',[LoginController::class, 'force_password_change'] )->name('forcepassword');
        Route::post('logout',[LoginController::class,'logout'])->name('logout');
        //email verification
        Route::post('email/resend',[VerificationController::class,'resend'])->name('verification.resend');
        Route::get('email/verify',[VerificationController::class,'show'])->name('verification.notice');
        Route::get('email/verify/{id}/{hash}',[VerificationController::class,'verify'])->name('verification.verify');
        //password confirmation
        Route::get('password/confirm',[ConfirmPasswordController::class,'showConfirmForm'])->name('password.confirm');
        Route::post('password/confirm',[ConfirmPasswordController::class,'confirm']);
        Route::post('password/confirm',[ConfirmPasswordController::class,'confirm']);
            
        Route::group(['middleware'=> ['forcepassword']],function(){
            Route::get('dashboard',[HomeController::class, 'index'])->name('dashboard');
            
            Route::group(['prefix'=> 'users','as'=>'users.'],function(){
                Route::get('/',[UserController::class, 'index'])->name('index');
                Route::get('show/{user}',[UserController::class, 'show'])->name('show');
                Route::post('manage',[UserController::class, 'manage'])->name('manage');
            });
            Route::group(['prefix'=> 'stores','as'=>'stores.'],function(){
                Route::get('/',[StoreController::class, 'index'])->name('index');
                Route::view('list','stores.list')->name('list');
                Route::get('show/{shop}',[StoreController::class, 'show'])->name('show');
                Route::post('manage',[StoreController::class, 'manage'])->name('manage');
                Route::post('kyc', [StoreController::class, 'kyc'])->name('kyc');
            });
            Route::group(['prefix'=> 'orders','as'=>'orders.'],function(){
                Route::get('/',[OrderController::class, 'index'])->name('index');
                Route::get('show/{order}',[OrderController::class, 'show'])->name('show');
                Route::post('update',[OrderController::class, 'update'])->name('update');
                Route::post('message/',[OrderController::class, 'message'])->name('message');
            });
            Route::group(['prefix'=> 'products','as'=>'products.'],function(){
                Route::get('/',[ProductController::class, 'index'])->name('index');
                Route::get('show/{product}',[ProductController::class, 'show'])->name('show');
                Route::post('manage',[ProductController::class, 'manage'])->name('manage');
            });
            Route::group(['prefix'=> 'coupons','as'=>'coupons.'],function(){
                Route::get('/',[CouponController::class, 'list'])->name('list');
                Route::post('store',[CouponController::class, 'store'])->name('store');
                Route::post('update',[CouponController::class, 'update'])->name('update');
                Route::post('delete',[CouponController::class, 'destroy'])->name('delete');
            });
            Route::group(['prefix'=> 'adverts','as'=>'adverts.'],function(){
                Route::get('/',[AdvertController::class, 'index'])->name('index');
                Route::get('adsets',[AdvertController::class, 'adsets'])->name('adsets');
                Route::post('manage',[AdvertController::class, 'manage'])->name('manage');
            });
            Route::group(['prefix'=> 'shippers','as'=>'shippers.'],function(){
                Route::get('/',[ShipmentController::class, 'shippers'])->name('index');
                Route::get('show/{shipper}',[ShipmentController::class, 'shipper'])->name('show');
                Route::post('manage',[ShipmentController::class, 'shipper_manage'])->name('manage');
            });
            Route::group(['prefix'=> 'shipments','as'=>'shipments.'],function(){
                Route::get('/',[ShipmentController::class, 'index'])->name('index');
                Route::get('rates',[ShipmentController::class,'rates'])->name('rates');
                Route::post('store',[ShipmentController::class,'store'])->name('store');
                Route::post('update',[ShipmentController::class,'update'])->name('update');
                Route::post('destroy',[ShipmentController::class,'destroy'])->name('delete');
                Route::post('process',[ShipmentController::class, 'process'])->name('process');
            });
            Route::group(['prefix' => 'compliance', 'as' => 'compliance.'], function() {
                Route::group(['prefix' => 'submissions', 'as' => 'submissions.'], function() {
                    Route::get('/', [ComplianceController::class, 'index'])->name('index');
                    Route::get('show/{submission}', [ComplianceController::class, 'show'])->name('show');
                    Route::post('update', [ComplianceController::class, 'update'])->name('update');
                });
            });
            Route::group(['prefix'=> 'disputes','as'=>'disputes.'],function(){
                Route::get('/',[DisputeController::class, 'index'])->name('index');
                Route::get('show/{dispute}',[DisputeController::class, 'show'])->name('show');
                Route::post('message/',[DisputeController::class, 'message'])->name('message');
                Route::post('update',[DisputeController::class, 'update'])->name('update');
                Route::post('resolution',[DisputeController::class, 'resolution'])->name('resolution');
            });
            Route::group(['prefix' => 'support', 'as' => 'support.'], function () {
                Route::group(['prefix'=> 'tickets','as'=> 'tickets.'],function(){
                    Route::view('index','support.tickets.index')->name('index');
                    Route::view('show/{id}','support.tickets.view')->name('view');
                    Route::post('comment/{id}', [SupportController::class, 'addComment'])->name('comment');
                });
            });
            Route::group(['prefix'=> 'finance','as'=> 'finance.'],function(){
                Route::get('payments',[FinanceController::class,'payments'])->name('payments');
                Route::post('payments/export', [FinanceController::class, 'exportPayments'])->name('payments.export');
                Route::get('invoice/{payment}',[PaymentController::class, 'invoice'])->name('invoice');
                Route::get('invoice/{payment}/download',[PaymentController::class, 'invoice_download'])->name('invoice.download');
                Route::get('invoice/{payment}/receipt',[PaymentController::class, 'receipt'])->name('receipt'); 
                Route::get('withdrawals',[FinanceController::class,'withdrawals'])->name('withdrawals');
                Route::get('withdrawals/show/{withdrawal}',[FinanceController::class,'withdrawal_show'])->name('withdrawal.show');
                Route::post('withdrawals/payout',[FinanceController::class,'withdrawal_payout'])->name('withdrawal.payout');
                Route::get('withdrawals/export', [FinanceController::class, 'exportWithdrawals'])->name('withdrawals.export');

                Route::get('settlements',[FinanceController::class,'settlements'])->name('settlements');
                Route::post('settlements/export', [FinanceController::class, 'exportSettlements'])->name('settlements.export');

                Route::get('revenues',[FinanceController::class,'revenues'])->name('revenues');
                Route::get('revenues/show/{revenue}',[FinanceController::class,'revenue_show'])->name('revenue.show');
                Route::post('payouts/manage',[FinanceController::class, 'update'])->name('payouts.manage');
            });
            Route::group(['prefix'=> 'settings','as' => 'settings.'],function (){
                Route::get('/', [SettingsController::class,'index'])->name('index');
                Route::post('store', [SettingsController::class,'store'])->name('store');

                Route::group(['prefix'=> 'countries','as'=> 'countries.'],function(){
                    Route::get('/', [CountryController::class,'index'])->name('index');
                    Route::get('financials/{country}', [CountryController::class,'financials'])->name('financials');
                    Route::post('financial-gateway', [CountryController::class,'financial_gateway'])->name('financials.gateway');
                    Route::post('financial-banking', [CountryController::class,'financial_banking'])->name('financials.banking');
                    
                    Route::get('subscription-plans/{country}', [CountryController::class,'subscription_plan'])->name('subscription_plans');
                    Route::post('store/subscription-plan', [CountryController::class,'store_subscription_plan'])->name('subscription_plan.store');
                    Route::post('update/subscription-plan', [CountryController::class,'update_subscription_plan'])->name('subscription_plan.update');
                    
                    Route::get('ad-plans/{country}', [CountryController::class,'ad_plan'])->name('ad_plans');
                    Route::post('update/ad-plan', [CountryController::class,'updateAdPlan'])->name('update.ad_plan');
                    Route::get('newsletter-plans/{country}', [CountryController::class,'newsletter_plan'])->name('newsletter_plans');
                    Route::post('update/newsletter-plan', [CountryController::class,'updateNewsletterPlan'])->name('update.newsletter_plan');
                    
                    Route::get('verification/{country}', [CountryController::class,'verifications'])->name('verifications');
                    Route::post('update/verification', [CountryController::class,'updateVerification'])->name('update.verifications');
                });

                Route::group(['prefix'=> 'roles','as'=> 'roles.'],function(){
                    Route::get('/', [SettingsController::class,'roles'])->name('index');
                    Route::post('store',[SettingsController::class,'store_role'] )->name('store'); 
                    Route::post('update', [SettingsController::class,'update_role'])->name('update');
                    Route::post('delete', [SettingsController::class,'destroy_role'])->name('delete');
                });
                
                Route::group(['prefix'=> 'staff','as'=> 'staff.'],function(){
                    Route::get('/', [UserController::class,'admin'])->name('index');
                    Route::post('store',[UserController::class,'store'] )->name('store'); 
                    Route::post('update', [UserController::class,'update'])->name('update');
                    Route::post('delete', [UserController::class,'destroy'])->name('delete');
                });
    
                Route::group(['prefix'=> 'newsletters','as'=> 'newsletters.'],function(){
                    Route::get('/', [NewsletterController::class,'index'])->name('index');
                    Route::post('store', [NewsletterController::class,'store'])->name('store');
                    Route::post('update', [NewsletterController::class,'update'])->name('update');
                });

                

                Route::group(['prefix'=> 'categories','as'=> 'categories.'],function(){
                    Route::get('/',[CategoryController::class,'index'])->name('index');
                    Route::post('store',[CategoryController::class,'store'])->name('store');
                    Route::post('update',[CategoryController::class,'update'])->name('update');
                    Route::post('destroy',[CategoryController::class,'destroy'])->name('destroy');
                });

                // Admin routes for product attributes
                Route::group(['prefix'=> 'attributes','as'=> 'attributes.'],function(){
                    Route::get('/', [ProductAttributeController::class, 'index'])->name('index');
                    Route::post('store', [ProductAttributeController::class, 'store'])->name('store');
                    Route::post('update', [ProductAttributeController::class, 'update'])->name('update');
                    Route::post('destroy', [ProductAttributeController::class, 'destroy'])->name('destroy');
                });

                Route::group(['prefix'=> 'security','as'=> 'security.'],function(){
                    Route::get('/',[SecurityController::class,'index'])->name('index');
                    Route::post('store',[SecurityController::class,'store'])->name('store');
                    Route::post('update',[SecurityController::class,'update'])->name('update');
                    Route::post('delete',[SecurityController::class,'destroy'])->name('delete');
                });

               

            });
            Route::group(['prefix'=> 'security','as'=> 'security.'],function(){
                Route::group(['prefix'=> 'api','as'=> 'api.'],function(){
                    Route::get('keys',[SecurityController::class,'api_keys'])->name('keys');
                    Route::get('logs',[SecurityController::class,'access_logs'])->name('logs');
                });
                Route::group(['prefix'=> 'monitoring','as'=> 'monitoring.'],function(){
                    Route::get('ips',[SecurityController::class,'ips'])->name('ips');
                    Route::get('users',[SecurityController::class,'users'])->name('users');
                    Route::get('stores',[SecurityController::class,'stores'])->name('stores');  
                });

                Route::get('security',[SecurityController::class, 'index'])->name('security');
                Route::post('security/ipaddress/block',[SecurityController::class, 'ip_block'])->name('security.ip_block');
                Route::post('security/ipaddress/release',[SecurityController::class, 'ip_release'])->name('security.ip_release');

            });
            Route::group(['middleware'=> 'permission:settings'],function(){
                
            });
            
            Route::get('vendors', [StoreController::class, 'index'])->name('vendors');
            Route::get('vendors/{shop}', [StoreController::class, 'show'])->name('vendor.show');
            Route::get('vendor/follow/{shop}',[SalesController::class, 'follow'])->name('vendor.follow');
            Route::get('vendor/unfollow/{shop}',[SalesController::class, 'unfollow'])->name('vendor.unfollow');

            Route::get('receipt/{payout}',[PaymentController::class, 'receipt'])->name('receipt');

        });
    });
