<?php

namespace App\Services\Notification\Constants;

use App\Mail\ForgetPassword;
use App\Mail\TopicCreated;
use App\Mail\UserRegistered;

class EmailTypes
{
    const TOPIC_CREATED = 1;
    const USER_REGISTERED = 2;
    const FORGET_PASSWORD = 3;

    public static function toString()
    {
        return [
            self::TOPIC_CREATED => 'ایجاد تاپیک',
            self::USER_REGISTERED => 'ثبت نام کاربر',
            self::FORGET_PASSWORD => 'فراموشی رمز عبور',
        ];
    }

    public static function toMail($mailType)
    {
        try {
            return [
                self::TOPIC_CREATED => TopicCreated::class,
                self::USER_REGISTERED => UserRegistered::class,
                self::FORGET_PASSWORD => ForgetPassword::class,
            ][$mailType];
        } catch (\Throwable $th) {
            throw new \InvalidArgumentException('Mailable Class does not exist');
        }
    }
}
