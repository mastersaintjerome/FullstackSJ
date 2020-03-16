<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An Artwork.
 *
 * @ORM\Entity
 * @ApiResource
 */
class Artwork
{
    /**
     * @var int The id of this Artwork.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string The description of this Artwork.
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    public $description;

    /**
     * @var \DateTimeInterface The publication date of this Artwork.
     *
     * @ORM\Column(type="datetime")
     * @Assert\NotNull
     */
    public $publicationDate;

    /**
     * @var string The image path of this Artwork.
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    public $image;

    /**
     * @var Local_Artwork[] Available local for this Artwork.
     *
     * @ORM\OneToMany(targetEntity="Local_Artwork", mappedBy="artwork", cascade={"persist", "remove"})
     */
    public $locals;

    /**
     * @var Artwork_Tag[] Tags of the Artwork
     *
     * @ORM\ManyToMany(targetEntity="Artwork_tag", inversedBy="artwork")
     * @Assert\NotNull
     */
    public $tags;

    /**
     * @var Artwork The Category of the Artwork.
     *
     * @ORM\ManyToOne(targetEntity="Artwork_Category", inversedBy="artwork")
     * @Assert\NotNull
     */
    public $category;

    /**
     * @var Author[] Authors of the Artwork
     *
     * @ORM\ManyToMany(targetEntity="Author", inversedBy="artwork")
     * @Assert\NotNull
     */
    public $authors;

    /**
     * @var Rating[] Available rating for this artwork.
     *
     * @ORM\OneToMany(targetEntity="Rating", mappedBy="artwork", cascade={"persist", "remove"})
     */
    public $ratings;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
