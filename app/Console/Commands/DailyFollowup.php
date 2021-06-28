<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Followup_log;
use App\User;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Env;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use Illuminate\Http\JsonResponse;
class DailyFollowup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Daily:followup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Today and tomorrow send followup mail';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public $MailController;
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // send mail for followup seduler
        send_mail_for_new_followup();
    }
}
