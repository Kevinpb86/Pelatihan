<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use Carbon\Carbon;
use App\Models\Fine;

class AutoCompleteBookings extends Command
{
    protected $signature = 'bookings:auto-complete';
    protected $description = 'Otomatis menyelesaikan booking yang sudah melewati waktu end_time';

    public function handle()
    {
        $bookings = Booking::where('status', 'active')->get();
        $now = Carbon::now();

        if ($bookings->isEmpty()) {
            $this->info('Tidak ada booking aktif yang perlu dicek.');
            return;
        }

        $count = 0;
        $fined = 0;
        $completed = 0;

        foreach ($bookings as $booking) {
            $minutesLate = Carbon::parse($booking->end_time)->diffInMinutes($now);

            if ($minutesLate > 0 && $minutesLate < 1440 && !$booking->fine) {
                $fineAmount = ($minutesLate / 60) * 10000; // misal 10rb per jam
                Fine::create([
                    'booking_id' => $booking->id,
                    'amount' => round($fineAmount, 2),
                    'hours_late' => $minutesLate / 60,
                ]);
                $fined++;
            } elseif ($minutesLate >= 1440) {
                $booking->update(['status' => 'completed']);
                $booking->unit->update(['status' => 'available']);
                $completed++;
            }

            $count++;
        }

        $this->info("✅ {$count} booking dicek | {$fined} kena denda | {$completed} auto completed.");
    } 
}
