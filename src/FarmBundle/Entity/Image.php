<?php

namespace FarmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="FarmBundle\Repository\ImageRepository")
 */
class Image
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=255, unique=true)
     */
    private $filename;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var \FarmBundle\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="\FarmBundle\Entity\Product", inversedBy="images")
     */
    private $product;

    /**
     * cette propriété sert a affciher un input file dans le form
     * elle n'est pas sauvegardée en bdd, car il n'y a pas d'annotation Column
     * c'est le filename qui sera sauvegardé en bdd
     * @var UploadedFile
     *
     * @Assert\Image(
     *   minWidth = 200,
     *   maxWidth = 400,
     *   minWidthMessage = "image trop petit",
     *   maxWidthMessage = "image trop gros",
     *   minHeight = 200,
     *   maxHeight = 400,
     *   maxSize = "20M",
     *   maxSizeMessage = "Votre image est trop gros, Max 20 méga SVP !"
     * )
     */
    private $file;

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file)
    {
        $this->file = $file;
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
     * Set filename
     *
     * @param string $filename
     * @return Image
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Image
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
     * Set product
     *
     * @param \FarmBundle\Entity\Product $product
     * @return Image
     */
    public function setProduct(\FarmBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \FarmBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }


}
