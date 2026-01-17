<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Programme;
use App\Models\StrategicInsight;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Morph the Headline based on goals
        $headlineMap = [
            'data' => "Your Roadmap to becoming a Data Leader",
            'ai' => "Building the Future with AI",
            'software' => "Architecting Scalable Systems",
            'management' => "Your Path to the C-Suite",
            'marketing' => "Mastering the Digital Landscape",
            'default' => "Welcome to your Future"
        ];

        $heroHeadline = $headlineMap[$user->career_interest] ?? $headlineMap['default'];

        // 2. Fetch Relevant Programmes (The "Curated List")
        // If user has a preference, filter by it. Else show all.
        $programmes = Programme::all();

        // Map for the definitions list in Alpine
        $dbLibraryPrograms = $programmes->map(function($prog) {
            return [
                'title' => $prog->title,
                'description' => $prog->description,
                'duration' => 'Flexible', // Placeholder as DB doesn't have it
                'level' => 'All Levels',  // Placeholder
                'icon' => 'M12 14l9-5-9-5-9 5 9 5z', // Generic layer icon
                // Pass extra info for the modal
                'price' => $prog->price,
                'startDate' => $prog->start_date,
            ];
        });

        // 3. Fetch Insights from DB and map to frontend key format
        $dbInsights = StrategicInsight::all()->map(function($insight) {
            return [
                'title' => $insight->title,
                'type' => $insight->type,
                'category' => $insight->category,
                'readTime' => $insight->read_time,
                'iconClass' => $insight->icon_class,
                'downloadUrl' => $insight->download_url,
            ];
        });

        // 3. AI Insights Simulation (Hardcoded for prototype based on interest) -> Kept as $aiInsights
        $aiInsights = $this->getInsights($user->career_interest);

        return view('home', compact('user', 'heroHeadline', 'programmes', 'aiInsights', 'dbInsights', 'dbLibraryPrograms'));
    }

    private function getInsights($interest)
    {
        // In a real app, this comes from the 'articles' table or an AI API
        return match($interest) {
            'data' => [
                'salary' => '$120,000 avg entry',
                'growth' => '+28% demand in 2026',
                'tip' => 'Python is overtaking R in 90% of enterprises.'
            ],
            'ai' => [
                'salary' => '$160,000 started',
                'growth' => 'Explosive (+50%)',
                'tip' => 'Learn Transformer architectures now.'
            ],
            'software' => [
                'salary' => '$115,000 base',
                'growth' => 'Steady High Demand',
                'tip' => 'System Design is the new interview roadblock.'
            ],
            'management' => [
                'salary' => '$145,000 base',
                'growth' => 'Stable but evolving',
                'tip' => 'Empathy is the #1 requested skill for new managers.'
            ],
            'marketing' => [
                'salary' => '$95,000 + bonus',
                'growth' => 'High for Tech Roles',
                'tip' => 'Video content is driving 82% of all traffic.'
            ],
            default => [
                'salary' => 'Competitive',
                'growth' => 'Steady',
                'tip' => 'Continuous learning is the key to promotion.'
            ]
        };
    }
}
