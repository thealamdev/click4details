<?php


use App\Models\RentalCategory;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MerchantController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Package\Vehicle\FuelController;
use App\Http\Controllers\Package\Vehicle\BrandController;
use App\Http\Controllers\Package\Vehicle\ColorController;
use App\Http\Controllers\Package\Vehicle\GradeController;
use App\Http\Controllers\Package\Vehicle\DetailController;
use App\Http\Controllers\Package\Vehicle\EngineController;
use App\Http\Controllers\Package\Vehicle\FeaturController;
use App\Http\Controllers\Package\Vehicle\EditionController;
use App\Http\Controllers\Package\Vehicle\GalleryController;
use App\Http\Controllers\Package\Vehicle\MileageController;
use App\Http\Controllers\Package\Vehicle\PackageController;
use App\Http\Controllers\Package\Vehicle\VehicleController;
use Intervention\Image\Drivers\Gd\Modifiers\RotateModifier;
use App\Http\Controllers\Package\Vehicle\CarmodelController;
use App\Http\Controllers\Package\Vehicle\SkeletonController;
use App\Http\Controllers\Package\Property\LandTypeController;
use App\Http\Controllers\Package\Property\PropertyController;
use App\Http\Controllers\Package\Property\SizeunitController;
use App\Http\Controllers\Package\Vehicle\AvailableController;
use App\Http\Controllers\Package\Vehicle\ConditionController;
use App\Http\Controllers\Package\Property\PriceunitController;
use App\Http\Controllers\Package\Vehicle\DescriptionController;
use App\Http\Controllers\Package\Accessories\ShippingController;
use App\Http\Controllers\Package\Vehicle\RegistrationController;
use App\Http\Controllers\Package\Vehicle\TransmissionController;
use App\Http\Controllers\Settings\Media\ImageDimentionController;
use App\Http\Controllers\Package\Accessories\AccessoriesController;
use App\Http\Controllers\Package\Property\PropertyGallaryController;
use App\Http\Controllers\Package\Accessories\AccessoryBrandController;
use App\Http\Controllers\Package\Accessories\AccessoryOrderController;
use App\Http\Controllers\Package\Vehicle\CustomerRequirementController;
use App\Http\Controllers\Package\CustomerCare\FeedbackMessageController;
use App\Http\Controllers\Package\CustomerCare\FollowupMessageController;
use App\Http\Controllers\Package\CustomerCare\FollowupPackageController;
use App\Http\Controllers\Package\Property\PropertyDescriptionController;
use App\Http\Controllers\Package\Accessories\AccessoriesGalleryController;
use App\Http\Controllers\Package\RentalServices\Services\GallaryController;
use App\Http\Controllers\Package\RentalServices\Services\RentalCarController;
use App\Http\Controllers\Package\Accessories\AccessoriesDescriptionController;
use App\Http\Controllers\Package\CustomerCare\FollowupMessageServiceController;
use App\Http\Controllers\Package\CustomerCare\CustomerFollowupMessageController;
use App\Http\Controllers\Package\RentalServices\Category\RentalCategoryController;
use App\Http\Controllers\Package\RentalServices\Services\RentCarGallaryController;
use App\Http\Controllers\Package\CustomerCare\CustomerFollowupMessageFeedbackController;
use App\Http\Controllers\Package\RentalServices\Services\RentCarDescriptionController;
use App\Http\Controllers\Package\Residence\ApartmentComplexController;
use App\Http\Controllers\Package\Residence\CompletionStatus;
use App\Http\Controllers\Package\Residence\CompletionStatusController;
use App\Http\Controllers\Package\Residence\FurnishedStatusController;
use App\Http\Controllers\Package\Residence\ResidenceController;
use App\Http\Controllers\Package\Residence\ResidenceDescriptionController;
use App\Http\Controllers\Package\Residence\ResidenceGalleryController;

