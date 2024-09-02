<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\User;
use App\Models\Note;

use App\Models\Image;
use App\Services\ImageService;

use App\Notifications\Reminder;

// Collection
use Illuminate\Database\Eloquent\Collection;

class NotifyUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Search for the notes that have a date limit and this date is bigger than today. Send Notification by email with the date limit and the remaining days to the deadline.';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $notesDateLimit = Note::whereNotNull('date_limit')
            ->where('date_limit', '>=', date('Y-m-d'))
            ->get();

        foreach ($notesDateLimit as $note) {

            $user = User::find($note->user_id);

            $images = Image::where('note_id', $note->id)
                ->get();

            $interval = datesInterval($note->date_limit);

            $dateLimit = date_create($note->date_limit)->format('l jS \o\f F Y');

            $message["header"] = "Hey, {$user->name}";
            $message["body"] = "You have a note {$note->title} with a date limit at {$dateLimit} deadline is in {$interval->days} days.";
            $message["info"] = "Note Info: {$note->info}";

            $user->notify(new Reminder($message, $images));
        }


        //dd('mire usted');
    }
}
