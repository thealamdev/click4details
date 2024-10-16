<?php

namespace App\Http\Livewire;

use App\Enums\Share;
use App\Enums\Session;
use Livewire\Component;
use App\Models\Residence;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class FlatDetailManager extends Component
{
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

        $this->slug = $slug;
        $this->detail = Residence::query()->with('translate')->where('slug', '=', $this->slug)->first();
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
        return view('livewire.flat-detail-manager',['detail' => $this->detail]);
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
        $this->detail       = Residence::query()->where('slug', '=', $this->slug)->first();
    }

    public function showSellerNumber(string $slug)
    {
        $this->isMask = $this->isMask == true ? false : true;
        $this->slug = $slug;
        $this->detail =  Residence::query()->with('translate')->where('slug', '=', $this->slug)->first();
        $this->shared = collect(Share::iterator(true))->map(fn ($i) => (object) [
            'name' => $i->toString(), 'icon' => $i->toBrands(), 'link' => $i->toShared($this->detail->slug),
        ])->toBase();
    }
}
