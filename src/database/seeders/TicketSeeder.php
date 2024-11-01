<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ticket;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen(base_path('database/seeders/data/obake-tickets.csv'), 'r');
        $firstLine = true;

        try {
            while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
                if (!$firstLine) {
                    Ticket::create([
                        'id' => $data[0],
                        'event_date' => $data[1],
                        'sale_start_time' => $data[2],
                        'end_time' => $data[3],
                        'title' => $data[4],
                        'balance' => $data[5],
                    ]);
                }
                $firstLine = false;
            }
            fclose($file);
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
