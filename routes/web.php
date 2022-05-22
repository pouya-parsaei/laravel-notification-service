<?php

use App\Http\Controllers\NotificationController;
use App\Mail\TopicCreated;
use App\Mail\UserRegistered;
use App\Models\User;
use App\Services\Notification\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

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

Route::get('/send-email', function () {
    $notification = resolve(Notification::class);
    $notification->sendEmail(User::first(),new TopicCreated);
});

Route::get('/send-sms', function () {
    $notification = resolve(Notification::class);
    $notification->sendSms(User::first(),'تست');
});

Route::get('send-email',[NotificationController::class,'email'])->name('notification.form.email');
Route::post('send-email',[NotificationController::class,'sendEmail'])->name('notification.send.email');
Route::get('send-sms',[NotificationController::class,'sms'])->name('notification.form.sms');
Route::post('send-sms',[NotificationController::class,'sendSms'])->name('notification.send.sms');
