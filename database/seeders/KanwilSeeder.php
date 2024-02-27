<?php

namespace Database\Seeders;

use App\Models\Kanwil;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KanwilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kanwil::create([
            'id' => 'K11',
            'nama' => 'PROVINSI DKI JAKARTA'
        ]);
    }
}
