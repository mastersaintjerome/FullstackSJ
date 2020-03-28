<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * An User.
 *
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ApiResource
 * @ORM\Table(name="`user`")
 */
class User implements UserInterface
{
    /**
     * @var int The id of this User.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", unique=true)
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

    /**
     * @var string[]
     *
     * @ORM\Column(type="json")
     */
    private $roles = [];

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    /**
     * @param string $pseudo
     */
    public function setPseudo(string $pseudo): void
    {
        $this->pseudo = $pseudo;
    }

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials(): void
    {
        // if you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * {@inheritdoc}
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * {@inheritdoc}
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    /**
     * {@inheritdoc}
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getUsername(): string
    {
        return (string) $this->pseudo;
    }
}
