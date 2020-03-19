<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * An User.
 *
 * @ORM\Entity
 * @ApiResource
 */
class User
{
    /**
     * @var int The id of this User.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string the firstname of the user.
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    public $firstname;

    /**
     * @var string the lastname of the user.
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    public $lastname;

    /**
     * @var string the pseudo of the user.
     *
     * @ORM\Column(type="text", unique=true)
     * @Assert\NotBlank
     */
    public $pseudo;

    /**
     * @var string the email of the user.
     *
     * @ORM\Column(type="text", unique=true)
     * @Assert\NotBlank
     */
    public $email;

    /**
     * @var string the password of the user.
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    public $password;

    /**
     * @var \DateTimeInterface The birthDate of the user.
     *
     * @ORM\Column(type="datetime")
     * @Assert\NotNull
     */
    public $birthDate;

    /**
     * @var Rating[] Available rating for this user.
     *
     * @ORM\OneToMany(targetEntity="Rating", mappedBy="user", cascade={"persist", "remove"})
     */
    public $ratings;

    /**
     * @var Favorite[] Available favorite for this user.
     *
     * @ORM\OneToMany(targetEntity="Favorite", mappedBy="user", cascade={"persist", "remove"})
     */
    public $favorites;

    /**
     * @var Comment[] Available comment for this user.
     *
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="user", cascade={"persist", "remove"})
     */
    public $comments;

    /**
     * @var CommentLike[] Available comment for this user.
     *
     * @ORM\OneToMany(targetEntity="CommentLike", mappedBy="user", cascade={"persist", "remove"})
     */
    public $commentlikes;

    /**
     * @var Role The Role of the User.
     *
     * @ORM\ManyToOne(targetEntity="Role", inversedBy="users")
     * @Assert\NotNull
     */
    public $role;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->ratings = new ArrayCollection();
        $this->favorites = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->commentlikes = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
