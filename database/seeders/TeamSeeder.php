<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        $team = Team::firstOrCreate(
            ['slug' => '15-adana-cyberova'],
            ['name' => '1.5 Adana Cyberova']
        );

        if ($team->sponsorshipPackages()->count() === 0) {
            $packages = [
                ['title' => 'Altın Sponsorlar', 'order' => 1],
                ['title' => 'Gümüş Sponsorlar', 'order' => 2],
                ['title' => 'Bronz Sponsorlar', 'order' => 3],
            ];

            foreach ($packages as $pkg) {
                $package = $team->sponsorshipPackages()->create($pkg);

                for ($i = 1; $i <= 3; $i++) {
                    $package->sponsors()->create([
                        'name' => "{$pkg['title']} {$i}",
                        'logo_path' => 'assets/images/placeholder.png',
                    ]);
                }
            }
        }
    }
}
