<?php

namespace App\Http\Livewire;

use App\Models\Accessory;
use App\Models\Card;
use App\Models\CardOrder;
use App\Models\Order;
use App\Models\Payment;
use App\Models\ShippingAddress;
use App\Models\User;
use App\Notifications\AccessoryNotification;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Union;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AccessoryOrder extends Component
{
    public $shipping_details;
    public $order_details;
    public $client_id;
    public $shipping_charge;
    public $payable_amount = 0;
    public $flag = 0;
    public $districts = [];
    public $upazilas = [];
    public $unions = [];
    public $f_name;
    public $address;
    public $mobile;
    public $district;
    public $upazila;
    public $union;
    public $old_address = [];
    public $accessory_slug = [];
    public $stocks = [];
    public $stock = [];
    public $stock_check;


    public function update()
    {
        $validate = $this->validate([
            'f_name' => 'required',
            'address' => 'required',
            'mobile' => 'required',
            'district' => 'required',
            'union' => 'required',
            'upazila' => 'required',
        ]);

        if ($validate) {
            $update_shipping_address = ShippingAddress::where('client_id', $this->client_id)->update([
                'f_name' => $this->f_name,
                'client_id' => Auth::guard('client')->user()->id,
                'address' => $this->address,
                'mobile' => $this->mobile,
                'district_id' => $this->district,
                'upazila_id' => $this->upazila,
                'union_id' => $this->union
            ]);
        } else {
            return back()->with('status', 'Oops some problem here !!!');
        }
    }


    public function updatedDistrict($district)
    {
        $this->upazilas = Upazila::where('district_id', $district)->get();
    }

    public function updatedUpazila($upazila)
    {
        $this->unions = Union::where('upazila_id', $upazila)->get();
    }

    public function updateDistricts()
    {
        $this->upazilas = Upazila::where('district_id', $this->district)->get();
        $this->unions = [];
    }

    public function mount()
    {

        $client = Auth::guard('client')->check();
        if ($client) {
            $this->client_id = Auth::guard('client')->user()->id;

            $client = Auth::guard('client')->check();
            if ($client) {
                $this->client_id = Auth::guard('client')->user()->id;
            }

            $this->districts = District::where('status', 1)->get();
            $this->upazilas = Upazila::all();
            $this->unions = Union::all();

            // set the value in frontend edit page:
            $this->old_address = ShippingAddress::where('client_id', $this->client_id)->latest()->first();

            if ($this->old_address) {
                $this->f_name = $this->old_address->f_name;
                $this->address = $this->old_address->address;
                $this->mobile = $this->old_address->mobile;
                $this->district = $this->old_address->district_id;
                $this->upazila = $this->old_address->upazila_id;
                $this->union = $this->old_address->union_id;
            } else {
                // Set default values or handle the case where the record is not found
                $this->f_name = '';
                $this->address = '';
                $this->mobile = '';
                $this->district = '';
                $this->upazila = '';
                $this->union = '';
            }


            $this->order_details = Card::where('client_id', $this->client_id)->get();
            $this->shipping_details = ShippingAddress::where('client_id', $this->client_id)
                ->with('district')
                ->with('upazila')
                ->with('union')
                ->first();

            $this->shipping_charge = $this->shipping_details->district->charge;
            $this->payable_amount = collect($this->order_details)->sum('sub_total') + $this->shipping_charge;
        }
    }


    public function order()
    {
        // here check the quantity 
        foreach ($this->order_details as $each) {
            $this->accessory_slug = $each->slug;
        }
        foreach ($this->order_details as $each) {
            $this->accessory_slug = $each->slug;
        }
        $this->stocks = Accessory::whereIn('slug', [$this->accessory_slug])->get();

        foreach ($this->order_details as $key => $card_q) {
            foreach ($this->stocks as $q => $accessory_q) {
                if ($key == $q && $card_q->quantity > $accessory_q->quantity) {
                    $this->stock_check = false;
                } else {
                    $this->stock_check = true;
                }
            }
        }
        // here check the quantity

        // dd($this->stock_check);

        $this->flag = 1;
        if ($this->client_id && count($this->order_details) > 0 && $this->stock_check == true) {
            $order = Order::create([
                'transaction_id' => uniqid(),
                'client_id' => $this->client_id,
                'order_status' => 'pending',
                'payment_status' => 'unpaid',
                'shipping_charge' => $this->shipping_charge,
                'payable_amount' => $this->payable_amount,
                'payment' => 0,
                'due' => $this->payable_amount,
                'district_id' => $this->shipping_details->district_id,
                'upazila_id' => $this->shipping_details->upazila_id,
                'union_id' => $this->shipping_details->union_id,
                'area' => $this->shipping_details->address,
                'mobile' => $this->mobile
            ]);

            if ($order) {
                $order_payment = Payment::create([
                    'order_id' => $order->id,
                    'pay' => 0
                ]);
            }

            if ($order) {
                foreach ($this->order_details as $final_order) {
                    $card_order = CardOrder::create([
                        'order_id' => $order->id,
                        'title' => $final_order->title,
                        'slug' => $final_order->slug,
                        'image' => $final_order->image,
                        'client_id' => $final_order->client_id,
                        'category_id' => $final_order->category_id,
                        'accessory_id' => $final_order->accessory_id,
                        'quantity' => $final_order->quantity,
                        'stock' => $final_order->stock,
                        'unit_price' => $final_order->unit_price,
                        'sub_total' => $final_order->sub_total
                    ]);
                    if ($card_order) {
                        $accessory_stock_updated = Accessory::where('slug', $final_order->slug)->decrement('quantity', $final_order->quantity);
                    }
                }
                if (!empty($this->order_details)) {
                    Card::where('client_id', $this->client_id)->delete();
                }
            }

            if ($card_order) {
                $users = User::all();
                foreach ($users as $user) {
                    $user->notify(new AccessoryNotification($order->toArray()));
                }
            }
            if ($order) {
                session()->flash('status', 'Order Create Successfully');
                return redirect()->to('/accessory');
            }
        } else {
            session()->flash('error', 'Card expired !! Again select product');
            return redirect()->to('accessory/card');
        }
    }
    public function render()
    {
        return view(
            'livewire.accessory-order',
            [
                'order_details' => $this->order_details,
                'shipping_details' => $this->shipping_details,
                'districts' => $this->districts,
                'upazilas' => $this->upazilas,
                'unions' => $this->unions,
                'old_address' => $this->old_address,
            ]
        );
    }
}
