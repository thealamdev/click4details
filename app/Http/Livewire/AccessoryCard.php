<?php

namespace App\Http\Livewire;

use App\Enums\Disk;
use App\Models\Card;
use App\Models\Accessory;
use App\Models\Shipping;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use Devfaysal\BangladeshGeocode\Models\Union;
use Matrix\Operators\Division as OperatorsDivision;

class AccessoryCard extends Component
{

    public $shipping_details;
    public $all_districts = [];
    public $all_unions = [];
    public $all_upazilas = [];
    public $shipping;
    public $f_name;
    public $mobile;
    public $address;
    public $districts;
    public $unions;
    public $upazilas;
    public $shipping_address;
    public $client_id;
    public $old_address;
    public $accssory;


    public function store()
    {
        $validate = $this->validate([
            'f_name' => 'required',
            'address' => 'required',
            'mobile' => 'required',
            'districts' => 'required',
            'unions' => 'required',
            'upazilas' => 'required',
        ]);

        $shippingAddressData = [
            'f_name' => $this->f_name,
            'client_id' => Auth::guard('client')->user()->id,
            'address' => $this->address,
            'mobile' => $this->mobile,
            'district_id' => $this->districts,
            'upazila_id' => $this->upazilas,
            'union_id' => $this->unions
        ];

        $shippingAddress = ShippingAddress::updateOrCreate(
            ['client_id' => $shippingAddressData['client_id']],
            $shippingAddressData
        );

        if ($shippingAddress->wasRecentlyCreated) {
            return redirect()->to('accessory/order')->with('status', 'Shipping Address added successfully');
        } else {
            return redirect()->to('accessory/order')->with('status', 'Shipping Address updated successfully');
        }
    }

    public function mount()
    {
        $client = Auth::guard('client')->check();
        if ($client) {
            $this->client_id = Auth::guard('client')->user()?->id;
        }
        $this->old_address = ShippingAddress::where('client_id', $this->client_id)->latest()->first();

        // set the value in frontend card page:
        if ($this->old_address) {
            $this->f_name = $this->old_address->f_name;
            $this->address = $this->old_address->address;
            $this->mobile = $this->old_address->mobile;
            $this->districts = $this->old_address->district_id;
            $this->upazilas = $this->old_address->upazila_id;
            $this->unions = $this->old_address->union_id;
        } else {
            // Set default values or handle the case where the record is not found
            $this->f_name = '';
            $this->address = '';
            $this->mobile = '';
            $this->districts = '';
            $this->upazilas = '';
            $this->unions = '';
        }
    }

    public function updateDistricts($divisions)
    {
        $this->all_districts = District::where('division_id', $divisions)->get();
        // passing the shipping details into blade:
        $this->shipping_details = District::where('id', $divisions)->first();
    }

    public function updatedDistricts($districts)
    {
        $this->all_upazilas = Upazila::where('district_id', $districts)->get();
    }

    public function updatedUpazilas($upazilas)
    {
        $this->all_unions = Union::where('upazila_id', $upazilas)->get();
    }

    public function updateUpazilas()
    {
        $this->all_upazilas = Upazila::where('district_id', $this->districts)->get();
        $this->all_unions = [];
    }


    public function render()
    {
        $this->all_districts = District::where('status', '1')->get();
        $cards = Card::where('client_id', $this->client_id)->get();
        return view('livewire.accessory-card', [
            'cards' => $cards,
            'shipping_details' => $this->shipping_details,
            'all_districts' => $this->all_districts,
            'all_upazilas' => $this->all_upazilas,
            'all_unions' => $this->all_unions,
            'old_address' => $this->old_address
        ]);
    }

    public function decrement($id, $slug)
    {
        $card = Card::find($id);
        $this->accssory = Accessory::where('slug', $slug)->first();

        if ($card && ($card->quantity > 1)) {
            $card->decrement('quantity');
        }
        $card->update([
            'sub_total' => $card->unit_price * $card->quantity
        ]);
        $card->refresh();
    }

    public function increment($id, $slug)
    {
        $card = Card::find($id);
        $this->accssory = Accessory::where('slug', $slug)->first();

        if ($card && ($card->quantity <  $this->accssory->quantity)) {
            $card->increment('quantity');
        }
        $card->update([
            'sub_total' => $card->unit_price * $card->quantity
        ]);
        $card->refresh();
    }

    public function delete($id)
    {
        Card::destroy($id);
    }
}
