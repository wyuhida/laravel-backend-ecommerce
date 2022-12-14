<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\FavouriteController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ProductCartController;
use App\Http\Controllers\Admin\ProductDetailsController;
use App\Http\Controllers\Admin\ProductListController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SiteInfoController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\ForgetController;
use App\Http\Controllers\User\ResetController;
use App\Http\Controllers\User\UserController;
use App\Models\ProductCart;
use Illuminate\Support\Facades\Route;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//////////////////////////// USER /////////////////////////////

//login
Route::post('/login',[AuthController::class,'Login']);

//register
Route::post('/register',[AuthController::class,'Register']);

//forgot password
Route::post('/forgetpassword',[ForgetController::class,'ForgetPassword']);
// reset password
Route::post('/resetpassword',[ResetController::class,'ResetPassword']);

// current user route
Route::get('/user',[UserController::class,'User'])->middleware('auth:api');



//////////////////////////// END USER /////////////////////////////

Route::get('/getvisitor',[VisitorController::class,'GetVisitorDetails']);

//CONTACT
Route::post('/postcontact',[ContactController::class,'PostContactDetails']);

//SITE INFO
Route::get('/allsiteinfo',[SiteInfoController::class,'AllSiteInfo']);

//Category all
Route::get('/allcategory',[CategoryController::class,'AllCategory']);

//Product
Route::get('/productlistbyremark/{remark}',[ProductListController::class,'ProductListByRemark']);
Route::get('/productlistbycategory/{category}',[ProductListController::class,'ProductListByCategory']);
Route::get('/productlistbysubcategory/{category}/{subcategory}',[ProductListController::class,'ProductListBySubCategory']);

//slider
Route::get('/allslider',[SliderController::class,'AllSlider']);

//product details
Route::get('/productdetails/{id}',[ProductDetailsController::class,'ProductDetails']);

//Notification
Route::get('/notification',[NotificationController::class,'NotificationHistory']);

//Search
Route::get('/search/{key}',[ProductListController::class,'ProductBySearch']);

// similar product
Route::get('/similar/{subcategory}',[ProductListController::class,'SimilarProduct']);


//product cart
Route::post('/addtocart',[ProductCartController::class,'addToCart']);

//product cart count
Route::get('/cartcount/{email}',[ProductCartController::class,'CartCount']);

//Favourite
Route::get('/favourite/{product_code}/{email}',[FavouriteController::class,'AddFavourite']);

// favourite list
Route::get('/favouritelist/{email}',[FavouriteController::class,'FavouriteList']);

// remove favourite
Route::get('/favouriteremove/{product_code}/{email}',[FavouriteController::class,'FavouriteRemove']);

//cart list
Route::get('/cartlist/{email}',[ProductCartController::class,'CartList']);

// remove cart
Route::get('/removecartlist/{id}',[ProductCartController::class,'RemoveCartList']);

//cart item plus
Route::get('/cartitemplus/{id}/{quantity}/{price}',[ProductCartController::class,'CartItemPlus']);

//cart item minus
Route::get('/cartitemminus/{id}/{quantity}/{price}',[ProductCartController::class,'CartItemMinus']);

//cart order
Route::post('/cartorder',[ProductCartController::class,'CartOrder']);

//order list by user
Route::get('/orderlistbyuser/{email}',[ProductCartController::class,'OrderListByUser']);

//post product review
Route::post('/postreview',[ReviewController::class,'PostReview']);

// Review Product Route
Route::get('/reviewlist/{product_code}',[ReviewController::class,'ReviewList']);