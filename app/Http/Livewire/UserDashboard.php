<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class UserDashboard extends Component
{
    public $user;
    public $orders;
    public $client;
    public $client_id;
    public $transaction;


    public function mount()
    {
        $this->user = Session::get('user');
        $client = Auth::guard('client')->check();
        if ($client) {
            $client_id = Auth::guard('client')->user()->id;
        }

        $this->orders = Order::with('card_order')->where('client_id', $client_id)->latest()->get();
    }

    /**
     * method for handle pending orders.
     * @return void
     */
    public function pendingOrder(): void
    {
        $this->client = Auth::guard('client')->check();
        if ($this->client) {
            $this->client_id = Auth::guard('client')->user()->id;
        }
        $this->orders = Order::where('client_id', $this->client_id)->with('card_order')->where('order_status', 'pending')->latest()->get();
    }

    public function paidOrder()
    {
        $this->client = Auth::guard('client')->check();
        if ($this->client) {
            $this->client_id = Auth::guard('client')->user()->id;
        }
        $this->orders = Order::where('client_id', $this->client_id)->with('card_order')->where('payment_status', 'paid')->latest()->get();
    }


    public function orders()
    {
        $this->client = Auth::guard('client')->check();
        if ($this->client) {
            $this->client_id = Auth::guard('client')->user()->id;
        }
        $this->orders = Order::where('client_id', $this->client_id)->with('card_order')->latest()->get();
    }



    public function render()
    {
        return view('livewire.user-dashboard', [
            'user' => $this->user,
            'orders' => $this->orders
        ]);
    }
}
