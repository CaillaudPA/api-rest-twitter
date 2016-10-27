<?php
/**
 * Created by PhpStorm.
 * User: Pierre-Antoine
 * Date: 26/10/2016
 * Time: 21:48
 */

namespace AppBundle\Service;

class ApiTwitter{

    private $twitter;

    public function __construct()
    {
        $this->twitter = $this->get('endroid.twitter');
    }

    public function getTimeline($number = 5)
    {
        $tweets = $this->twitter->getTimeline(array(
            'count' => 5
        ));

        // Or retrieve the timeline using the generic query method
        $response = $this->twitter->query('statuses/user_timeline', 'GET', 'json');

        return $response;
    }

}