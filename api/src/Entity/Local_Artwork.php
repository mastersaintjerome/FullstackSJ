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
     * @ORM\ManyToOne(targetEntity="Artwork", inversedBy="locals")
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
}