Route::middleware(['auth:web', 'verified.admin'])->group(function () {
    Route::controller(DashboardController::class)->prefix('dashboard')->group(function () {
        Route::get('/', 'index')->name('dashboard');
    });

    Route::controller(SliderController::class)->prefix('sliders')->name('slider.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('{slider}/edit', 'edit')->name('edit');
        Route::put('{slider}', 'update')->name('update');
        Route::delete('{slider}', 'destroy')->name('delete');
    });

    Route::controller(CategoryController::class)->prefix('categories')->name('category.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('{category}/edit', 'edit')->name('edit');
        Route::put('{category}', 'update')->name('update');
        Route::delete('{category}', 'destroy')->name('delete');
    });

    Route::controller(ContactController::class)->prefix('contacts')->name('contact.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('{contact}/edit', 'edit')->name('edit');
        Route::put('{contact}', 'update')->name('update');
        Route::get('{contact}', 'destroy')->name('delete');
    });

    Route::controller(ClientController::class)->prefix('clients')->name('client.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('{client}/profile', 'show')->name('show');
        Route::get('{client}/edit', 'edit')->name('edit');
        Route::put('{client}', 'update')->name('update');
        Route::delete('{client}', 'destroy')->name('delete');
    });

    Route::controller(MerchantController::class)->prefix('merchants')->name('merchant.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('{merchant}/profile', 'show')->name('show');
        Route::get('{merchant}/edit', 'edit')->name('edit');
        Route::put('{merchant}', 'update')->name('update');
        Route::delete('{merchant}', 'destroy')->name('delete');
    });

    Route::controller(UserController::class)->prefix('users')->name('user.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('{user}/profile', 'show')->name('show');
        Route::get('{user}/edit', 'edit')->name('edit');
        Route::put('{user}', 'update')->name('update');
        Route::delete('{user}', 'destroy')->name('delete');

        Route::get('detail/{customer}', 'detail')->name('detail');
    });

    /**
     * vehicles & it's modules routes
     */
    Route::prefix('vehicles')->name('vehicle.')->group(function () {
        Route::controller(BrandController::class)->prefix('brands')->name('brand.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{brand}/edit', 'edit')->name('edit');
            Route::put('{brand}', 'update')->name('update');
            Route::delete('{brand}', 'destroy')->name('delete');
        });

        Route::controller(ColorController::class)->prefix('colors')->name('color.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{color}/edit', 'edit')->name('edit');
            Route::put('{color}', 'update')->name('update');
            Route::delete('{color}', 'destroy')->name('delete');
        });

        Route::controller(CarmodelController::class)->prefix('models')->name('model.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{model}/edit', 'edit')->name('edit');
            Route::put('{model}', 'update')->name('update');
            Route::delete('{model}', 'destroy')->name('delete');
        });

        Route::controller(AvailableController::class)->prefix('availables')->name('available.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{available}/edit', 'edit')->name('edit');
            Route::put('{available}', 'update')->name('update');
            Route::delete('{available}', 'destroy')->name('delete');
        });

        Route::controller(RegistrationController::class)->prefix('registrations')->name('registration.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{registration}/edit', 'edit')->name('edit');
            Route::put('{registration}', 'update')->name('update');
            Route::delete('{registration}', 'destroy')->name('delete');
        });


        Route::controller(EditionController::class)->prefix('editions')->name('edition.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{edition}/edit', 'edit')->name('edit');
            Route::put('{edition}', 'update')->name('update');
            Route::delete('{edition}', 'destroy')->name('delete');
        });

        Route::controller(ConditionController::class)->prefix('conditions')->name('condition.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{condition}/edit', 'edit')->name('edit');
            Route::put('{condition}', 'update')->name('update');
            Route::delete('{condition}', 'destroy')->name('delete');
        });

        Route::controller(EngineController::class)->prefix('engines')->name('engine.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{engine}/edit', 'edit')->name('edit');
            Route::put('{engine}', 'update')->name('update');
            Route::delete('{engine}', 'destroy')->name('delete');
        });

        Route::controller(FuelController::class)->prefix('fuels')->name('fuel.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{fuel}/edit', 'edit')->name('edit');
            Route::put('{fuel}', 'update')->name('update');
            Route::delete('{fuel}', 'destroy')->name('delete');
        });

        Route::controller(SkeletonController::class)->prefix('skeletons')->name('skeleton.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{skeleton}/edit', 'edit')->name('edit');
            Route::put('{skeleton}', 'update')->name('update');
            Route::delete('{skeleton}', 'destroy')->name('delete');
        });

        Route::controller(MileageController::class)->prefix('mileages')->name('mileage.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{mileage}/edit', 'edit')->name('edit');
            Route::put('{mileage}', 'update')->name('update');
            Route::delete('{mileage}', 'destroy')->name('delete');
        });

        Route::controller(TransmissionController::class)->prefix('transmissions')->name('transmission.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{transmission}/edit', 'edit')->name('edit');
            Route::put('{transmission}', 'update')->name('update');
            Route::delete('{transmission}', 'destroy')->name('delete');
        });

        Route::controller(GradeController::class)->prefix('grades')->name('grade.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{grade}/edit', 'edit')->name('edit');
            Route::put('{grade}', 'update')->name('update');
            Route::delete('{grade}', 'destroy')->name('delete');
        });

        Route::controller(FeaturController::class)->prefix('featur')->name('featur.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{featur}/edit', 'edit')->name('edit');
            Route::put('{featur}', 'update')->name('update');
            Route::delete('{featur}', 'destroy')->name('delete');
        });

        Route::controller(DetailController::class)->prefix('detail')->name('detail.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{detail}/edit', 'edit')->name('edit');
            Route::put('{detail}', 'update')->name('update');
            Route::delete('{detail}', 'destroy')->name('delete');
        });

        Route::controller(PackageController::class)->prefix('package')->name('package.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('{package}/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{package}/edit', 'edit')->name('edit');
            Route::put('{package}', 'update')->name('update');
            Route::delete('{package}', 'destroy')->name('delete');
        });

        Route::prefix('products')->group(function () {
            Route::controller(VehicleController::class)->name('product.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('{product}/edit', 'edit')->name('edit');
                Route::put('{product}', 'update')->name('update');
                Route::delete('{product}', 'destroy')->name('delete');
                Route::get('secure', 'secure')->name('secure');
                Route::get('notification/{id}', 'notification')->name('notification');
                Route::get('notifications/read-all', 'notificationRead')->name('notificationRead');
            });


            Route::prefix('requirement')->group(function () {
                Route::controller(CustomerRequirementController::class)->name('requirement.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/create', 'create')->name('create');
                    Route::get('/detail', 'detail')->name('detail');
                    Route::post('/', 'store')->name('store');
                    Route::get('{requirement}/edit', 'edit')->name('edit');
                    Route::get('search', 'search')->name('search');
                    Route::get('filter', 'filter')->name('filter');
                    Route::get('filter/clients', 'filterClient')->name('filterClient');
                    Route::get('clients', 'clients')->name('clients');
                    Route::put('{requirement}', 'update')->name('update');
                    Route::put('{requirement}/update', 'instructionUpdate')->name('instructionUpdate');
                    Route::put('{requirement}/handover', 'handover')->name('handover');
                    Route::put('{requirement}/share', 'share')->name('share');
                });

                /**
                 * customer followup and followup's feedback routes.
                 */
                Route::prefix('{customer}')->name('customer.')->group(function () {
                    Route::controller(CustomerFollowupMessageController::class)->prefix('followup-message')->name('followup-message.')->group(function () {
                        Route::get('/', 'index')->name('index');
                        Route::get('create', 'create')->name('create');
                        Route::post('/', 'store')->name('store');
                        Route::get('edit', 'edit')->name('edit');
                        Route::put('update', 'update')->name('update');
                        Route::get('add-call/{customerFollowupMessage}', 'addCall')->name('addCall');
                        Route::get('remove-call/{customerFollowupMessage}', 'removeCall')->name('removeCall');
                        Route::get('add-followup/{customerFollowupMessage}', 'addFollowup')->name('addFollowup');
                        Route::post('add-followup', 'addFollowupStore')->name('addFollowupStore');
                        Route::post('visit/followup/store/{customerFollowupMessage}', 'visitFollowupStore')->name('visitFollowupStore');
                        Route::get('{customerFollowupMessage}', 'destroy')->name('delete');
                    });
                });

                Route::prefix('{followup}')->name('followup.')->group(function () {
                    Route::controller(CustomerFollowupMessageFeedbackController::class)->prefix('feedback-message')->name('feedback-message.')->group(function () {
                        Route::get('/', 'index')->name('index');
                        Route::get('create', 'create')->name('create');
                        Route::post('/', 'store')->name('store');
                        Route::get('updateMessageStatus', 'updateMessageStatus')->name('updateMessageStatus');
                        Route::put('updateCallStatus', 'updateCallStatus')->name('updateCallStatus');
                    });
                });
            });

            Route::prefix('{vehicle}')->group(function () {
                Route::controller(DescriptionController::class)->prefix('descriptions')->name('description.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::post('/', 'store')->name('store');
                });

                Route::controller(GalleryController::class)->prefix('galleries')->name('gallery.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::post('/', 'store')->name('store');
                    Route::delete('{gallery}', 'destroy')->name('delete');
                });
            });
        });
    });

    /**
     * Residence & it's modules routes
     */
    Route::prefix('residences')->name('residence.')->group(function () {
        Route::controller(CompletionStatusController::class)->prefix('completion-status')->name('completion-status.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('{completionStatus}/edit', 'edit')->name('edit');
            Route::put('{completionStatus}', 'update')->name('update');
            Route::delete('{completionStatus}', 'destroy')->name('delete');
        });

        Route::controller(FurnishedStatusController::class)->prefix('furnished-status')->name('furnished-status.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('{furnishedStatus}/edit', 'edit')->name('edit');
            Route::put('{furnishedStatus}', 'update')->name('update');
            Route::delete('{furnishedStatus}', 'destroy')->name('delete');
        });

        Route::controller(ApartmentComplexController::class)->prefix('apartment-complex')->name('apartment-complex.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('{apartmentComplex}/edit', 'edit')->name('edit');
            Route::put('{apartmentComplex}', 'update')->name('update');
            Route::delete('{apartmentComplex}', 'destroy')->name('delete');
        });

        Route::controller(ResidenceController::class)->prefix('products')->name('product.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('{residence}/edit', 'edit')->name('edit');
            Route::put('{residence}', 'update')->name('update');
            Route::delete('{residence}', 'destroy')->name('delete');

            Route::prefix('{residence}')->group(function () {
                Route::controller(ResidenceDescriptionController::class)->prefix('descriptions')->name('description.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::post('/', 'store')->name('store');
                });

                Route::controller(ResidenceGalleryController::class)->prefix('galleries')->name('gallery.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::post('/', 'store')->name('store');
                    Route::delete('{gallery}', 'destroy')->name('delete');
                });
            });
        });
    });


    /**
     * Followup & feedback Routes.
     */
    Route::prefix('customer-care')->name('customer-care.')->group(function () {
        Route::prefix('followup-message')->name('followup-message.')->group(function () {
            Route::controller(FollowupMessageController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('', 'store')->name('store');
                Route::get('{followupMessage}/edit', 'edit')->name('edit');
                Route::put('{followupMessage}/update', 'update')->name('update');
                Route::delete('{followupMessage}/delete', 'destroy')->name('delete');
            });
        });

        Route::prefix('followup-package')->name('followup-package.')->group(function () {
            Route::controller(FollowupPackageController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('', 'store')->name('store');
                Route::get('{followupMessage}/edit', 'edit')->name('edit');
                Route::put('{followupMessage}/update', 'update')->name('update');
                Route::delete('{followupMessage}/delete', 'destroy')->name('delete');
            });
        });

        Route::prefix('followup-message-service')->name('followup-message-service.')->group(function () {
            Route::controller(FollowupMessageServiceController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('', 'store')->name('store');
                Route::get('{followupMessage}/edit', 'edit')->name('edit');
                Route::put('{followupMessage}/update', 'update')->name('update');
                Route::delete('{followupMessage}/delete', 'destroy')->name('delete');
            });
        });

        Route::prefix('feedback-message')->name('feedback-message.')->group(function () {
            Route::controller(FeedbackMessageController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('', 'store')->name('store');
                Route::get('{feedbackMessage}/edit', 'edit')->name('edit');
                Route::put('{feedbackMessage}/update', 'update')->name('update');
                Route::delete('{feedbackMessage}/delete', 'destroy')->name('delete');
            });
        });
    });


    /**
     * Land All controllers are here.
     */
    Route::prefix('properties')->name('property.')->group(function () {

        Route::controller(LandTypeController::class)->prefix('types')->name('type.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{type}/profile', 'show')->name('show');
            Route::get('{type}/edit', 'edit')->name('edit');
            Route::put('{type}', 'update')->name('update');
            Route::delete('{type}', 'destroy')->name('delete');
        });

        Route::controller(SizeunitController::class)->prefix('sizes')->name('size.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{size}/profile', 'show')->name('show');
            Route::get('{size}/edit', 'edit')->name('edit');
            Route::put('{size}', 'update')->name('update');
            Route::delete('{size}', 'destroy')->name('delete');
        });

        Route::controller(PriceunitController::class)->prefix('prices')->name('price.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{price}/profile', 'show')->name('show');
            Route::get('{price}/edit', 'edit')->name('edit');
            Route::put('{price}', 'update')->name('update');
            Route::delete('{price}', 'destroy')->name('delete');
        });

        Route::prefix('products')->group(function () {
            Route::controller(PropertyController::class)->name('product.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('{product}/edit', 'edit')->name('edit');
                Route::put('{product}', 'update')->name('update');
                Route::delete('{product}', 'destroy')->name('delete');
            });

            Route::prefix('{property}')->group(function () {
                Route::controller(PropertyDescriptionController::class)->prefix('descriptions')->name('description.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::post('/', 'store')->name('store');
                });

                Route::controller(PropertyGallaryController::class)->prefix('galleries')->name('gallery.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::post('/', 'store')->name('store');
                    Route::delete('{gallery}', 'destroy')->name('delete');
                });
            });
        });
    });

    /**
     *   Accessories Routes.
     */
    Route::prefix('accessories')->name('accessory.')->group(function () {
        Route::prefix('products')->group(function () {

            Route::controller(ShippingController::class)->prefix('shippings')->name('shipping.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('{shipping}/edit', 'edit')->name('edit');
                Route::put('{shipping}', 'update')->name('update');
                Route::delete('{shipping}', 'destroy')->name('delete');
            });

            Route::controller(AccessoryBrandController::class)->prefix('brands')->name('brand.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('{brand}/edit', 'edit')->name('edit');
                Route::put('{brand}', 'update')->name('update');
                Route::delete('{brand}', 'destroy')->name('delete');
            });

            Route::controller(AccessoryOrderController::class)->prefix('orders')->name('order.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('{order}/edit', 'edit')->name('edit');
                Route::get('{order}/show', 'show')->name('show');
                Route::get('{order}/pay', 'pay')->name('pay');
                Route::put('{order}/pay', 'dopay')->name('dopay');
                Route::get('{order}/update-order-status', 'updateOrder')->name('updateOrder');
                Route::put('{order}/update-order-status', 'updateOrderStatus')->name('updateOrderStatus');
                Route::get('{order}/payment-history', 'paymentHistory')->name('paymentHistory');
                Route::delete('{order}', 'destroy')->name('delete');
            });


            Route::controller(AccessoriesController::class)->name('product.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('{product}/edit', 'edit')->name('edit');
                Route::put('{product}', 'update')->name('update');
                Route::delete('{product}', 'destroy')->name('delete');
                // note:
                Route::get('search', 'search')->name('search');
            });

            Route::prefix('{accessory}')->group(function () {
                Route::controller(AccessoriesDescriptionController::class)->prefix('descriptions')->name('description.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::post('/', 'store')->name('store');
                });

                Route::controller(AccessoriesGalleryController::class)->prefix('galleries')->name('gallery.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::post('/', 'store')->name('store');
                    Route::delete('{gallery}', 'destroy')->name('delete');
                });
            });
        });
    });

    /**
     * Rental Service Routes
     */
    Route::prefix('rental')->name('rental.')->group(function () {
        Route::prefix('categories')->name('category.')->group(function () {
            Route::controller(RentalCategoryController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
            });
        });
        Route::prefix('services')->name('service.')->group(function () {
            Route::prefix('cars')->name('car.')->group(function () {
                Route::controller(RentalCarController::class)->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('create', 'create')->name('create');
                    Route::post('/', 'store')->name('store');
                    Route::get('{rentCar}/edit', 'edit')->name('edit');
                    Route::put('{rentCar}/update', 'update')->name('update');
                    Route::delete('{rentCar}', 'destroy')->name('delete');
                });
                Route::prefix('{rentCar}')->group(function () {
                    Route::controller(RentCarDescriptionController::class)->prefix('descriptions')->name('description.')->group(function () {
                        Route::get('create', 'create')->name('create');
                        Route::post('store', 'store')->name('store');
                        Route::delete('{description}', 'destroy')->name('delete');
                    });
                });
                Route::prefix('{rentCar}')->group(function () {
                    Route::controller(RentCarGallaryController::class)->prefix('galleries')->name('gallery.')->group(function () {
                        Route::get('create', 'create')->name('create');
                        Route::post('store', 'store')->name('store');
                        Route::delete('{gallery}', 'destroy')->name('delete');
                    });
                });
            });
        });
    });
    /**
     * settings routes
     */
    Route::prefix('settings')->name('setting.')->group(function () {
        Route::prefix('medias')->name('media.')->group(function () {
            Route::controller(ImageDimentionController::class)->group(function () {
                Route::prefix('image-dimention')->name('image-dimentin.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::post('/', 'updateOrCreate')->name('updateOrCreate');
                });
            });
        });
    });
});

/**
 * whats app vehicle view.
 */
Route::controller(VehicleController::class)->group(function () {
    Route::get('vehicle-whatsapp/{slug}', 'VehicleWhatsApp')->name('VehicleWhatsApp');
});
