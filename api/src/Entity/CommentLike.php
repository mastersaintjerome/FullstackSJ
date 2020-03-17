<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * A Comment like.
 *
 * @ORM\Entity
 * @ApiResource
 */
class CommentLike
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
     * @var User The User of the CommentLike.
     * @ORM\ManyToOne(targetEntity="User", inversedBy="commentlikes")
     * @Assert\NotNull
     */
    public $user;

    /**
     * @var Comment The Comment of the CommentLike.
     * @ORM\ManyToOne(targetEntity="Comment", inversedBy="commentlikes")
     * @Assert\NotNull
     */
    public $comment;

    /**
     * @var boolean COmment is like.
     *
     * @ORM\Column(type="boolean")
     * @Assert\NotBlank
     */
    public $isLike;
}
