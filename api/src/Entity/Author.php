<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Serializer\Filter\PropertyFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * An Author.
 *
 * @ORM\Entity
 * @ApiResource(
 *     attributes={"security"="IS_AUTHENTICATED_ANONYMOUSLY"},
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
class Author
{
    /**
     * @var int The id of this Author.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string The author firstName.
     *
     * @ORM\Column(type="text")
     * @Groups({"user:read", "user:write"})
     * @Assert\NotBlank
     */
    public $firstname;

    /**
     * @var string The author lastname.
     *
     * @ORM\Column(type="text")
     * @Groups({"user:read", "user:write"})
     * @Assert\NotBlank
     */
    public $lastname;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
