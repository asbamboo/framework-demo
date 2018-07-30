<?php
namespace asbamboo\frameworkDemo\model\post;

use Doctrine\ORM\Mapping as ORM;
use asbamboo\frameworkDemo\model\user\UserEntity;

class PostEntity
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $post_seq;


    /**
     * @var UserEntity
     *
     * @ORM\ManyToOne(targetEntity="asbamboo\frameworkDemo\model\user\UserEntity")
     * @ORM\JoinColumn(name="user_seq", referencedColumnName="user_seq")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $post_title;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $post_content;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $post_create_time;

    /**
     *
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $post_update_time;

    /**
     *
     * @return number
     */
    public function getPostSeq()
    {
        return $this->post_seq;
    }

    /**
     *
     * @return \asbamboo\frameworkDemo\model\user\UserEntity
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     *
     * @return string
     */
    public function getPostTitle()
    {
        return $this->post_title;
    }

    /**
     *
     * @return string
     */
    public function getPostContent()
    {
        return $this->post_content;
    }

    /**
     *
     * @return number
     */
    public function getPostCreateTime()
    {
        return $this->post_create_time;
    }

    /**
     *
     * @return number
     */
    public function getPostUpdateTime()
    {
        return $this->post_update_time;
    }
}
