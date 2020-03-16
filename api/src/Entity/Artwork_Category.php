<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An Artwork category.
 *
 * @ORM\Entity
 * @ApiResource
 */
class Artwork_Category
{
    /**
     * @var int The id of this Artwork Category.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
}
