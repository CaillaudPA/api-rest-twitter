<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Tweet")
 */
class Tweet
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", length=100)
     */
    private $idTweet;

    /**
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    private function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of idTweet.
     *
     * @return mixed
     */
    public function getIdTweet()
    {
        return $this->idTweet;
    }

    /**
     * Sets the value of idTweet.
     *
     * @param mixed $idTweet the id tweet
     *
     * @return self
     */
    private function setIdTweet($idTweet)
    {
        $this->idTweet = $idTweet;

        return $this;
    }
}