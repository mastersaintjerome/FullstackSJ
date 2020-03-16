<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An Author.
 *
 * @ORM\Entity
 * @ApiResource
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
     * @ORM\Column
     * @Assert\NotBlank
     */
    public $firstname;

    /**
     * @var string The author lastname.
     *
     * @ORM\Column
     * @Assert\NotBlank
     */
    public $lastname;

    /**
     * @var Artwork[] Artworks of the Authors
     *
     * @ORM\ManyToMany(targetEntity="Artwork", inversedBy="author")
     * @Assert\NotNull
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
