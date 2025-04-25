<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\user_has_refs;

class SystemRefsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $system = User::where('email', 'admin247@selpoint.com')->first();
        if ($system) {

            /**
             * system has it's own reffer code 
             */
            user_has_refs::create(
                [
                    'user_id' => $system->id,
                    'ref' => config('app.ref'),
                    'status' => 1
                ]
            );

            // $system->syncRole($systemRole);
        }
    }
}
