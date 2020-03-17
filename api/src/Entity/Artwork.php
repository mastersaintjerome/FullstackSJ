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
     * @ORM\ManyToMany(targetEntity="Artwork_tag")
     * @Assert\NotNull
     */
    public $tags;

    /**
     * @var Artwork The Category of the Artwork.
     *
     * @ORM\ManyToOne(targetEntity="Artwork_Category", inversedBy="artworks")
     * @Assert\NotNull
     */
    public $category;

    /**
     * @var Author[] Authors of the Artwork
     *
     * @ORM\ManyToMany(targetEntity="Author")
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
     * Artwork_Category constructor.
     */
    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->ratings = new ArrayCollection();
        $this->authors = new ArrayCollection();
        $this->locals = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
