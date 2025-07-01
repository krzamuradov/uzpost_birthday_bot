<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramController extends Controller
{
    protected $token;
    protected $chat_id;
    protected $url;

    public function __construct()
    {
        $this->token = config('telegram.token');
        $this->url = config("telegram.url") . $this->token;
        $this->chat_id = config("telegram.chat_id");
    }
    public function sendMessage()
    {
        $today = Carbon::today()->format("d.m.Y");
        $photoPath = storage_path('app/private/birthday.webp');
        $members = Member::whereDay('birthday_at', today()->day)
            ->whereMonth('birthday_at', today()->month)
            ->where("is_active", true)
            ->get();

        $congratulation = "Сегодня/Bugun {$today} \nС днём рождения / Tug'ilgan kuningiz muborak \n\n";

        $caption = $congratulation . $members->map(function ($m) {
            return '✅ ' . $m->lastname . ' ' . $m->firstname . ' ' . $m->middlename;
        })->implode("\n\n");

        $response = Http::attach(
            'photo',
            file_get_contents($photoPath),
            basename($photoPath)
        )->post($this->url . '/sendPhoto', [
            'chat_id' => $this->chat_id,
            'caption' => $caption,
        ]);
    }
}
