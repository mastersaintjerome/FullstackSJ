<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * An Artwork Comment.
 *
 * @ORM\Entity
 * @ApiResource
 */
class Comment
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
     * @var User The User of the Comment.
     * @ORM\ManyToOne(targetEntity="User", inversedBy="comments")
     * @Assert\NotNull
     */
    public $user;

    /**
     * @var Artwork The Artwork of the Comment.
     * @ORM\ManyToOne(targetEntity="Artwork", inversedBy="comments")
     * @Assert\NotNull
     */
    public $artwork;

    /**
     * @var \DateTimeInterface The date of the comment.
     *
     * @ORM\Column(type="datetime")
     * @Assert\NotNull
     */
    public $commentCreationDate;

    /**
     * @var \DateTimeInterface The date of the last modification of the comment.
     *
     * @ORM\Column(type="datetime")
     * @Assert\NotNull
     */
    public $commentLastModificationDate;

    /**
     * @var string The text of this comment.
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    public $commentText;

    /**
     * @var CommentLike[] Available comment for this user.
     *
     * @ORM\OneToMany(targetEntity="CommentLike", mappedBy="comment", cascade={"persist", "remove"})
     */
    public $commentlikes;

    /**
     * Comment constructor.
     */
    public function __construct()
    {
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
