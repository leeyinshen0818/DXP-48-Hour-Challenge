<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProgrammeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('programmes')->insert([
            // Data Track
            [
                'title' => 'Certified Data Scientist Bootcamp',
                'slug' => 'certified-data-scientist',
                'description' => 'Master Python, SQL, and Machine Learning in 12 weeks. Built for beginners ready to pivot.',
                'category_tag' => 'data',
                'start_date' => Carbon::now()->addDays(14),
                'price' => 3499.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Advanced Data Engineering',
                'slug' => 'advanced-data-engineering',
                'description' => 'Learn how to build scalable pipelines using Apache Spark and Kafka.',
                'category_tag' => 'data',
                'start_date' => Carbon::now()->addDays(30),
                'price' => 4199.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Management Track
            [
                'title' => 'Executive Leadership Program',
                'slug' => 'executive-leadership',
                'description' => 'For new managers. Learn empathy-driven leadership and conflict resolution.',
                'category_tag' => 'management',
                'start_date' => Carbon::now()->addDays(10),
                'price' => 5000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Agile Project Management',
                'slug' => 'agile-pm',
                'description' => 'Become a certified Scrum Master and lead high-velocity teams.',
                'category_tag' => 'management',
                'start_date' => Carbon::now()->addDays(45),
                'price' => 2500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Marketing Track
            [
                'title' => 'Digital Marketing Masterclass',
                'slug' => 'digital-marketing',
                'description' => 'Dominate SEO, SEM, and Content Strategy. Real-world client projects included.',
                'category_tag' => 'marketing',
                'start_date' => Carbon::now()->addDays(7),
                'price' => 1899.00,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
