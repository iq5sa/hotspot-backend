<?php

namespace App\Widgets;
use App\Ad;
use App\Location;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;

class AdsWidget extends BaseDimmer
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
        $count = Ad::count();
        $string = "Ads";

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-images',
            'title'  => "{$count} {$string}",
            'text'   => "You have $count ads in your database. Click on button below to view all ads.>>>>>>>>>>",
            'button' => [
                'text' => __('voyager::dimmer.user_link_text'),
                'link' => route('voyager.ads.index'),
            ],
            'image' => asset("images/ads.jpg")
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
