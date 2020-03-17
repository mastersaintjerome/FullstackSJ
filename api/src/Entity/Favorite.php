<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * A Favorite.
 *
 * @ORM\Entity
 * @ApiResource
 */
class Favorite
{
    /**
     * @var User The User of the Rating.
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="User", inversedBy="favorites")
     * @Assert\NotNull
     */
    public $user;

    /**
     * @var Artwork The Artwork of the Rating.
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Artwork", inversedBy="favorites")
     * @Assert\NotNull
     */
    public $artwork;

    /**
     * @var \DateTimeInterface The date of the favorite.
     *
     * @ORM\Column(type="datetime")
     * @Assert\NotNull
     */
    public $favoriteDate;
}
