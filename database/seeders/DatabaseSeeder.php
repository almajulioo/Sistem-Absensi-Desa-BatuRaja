<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'admin'
            ]);

            User::insert([
                [
                    'name' => 'Amrullah', 
                    'email' => 'amrullah.kades@gmail.com', 
                    'password' => bcrypt('amrullah123'), 
                    'role' => 'user'
                ],
                [
                    'name' => 'Iredi Setiawan', 
                    'email' => 'iredi.sekdes@gmail.com', 
                    'password' => bcrypt('iredi123'), 
                    'role' => 'user'
                ],
                [
                    'name' => 'Budi Wijaya', 
                    'email' => 'budi.pemerintahan@gmail.com', 
                    'password' => bcrypt('budi123'), 
                    'role' => 'user'
                ],
                [
                    'name' => 'Edi Subhani', 
                    'email' => 'edi.kesra@gmail.com', 
                    'password' => bcrypt('edi123'), 
                    'role' => 'user'
                ],
                [
                    'name' => 'Mutia Rosmaya', 
                    'email' => 'mutia.pelayanan@gmail.com', 
                    'password' => bcrypt('mutia123'), 
                    'role' => 'user'
                ],
                [
                    'name' => 'Afrizal', 
                    'email' => 'afrizal.keuangan@gmail.com', 
                    'password' => bcrypt('afrizal123'), 
                    'role' => 'user'
                ],
                [
                    'name' => 'Dewi Lestari', 
                    'email' => 'dewi.umum@gmail.com', 
                    'password' => bcrypt('dewi123'), 
                    'role' => 'user'
                ],
                [
                    'name' => 'Mursid', 
                    'email' => 'mursid.perencanaan@gmail.com', 
                    'password' => bcrypt('mursid123'), 
                    'role' => 'user'
                ],
                [
                    'name' => 'Yusroni', 
                    'email' => 'yusroni.kadus1@gmail.com', 
                    'password' => bcrypt('yusroni123'), 
                    'role' => 'user'
                ],
                [
                    'name' => 'Ewin Haniago', 
                    'email' => 'ewin.kadus2@gmail.com', 
                    'password' => bcrypt('ewin123'), 
                    'role' => 'user'
                ],
                [
                    'name' => 'Nopi Yansyah', 
                    'email' => 'nopi.kadus3@gmail.com', 
                    'password' => bcrypt('nopi123'), 
                    'role' => 'user'
                ],
                [
                    'name' => 'Solihin', 
                    'email' => 'solihin.kadus4@gmail.com', 
                    'password' => bcrypt('solihin123'), 
                    'role' => 'user'
                ],
                [
                    'name' => 'Indar Gustiawan', 
                    'email' => 'indar.kadus5@gmail.com', 
                    'password' => bcrypt('indar123'), 
                    'role' => 'user'
                ],
                [
                    'name' => 'Hasanuddin', 
                    'email' => 'hasanuddin.kadus6@gmail.com', 
                    'password' => bcrypt('hasanuddin123'), 
                    'role' => 'user'
                ],
                [
                    'name' => 'Rijal Supi', 
                    'email' => 'rijal.kadus7@gmail.com', 
                    'password' => bcrypt('rijal123'), 
                    'role' => 'user'
                ],
                [
                    'name' => 'Hari Yansah', 
                    'email' => 'hari.rt01@gmail.com', 
                    'password' => bcrypt('hari123'), 
                    'role' => 'user'
                ],
                [
                    'name' => 'Dailami', 
                    'email' => 'dailami.rt02@gmail.com', 
                    'password' => bcrypt('dailami123'), 
                    'role' => 'user'
                ],
                [
                    'name' => 'Ria Indalia', 
                    'email' => 'ria.rt03@gmail.com', 
                    'password' => bcrypt('ria123'), 
                    'role' => 'user'
                ],
                [
                    'name' => 'Bahri', 
                    'email' => 'bahri.rt04@gmail.com', 
                    'password' => bcrypt('bahri123'), 
                    'role' => 'user'
                ],
                [
                    'name' => 'Muhizar', 
                    'email' => 'muhizar.rt05@gmail.com', 
                    'password' => bcrypt('muhizar123'), 
                    'role' => 'user'
                ],
                [
                    'name' => 'M. Risada', 
                    'email' => 'risada.rt06@gmail.com', 
                    'password' => bcrypt('risada123'), 
                    'role' => 'user'
                ],
                [
                    'name' => 'Asbendi', 
                    'email' => 'asbendi.rt07@gmail.com', 
                    'password' => bcrypt('asbendi123'), 
                    'role' => 'user'
                ],
                [
                    'name' => 'Khairuddin', 
                    'email' => 'khairuddin.rt08@gmail.com', 
                    'password' => bcrypt('khairuddin123'), 
                    'role' => 'user'
                ],
                [
                    'name' => 'Dedi Bahrizal', 
                    'email' => 'dedi.rt09@gmail.com', 
                    'password' => bcrypt('dedi123'), 
                    'role' => 'user'
                ],
                [
                    'name' => 'Siswanda', 
                    'email' => 'siswanda.rt10@gmail.com', 
                    'password' => bcrypt('siswanda123'), 
                    'role' => 'user'
                ],
                [
                    'name' => 'Sarman', 
                    'email' => 'sarman.rt11@gmail.com', 
                    'password' => bcrypt('sarman123'), 
                    'role' => 'user'
                ],
                [
                    'name' => 'Berlin', 
                    'email' => 'berlin.rt12@gmail.com', 
                    'password' => bcrypt('berlin123'), 
                    'role' => 'user'
                ],
                [
                    'name' => 'Nurdin', 
                    'email' => 'nurdin.rt13@gmail.com', 
                    'password' => bcrypt('nurdin123'), 
                    'role' => 'user'
                ],
                [
                    'name' => 'Bahrun', 
                    'email' => 'bahrun.rt14@gmail.com', 
                    'password' => bcrypt('bahrun123'), 
                    'role' => 'user'
                ],
            ]);
            
    }
}
