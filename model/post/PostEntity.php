<?php
namespace asbamboo\frameworkDemo\model\post;

use asbamboo\frameworkDemo\model\user\UserEntity;

/**
 * @Entity
 * @Table(name="t_post")
 */
class PostEntity
{
    /**
     * @var integer
     *
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $post_seq;


    /**
     * @var UserEntity
     *
     * @ManyToOne(targetEntity="asbamboo\frameworkDemo\model\user\UserEntity")
     * @JoinTable(name="t_user")
     * @JoinColumn(name="user_seq", referencedColumnName="user_seq")
     */
    private $User;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    private $post_title;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    private $post_content;

    /**
     * @var integer
     *
     * @Column(type="integer")
     */
    private $post_create_time;

    /**
     *
     * @var integer
     *
     * @Column(type="integer")
     */
    private $post_update_time;


    /**
     *
     */
    public function __construct()
    {
        $this->post_create_time = time();
        $this->post_update_time = time();
    }

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
     * @param UserEntity $user
     * @return \asbamboo\frameworkDemo\model\post\PostEntity
     */
    public function setUser(UserEntity $User)
    {
        $this->User = $User;
        return $this;
    }

    /**
     *
     * @return \asbamboo\frameworkDemo\model\user\UserEntity
     */
    public function getUser()
    {
        return $this->User;
    }

    /**
     *
     * @param string $post_title
     * @return \asbamboo\frameworkDemo\model\post\PostEntity
     */
    public function setPostTitle(string $post_title)
    {
        $this->post_title   = $post_title;
        return $this;
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
     * @param string $post_content
     * @return \asbamboo\frameworkDemo\model\post\PostEntity
     */
    public function setPostContent(string $post_content)
    {
        $this->post_content = $post_content;
        return $this;
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
     * @param int $time
     * @return \asbamboo\frameworkDemo\model\post\PostEntity
     */
    public function setPostUpdateTime(int $time)
    {
        $this->post_update_time  = $time;
        return $this;
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
