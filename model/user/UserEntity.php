<?php
namespace asbamboo\frameworkDemo\model\user;

/**
 * @Entity
 * @Table(name="t_user")
 */
class UserEntity
{
    /**
     * @var int
     *
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $user_seq;

    /**
     * @var string
     *
     * @Column(type="string", unique=true)
     */
    private $user_id;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    private $user_password;

    /**
     * @var int
     *
     * @Column(type="integer")
     */
    private $user_type;

    /**
     *
     * @return number
     */
    public function getUserSeq()
    {
        return $this->user_seq;
    }

    /**
     *
     * @param string $user_id
     * @return \asbamboo\frameworkDemo\model\user\UserEntity
     */
    public function setUserId(string $user_id)
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     *
     * @param string $user_password
     * @return \asbamboo\frameworkDemo\model\user\UserEntity
     */
    public function setUserPassword(string $user_password)
    {
        $this->user_password    = $user_password;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getUserPassword()
    {
        return $this->user_password;
    }

    /**
     *
     * @param string $user_type
     * @return \asbamboo\frameworkDemo\model\user\UserEntity
     */
    public function setUserType(string $user_type)
    {
        $this->user_type    = $user_type;
        return $this;
    }

    /**
     *
     * @return number
     */
    public function getUserType()
    {
        return $this->user_type;
    }
}