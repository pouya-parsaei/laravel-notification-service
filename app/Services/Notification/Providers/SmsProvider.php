<?php

namespace App\Services\Notification\Providers;

use App\Models\User;
use App\Services\Notification\Exceptions\MobileIsNullException;

class SmsProvider implements Contract\Provider
{

    public function __construct(private User $user, private string $text)
    {

    }

    public function send()
    {
        $this->checkMobile();

        echo 'sms to ' . $this->user->mobile . ' was sent.' . 'text:' . '<br/>' . $this->text;
    }

    private function checkMobile()
    {
        if(is_null($this->user->mobile))
            throw new MobileIsNullException('This user has not any mobiel number');

    }
}
