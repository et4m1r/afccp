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
 * @ORM\Table(name="application")
 */
class Application
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
    private $departmentName;

    /**
     * @ORM\Column(type="string", length=1000, nullable=false)
     */
    private $applicantBio;

    /**
     * @ORM\Column(type="string", length=1000, nullable=false)
     */
    private $applicantAddress;

    /**
     * @ORM\Column(type="decimal", length=20, nullable=false)
     */
    private $applicantPhone;

    /**
     * @ORM\Column(type="string", length=1000, nullable=false)
     */
    private $applicantName;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $request;

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

    public function __construct()
    {
        $this->createdAt = new \DateTime();
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
     * Set departmentName
     *
     * @param string $departmentName
     * @return Application
     */
    public function setDepartmentName($departmentName)
    {
        $this->departmentName = $departmentName;

        return $this;
    }

    /**
     * Get departmentName
     *
     * @return string 
     */
    public function getDepartmentName()
    {
        return $this->departmentName;
    }

    /**
     * Set applicantBio
     *
     * @param string $applicantBio
     * @return Application
     */
    public function setApplicantBio($applicantBio)
    {
        $this->applicantBio = $applicantBio;

        return $this;
    }

    /**
     * Get applicantBio
     *
     * @return string 
     */
    public function getApplicantBio()
    {
        return $this->applicantBio;
    }

    /**
     * Set applicantAddress
     *
     * @param string $applicantAddress
     * @return Application
     */
    public function setApplicantAddress($applicantAddress)
    {
        $this->applicantAddress = $applicantAddress;

        return $this;
    }

    /**
     * Get applicantAddress
     *
     * @return string 
     */
    public function getApplicantAddress()
    {
        return $this->applicantAddress;
    }

    /**
     * Set applicantPhone
     *
     * @param string $applicantPhone
     * @return Application
     */
    public function setApplicantPhone($applicantPhone)
    {
        $this->applicantPhone = $applicantPhone;

        return $this;
    }

    /**
     * Get applicantPhone
     *
     * @return string 
     */
    public function getApplicantPhone()
    {
        return $this->applicantPhone;
    }

    /**
     * Set applicantName
     *
     * @param string $applicantName
     * @return Application
     */
    public function setApplicantName($applicantName)
    {
        $this->applicantName = $applicantName;

        return $this;
    }

    /**
     * Get applicantName
     *
     * @return string 
     */
    public function getApplicantName()
    {
        return $this->applicantName;
    }

    /**
     * Set request
     *
     * @param string $request
     * @return Application
     */
    public function setRequest($request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * Get request
     *
     * @return string 
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Application
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
     * @return Application
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
     * @return Application
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
     * @return Application
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
     * @return Application
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
     * @return Application
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
}
