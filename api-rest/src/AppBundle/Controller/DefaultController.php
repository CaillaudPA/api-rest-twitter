<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Endroid\Bundle\TwitterBundle\EndroidTwitterBundle;
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/my-tweets", name="myTweet")
     */
    public function showTweet()
    {

        $twitter = $this->get('endroid.twitter');

// Retrieve the user's timeline
        $tweets = $twitter->getTimeline(array(
            'count' => 5
        ));

// Or retrieve the timeline using the generic query method
        $response = $twitter->query('statuses/user_timeline', 'GET', 'json');
        $tweets = json_decode($response->getContent());
        var_dump($tweets);
        $data = [];
        return $this->render("tweet.html.twig", $data);
    }

}
