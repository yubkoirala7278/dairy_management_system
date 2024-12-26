<?php

namespace App\Livewire\Frontend\Login;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $page = 'login';
    public $sub_page;
    public $farmer_number, $password;

    public function render()
    {
        return view('livewire.frontend.login.login');
    }

    public function login()
    {
        $this->validate([
            'farmer_number' => 'required|string',
            'password' => 'required',
        ], [
            'farmer_number.required' => 'किसान नम्बर आवश्यक छ।',
            'farmer_number.string' => 'किसान नम्बर केवल अङ्क र अक्षर हुनुपर्छ।',
            'password.required' => 'पासवर्ड आवश्यक छ।',
        ]);

        if (Auth::attempt(['farmer_number' => $this->farmer_number, 'password' => $this->password])) {
            session()->regenerate();

            // Dispatch a success message
            $this->dispatch('success', title: 'लॉगिन सफल भयो।');
            return;
        }

        // Return error message
        $this->addError('farmer_number', 'किसान नम्बर वा पासवर्ड मिलेन।');
    }
}
