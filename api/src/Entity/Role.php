<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * An User Role.
 *
 * @ORM\Entity
 * @ApiResource
 */
class Role
{
    /**
     * @var int The id of this User ROle.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string the name of the role.
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    public $name;

    /**
     * @var User[] Users with the role.
     *
     * @ORM\OneToMany(targetEntity="User", mappedBy="role", cascade={"persist", "remove"})
     */
    public $users;

    /**
     * Artwork_Category constructor.
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
