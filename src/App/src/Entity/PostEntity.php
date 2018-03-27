<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="\App\Repository\PostRepository")
 * @ORM\Table(name="post")
 *
 * @package App\Entity
 */
class PostEntity
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(type="bigint", unique=true, options={"unsigned" : true})
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=200)
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(type="string", unique=true)
     */
    private $slug;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="\App\Entity\TagEntity", inversedBy="posts")
     * @ORM\JoinTable(
     *     name="post_tag",
     *     joinColumns={@ORM\JoinColumn(name="post_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")}
     *)
     */
    private $tags;

    /**
     * PostEntity constructor.
     */
    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param $tags
     */
    public function setTags($tags): void
    {
        $this->tags = $tags;
    }

    public function tagsToString()
    {
        $tagsStr     = '';
        foreach ($this->tags as $tag) {
            $tagsStr .= $tag->getName();
        }

        return $tagsStr;
    }
}
