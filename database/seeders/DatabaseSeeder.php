<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Barangay;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $barangayEmails = [
            ['name' => 'Barangay 1 (Poblacion)', 'email' => 'barangay1.poblacion@gmail.com'],
            ['name' => 'Barangay 2 (Poblacion)', 'email' => 'barangay2.poblacion@gmail.com'],
            ['name' => 'Barangay 3 (Poblacion)', 'email' => 'barangay3.poblacion@gmail.com'],
            ['name' => 'Barangay 4 (Poblacion)', 'email' => 'barangay4.poblacion@gmail.com'],
            ['name' => 'Barangay 5 (Poblacion)', 'email' => 'barangay5.poblacion@gmail.com'],
            ['name' => 'Barangay 6 (Poblacion)', 'email' => 'barangay6.poblacion@gmail.com'],
            ['name' => 'Barangay 7 (Poblacion)', 'email' => 'barangay7.poblacion@gmail.com'],
            ['name' => 'Barangay 8 (Poblacion)', 'email' => 'barangay8.poblacion@gmail.com'],
            ['name' => 'Barangay 9 (Poblacion)', 'email' => 'barangay9.poblacion@gmail.com'],
            ['name' => 'Barangay 10 (Poblacion)', 'email' => 'barangay10.poblacion@gmail.com'],
            ['name' => 'Barangay 11 (Poblacion)', 'email' => 'barangay11.poblacion@gmail.com'],
            ['name' => 'Barra', 'email' => 'barra@gmail.com'],
            ['name' => 'Bocohan', 'email' => 'bocohan@gmail.com'],
            ['name' => 'Cotta', 'email' => 'cotta@gmail.com'],
            ['name' => 'Gulang-Gulang', 'email' => 'gulang.gulang@gmail.com'],
            ['name' => 'Dalahican', 'email' => 'dalahican@gmail.com'],
            ['name' => 'Domoit', 'email' => 'domoit@gmail.com'],
            ['name' => 'Ibabang Dupay', 'email' => 'ibabangdupay@gmail.com'],
            ['name' => 'Ibabang Iyam', 'email' => 'ibabangiyam@gmail.com'],
            ['name' => 'Ibabang Talim', 'email' => 'ibabangtalim@gmail.com'],
            ['name' => 'Ilayang Dupay', 'email' => 'ilayangdupay@gmail.com'],
            ['name' => 'Ilayang Iyam', 'email' => 'ilayangiyam@gmail.com'],
            ['name' => 'Ilayang Talim', 'email' => 'ilayangtalim@gmail.com'],
            ['name' => 'Isabang', 'email' => 'isabang@gmail.com'],
            ['name' => 'Market View', 'email' => 'marketview@gmail.com'],
            ['name' => 'Mayao Castillo', 'email' => 'mayaocastillo@gmail.com'],
            ['name' => 'Mayao Crossing', 'email' => 'mayaocrossing@gmail.com'],
            ['name' => 'Mayao Kanluran', 'email' => 'mayaokanluran@gmail.com'],
            ['name' => 'Mayao Parada', 'email' => 'mayao.parada@gmail.com'],
            ['name' => 'Mayao Silangan', 'email' => 'mayaosilangan@gmail.com'],
            ['name' => 'Ransohan', 'email' => 'ransohan@gmail.com'],
            ['name' => 'Salinas', 'email' => 'salinas@gmail.com'],
            ['name' => 'Talao-Talao', 'email' => 'talao.talao@gmail.com']
        ];
        
        
        foreach ($barangayEmails as $key => $value) {
           $user = User::create([
            'name' => $value['name'],
            'email' => $value['email'],
            'password' => bcrypt('password'),
            'role' => 2
           ]);

           Barangay::create([
            'user_id' => $user->id,
            'name' => $value['name']
            
           ]);
        }
    }
}
