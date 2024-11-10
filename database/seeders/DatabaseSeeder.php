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
            ['name' => 'Barangay 1', 'email' => 'barangay1.poblacion@gmail.com', 'latitude' => '13.9432098', 'longitude' => '121.6051391'],
            ['name' => 'Barangay 2', 'email' => 'barangay2.poblacion@gmail.com', 'latitude' => '13.9388377', 'longitude' => '121.6144989'],
            ['name' => 'Barangay 3', 'email' => 'barangay3.poblacion@gmail.com', 'latitude' => '13.9374033', 'longitude' => '121.6122379'],
            ['name' => 'Barangay 4', 'email' => 'barangay4.poblacion@gmail.com', 'latitude' => '13.9368604', 'longitude' => '121.6147461'],
            ['name' => 'Barangay 5', 'email' => 'barangay5.poblacion@gmail.com', 'latitude' => '13.935468', 'longitude' => '121.6116846'],
            ['name' => 'Barangay 6', 'email' => 'barangay6.poblacion@gmail.com', 'latitude' => '13.9342259', 'longitude' => '121.6139289'],
            ['name' => 'Barangay 7', 'email' => 'barangay7.poblacion@gmail.com', 'latitude' => '13.9332718', 'longitude' => '121.6118396'],
            ['name' => 'Barangay 8', 'email' => 'barangay8.poblacion@gmail.com', 'latitude' => '13.9305534', 'longitude' => '121.6115712'],
            ['name' => 'Barangay 9', 'email' => 'barangay9.poblacion@gmail.com', 'latitude' => '13.9312075', 'longitude' => '121.6135011'],
            ['name' => 'Barangay 10', 'email' => 'barangay10.poblacion@gmail.com', 'latitude' => '13.9277832', 'longitude' => '121.6154889'],
            ['name' => 'Barangay 11', 'email' => 'barangay11.poblacion@gmail.com', 'latitude' => '13.9416713', 'longitude' => '121.61457'],
            ['name' => 'Barra', 'email' => 'barra@gmail.com','latitude' => '13.9358509', 'longitude' => '121.6130954'],
            ['name' => 'Bocohan', 'email' => 'bocohan@gmail.com', 'latitude' => '13.957689', 'longitude' => '121.5908841'],
            ['name' => 'Cotta', 'email' => 'cotta@gmail.com', 'latitude' => '13.9167742', 'longitude' => '121.6064396'],
            ['name' => 'Gulang-Gulang', 'email' => 'gulang.gulang@gmail.com', 'latitude' => '13.9607505', 'longitude' => '121.6097897'],
            ['name' => 'Dalahican', 'email' => 'dalahican@gmail.com', 'latitude' => '13.9111009', 'longitude' => '121.6170982'],
            ['name' => 'Domoit', 'email' => 'domoit@gmail.com', 'latitude' => '13.9656741', 'longitude' => '121.5954539'],
            ['name' => 'Ibabang Dupay', 'email' => 'ibabangdupay@gmail.com', 'latitude' => '13.9413972', 'longitude' => '121.6235766'],
            ['name' => 'Ibabang Iyam', 'email' => 'ibabangiyam@gmail.com', 'latitude' => '13.9262972', 'longitude' => '121.6012926'],
            ['name' => 'Ibabang Talim', 'email' => 'ibabangtalim@gmail.com', 'latitude' => '13.9157046', 'longitude' => '121.5782202'],
            ['name' => 'Ilayang Dupay', 'email' => 'ilayangdupay@gmail.com', 'latitude' => '13.9759083', 'longitude' => '121.6231585'],
            ['name' => 'Ilayang Iyam', 'email' => 'ilayangiyam@gmail.com', 'latitude' => '13.9421715', 'longitude' => '121.6046099'],
            ['name' => 'Ilayang Talim', 'email' => 'ilayangtalim@gmail.com', 'latitude' => '13.9413578', 'longitude' => '121.5697131'],
            ['name' => 'Isabang', 'email' => 'isabang@gmail.com', 'latitude' => '13.9485716', 'longitude' => '121.5838776'],
            ['name' => 'Market View', 'email' => 'marketview@gmail.com', 'latitude' => '13.9340697', 'longitude' => '121.619052'],
            ['name' => 'Mayao Castillo', 'email' => 'mayaocastillo@gmail.com', 'latitude' => '13.9292861', 'longitude' => '121.665769'],
            ['name' => 'Mayao Crossing', 'email' => 'mayaocrossing@gmail.com', 'latitude' => '13.9257621', 'longitude' => '121.6217745'],
            ['name' => 'Mayao Kanluran', 'email' => 'mayaokanluran@gmail.com', 'latitude' => '13.9490209', 'longitude' => '121.6353526'],
            ['name' => 'Mayao Parada', 'email' => 'mayao.parada@gmail.com', 'latitude' => '13.9271391', 'longitude' => '121.6435781'],
            ['name' => 'Mayao Silangan', 'email' => 'mayaosilangan@gmail.com', 'latitude' => '13.9544415', 'longitude' => '121.6468125'],
            ['name' => 'Ransohan', 'email' => 'ransohan@gmail.com', 'latitude' => '13.8935974', 'longitude' => '121.5938519'],
            ['name' => 'Salinas', 'email' => 'salinas@gmail.com', 'latitude' => '13.9020528', 'longitude' => '121.5785299'],
            ['name' => 'Talao-Talao', 'email' => 'talao.talao@gmail.com', 'latitude' => '13.9100969', 'longitude' => '121.6451863']
        ];

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role' => 1
        ]);

        foreach ($barangayEmails as $key => $value) {
           $user = User::create([
            'name' => $value['name'],
            'email' => $value['email'],
            'password' => bcrypt('password'),
            'role' => 2
           ]);

           Barangay::create([
            'user_id' => $user->id,
            'name' => $value['name'],
            'latitude' => $value['latitude'],
            'longitude' => $value['longitude'],
           ]);
        }
    }
}
