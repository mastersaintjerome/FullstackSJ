<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\OneToMany(targetEntity="Artwork", mappedBy="Artwork_Category", cascade={"persist", "remove"})
     */
    public $artworks;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
