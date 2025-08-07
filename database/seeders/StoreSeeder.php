<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Store as CoinStore;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!CoinStore::where('name', 'store')->exists()) {
            # code...
            CoinStore::create(
                [
                    'name' => 'store',
                    'coin' => 1,
                ]
            );
        }
        if (!CoinStore::where('name', 'donation')->exists()) {
            # code...
            CoinStore::create(
                [
                    'name' => 'donation',
                    'coin' => 1,
                ]
            );
        }
        if (!CoinStore::where('name', 'server_cost')->exists()) {
            # code...
            CoinStore::create(
                [
                    'name' => 'server_cost',
                    'coin' => 1,
                ]
            );
        }
    }
}
