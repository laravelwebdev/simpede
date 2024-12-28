<?php

namespace App\Console\Commands;

use App\Helpers\Fonnte;
use App\Helpers\Helper;
use App\Models\DaftarReminder;
use App\Models\UnitKerja;
use App\Models\User;
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
            $kegiatan = $reminder->daftarKegiatan;
            $hari = $kegiatan->awal->diffInDays($reminder->tanggal);
            $pesan = strtr($kegiatan->pesan, [
                '{judul}' => '[Reminder Deadline (H'.$hari.')]',
                '{tanggal}' => Helper::terbilangTanggal($kegiatan->awal),
                '{kegiatan}' => $kegiatan->kegiatan,
                '{pj}' => $kegiatan->daftar_kegiatanable_type == 'App\Models\UnitKerja' ? UnitKerja::find($kegiatan->daftar_kegiatanable_id)->unit : User::find($kegiatan->daftar_kegiatanable_id)->name,
            ]);
            $response = Fonnte::make()->sendWhatsAppMessage($kegiatan->wa_group_id, $pesan);
            $reminder->status = $response['data']['process'] ?? 'Gagal';
            $reminder->message_id = $response['data']['id'][0];
            $reminder->save();
        }
    }
}
