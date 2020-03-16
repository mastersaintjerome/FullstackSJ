<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A local Artwork : collection of artwork title in differents languages.
 *
 * @ORM\Entity
 * @ApiResource
 */
class Local_Artwork
{
    /**
     * @var string the local language.
     * @ORM\Id
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    public $local;

    /**
     * @var Artwork The Artwork this local is about.
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Artwork", inversedBy="local_artwork")
     * @Assert\NotNull
     */
    public $artwork;

    /**
     * @var string the title of the Artwork in the language of the local.
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    public $title;

    /**
     * @return string
     */
    public function getLocal(): string
    {
        return $this->local;
    }

    /**
     * @return Artwork
     */
    public function getArtwork(): Artwork
    {
        return $this->artwork;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
}
