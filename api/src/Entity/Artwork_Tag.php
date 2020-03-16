<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An Artwork tag/genre.
 *
 * @ORM\Entity
 * @ApiResource
 */
class Artwork_Tag
{
    /**
     * @var int The id of this Artwork Tag.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
}
