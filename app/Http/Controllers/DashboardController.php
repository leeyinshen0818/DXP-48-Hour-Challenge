<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Programme;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Fallback for no-auth mode
        if (!$user) {
            $user = new \App\Models\User([
                'name' => 'Guest User',
                'email' => 'guest@example.com',
                'career_interest' => 'software', // Default preference
                'emotional_state' => 'professional'
            ]);
        }

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
        $programmes = Programme::query();

        if ($user->career_interest) {
            $programmes->where('category_tag', $user->career_interest);
        }

        $programmes = $programmes->get();

        // 3. AI Insights Simulation (Hardcoded for prototype based on interest)
        $insights = $this->getInsights($user->career_interest);

        return view('home', compact('user', 'heroHeadline', 'programmes', 'insights'));
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
