<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Note;
use Carbon\Carbon;

use App\Models\Image;


class Testini extends Controller
{

    public function index()
    {

        $images = Image::where('original_filename', 'data.jpg')
            ->get();

        showNice($images);

        /* 
        $notesDateLimit = Note::whereNotNull('date_limit')->get();

        $datetime1 = date_create($notesDateLimit[0]->date_limit);
        $datetime2 = date_create(date('Y-m-d'));
        $datetime3 = date_create('1982-11-18');

        $interval = date_diff($datetime2, $datetime3);

        showNice($datetime3->format('l jS \o\f F Y'));

        foreach ($notesDateLimit as $noteDateLimit) {

            echo date('Y-m-d');
            showNice($noteDateLimit->date_limit, 'date_limit');
        } */
    }
}
