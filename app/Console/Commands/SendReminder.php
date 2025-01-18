<?php

namespace App\Console\Commands;

use App\Helpers\Helper;
use App\Models\DaftarReminder;
use Illuminate\Console\Command;

class SendReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Scheduled Reminders';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tanggal = date('Y-m-d');
        $reminders = DaftarReminder::with('daftarKegiatan')->where('tanggal', $tanggal)->where('status', '!=', 'sent')->get();
        foreach ($reminders as $reminder) {
            Helper::sendReminder($reminder);
        }
    }
}
