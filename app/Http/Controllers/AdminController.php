<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => 1240,
            'active_now' => 56,
            'completion_rate' => '68%',
            'revenue' => '$12,450'
        ];

        // Chart Data - Mocking last 7 days
        $chartData = [
            'dates' => ['Jan 10', 'Jan 11', 'Jan 12', 'Jan 13', 'Jan 14', 'Jan 15', 'Jan 16'],
            'registrations' => [45, 52, 38, 65, 42, 78, 95], // User increment
            'active_users' => [30, 45, 35, 50, 40, 65, 80]
        ];

        $recentUsers = [
            [
                'id' => 1,
                'name' => 'Sarah Connor',
                'email' => 'sarah@sky.net',
                'role' => 'Student',
                'status' => 'Active',
                'joined' => '2 hrs ago',
                'alex_completed' => true,
                'programs_explored' => 4,
                'time_spent' => '4h 15m',
                'sections_explored' => 12
            ],
            [
                'id' => 2,
                'name' => 'John Wick',
                'email' => 'john@continental.com',
                'role' => 'Professional',
                'status' => 'Active',
                'joined' => '5 hrs ago',
                'alex_completed' => false,
                'programs_explored' => 0,
                'time_spent' => '1h 30m',
                'sections_explored' => 3
            ],
            [
                'id' => 3,
                'name' => 'Ellen Ripley',
                'email' => 'ellen@nostromo.space',
                'role' => 'Student',
                'status' => 'Inactive',
                'joined' => '1 day ago',
                'alex_completed' => true,
                'programs_explored' => 2,
                'time_spent' => '2h 10m',
                'sections_explored' => 8
            ],
            [
                'id' => 4,
                'name' => 'Marty McFly',
                'email' => 'marty@hillvalley.edu',
                'role' => 'Student',
                'status' => 'Active',
                'joined' => '2 days ago',
                'alex_completed' => false,
                'programs_explored' => 6,
                'time_spent' => '35m',
                'sections_explored' => 5
            ],
        ];

        return view('admin.dashboard', compact('stats', 'recentUsers', 'chartData'));
    }

    public function users()
    {
        // Mocking a larger user list
        $users = [
            ['id' => 1, 'name' => 'Sarah Connor', 'email' => 'sarah@sky.net', 'role' => 'Student', 'status' => 'Active', 'joined' => '2023-10-15', 'career_interest' => 'Cybersecurity'],
            ['id' => 2, 'name' => 'John Wick', 'email' => 'john@continental.com', 'role' => 'Mentor', 'status' => 'Active', 'joined' => '2023-09-12', 'career_interest' => 'Law Enforcement'],
            ['id' => 3, 'name' => 'Ellen Ripley', 'email' => 'ellen@nostromo.space', 'role' => 'Student', 'status' => 'Inactive', 'joined' => '2023-11-01', 'career_interest' => 'Engineering'],
            ['id' => 4, 'name' => 'Marty McFly', 'email' => 'marty@hillvalley.edu', 'role' => 'Student', 'status' => 'Active', 'joined' => '2023-11-20', 'career_interest' => 'Music'],
            ['id' => 5, 'name' => 'Tony Stark', 'email' => 'tony@stark.com', 'role' => 'Mentor', 'status' => 'Active', 'joined' => '2023-08-30', 'career_interest' => 'Engineering'],
            ['id' => 6, 'name' => 'Bruce Wayne', 'email' => 'bruce@wayne.com', 'role' => 'Mentor', 'status' => 'Active', 'joined' => '2023-09-01', 'career_interest' => 'Business'],
            ['id' => 7, 'name' => 'Peter Parker', 'email' => 'peter@dailybugle.com', 'role' => 'Student', 'status' => 'Active', 'joined' => '2023-12-10', 'career_interest' => 'Journalism'],
            ['id' => 8, 'name' => 'Diana Prince', 'email' => 'diana@themyscira.gov', 'role' => 'Mentor', 'status' => 'Active', 'joined' => '2023-07-04', 'career_interest' => 'Diplomacy'],
        ];

        return view('admin.users', compact('users'));
    }

    public function actions()
    {
        return view('admin.actions');
    }

    public function generateAiEmail(Request $request)
    {
        $topic = $request->input('topic', 'General Update'); // Default to General Update

        $subject = '';
        $body = '';

        switch ($topic) {
            case 'Maintenance':
                $subject = 'Scheduled Platform Maintenance Notice';
                $body = "Dear User,\n\nThis is to inform you that the DXP platform will be undergoing scheduled maintenance on [Date] from [Start Time] to [End Time].\n\nDuring this period, access to the portal may be intermittent. We apologize for any inconvenience this may cause and appreciate your understanding as we work to improve our services.\n\nBest regards,\nThe DXP Team";
                break;
            case 'Internship':
                $subject = 'New Internship Opportunities Available!';
                $body = "Hi there,\n\nWe are thrilled to announce that several new internship positions have been posted on the DXP platform! Top partner companies are looking for talent just like you.\n\nLog in now to browse opportunities in Software Engineering, Data Science, and Cybersecurity.\n\nDon't miss out on kickstarting your career!\n\nBest,\nThe DXP Team";
                break;
            case 'Event':
                $subject = 'Invitation: Exclusive Industry Webinar';
                $body = "Hello,\n\nYou are cordially invited to our upcoming webinar featuring industry leaders from the tech world.\n\nTopic: The Future of AI in Development\nDate: [Date]\nTime: [Time]\n\nReserve your spot today by visiting the Events section in your dashboard.\n\nSee you there,\nThe DXP Team";
                break;
            default:
                $subject = 'Platform Update: New Features & Resources';
                $body = "Dear User,\n\nWe've recently updated the platform with new resources to help you in your learning journey. Check out the latest modules in the 'Courses' section.\n\nHappy Learning!\n\nThe DXP Team";
                break;
        }

        return response()->json(['subject' => $subject, 'body' => $body]);
    }

    public function generateAiContent(Request $request)
    {
        $sourceType = $request->input('source_type'); // 'link' or 'file'
        $sourceValue = $request->input('source_value');

        // Mock AI processing logic based on input
        $title = '';
        $summary = '';
        $content = '';
        $preview = '';
        $expectedViews = 0;

        if ($sourceType === 'link') {
            // Simulate scraping a URL
            $domain = parse_url($sourceValue, PHP_URL_HOST) ?? 'External Source';
            $title = "Insights from " . $domain . ": Key Trends in 2024";
            $summary = "<ul><li>Analysis of emerging technologies discussed in the source article.</li><li>Impact on junior developers and career growth.</li><li>Recommendations for upskilling in relevant areas.</li></ul>";
            $preview = "A recent article from " . $domain . " highlights the shifting landscape of technology...";
            $content = "<h1>$title</h1>\n<p><strong>Source:</strong> <a href='$sourceValue'>$sourceValue</a></p>\n<h2>Executive Summary</h2>\n<p>The shared article discusses critical advancements in the tech sector. Here is a breakdown of the core concepts...</p>\n$summary\n<h2>Detailed Analysis</h2>\n<p>As the industry evolves, staying adaptable is key. The source material emphasizes the importance of continuous learning...</p>";
            $expectedViews = rand(1500, 3500);
        } else {
            // Simulate processing a PDF/File
            $filename = $sourceValue ?? 'uploaded_document.pdf';
            $title = "Summary & Key Takeaways: " . $filename;
            $summary = "<ul><li>Core thesis extracted from the document introduction.</li><li>Statistical data points regarding market growth.</li><li>Conclusion and future predictions as outlined in the text.</li></ul>";
            $preview = "This document provides a comprehensive overview of...";
            $content = "<h1>$title</h1>\n<p><strong>Document Analysis</strong></p>\n<p>We have processed the uploaded file <em>$filename</em> and extracted the following key insights.</p>\n<h2>Key Points</h2>\n$summary\n<h2>Full Digest</h2>\n<p>The document argues that...</p>";
            $expectedViews = rand(800, 2000);
        }

        return response()->json([
            'title' => $title,
            'summary' => $summary,
            'preview' => $preview,
            'content' => $content,
            'expected_views' => $expectedViews
        ]);
    }

    public function analytics()
    {
        // Mock analytics data
        $analyticsData = [
            'engagement' => [65, 59, 80, 81, 56, 55, 40],
            'retention' => [28, 48, 40, 19, 86, 27, 90],
            'program_popularity' => [300, 50, 100, 80],
            'labels' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
        ];
        return view('admin.analytics', compact('analyticsData'));
    }
}
