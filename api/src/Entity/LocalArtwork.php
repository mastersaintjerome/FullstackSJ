<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Validator\Constraints as Assert;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Serializer\Filter\PropertyFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * A local Artwork : collection of artwork title in differents languages.
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
class LocalArtwork
{
    /**
     * @var string the local language.
     * @ORM\Id
     * @ORM\Column(type="text")
     * @Groups({"user:read", "user:write"})
     * @Assert\NotBlank
     */
    public $local;

    /**
     * @var Artwork The Artwork this local is about.
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Artwork", inversedBy="locals")
     * @ApiSubresource
     * @Groups({"user:read", "user:write"})
     * @Assert\NotNull
     */
    public $artwork;

    /**
     * @var string the title of the Artwork in the language of the local.
     *
     * @ORM\Column(type="text")
     * @Groups({"user:read", "user:write"})
     * @Assert\NotBlank
     */
    public $title;


}
