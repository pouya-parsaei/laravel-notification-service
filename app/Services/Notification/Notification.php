<?php

namespace App\Services\Notification;

use App\Services\Notification\Providers\Contract\Provider;
use Exception;

/**
 * @method sendSms(\App\Models\User $user, string $text)
 * @method sendEmail(\App\Models\User $user, \Illuminate\Mail\Mailable $mailable)
*/

class Notification
{
    public function __call($method,$arguments)
    {
        $providerPath = __NAMESPACE__ . '\Providers\\' . substr($method,4) . 'Provider';
        if(!class_exists($providerPath))
            throw new Exception('Class ' . $providerPath . ' does not exist',1);

        $providerInstance = new $providerPath(... $arguments);
        if(!is_subclass_of($providerInstance,Provider::class))
            throw new Exception('Class ' . $providerPath . ' must implement ' .get_class(Provider::class),1);

        $providerInstance->send();
    }
}
