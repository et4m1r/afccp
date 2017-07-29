<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="createdUser")
     */
    private $createdPosts;

     /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="updatedUser")
     */
    private $updatedPosts;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Add posts
     *
     * @param \AppBundle\Entity\Post $posts
     * @return User
     */
    public function addPost(\AppBundle\Entity\Post $posts)
    {
        $this->posts[] = $posts;

        return $this;
    }

    /**
     * Remove posts
     *
     * @param \AppBundle\Entity\Post $posts
     */
    public function removePost(\AppBundle\Entity\Post $posts)
    {
        $this->posts->removeElement($posts);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Add createdPosts
     *
     * @param \AppBundle\Entity\Post $createdPosts
     * @return User
     */
    public function addCreatedPost(\AppBundle\Entity\Post $createdPosts)
    {
        $this->createdPosts[] = $createdPosts;

        return $this;
    }

    /**
     * Remove createdPosts
     *
     * @param \AppBundle\Entity\Post $createdPosts
     */
    public function removeCreatedPost(\AppBundle\Entity\Post $createdPosts)
    {
        $this->createdPosts->removeElement($createdPosts);
    }

    /**
     * Get createdPosts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCreatedPosts()
    {
        return $this->createdPosts;
    }

    /**
     * Add updatedPosts
     *
     * @param \AppBundle\Entity\Post $updatedPosts
     * @return User
     */
    public function addUpdatedPost(\AppBundle\Entity\Post $updatedPosts)
    {
        $this->updatedPosts[] = $updatedPosts;

        return $this;
    }

    /**
     * Remove updatedPosts
     *
     * @param \AppBundle\Entity\Post $updatedPosts
     */
    public function removeUpdatedPost(\AppBundle\Entity\Post $updatedPosts)
    {
        $this->updatedPosts->removeElement($updatedPosts);
    }

    /**
     * Get updatedPosts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUpdatedPosts()
    {
        return $this->updatedPosts;
    }
}
