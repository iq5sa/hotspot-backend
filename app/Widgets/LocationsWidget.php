<?php

namespace App\Widgets;
use App\Location;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;

class LocationsWidget extends BaseDimmer
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
        $count = Location::count();
        $string = "Location";

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-location',
            'title'  => "{$count} {$string}",
            'text'   => "You have $count locations in your database. Click on button below to view all locations.",
            'button' => [
                'text' => __('voyager::dimmer.user_link_text'),
                'link' => route('voyager.locations.index'),
            ],
            'image' => asset("images/locations.jpg")
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
