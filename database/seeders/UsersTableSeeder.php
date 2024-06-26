<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            $zone = $faker->randomElement(['east', 'west', 'north', 'south']);
            $state = $this->getStateForZone($zone);
            $city = $faker->randomElement($this->getCitiesForState($state));

            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'), // or use $faker->password() for random passwords
                'status' => 'active',
                'zone' => $zone,
                'state' => $state,
                'city' => $city,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Get a state based on the provided zone.
     *
     * @param string $zone
     * @return string
     */
    private function getStateForZone($zone)
    {
        $states = [
            'east' => ['West Bengal', 'Odisha', 'Assam'],
            'west' => ['Maharashtra', 'Gujarat', 'Rajasthan'],
            'north' => ['Delhi', 'Punjab', 'Uttar Pradesh'],
            'south' => ['Karnataka', 'Tamil Nadu', 'Kerala'],
        ];

        return $states[$zone][array_rand($states[$zone])];
    }

    /**
     * Get cities for the provided state.
     *
     * @param string $state
     * @return array
     */
    private function getCitiesForState($state)
    {
        $cities = [
            'West Bengal' => ['Kolkata', 'Siliguri', 'Durgapur'],
            'Odisha' => ['Bhubaneswar', 'Cuttack', 'Rourkela'],
            'Assam' => ['Guwahati', 'Dibrugarh', 'Silchar'],
            'Maharashtra' => ['Mumbai', 'Pune', 'Nagpur'],
            'Gujarat' => ['Ahmedabad', 'Surat', 'Vadodara'],
            'Rajasthan' => ['Jaipur', 'Udaipur', 'Jodhpur'],
            'Delhi' => ['New Delhi'],
            'Punjab' => ['Amritsar', 'Ludhiana', 'Chandigarh'],
            'Uttar Pradesh' => ['Lucknow', 'Kanpur', 'Varanasi'],
            'Karnataka' => ['Bangalore', 'Mysore', 'Mangalore'],
            'Tamil Nadu' => ['Chennai', 'Coimbatore', 'Madurai'],
            'Kerala' => ['Thiruvananthapuram', 'Kochi', 'Kozhikode'],
        ];

        return $cities[$state];
    }
}
