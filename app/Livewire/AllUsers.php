<?php

namespace App\Livewire;

use App\Models\Purchase;
use App\Models\User;
use Livewire\Component;

class AllUsers extends Component
{
    public $users;
    public $selectedUser;
    public $expirationDate;

    protected $rules = [
        'expirationDate' => 'required|date',
    ];

    public function mount()
    {
        // Load all users with the 'customer' role
        $this->users = User::where('role', 'customer')
            ->with(['purchases' => function ($query) {
                $query->latest()->first();
            }])
            ->get();
    }

    public function addPurchase()
    {
        $this->validate();

        Purchase::create([
            'user_id' => $this->selectedUser->id,
            'started_at' => now(),
            'expires_at' => $this->expirationDate,
            'is_active' => true,
        ]);

        $this->expirationDate = '';

        // Reload users to update the table
        $this->mount();

        $this->dispatch('close-modal');
        $this->dispatch('alert_add', ['type' => 'success', 'message' => 'Purchase added successfully!']);
    }

    public function openModal(User $user)
    {
        $this->selectedUser = $user;
        $this->expirationDate = '';
        $this->dispatch('open-modal');
    }

    public function clearPurchase(User $user)
    {
        $user->purchases()->delete();
        // Reload users to update the table
        $this->mount();

        $this->dispatch('alert_clear', ['type' => 'success', 'message' => 'Purchase cleared successfully!']);
    }

    public function render()
    {
        return view('livewire.all-users');
    }
}
