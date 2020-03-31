<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Serializer\Filter\PropertyFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * An Artwork.
 *
 * @ORM\Entity
 * @ApiResource(
 *     attributes={"security"="is_granted('ROLE_USER')"},
 *     collectionOperations={
 *          "get",
 *          "post"={"security"="is_granted('IS_AUTHENTICATED_ANONYMOUSLY')"},
 *     },
 *     itemOperations={
 *          "get",
 *          "put"={"security"="is_granted('ROLE_ADMIN')"},
 *          "delete"={"security"="is_granted('ROLE_ADMIN')"}
 *     },
 *     normalizationContext={"groups"={"user:read"}},
 *     denormalizationContext={"groups"={"user:write"}},
 * )
 * @ApiFilter(PropertyFilter::class)
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
     * @var string The synopsis of this Artwork.
     *
     * @ORM\Column(type="text")
     * @Groups({"user:read", "user:write"})
     * @Assert\NotBlank
     */
    public $synopsis;

    /**
     * @var \DateTimeInterface The publication date of this Artwork.
     *
     * @ORM\Column(type="datetime")
     * @Groups({"user:read", "user:write"})
     * @Assert\NotNull
     */
    public $publicationDate;

    /**
     * @var string The image path of this Artwork.
     *
     * @ORM\Column(type="text")
     * @Groups({"user:read", "user:write"})
     * @Assert\NotBlank
     */
    public $image;

    /**
     * @var Local_Artwork[] Available local for this Artwork.
     * @ORM\OneToMany(targetEntity="LocalArtwork", mappedBy="artwork", cascade={"persist", "remove"})
     * @ApiSubresource
     * @Groups({"user:read", "user:write"})
     */
    public $locals;

    /**
     * @var Artwork_Tag[] Tags of the Artwork
     *
     * @ORM\ManyToMany(targetEntity="ArtworkTag")
     * @ApiSubresource
     * @Groups({"user:read", "user:write"})
     * @Assert\NotNull
     */
    public $tags;

    /**
     * @var Artwork The Category of the Artwork.
     *
     * @ORM\ManyToOne(targetEntity="ArtworkCategory", inversedBy="artworks")
     * @ApiSubresource
     * @Groups({"user:read", "user:write"})
     * @Assert\NotNull
     */
    public $category;

    /**
     * @var Author[] Authors of the Artwork
     *
     * @ORM\ManyToMany(targetEntity="Author")
     * @ApiSubresource
     * @Groups({"user:read", "user:write"})
     * @Assert\NotNull
     */
    public $authors;

    /**
     * @var Rating[] Available rating for this artwork.
     * @ORM\OneToMany(targetEntity="Rating", mappedBy="artwork", cascade={"persist", "remove"})
     * @ApiSubresource
     * @Groups({"user:read", "user:write"})
     */
    public $ratings;

    /**
     * @var Favorite[] Available favorite for this artwork.
     * @ORM\OneToMany(targetEntity="Favorite", mappedBy="artwork", cascade={"persist", "remove"})
     * @ApiSubresource
     * @Groups({"user:read", "user:write"})
     */
    public $favorites;

    /**
     * @var Comment[] Available comment for this artwork.
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="artwork", cascade={"persist", "remove"})
     * @ApiSubresource
     * @Groups({"user:read", "user:write"})
     */
    public $comments;

    /**
     * Artwork_Category constructor.
     */
    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->ratings = new ArrayCollection();
        $this->authors = new ArrayCollection();
        $this->locals = new ArrayCollection();
        $this->favorites = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
