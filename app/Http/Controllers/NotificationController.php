<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendEmailRequest;
use App\Http\Requests\sendSmsRequest;
use App\Jobs\SendEmail;
use App\Jobs\SendSms;
use App\Models\User;
use App\Services\Notification\Constants\EmailTypes;
use App\Services\Notification\Exceptions\MobileIsNullException;
use App\Services\Notification\Notification;

class NotificationController extends Controller
{
    public function email()
    {
        $users = User::select(['id', 'name'])->get();
        $emailTypes = EmailTypes::toString();

        return view('notifications.email', compact('users', 'emailTypes'));
    }

    public function sendEmail(SendEmailRequest $request)
    {
        try {
            $mailable = EmailTypes::toMail($request->email_type);
            SendEmail::dispatch(User::find($request->user), new $mailable);
            return $this->redirectBack('success', __('notification.messages.email-sent'));
        } catch (\Throwable $th) {
            return $this->redirectBack('failed', __('notification.errors.sending-email-failed'));
        }
    }

    public function sms()
    {
        $users = User::select(['id', 'name'])->get();

        return view('notifications.send-sms', compact('users'));
    }

    public function sendSms(SendSmsRequest $request)
    {
        try {
            SendSms::dispatch(User::find($request->user), $request->text);
        } catch (MobileIsNullException $e) {
            return $this->redirectBack('failed', __('notification.errors.user-has-not-mobile'));
        } catch (\Exception $e){
            return $this->redirectBack('failed', __('notification.errors.failed-to-send-sms'));
        }
    }

    private function redirectBack(string $status,string $message)
    {
        return redirect()->back()->with($status, $message);
    }
}
