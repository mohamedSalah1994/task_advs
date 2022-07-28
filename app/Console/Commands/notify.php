<?php

namespace App\Console\Commands;

use App\Mail\NotifyEmail;
use Carbon\Carbon;
use App\Models\Adv;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class notify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $after_day =  (Carbon::now())->addDays(0);
        $after_2_days =  (Carbon::now())->addDays(1);

        $advertisers =  Adv::whereBetween('start_date',[$after_day , $after_2_days])->select('advertiser_email')->get();
        $emails = Adv::whereBetween('start_date',[$after_day , $after_2_days])->pluck('advertiser_email')->toArray();

        $data = [
            'title' => 'Advertise' ,
            'body' => 'your advertise will be start tomorrow'
        ];

        foreach($emails as $email){
            Mail::To($email) ->send(new NotifyEmail($data));
        }
        
    }
}
