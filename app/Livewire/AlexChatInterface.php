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

    // User Choices
    public $userStatus = ''; // 'student' or 'professional'
    public $careerInterest = ''; // 'data', 'ai', 'software'
    public $email = '';

    // For UI State
    public $showEmailInput = false;

    public function mount()
    {
        // Reset session for demo purposes on fresh load if needed,
        // but for now we follow standard Livewire lifecycle
    }

    // Node A -> B
    public function startChat()
    {
        $this->step = 1;
        $this->logInteraction('intro', 'started');
    }

    // Node B -> C
    public function setStatus($status)
    {
        $this->userStatus = $status;
        $this->step = 2;
        $this->logInteraction('status_check', $status);
    }

    // Node C -> D
    public function setInterest($interest)
    {
        $this->careerInterest = $interest;
        $this->step = 3;
        $this->logInteraction('career_interest', $interest);
    }

    // Node D -> E
    public function acceptOffer()
    {
        $this->step = 4;
        $this->showEmailInput = true;
        $this->logInteraction('offer_accepted', 'yes');
    }

    public function declineOffer()
    {
        // Maybe show a "No worries" message or restart?
        // For now, let's just reset or show a friendly exit
        // but user script says "Close Chat"...
        // we'll keep it simple for this prototype.
        $this->logInteraction('offer_declined', 'no');
    }

    // Node E -> F
    public function submitLead()
    {
        $this->validate([
            'email' => 'required|email'
        ]);

        // Calculate Score based on Status + Interest
        $score = $this->calculateScore($this->userStatus, $this->careerInterest);

        // Map old "vibe" field to status for backward compatibility or DB schema
        // We'll treat 'emotional_state' as the status ('student' or 'professional')
        // to fit existing DB columns for now.

        $user = User::firstOrCreate(
            ['email' => $this->email],
            [
                'name' => 'Future ' . ucfirst($this->careerInterest) . ' Leader',
                'password' => Hash::make(Str::random(16)),
                'emotional_state' => $this->userStatus, // Reusing this column
                'career_interest' => $this->careerInterest,
                'lead_score' => $score
            ]
        );

        Auth::login($user);

        // Node F: The Close & Redirect
        $this->step = 5;

        // Redirect after a short delay (handled in frontend or here)
        // We'll use a browser event or just standard redirect
        // return redirect()->to('/home'); // Commented out to allow Node F message to display
    }

    private function calculateScore($status, $interest)
    {
        $score = 50;

        // Professionals are usually higher value leads (more likely to pay)
        if ($status === 'professional') {
            $score += 30;
        } else {
            $score += 10;
        }

        // Specific high-demand interests might score higher
        if ($interest === 'data' || $interest === 'ai') {
            $score += 10;
        }

        return $score;
    }

    private function logInteraction($stepName, $choice)
    {
        Interaction::create([
            'guest_session_id' => session()->getId(),
            'step_name' => $stepName,
            'choice_selected' => $choice
        ]);
    }

    public function render()
    {
        return view('livewire.alex-chat-interface');
    }
}
