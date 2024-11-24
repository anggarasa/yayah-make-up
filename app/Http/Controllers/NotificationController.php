<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\NotificationEvent;

class NotificationController extends Controller
{
    public function sendNotification(Request $request)
    {
        $message = $request->input('message');
        
        // Trigger event
        event(new NotificationEvent($message));

        return response()->json(['status' => 'Notification sent']);
    }
}
