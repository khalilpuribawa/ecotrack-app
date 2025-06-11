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
            'title' => '5 Cara Mudah Mengurangi Sampah Plastik di Rumah',
            'content' => 'Mengurangi sampah plastik adalah langkah kecil dengan dampak besar. Mulailah dengan membawa tas belanja sendiri, menggunakan botol minum isi ulang, dan menghindari sedotan plastik. Setiap tindakan kecil berarti!',
            'type' => 'article',
            'created_by' => $admin->id,
        ]);
        Article::create([
            'title' => 'Cara Membuat Kompos dari Sampah Dapur',
            'content' => 'Jangan buang sisa sayuran dan buah! Anda bisa mengubahnya menjadi kompos yang subur untuk tanaman Anda. Prosesnya mudah dan sangat bermanfaat untuk mengurangi sampah organik yang berakhir di TPA.',
            'type' => 'article',
            'created_by' => $admin->id,
        ]);

        // --- Seed Challenges ---
        Challenge::create([
            'title' => 'Tantangan 7 Hari Tanpa Sedotan Plastik',
            'description' => 'Beranikan diri untuk tidak menggunakan sedotan plastik sama sekali selama seminggu penuh. Upload foto minumanmu tanpa sedotan untuk menyelesaikan tantangan!',
            'start_date' => now()->startOfWeek(),
            'end_date' => now()->endOfWeek(),
            'point_reward' => 50,
            'badge' => 'no-straw-hero',
        ]);
        Challenge::create([
            'title' => 'Tanam Satu Pohon di Rumahmu',
            'description' => 'Tanam pohon atau tanaman apa saja di pekarangan, pot, atau bahkan di dalam ruangan. Setiap tanaman membantu menghasilkan oksigen.',
            'start_date' => now(),
            'end_date' => now()->addMonth(),
            'point_reward' => 100,
            'badge' => 'green-thumb',
        ]);

        // --- Seed Reports ---
        Report::create([
            'user_id' => $users->random()->id,
            'category' => 'Sampah menumpuk',
            'description' => 'Ada tumpukan sampah liar di pinggir Jalan Merdeka, dekat jembatan.',
            'latitude' => -6.2297,
            'longitude' => 106.829,
            'status' => 'pending',
        ]);
        Report::create([
            'user_id' => $users->random()->id,
            'category' => 'Penebangan pohon liar',
            'description' => 'Terlihat ada aktivitas penebangan pohon tanpa izin di area taman kota.',
            'latitude' => -6.2088,
            'longitude' => 106.8456,
            'status' => 'verified',
        ]);

        // --- Seed Green Points ---
        GreenPoint::create([
            'type' => 'Bank Sampah',
            'name' => 'Bank Sampah Maju Bersama',
            'description' => 'Menerima sampah plastik, kertas, dan logam. Buka setiap hari Sabtu.',
            'latitude' => -6.2146,
            'longitude' => 106.8451,
            'added_by' => $admin->id,
            'verified' => true,
        ]);
        GreenPoint::create([
            'type' => 'Taman Kota',
            'name' => 'Taman Kota Sejuk Asri',
            'description' => 'Taman publik dengan jogging track dan area bermain anak.',
            'latitude' => -6.1751,
            'longitude' => 106.8650,
            'added_by' => $admin->id,
            'verified' => true,
        ]);
        
        // --- Seed Communities ---
        $community = Community::create([
            'name' => 'Komunitas Peduli Sungai Ciliwung',
            'description' => 'Grup untuk warga yang ingin berpartisipasi dalam kegiatan bersih-bersih Sungai Ciliwung.',
            'created_by' => $users->first()->id,
        ]);
        $community->members()->attach($users->first()->id, ['role' => 'admin']);
        $community->members()->attach($users->last()->id, ['role' => 'member']);
    }
}