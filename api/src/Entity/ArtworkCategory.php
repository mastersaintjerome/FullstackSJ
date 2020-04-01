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
 * An Artwork category.
 *
 * @ORM\Entity
 * @ApiResource(
 *     attributes={"security"="is_granted('IS_AUTHENTICATED_ANONYMOUSLY')"},
 *     collectionOperations={
 *          "get",
 *          "post"={"security"="is_granted('IS_AUTHENTICATED_ANONYMOUSLY')"},
 *     },
 *     itemOperations={
 *          "get",
 *          "put"={"security"="is_granted('IS_AUTHENTICATED_ANONYMOUSLY')"},
 *          "delete"={"security"="is_granted('IS_AUTHENTICATED_ANONYMOUSLY')"}
 *     },
 *     normalizationContext={"groups"={"user:read"}},
 *     denormalizationContext={"groups"={"user:write"}},
 * )
 * @ApiFilter(PropertyFilter::class)
 */
class ArtworkCategory
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
     * @Groups({"user:read", "user:write"})
     * @Assert\NotBlank
     */
    public $category;

    /**
     * @var Artwork[] Available artwork for this category.
     *
     * @ORM\OneToMany(targetEntity="Artwork", mappedBy="category", cascade={"persist", "remove"})
     * @Groups({"user:read", "user:write"})
     * @ApiSubresource
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
