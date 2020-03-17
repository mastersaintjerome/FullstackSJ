<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An Artwork Rating.
 *
 * @ORM\Entity
 * @ApiResource
 */
class Rating
{
    /**
     * @var User The User of the Rating.
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="User", inversedBy="ratings")
     * @Assert\NotNull
     */
    public $user;

    /**
     * @var Artwork The Artwork of the Rating.
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Artwork", inversedBy="ratings")
     * @Assert\NotNull
     */
    public $artwork;

    /**
     * @var int The rating of the Artwork by an User (between 1 and 5).
     *
     * @ORM\Column(type="smallint")
     * @Assert\Range(min=1, max=5)
     */
    public $grade;

    /**
     * @var \DateTimeInterface The date of the rating.
     *
     * @ORM\Column(type="datetime")
     * @Assert\NotNull
     */
    public $ratingDate;
}
