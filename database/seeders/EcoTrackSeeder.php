<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Report;
use App\Models\Article;
use App\Models\GreenPoint;
use App\Models\Challenge;
use App\Models\Community;

class EcoTrackSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();
        $users = User::where('role', 'user')->get();

        // --- Seed Articles ---
        Article::create([
            'title' => '5 Easy Ways to Reduce Single-Use Plastic at Home',
            'content' => 'Cutting down on plastic waste is a simple habit with massive global impact. Start by bringing your reusable shopping tote, carrying a refillable water bottle, and refusing single-use straws. Every small step counts towards a cleaner planet!',
            'type' => 'article',
            'created_by' => $admin->id,
        ]);
        Article::create([
            'title' => 'How to Make Nutrient-Rich Compost from Kitchen Scraps',
            'content' => 'Do not throw away fruit peels and vegetable cuttings! Transform kitchen leftovers into nutrient-packed organic compost for your plants. It is simple, free, and significantly reduces municipal landfill waste.',
            'type' => 'article',
            'created_by' => $admin->id,
        ]);

        // --- Seed Challenges ---
        Challenge::create([
            'title' => '7-Day Zero Plastic Straw Challenge',
            'description' => 'Commit to going 100% plastic straw-free for an entire week. Snap and upload a photo of your straw-free drink to complete the challenge and earn your badge!',
            'start_date' => now()->startOfWeek(),
            'end_date' => now()->endOfWeek(),
            'point_reward' => 50,
            'badge' => 'no-straw-hero',
        ]);
        Challenge::create([
            'title' => 'Plant a Tree or Houseplant',
            'description' => 'Plant a sapling, balcony houseplant, or backyard garden tree. Every new green plant purifies our air and captures carbon dioxide.',
            'start_date' => now(),
            'end_date' => now()->addMonth(),
            'point_reward' => 100,
            'badge' => 'green-thumb',
        ]);

        // --- Seed Reports ---
        Report::create([
            'user_id' => $users->random()->id,
            'category' => 'Illegal Waste Dumping',
            'description' => 'Large pile of discarded plastic bags and industrial trash accumulated along the riverbank near the main bridge.',
            'latitude' => -6.2297,
            'longitude' => 106.829,
            'status' => 'pending',
        ]);
        Report::create([
            'user_id' => $users->random()->id,
            'category' => 'Unauthorized Tree Cutting',
            'description' => 'Unauthorized logging activity observed damaging protected urban park greenery.',
            'latitude' => -6.2088,
            'longitude' => 106.8456,
            'status' => 'verified',
        ]);

        // --- Seed Green Points ---
        GreenPoint::create([
            'type' => 'Recycling Station',
            'name' => 'EcoHub Community Recycling Drop-off',
            'description' => 'Accepts clean plastics, cardboard, and electronic recyclables. Open every Saturday from 8 AM to 4 PM.',
            'latitude' => -6.2146,
            'longitude' => 106.8451,
            'added_by' => $admin->id,
            'verified' => true,
        ]);
        GreenPoint::create([
            'type' => 'Urban Eco Park',
            'name' => 'Breeze Botanical City Park',
            'description' => 'Public botanical sanctuary featuring solar-lit jogging trails and community tree nurseries.',
            'latitude' => -6.1751,
            'longitude' => 106.8650,
            'added_by' => $admin->id,
            'verified' => true,
        ]);
        
        // --- Seed Communities ---
        $community = Community::create([
            'name' => 'Clean River Action Alliance',
            'description' => 'A passionate group of community volunteers organizing weekly river cleanup drives and water testing.',
            'created_by' => $users->first()->id,
        ]);
        $community->members()->attach($users->first()->id, ['role' => 'admin']);
        $community->members()->attach($users->last()->id, ['role' => 'member']);
    }
}