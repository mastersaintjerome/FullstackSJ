<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Serializer\Filter\PropertyFilter;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * An User.
 * @ApiResource(
 *     attributes={"security"="is_granted('ROLE_USER')"},
 *     collectionOperations={
 *          "get",
 *          "post"={
 *              "security"="is_granted('IS_AUTHENTICATED_ANONYMOUSLY')",
 *              "validation_groups"={"Default", "create"}
 *          },
 *     },
 *     itemOperations={
 *          "get",
 *          "put"={"security"="is_granted('ROLE_USER') and object.owner == user"},
 *          "delete"={"security"="is_granted('ROLE_ADMIN')"}
 *     },
 *     normalizationContext={"groups"={"user:read"}},
 *     denormalizationContext={"groups"={"user:write"}},
 * )
 * @ApiFilter(PropertyFilter::class)
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
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
     * @Groups({"user:read", "user:write"})
     * @Assert\NotBlank
     */
    public $firstname;

    /**
     * @var string the lastname of the user.
     *
     * @ORM\Column(type="text")
     * @Groups({"user:read", "user:write"})
     * @Assert\NotBlank
     */
    public $lastname;

    /**
     * @var string the pseudo of the user.
     *
     * @ORM\Column(type="text", unique=true)
     * @Groups({"user:read", "user:write"})
     * @Assert\NotBlank
     */
    public $username;

    /**
     * @var string the email of the user.
     *
     * @ORM\Column(type="text", unique=true)
     * @Groups({"user:read", "user:write"})
     * @Assert\NotBlank
     */
    public $email;

    /**
     * @var string the password of the user.
     *
     * @ORM\Column(type="text")
     */
    public $password;

    /**
     * @var \DateTimeInterface The birthDate of the user.
     *
     * @ORM\Column(type="datetime")
     * @Groups({"user:read", "user:write"})
     * @Assert\NotNull
     */
    public $birthDate;

    /**
     * @var Rating[] Available rating for this user.
     *
     * @ORM\OneToMany(targetEntity="Rating", mappedBy="user", cascade={"persist", "remove"})
     * @Groups({"user:read", "user:write"})
     */
    public $ratings;

    /**
     * @var Favorite[] Available favorite for this user.
     *
     * @ORM\OneToMany(targetEntity="Favorite", mappedBy="user", cascade={"persist", "remove"})
     * @Groups({"user:read", "user:write"})
     */
    public $favorites;

    /**
     * @var string[]
     *
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var Comment[] Available comment for this user.
     *
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="user", cascade={"persist", "remove"})
     * @Groups({"user:read", "user:write"})
     */
    public $comments;

    /**
     * @var CommentLike[] Available comment for this user.
     *
     * @ORM\OneToMany(targetEntity="CommentLike", mappedBy="user", cascade={"persist", "remove"})
     * @Groups({"user:read", "user:write"})
     */
    public $commentlikes;

    /**
     * @Groups("user:write")
     * @SerializedName("password")
     * @Assert\NotBlank(groups={"create"})
     */
    private $plainPassword;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials(): void
    {
        // if you store any temporary, sensitive data on the user, clear it here
        $this->plainPassword = null;
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
        return (string) $this->username;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }
}
