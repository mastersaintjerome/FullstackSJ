<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * An Artwork category.
 *
 * @ORM\Entity
 * @ApiResource
 */
class Artwork_Category
{
    /**
     * @var int The id of this Artwork Category.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string The category of the Artwork.
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    public $category;

    /**
     * @var Artwork[] Available artwork for this category.
     *
     * @ORM\OneToMany(targetEntity="Artwork", mappedBy="category", cascade={"persist", "remove"})
     */
    public $artworks;

    /**
     * Artwork_Category constructor.
     */
    public function __construct()
    {
        $this->artworks = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


}
