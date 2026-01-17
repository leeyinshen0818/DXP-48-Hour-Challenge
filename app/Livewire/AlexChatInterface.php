<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Interaction;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AlexChatInterface extends Component
{
    public $step = 0;
    public $vibe = '';
    public $goal = '';
    public $email = '';
    public $messages = [];

    public function mount()
    {
        // Check if user has already started a session
        if (session()->has('guest_vibe')) {
            $this->vibe = session('guest_vibe');
            $this->step = 1;
        }
        if (session()->has('guest_goal')) {
            $this->goal = session('guest_goal');
            $this->step = 2;
        }
    }

    public function setVibe($vibe)
    {
        $this->vibe = $vibe;
        $this->step = 1;
        session(['guest_vibe' => $vibe]);

        // Log interaction
        Interaction::create([
            'guest_session_id' => session()->getId(),
            'step_name' => 'vibe_check',
            'choice_selected' => $vibe
        ]);
    }

    public function setGoal($goal)
    {
        $this->goal = $goal;
        $this->step = 2;
        session(['guest_goal' => $goal]);

        Interaction::create([
            'guest_session_id' => session()->getId(),
            'step_name' => 'goal_setting',
            'choice_selected' => $goal
        ]);
    }

    public function submitLead()
    {
        $this->validate([
            'email' => 'required|email'
        ]);

        // Create or Update User (Lead)
        $user = User::firstOrCreate(
            ['email' => $this->email],
            [
                'name' => 'Guest Future Leader',
                'password' => Hash::make(Str::random(16)), // Temporary password
                'emotional_state' => $this->vibe,
                'career_interest' => $this->goal,
                'lead_score' => $this->calculateScore($this->vibe)
            ]
        );

        // Auto-login the user to personalize the next page
        Auth::login($user);

        return redirect()->to('/home');
    }

    private function calculateScore($vibe)
    {
        // High urgency = stuck/evaluating. Low urgency = curious.
        return match($vibe) {
            'stuck' => 90,
            'evaluating' => 70,
            'ambitious' => 60,
            'curious' => 30,
            default => 50
        };
    }

    public function render()
    {
        return view('livewire.alex-chat-interface');
    }
}
