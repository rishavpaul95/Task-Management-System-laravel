<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Leads;
use App\Mail\DailyUpdateMail;
use Illuminate\Support\Facades\Mail;

class SendDailyUpdates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:daily-updates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily updates to leads';

    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $leads = Leads::where('daily_updates', 1)->get();

        foreach ($leads as $lead) {
            Mail::to($lead->email)->send(new DailyUpdateMail($lead));
        }
    }
}
