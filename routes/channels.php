<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('pop-up_user.{userId}', function ($user, $userId) {
    return $user->id === (int)$userId;
});

Broadcast::channel('notification_user.{userId}', function ($user, $userId) {
    return $user->id === (int)$userId;
});
