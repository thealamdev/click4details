<?php

namespace App\Http\Controllers\Merchant\CustomerCare;

use App\Models\CustomerCare;
use Illuminate\Http\Request;


class CustomerCareController
{
    /**
     * method for render the customer cares
     * @param Request $request
     */
    public function index(Request $request)
    {
        $customerCare = CustomerCare::query()->where('parent_id', $request->user()->id)->get();
        return view('content.merchant.customer-care.index', compact('customerCare'));
    }

    /**
     * method for rendering edit blade
     * @param Request $request
     * @param CustomerCare $customerCare
     */
    public function edit(CustomerCare $customerCare)
    {
        return view('content.merchant.customer-care.edit', compact('customerCare'));
    }

    /**
     * method for update customer care infos
     * @param CustomerCare $customerCare
     */
    public function update(Request $request, CustomerCare $customerCare)
    {
        $customerCare->update(['name' => $request->name, 'email' => $request->email, 'mobile' => $request->mobile]);
        return back()->with('status', 'Customer care update successful');
    }

    /**
     * method for delete the customer care
     * @param CustomerCare $customerCare
     */
    public function destroy(CustomerCare $customerCare)
    {
        $customerCare->delete();
        return back()->with('status', 'Customer care delete successfully');
    }
}
