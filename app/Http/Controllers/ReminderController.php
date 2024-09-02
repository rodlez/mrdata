<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Note;
use App\Models\User;
use App\Notifications\Reminder;


class ReminderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::find(1);

        $message["header"] = "Hey, Happy Birthday {$user->name}";
        $message["body"] = "On behalf of the entire company I wish you a very happy birthday and send you my best wishes for much happiness in your life.";

        $user->notify(new Reminder($message));

        dd('Done');
    }
}
