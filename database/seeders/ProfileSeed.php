<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'name' => 'Administrador'],
            ['id' => 2, 'name' => 'Usuário'],
        ];

        foreach ($data as $row) {
            Profile::create($row);
        }
    }
}
