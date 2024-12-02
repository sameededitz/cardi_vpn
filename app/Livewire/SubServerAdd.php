<?php

namespace App\Livewire;

use App\Models\Server;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SubServerAdd extends Component
{
    public $server;

    #[Validate]
    public $name;

    #[Validate]
    public $ip_address;

    #[Validate]
    public $panel_address;

    #[Validate]
    public $config;

    #[Validate]
    public $password;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'ip_address' => 'required|string|max:255',
            'panel_address' => 'required|string|max:255',
            'config' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ];
    }

    public function mount(Server $server)
    {
        $this->server = $server;
    }

    public function submit()
    {
        $this->validate();
        $this->server->subServers()->create([
            'name' => $this->name,
            'ip_address' => $this->ip_address,
            'panel_address' => $this->panel_address,
            'config' => $this->config,
            'password' => $this->password,
        ]);

        return redirect()->route('all-sub-servers', $this->server)->with([
            'status' => 'success',
            'message' => 'Sub Server Added Successfully',
        ]);
    }
    public function render()
    {
        return view('livewire.sub-server-add');
    }
}
