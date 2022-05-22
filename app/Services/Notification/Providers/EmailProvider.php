<?php

namespace App\Services\Notification\Providers;

use App\Models\User;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class EmailProvider implements Contract\Provider
{

    public function __construct(private User $user, private Mailable $mailable)
    {

    }

    public function send()
    {
        Mail::to($this->user->email)->send($this->mailable);
    }
}
