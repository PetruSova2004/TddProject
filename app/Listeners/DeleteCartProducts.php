<?php

namespace App\Listeners;

use App\Events\TokenCookieExpired;
use App\Models\Cart;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeleteCartProducts
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TokenCookieExpired $event): void
    {
        $user_id = $event->user->id;

        Cart::query()->where('user_id', $user_id)->delete();
    }
}
