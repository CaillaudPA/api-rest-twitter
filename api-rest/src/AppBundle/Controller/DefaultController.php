<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/*
 * Entity
 */
use AppBundle\Entity\Tweet;

class DefaultController extends Controller
{
    private $dir;
    private $twitter;

    public function __construct()
    {
        $this->dir = 'localhost/api-rest-twitter/api-rest/web';

    }

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
        $response = $this->forward("AppBundle:Api:getTimeline", array("number"=>10));

        #$response = Request::create( $this->dir.'/getTimeline/5', 'GET' );
        $tweets = json_decode($response->getContent());


        return $this->render("tweet.html.twig", array("tweets"=>$tweets));
    }    

}
