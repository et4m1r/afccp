<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Image")
 * @Vich\Uploadable
 */
class Image
{
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Post", inversedBy="image")
     * @ORM\JoinColumn(nullable=false, referencedColumnName="id")
     */
    protected $post;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    protected $file_name;

    /**
     * @Vich\UploadableField(mapping="post_images", fileNameProperty="file_name")
     * @var File $image
     */
    protected $image;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set product.
     *
     * @param \AppBundle\Entity\Post $post
     *
     * @return Image
     */
    public function setPost(Post $post)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get product.
     *
     * @return \AppBundle\Entity\Post
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set Image
     *
     * @param File $image
     *
     * @return $this
     */
    public function setImage(File $image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * Get Image
     *
     * @return File
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set FileName
     *
     * @param $file_name
     *
     * @return $this
     */
    public function setFileName($file_name){
        $this->file_name = $file_name;

        return $this;
    }

    /**
     * Get FileName
     *
     * @return string
     */
    public function getFileName(){
        return $this->file_name;
    }
}
