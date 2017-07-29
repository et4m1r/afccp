<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @Vich\Uploadable
 * @ORM\Table(name="post")
 */
class Post
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1000, nullable=false)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $content;

    /**
     * @var datetime $createdAt
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var datetime $updatedAt
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="createdPosts")
     * @ORM\JoinColumn(name="created_user_id", referencedColumnName="id")
     */
    private $createdUser;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="updatedPosts")
     * @ORM\JoinColumn(name="updated_user_id", referencedColumnName="id")
     */
    private $updatedUser;

     /**
     * @var Image[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Image", mappedBy="post", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $images;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->images = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Post
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Post
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set createdUser
     *
     * @param \AppBundle\Entity\User $createdUser
     * @return Post
     */
    public function setCreatedUser(\AppBundle\Entity\User $createdUser = null)
    {
        $this->createdUser = $createdUser;

        return $this;
    }

    /**
     * Get createdUser
     *
     * @return \AppBundle\Entity\User 
     */
    public function getCreatedUser()
    {
        return $this->createdUser;
    }

    /**
     * Set updatedUser
     *
     * @param \AppBundle\Entity\User $updatedUser
     * @return Post
     */
    public function setUpdatedUser(\AppBundle\Entity\User $updatedUser = null)
    {
        $this->updatedUser = $updatedUser;

        return $this;
    }

    /**
     * Get updatedUser
     *
     * @return \AppBundle\Entity\User 
     */
    public function getUpdatedUser()
    {
        return $this->updatedUser;
    }
    
    /**
     * Get images
     *
     * @return Image[]|ArrayCollection
     */
    public function getImages()
    {
        return $this->images;
    }
    
    /**
     * Add image
     *
     * @param Image $image
     *
     * @return Post
     */
    public function addImage(Image $image)
    {
        $image->setPost($this);
        $this->images[] = $image;

        dump($image);

        return $this;
    }

    /**
     * Remove image
     *
     * @param Image $image
     */
    public function removeImage(Image $image)
    {
        $image->setPost(null); 
        $this->images->removeElement($image);
    }

}
