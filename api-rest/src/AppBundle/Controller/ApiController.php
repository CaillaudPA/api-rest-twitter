<?php
/**
 * Created by PhpStorm.
 * User: Pierre-Antoine
 * Date: 26/10/2016
 * Time: 21:54
 */

namespace AppBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\DependencyInjection\Dump\Container;
use Symfony\Component\HttpFoundation\Response;


class ApiController extends Controller
{

    private $twitter;

    public function __construct()
    {
    }

    /**
     * @Route("/getTimeline/{number}", name="getTimeline")
     */
    public function getTimelineAction($number = 5)
    {
        $this->twitter = $this->get('endroid.twitter');
        $tweets = $this->twitter->query('statuses/home_timeline', 'GET', 'json', array("count"=>$number));

        $response = json_decode($tweets->getContent());

        return $this->json($response);
        #return $this->twitter->query('statuses/user_timeline', 'GET', 'json');
    }

    /**
     * @Route("/showTweet/{id}", name="showTweet")
     */
    public function showTweetAction($id)
    {
        $this->twitter = $this->get('endroid.twitter');
        $tweets = $this->twitter->query("statuses/show", 'GET', 'json', array('id'=>$id));

        $response = json_decode($tweets->getContent());

        return $this->json($response);
        #return $this->twitter->query('statuses/user_timeline', 'GET', 'json');
    }



    /**
     * @Route("/lists/statuses", name="getListStatuses")
     */
    public function getListStatusesAction($ids)
    {

        $this->twitter = $this->get('endroid.twitter');
        var_dump($ids);
        $tweets = $this->twitter->query("lists/statuses", 'GET', 'json', array('list_id'=>$ids));
        var_dump('ok');
        $response = json_decode($tweets->getContent());

        return $this->json($response);
    }

}