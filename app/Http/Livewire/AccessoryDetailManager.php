<?php

namespace App\Http\Livewire;

use App\Enums\Share;
use App\Enums\Status;
use App\Enums\Session;
use App\Models\Accessory;
use App\Models\Card;
use App\Models\Vehicle;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Container\ContainerExceptionInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Auth;

class AccessoryDetailManager extends Component
{
    public array|string|object $cards;
    /**
     * Define the incoming product detail
     * @var array|object|null
     */
    protected array|object|null $detail = null;

    /**
     * Define the social share link
     * @var array|object|null
     */
    protected array|object|null $shared = [];

    /**
     * Define the product slug
     * @var string|null
     */
    public ?string $slug = null;

    /**
     * Define the current locale
     * @var string|null
     */
    public ?string $translate = null;

    /**
     * Define the product slug
     * @var string|null
     */
    public ?string $mobile = null;

    /**
     * Define the masking status
     * @var null|bool
     */
    public ?bool $isMask = null;


    public $suggestions = null;
    /**
     * Event listeners for this component
     * @var string[]
     */
    protected $listeners = ['updateLocaleString' => 'toTranslatorString'];

    /**
     * Initialize a new object instance
     * @param  string|null $slug
     * @return void
     */



    public function mount(string|null $slug): void
    {
        // $search_name = Accessory::query()->with('translate')->where('slug', '=', $this->slug)->first();


        // if (!empty($search_name)) {
        //     $this->suggestions = Accessory::query()
        //         ->where('slug', 'LIKE', "%$search_name%")
        //         // ->where('slug', '<>', $this->slug)
        //         ->with('translate')
        //         ->where('is_approved', '=', Status::ACTIVE->toString())
        //         ->get();
        // }



        // 01407054411
        $this->slug = $slug;
        $this->detail = Accessory::query()->with('translate')->with('brand')->where('slug', '=', $this->slug)->first();
        $this->shared = collect(Share::iterator(true))->map(fn ($i) => (object) [
            'name' => $i->toString(), 'icon' => $i->toBrands(), 'link' => $i->toShared($this->detail->slug),
        ])->toBase();
        $this->mobile = '+88 01407-333777';
        $this->isMask = false;
    }

    /**
     * Render the detail component
     * @return Application|Factory|View
     * @throws NotFoundExceptionInterface|ContainerExceptionInterface
     */
    public function render(): View|Factory|Application
    {
        $this->translate = session()->get(Session::TRANSLATION->toString()) ?? app()->getLocale();
        return view('livewire.accessory-detail-manager', ['detail' => $this->detail, 'shared' => $this->shared]);
    }

    /**
     * Listen the locale change event
     * @param  string $local
     * @return void
     * @noinspection PhpUnused
     */
    public function toTranslatorString(string $local): void
    {
        $this->translate    = $local;
        $this->detail       = Accessory::query()->where('slug', '=', $this->slug)->first();
    }

    public function showSellerNumber(string $slug)
    {
        $this->isMask = $this->isMask == true ? false : true;
        $this->slug = $slug;
        $this->detail =  Accessory::query()->with('translate')->where('slug', '=', $this->slug)->first();
        $this->shared = collect(Share::iterator(true))->map(fn ($i) => (object) [
            'name' => $i->toString(), 'icon' => $i->toBrands(), 'link' => $i->toShared($this->detail->slug),
        ])->toBase();
    }


    public function card($slug)
    {
        if (Auth::guard('client')->check()) {
            return $this->handleCardLogic($slug);
        } else {
            return redirect()->to('/accessory/card');
        }
    }


    private function handleCardLogic($slug)
    {
        $accessory = Accessory::query()->with('translate')->where('slug', '=', $slug)->first();
        $titles = $accessory->translate->pluck('title')->toArray();
        $title = $titles[0];

        $client_id = Auth::guard('client')->user()->id;
        $existingCard = Card::where('slug', $slug)->where('client_id', $client_id)->first();

        if ($existingCard) {
            if ($existingCard->quantity < $existingCard->stock) {
                $existingCard->increment('quantity');
                $existingCard->update([
                    'sub_total' => $existingCard->quantity * $accessory->price
                ]);
            } elseif ($existingCard->quantity >= $existingCard->stock) {
                return redirect()->to('/accessory/card')->with('error', "Product Stock Out");
            }
        } else {
            Card::create([
                'title' => $title,
                'slug' => $slug,
                'image' => $accessory->image->name,
                'client_id' => $client_id,
                'category_id' => $accessory->category_id,
                'merchant_id' => $accessory->merchant_id,
                'accessory_id' => $accessory->id,
                'quantity' => 1,
                'stock' => $accessory->quantity,
                'unit_price' => $accessory->price,
                'sub_total' => $accessory->price
            ]);
        }

        return redirect()->to('/accessory/card');
    }
}
