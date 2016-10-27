<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/*
 * Entity
 */
use AppBundle\Entity\Tweet;
use Symfony\Component\HttpFoundation\Response;

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
        $response = $this->forward("AppBundle:Api:getTimeline", array("number"=>10));

        #$response = Request::create( $this->dir.'/getTimeline/5', 'GET' );
        $tweets = json_decode($response->getContent());


        return $this->render("tweet.html.twig", array("tweets"=>$tweets));
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

    /**
     * @Route("/save-tweet/{id}", name="saveTweet")
     */
    public function saveTweet($id)
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();

        $pr = $doctrine->getRepository("AppBundle:Tweet");

        $tweet_exist = $pr->findOneByIdTweet($id);

        if(empty($tweet_exist)){
            $tweet = new Tweet($id);
            $em->persist($tweet);
            $em->flush();
            return new Response('Saved');
        }

        return new Response('Not saved');

    }

    /**
     * @Route("/showSavedTweet", name="showSavedTweet")
     */
    public function showSavedTweetAction()
    {
        $doctrine = $this->getDoctrine();
        $tweets = $doctrine->getRepository('AppBundle:Tweet')->findAll();

        $ids = [];
        foreach ($tweets as $t){
            $ids[] = $t->getIdTweet();
        }

        $tweets_json = [];

        foreach ($ids as $id){
            $response = $this->forward("AppBundle:Api:showTweet", array("id"=>$id));
            $tweets_json[] = json_decode($response->getContent());
        }

        //$response = $this->forward("AppBundle:Api:getListStatuses", array("ids"=>$ids));

        //$tweets = json_decode($response->getContent());


        return $this->render("tweetSave.html.twig", array("tweets"=>$tweets_json));
    }


    /**
     * @Route("remove_tweet/{id}", name="removeTweet")
     */
    public function removeTweetAction($id)
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();

        $tweet = $doctrine->getRepository('AppBundle:Tweet')->findOneByIdTweet($id);

        if(!empty($tweet)){
            $em->remove($tweet);
            $em->flush();
            return new Response('1');
        }

        return new Response('0');


    }


}
