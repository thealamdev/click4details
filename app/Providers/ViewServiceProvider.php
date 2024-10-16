<?php

namespace App\Providers;

use App\View\Composers\FuelComposer;
use Illuminate\Support\Facades\View;
use App\View\Composers\BrandComposer;
use App\View\Composers\ColorComposer;
use App\View\Composers\GradeComposer;
use App\View\Composers\EngineComposer;
use App\View\Composers\LocaleComposer;
use App\View\Composers\EditionComposer;
use App\View\Composers\FeatureComposer;
use App\View\Composers\MileageComposer;
use Illuminate\Support\ServiceProvider;
use App\View\Composers\CarmodelComposer;
use App\View\Composers\CategoryComposer;
use App\View\Composers\LandTypeComposer;
use App\View\Composers\MerchantComposer;
use App\View\Composers\ShippingComposer;
use App\View\Composers\SizeUnitComposer;
use App\View\Composers\SkeletonComposer;
use App\View\Composers\AvailableComposer;
use App\View\Composers\ConditionComposer;
use App\View\Composers\DashboardComposer;
use App\View\Composers\PriceUnitComposer;
use App\View\Composers\NotificationComposer;
use App\View\Composers\RegistrationComposer;
use App\View\Composers\TransmissionComposer;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services
     * @return void
     */
    public function register(): void
    {
        // TODO: implement register() method
    }

    /**
     * Bootstrap services
     * @return void
     */
    public function boot(): void
    {
        View::composer(['content.package.vehicle.*'], LocaleComposer::class);
        View::composer(['content.package.vehicle.product.create', 'content.package.vehicle.product.update', 'content.package.property.product.create', 'content.package.property.product.update', 'content.package.accessory.product.create', 'content.package.accessory.product.update', 'content.merchant.vehicle.product.create', 'content.merchant.vehicle.product.edit'], CategoryComposer::class);

        View::composer(['content.package.vehicle.product.create', 'content.package.vehicle.product.update', 'content.package.property.product.create', 'content.package.property.product.update', 'content.package.accessory.product.create', 'content.package.accessory.product.update', 'content.package.rental-services.services.rental-car.create','content.package.rental-services.services.rental-car.edit'], MerchantComposer::class);

        View::composer(['content.package.vehicle.product.index', 'content.package.vehicle.product.create', 'content.package.vehicle.product.update', 'content.merchant.vehicle.product.create', 'content.merchant.vehicle.product.edit', 'content.package.vehicle.requirement.index', 'content.package.vehicle.requirement.create', 'content.package.vehicle.requirement.edit', 'content.package.rental-services.services.rental-car.create','content.package.rental-services.services.rental-car.edit'], BrandComposer::class);

        View::composer(['content.package.vehicle.product.index', 'content.package.vehicle.product.create', 'content.package.vehicle.product.update', 'content.merchant.vehicle.product.create', 'content.merchant.vehicle.product.edit', 'content.package.vehicle.requirement.index', 'content.package.vehicle.requirement.create', 'content.package.vehicle.requirement.edit'], ConditionComposer::class);

        View::composer(['content.package.vehicle.product.index', 'content.package.vehicle.product.create', 'content.package.vehicle.product.update', 'content.merchant.vehicle.product.create', 'content.merchant.vehicle.product.edit', 'content.package.vehicle.requirement.index', 'content.package.vehicle.requirement.create', 'content.package.vehicle.requirement.edit'], EditionComposer::class);

        View::composer(['content.package.vehicle.product.create', 'content.package.vehicle.product.update', 'content.merchant.vehicle.product.create', 'content.merchant.vehicle.product.edit'], EngineComposer::class);

        View::composer(['content.package.vehicle.product.index', 'content.package.vehicle.product.create', 'content.package.vehicle.product.update', 'content.merchant.vehicle.product.create', 'content.merchant.vehicle.product.edit', 'content.package.vehicle.requirement.index', 'content.package.vehicle.requirement.create', 'content.package.vehicle.requirement.edit'], FuelComposer::class);

        View::composer(['content.package.vehicle.product.index', 'content.package.vehicle.product.create', 'content.package.vehicle.product.update', 'content.merchant.vehicle.product.create', 'content.merchant.vehicle.product.edit', 'content.package.vehicle.requirement.index', 'content.package.vehicle.requirement.create', 'content.package.vehicle.requirement.edit'], GradeComposer::class);

        View::composer(['content.package.vehicle.product.create', 'content.package.vehicle.product.update', 'content.merchant.vehicle.product.create', 'content.merchant.vehicle.product.edit', 'content.package.vehicle.product.requirement'], MileageComposer::class);

        View::composer(['content.package.vehicle.product.index', 'content.package.vehicle.product.create', 'content.package.vehicle.product.update', 'content.merchant.vehicle.product.create', 'content.merchant.vehicle.product.edit', 'content.package.vehicle.requirement.index', 'content.package.vehicle.requirement.create', 'content.package.vehicle.requirement.edit'], SkeletonComposer::class);

        View::composer(['content.package.vehicle.product.index', 'content.package.vehicle.product.create', 'content.package.vehicle.product.update', 'content.merchant.vehicle.product.create', 'content.merchant.vehicle.product.edit', 'content.package.vehicle.requirement.index', 'content.package.vehicle.requirement.create', 'content.package.vehicle.requirement.edit'], TransmissionComposer::class);

        View::composer(['content.package.vehicle.product.index', 'content.package.vehicle.product.create', 'content.package.vehicle.product.update', 'content.merchant.vehicle.product.create', 'content.merchant.vehicle.product.edit', 'content.package.vehicle.requirement.index', 'content.package.vehicle.requirement.create', 'content.package.vehicle.requirement.edit', 'content.package.rental-services.services.rental-car.create','content.package.rental-services.services.rental-car.edit'], ColorComposer::class);

        View::composer(['content.package.vehicle.product.index', 'content.package.vehicle.product.create', 'content.package.vehicle.product.update', 'content.merchant.vehicle.product.create', 'content.merchant.vehicle.product.edit', 'content.package.vehicle.requirement.index', 'content.package.vehicle.requirement.create', 'content.package.vehicle.requirement.edit', 'content.package.rental-services.services.rental-car.create','content.package.rental-services.services.rental-car.edit'], CarmodelComposer::class);

        View::composer(['content.package.vehicle.product.index', 'content.package.vehicle.product.create', 'content.package.vehicle.product.update', 'content.merchant.vehicle.product.create', 'content.merchant.vehicle.product.edit', 'content.package.vehicle.requirement.index', 'content.package.vehicle.requirement.create', 'content.package.vehicle.requirement.edit'], AvailableComposer::class);

        View::composer(['content.package.vehicle.product.index', 'content.package.vehicle.product.create', 'content.package.vehicle.product.update', 'content.merchant.vehicle.product.create', 'content.merchant.vehicle.product.edit', 'content.package.vehicle.requirement.index', 'content.package.vehicle.requirement.create', 'content.package.rental-services.services.rental-car.create'], RegistrationComposer::class);

        View::composer(['content.package.property.product.create', 'content.package.property.product.update', 'content.merchant.vehicle.product.create', 'content.merchant.vehicle.product.edit'], PriceUnitComposer::class);
        View::composer(['content.package.property.product.create', 'content.package.property.product.update', 'content.merchant.vehicle.product.create', 'content.merchant.vehicle.product.edit'], SizeUnitComposer::class);
        View::composer(['content.package.property.product.create', 'content.package.property.product.update'], LandTypeComposer::class);
        View::composer(['livewire.accessory-card'], ShippingComposer::class);
        View::composer('layouts.partials.header', NotificationComposer::class);
        View::composer(['content.package.vehicle.product.index', 'content.package.vehicle.requirement.index', 'content.package.vehicle.requirement.create', 'content.package.vehicle.requirement.edit'], FeatureComposer::class);

        View::composer('content.admin.dashboard', DashboardComposer::class);
    }
}
