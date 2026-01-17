<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StrategicInsightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $insights = [
            [
                'title' => 'Future of Work Report 2024',
                'type' => 'PDF Report',
                'category' => 'market_data',
                'read_time' => '15 min read',
                'icon_class' => 'bg-orange-50 text-orange-600',
                'download_url' => '#download-report-2024'
            ],
            [
                'title' => 'Tech Salary Trends Q3',
                'type' => 'Market Data',
                'category' => 'market_data',
                'read_time' => '5 min read',
                'icon_class' => 'bg-emerald-50 text-emerald-600',
                'download_url' => '#download-salary-trends'
            ],
            [
                'title' => 'Case Study: AI in FinTech',
                'type' => 'Case Study',
                'category' => 'case_studies',
                'read_time' => '20 min read',
                'icon_class' => 'bg-blue-50 text-blue-600',
                'download_url' => '#read-case-study'
            ],
            [
                'title' => 'Leadership in Remote Teams',
                'type' => 'Article',
                'category' => 'latest',
                'read_time' => '8 min read',
                'icon_class' => 'bg-purple-50 text-purple-600',
                'download_url' => 'https://hbr.org/'
            ],
            [
                'title' => 'Global Skills Index 2025',
                'type' => 'PDF Report',
                'category' => 'market_data',
                'read_time' => '45 min read',
                'icon_class' => 'bg-orange-50 text-orange-600',
                'download_url' => '#download-gsi-2025'
            ],
            [
                'title' => 'Startup Growth Metrics',
                'type' => 'Cheatsheet',
                'category' => 'latest',
                'read_time' => '2 min read',
                'icon_class' => 'bg-pink-50 text-pink-600',
                'download_url' => '#download-cheatsheet'
            ],
            [
                'title' => 'Design Systems Handbook',
                'type' => 'eBook',
                'category' => 'latest',
                'read_time' => '3 hrs read',
                'icon_class' => 'bg-indigo-50 text-indigo-600',
                'download_url' => '#download-handbook'
            ],
            [
                'title' => 'AWS Architecture Whitepaper',
                'type' => 'Whitepaper',
                'category' => 'case_studies',
                'read_time' => '60 min read',
                'icon_class' => 'bg-slate-100 text-slate-600',
                'download_url' => '#download-whitepaper'
            ],
            [
                'title' => 'Product Roadmap Template',
                'type' => 'Template',
                'category' => 'latest',
                'read_time' => 'For Notion/Excel',
                'icon_class' => 'bg-green-50 text-green-600',
                'download_url' => '#download-template'
            ],
            [
                'title' => 'Cybersecurity Threat Landscape',
                'type' => 'Briefing',
                'category' => 'market_data',
                'read_time' => '10 min read',
                'icon_class' => 'bg-red-50 text-red-600',
                'download_url' => '#download-briefing'
            ]
        ];

        foreach ($insights as $insight) {
            \App\Models\StrategicInsight::create($insight);
        }
    }
}
