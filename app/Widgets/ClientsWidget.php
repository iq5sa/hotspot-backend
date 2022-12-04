<?php

namespace App\Widgets;
use App\Ad;
use App\Client;
use App\Location;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;

class ClientsWidget extends BaseDimmer
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $count = Client::count();
        $string = "Client";

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-images',
            'title'  => "{$count} {$string}",
            'text'   => "You have $count client in your database. Click on button below to view all client.",
            'button' => [
                'text' => __('voyager::dimmer.user_link_text'),
                'link' => route('voyager.clients.index'),
            ],
            'image' => asset("images/clients.jpeg")
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return Auth::user()->can('browse', Voyager::model('User'));
    }
}
