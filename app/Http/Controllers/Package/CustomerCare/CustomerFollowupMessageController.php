<?php

namespace App\Http\Controllers\Package\CustomerCare;

use DateTime;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\FollowupMessage;
use App\Models\FollowupPackage;
use App\Http\Controllers\Controller;
use App\Models\FollowupMessageService;
use App\Models\CustomerFollowupMessage;
use Illuminate\Support\Facades\Session;

class CustomerFollowupMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Customer $customer)
    {
        $today = date('Y-m-d');
        $collections = CustomerFollowupMessage::query()
            ->with('user', 'customer')
            ->where('user_id', auth()->user()->id)
            ->where('customer_id', $customer->id)
            ->where(function ($query) use ($today) {
                $query->whereDate('send_date', $today);
            })
            ->get();

        return view('content.package.customer-care.set-followup.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Customer $customer)
    {
        $package_message_service = FollowupMessageService::query()->select('followup_package_id', 'name')->distinct()->get();
        return view('content.package.customer-care.set-followup.create', compact('package_message_service', 'customer'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request, Customer $customer)
    {
        $followup_message = FollowupMessageService::query()
            ->where('followup_package_id', $request->package_id)
            ->with('message')->get();

        $package = FollowupPackage::query()->where('id', $request->package_id)->select('starting_day', 'name')->first();

        if ($package->name !== 'No update' && $package->name !== 'DateService') {
            $today = now();
            $startingDate = '';
            $allDate = [];

            for ($i = 0; $i < 7; $i++) {
                $nextDay = clone $today;
                if ($nextDay->addDays($i)->format('l') === $package->starting_day) {
                    $startingDate = $nextDay->format('d-m-Y');
                    break;
                }
            }

            $startingDate = \Carbon\Carbon::createFromFormat('d-m-Y', $startingDate);

            $allDate = [];
            for ($i = 0; $i < 7; $i++) {
                $currentDate = clone $startingDate;
                $currentDate->addDays($i);

                $dayOfWeek = $currentDate->format('l');
                $formattedDate = $currentDate->format('d-m-Y');
                $allDate[$dayOfWeek] = $formattedDate;
            }

            foreach ($followup_message as $each) {
                foreach ($allDate as $key => $date) {
                    if ($key == $each->send_day) {
                        $dateTime = strtotime($date);
                        $formattedDate = date('Y-m-d', $dateTime);
                        $data[] = [
                            'user_id' => $request->user()->id,
                            'customer_id' => $customer->id,
                            'message' => $each->message->message,
                            'send_date' => $key == $each->send_day ? $formattedDate : null,
                            'message_send_time' => $each->message_send_time,
                            'call_time' => $each->call_time,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                        ];
                    }
                }
            }

            CustomerFollowupMessage::insert($data);
        } elseif ($package->name == 'DateService') {

            $startingDate = new DateTime($request->starting_date);
            $visitDate = new DateTime($request->visit_date);
            $diff = $startingDate->diff($visitDate)->days + 1;

            $message_array = [];

            if ($diff == 5) {
                $message_array = [
                    [
                        'message' => 'আসসালামু আলাইকুম। গাড়ি ক্রয় বিক্রয়ের জন্য পাইলট বাজার অটোমোবাইলস গাড়ির শোরুমকে পছন্দ করার জন্য আপনাকে অসংখ্য ধন্যবাদ । আমরা সর্বদাই চেষ্টা করি সাশ্রয়ী দামে ভাল মানের একটি গাড়ী আপনাকে প্রদান করতে । আপনার সন্তুষ্টিই আমাদের প্রত্যাশা।',
                        'call_time' => null,
                        'message_send_time' => '12:00:00',
                        'send_date' => $startingDate->modify('+0 day')->format('Y-m-d'),
                    ],
                    [
                        'message' => 'আসসালামু আলাইকুম। আশা করি ভালো আছেন।আমরা সবসময় চেষ্টা করি যেন আপনি যেন ন্যায্য দামে ভালো গাড়ি পেতে পারেন। আল্লাহর রহমতে আমাদের কাছ থেকে গাড়ি নিয়ে সকলেই খুব সন্তুষ্ট। আশা করি আপনিও সন্তুষ্ট হবেন ইনশাল্লাহ।',
                        'call_time' => '',
                        'message_send_time' => '12:00:00',
                        'send_date' => $startingDate->modify('+1 day')->format('Y-m-d'),
                    ],
                    [
                        'message' => 'আসসালামু আলাইকুম। আগামী পরশু আপনার আমাদের পাইলেট বাজার শোরুমে একটি গাড়ি দেখতে আসার সিডিউল দিয়েছিলেন। আমরা আপনার সিডিউল রেখেছি। আশা করি আপনি আসবেন। আমরা আপনার অপেক্ষায় থাকবো। ধন্যবাদ।',
                        'call_time' => null,
                        'message_send_time' => '12:00:00',
                        'send_date' => $startingDate->modify('+1 day')->format('Y-m-d'),
                    ],
                    [
                        'message' => 'আসসালামু আলাইকুম। আগামিকাল আপনার পাইলট বাজার অটোমোবাইলস গাড়ির শোরুমে আসার সিডিউল রয়েছে। ভাইয়া আপনি কয়টার দিকে আসতে পারবেন? 
                        আমরা আপনার আসার সময় জানলে সেই সময়ে আপনার অপেক্ষায় থাকব।',
                        'call_time' => '12:00:00',
                        'message_send_time' => '12:00:00',
                        'send_date' => $startingDate->modify('+1 day')->format('Y-m-d'),
                    ],
                    [
                        'message' => 'আমাদের শোরুমের ঠিকানাঃ Plot: 1/A, Road-138, Gulshan-1, Dhaka. গুলশান এক থেকে পুলিশপ্লাজা বা হাতিরঝিল যাবার পথে, ( Abacus Restaurant পাশে দিয়ে) ১৩৮ নং রোডের শেষ মাথায় লেকের পাড়ে অবস্থিত। 
                        
                        নিচের লিংকে আমাদের শোরুমের লোকেশন দেখানো হলো। গাড়ীটি দেখার জন্য আমাদের শোরুমে আসলে খুশি হব ।https://rb.gy/omkagt 
                        
                        ঠিকানা চিনতে কোন অসুবিধা হলে দয়া করে এই নম্বরে আমাকে ফোন দিবেন।',
                        'call_time' => '10:00:00',
                        'message_send_time' => '12:00:00',
                        'send_date' => $startingDate->modify('+1 day')->format('Y-m-d'),
                    ],

                ];
            } elseif ($diff == 4) {
                $message_array = [
                    [
                        'message' => 'আসসালামু আলাইকুম। আশা করি ভালো আছেন।আমরা সবসময় চেষ্টা করি যেন আপনি যেন ন্যায্য দামে ভালো গাড়ি পেতে পারেন। আল্লাহর রহমতে আমাদের কাছ থেকে গাড়ি নিয়ে সকলেই খুব সন্তুষ্ট। আশা করি আপনিও সন্তুষ্ট হবেন ইনশাল্লাহ।',
                        'call_time' => null,
                        'message_send_time' => '12:00:00',
                        'send_date' => $startingDate->modify('+0 day')->format('Y-m-d'),
                    ],
                    [
                        'message' => 'আসসালামু আলাইকুম। আগামী পরশু আপনার আমাদের পাইলেট বাজার শোরুমে একটি গাড়ি দেখতে আসার সিডিউল দিয়েছিলেন। আমরা আপনার সিডিউল রেখেছি। আশা করি আপনি আসবেন। আমরা আপনার অপেক্ষায় থাকবো। ধন্যবাদ।',
                        'call_time' => null,
                        'message_send_time' => '12:00:00',
                        'send_date' => $startingDate->modify('+1 day')->format('Y-m-d'),
                    ],
                    [
                        'message' => 'আসসালামু আলাইকুম। আগামিকাল আপনার পাইলট বাজার অটোমোবাইলস গাড়ির শোরুমে আসার সিডিউল রয়েছে। ভাইয়া আপনি কয়টার দিকে আসতে পারবেন? 
                        আমরা আপনার আসার সময় জানলে সেই সময়ে আপনার অপেক্ষায় থাকব।',
                        'call_time' => '12:00:00',
                        'message_send_time' => '12:00:00',
                        'send_date' => $startingDate->modify('+1 day')->format('Y-m-d'),
                    ],
                    [
                        'message' => 'আমাদের শোরুমের ঠিকানাঃ Plot: 1/A, Road-138, Gulshan-1, Dhaka. গুলশান এক থেকে পুলিশপ্লাজা বা হাতিরঝিল যাবার পথে, ( Abacus Restaurant পাশে দিয়ে) ১৩৮ নং রোডের শেষ মাথায় লেকের পাড়ে অবস্থিত। 
                        
                        নিচের লিংকে আমাদের শোরুমের লোকেশন দেখানো হলো। গাড়ীটি দেখার জন্য আমাদের শোরুমে আসলে খুশি হব ।https://rb.gy/omkagt 
                        
                        ঠিকানা চিনতে কোন অসুবিধা হলে দয়া করে এই নম্বরে আমাকে ফোন দিবেন।',
                        'call_time' => '10:00:00',
                        'message_send_time' => '12:00:00',
                        'send_date' => $startingDate->modify('+1 day')->format('Y-m-d'),
                    ],
                ];
            } elseif ($diff == 3) {
                $message_array = [
                    [
                        'message' => 'আসসালামু আলাইকুম। আগামী পরশু আপনার আমাদের পাইলেট বাজার শোরুমে একটি গাড়ি দেখতে আসার সিডিউল দিয়েছিলেন। আমরা আপনার সিডিউল রেখেছি। আশা করি আপনি আসবেন। আমরা আপনার অপেক্ষায় থাকবো। ধন্যবাদ।',
                        'call_time' => null,
                        'message_send_time' => '12:00:00',
                        'send_date' => $startingDate->modify('+0 day')->format('Y-m-d'),
                    ],
                    [
                        'message' => 'আসসালামু আলাইকুম। আগামিকাল আপনার পাইলট বাজার অটোমোবাইলস গাড়ির শোরুমে আসার সিডিউল রয়েছে। ভাইয়া আপনি কয়টার দিকে আসতে পারবেন? 
                        আমরা আপনার আসার সময় জানলে সেই সময়ে আপনার অপেক্ষায় থাকব।',
                        'call_time' => '12:00:00',
                        'message_send_time' => '12:00:00',
                        'send_date' => $startingDate->modify('+1 day')->format('Y-m-d'),
                    ],
                    [
                        'message' => 'আমাদের শোরুমের ঠিকানাঃ Plot: 1/A, Road-138, Gulshan-1, Dhaka. গুলশান এক থেকে পুলিশপ্লাজা বা হাতিরঝিল যাবার পথে, ( Abacus Restaurant পাশে দিয়ে) ১৩৮ নং রোডের শেষ মাথায় লেকের পাড়ে অবস্থিত। 
                        
                        নিচের লিংকে আমাদের শোরুমের লোকেশন দেখানো হলো। গাড়ীটি দেখার জন্য আমাদের শোরুমে আসলে খুশি হব ।https://rb.gy/omkagt 
                        
                        ঠিকানা চিনতে কোন অসুবিধা হলে দয়া করে এই নম্বরে আমাকে ফোন দিবেন।',
                        'call_time' => '10:00:00',
                        'message_send_time' => '12:00:00',
                        'send_date' => $startingDate->modify('+1 day')->format('Y-m-d'),
                    ],
                ];
            } elseif ($diff == 2) {
                $message_array = [
                    [
                        'message' => 'আসসালামু আলাইকুম। আগামিকাল আপনার পাইলট বাজার অটোমোবাইলস গাড়ির শোরুমে আসার সিডিউল রয়েছে। ভাইয়া আপনি কয়টার দিকে আসতে পারবেন? 
                        আমরা আপনার আসার সময় জানলে সেই সময়ে আপনার অপেক্ষায় থাকব।',
                        'call_time' => '12:00:00',
                        'message_send_time' => '12:00:00',
                        'send_date' => $startingDate->modify('+0 day')->format('Y-m-d'),
                    ],
                    [
                        'message' => 'আমাদের শোরুমের ঠিকানাঃ Plot: 1/A, Road-138, Gulshan-1, Dhaka. গুলশান এক থেকে পুলিশপ্লাজা বা হাতিরঝিল যাবার পথে, ( Abacus Restaurant পাশে দিয়ে) ১৩৮ নং রোডের শেষ মাথায় লেকের পাড়ে অবস্থিত। 
                        
                        নিচের লিংকে আমাদের শোরুমের লোকেশন দেখানো হলো। গাড়ীটি দেখার জন্য আমাদের শোরুমে আসলে খুশি হব ।https://rb.gy/omkagt 
                        
                        ঠিকানা চিনতে কোন অসুবিধা হলে দয়া করে এই নম্বরে আমাকে ফোন দিবেন।',
                        'call_time' => '10:00:00',
                        'message_send_time' => '12:00:00',
                        'send_date' => $startingDate->modify('+1 day')->format('Y-m-d'),
                    ],
                ];
            } elseif ($diff == 1) {
                $message_array = [
                    [
                        'message' => 'আমাদের শোরুমের ঠিকানাঃ Plot: 1/A, Road-138, Gulshan-1, Dhaka. গুলশান এক থেকে পুলিশপ্লাজা বা হাতিরঝিল যাবার পথে, ( Abacus Restaurant পাশে দিয়ে) ১৩৮ নং রোডের শেষ মাথায় লেকের পাড়ে অবস্থিত। 
                        
                        নিচের লিংকে আমাদের শোরুমের লোকেশন দেখানো হলো। গাড়ীটি দেখার জন্য আমাদের শোরুমে আসলে খুশি হব ।https://rb.gy/omkagt 
                        
                        ঠিকানা চিনতে কোন অসুবিধা হলে দয়া করে এই নম্বরে আমাকে ফোন দিবেন।',
                        'call_time' => '10:00:00',
                        'message_send_time' => '12:00:00',
                        'send_date' => $startingDate->modify('+1 day')->format('Y-m-d'),
                    ],
                ];
            }

            $json_object = json_encode($message_array);
            $json_array = json_decode($json_object);

            $data = [];

            foreach ($json_array as $each) {
                $data[] = [
                    'user_id' => $request->user()->id,
                    'customer_id' => $customer->id,
                    'message' => $each->message,
                    'send_date' =>  $each->send_date,
                    'message_send_time' => $each->message_send_time,
                    'call_time' => $each->call_time,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }

            CustomerFollowupMessage::insert($data);
        } else {

            $message_array = [
                [
                    'message' => null,
                    'call_time' => '12:00:00',
                    'message_send_time' => '12:00:00',
                    'send_date' => date('Y-m-d', strtotime('+1 day')),
                ],
                [
                    'message' => 'আসসালামু আলাইকুম। আশা করি ভালো আছেন।আমরা সবসময় চেষ্টা করি যেন আপনি যেন ন্যায্য দামে ভালো গাড়ি পেতে পারেন। আল্লাহর রহমতে আমাদের কাছ থেকে গাড়ি নিয়ে সকলেই খুব সন্তুষ্ট। আশা করি আপনিও সন্তুষ্ট হবেন ইনশাল্লাহ।',
                    'call_time' => null,
                    'message_send_time' => '12:00:00',
                    'send_date' => date('Y-m-d', strtotime('+2 day')),
                ],
                [
                    'message' => null,
                    'call_time' => '12:00:00',
                    'message_send_time' => '12:00:00',
                    'send_date' => date('Y-m-d', strtotime('+3 days')),
                ]
            ];

            $json_object = json_encode($message_array);
            $json_array = json_decode($json_object);

            $data = [];

            foreach ($json_array as $each) {
                $data[] = [
                    'user_id' => $request->user()->id,
                    'customer_id' => $customer->id,
                    'message' => $each->message,
                    'send_date' =>  $each->send_date,
                    'message_send_time' => $each->message_send_time,
                    'call_time' => $each->call_time,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }

            CustomerFollowupMessage::insert($data);
        }
        return back();
    }

    /**
     * method for store visit followups
     * @param Request $request
     * @param Customer $customer
     * @param CustomerFollowupMessage $customerFollowupMessage
     */
    public function visitFollowupStore(Request $request, Customer $customer, CustomerFollowupMessage $customerFollowupMessage)
    {
        foreach ($request->message as $key1 => $message) {
            foreach ($request->note as $key4 => $note) {
                foreach ($request->send_date as $key2 => $send_date) {
                    foreach ($request->call_time as $key3 => $call_time) {
                        if ($key1 == $key2 && $key1 == $key3 && $key1 == $key4) {
                            $response[] = [
                                'send_date' => $send_date,
                                'call_time' => $call_time,
                                'user_id' => $request->user()?->id,
                                'customer_id' => $customer->id,
                                'message' => $message,
                                'note' => $note,
                                'send_date' => $send_date ?? null,
                                'message_send_time' => '12:00:00',
                                'call_time' => $call_time ?? null,
                                'after_visit' => 1,
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s'),
                            ];
                        }
                    }
                }
            }
        }

        CustomerFollowupMessage::insert($response);
        $customerFollowupMessage->update(['visited_at' => 1]);
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        $package_message_service = FollowupMessageService::query()->select('followup_package_id', 'name')
            ->distinct()
            ->get();
        return view('content.package.customer-care.set-followup.edit', compact('package_message_service', 'customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CustomerFollowupMessage $customerFollowupMessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer, CustomerFollowupMessage $customerFollowupMessage)
    {
        $customerFollowupMessage->delete();
        return back()->with('status', 'Followup message delete successfull');
    }

    /**
     * method for customly add a call
     * @param Customer $customer
     * @param CustomerFollowupMessage $customerFollowupMessage
     */
    public function addCall(Customer $customer, CustomerFollowupMessage $customerFollowupMessage)
    {
        $customerFollowupMessage->update(['call_time' => '12:00:00']);
        return response()->json(['status' => 'Customer followup call has been added']);
    }

    /**
     * method for customly remove a call
     * @param Customer $customer
     * @param CustomerFollowupMessage $customerFollowupMessage
     */
    public function removeCall(Customer $customer, CustomerFollowupMessage $customerFollowupMessage)
    {
        $customerFollowupMessage->update(['call_time' => null]);
        return back()->with('status', 'Followup call removed');
    }

    /**
     * method for customly add a followup page
     * @param Customer $customer
     * @param CustomerFollowupMessage $customerFollowupMessage
     */
    public function addFollowup(Customer $customer, CustomerFollowupMessage $customerFollowupMessage)
    {
        $followup_message = FollowupMessage::query()->get();
        return view('content.package.customer-care.set-followup.custom', compact('customer', 'customerFollowupMessage', 'followup_message'));
    }

    /**
     * method for customly add a followup store
     * @param Customer $customer
     */
    public function addFollowupStore(Request $request, Customer $customer)
    {
        $messageCustom = $request->messageCustom;
        $custom_message = CustomerFollowupMessage::create([
            'user_id' => $request->user()->id,
            'customer_id' => $customer->id,
            'send_date' => $request->send_date,
            'message' => $messageCustom ?? $request->message,
            'message_send_time' => '12:00:00',
            'call_time' => $request->call_time,
        ]);

        return back()->with('success', 'Custom followup set successfully');
    }
}
