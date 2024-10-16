<?php

namespace App\View\Composers;

use App\Models\User;
use Illuminate\View\View;

class NotificationComposer
{
    /**
     * Data to be passed to the view
     *
     * @var array|object
     */
    private $response;

    /**
     * Create a new composer instance
     */
    public function __construct()
    {
        $user = auth()->user();
        if ($user) {
            $this->response = $user;
        }
    }

    /**
     * Bind data to the view
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        // Pass the data to the view
        $view->with('user', $this->response);
    }
}
