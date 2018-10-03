<?php
namespace asbamboo\frameworkDemo\model\user;

use asbamboo\security\user\BaseUser;

/**
 * @Entity
 * @Table(name="t_user")
 */
class UserEntity extends BaseUser
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
     *
     * @var string
     *
     * @Column(type="string")
     */
    private $user_security;

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
        $this->setLoginName($user_id);
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
        $user_password          = $this->encodePassword($user_password);
        $this->user_password    = $user_password;
        $this->setLoginPassword($user_password, true);
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getUserPassword() : string
    {
        return $this->user_password;
    }

    /**
     *
     * @param string $user_security
     * @return \asbamboo\frameworkDemo\model\user\UserEntity
     */
    public function setUserSecurity(string $user_security)
    {
        $this->user_security    = $user_security;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getUserSecurity() : string
    {
        return $this->user_security ?? '';
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\security\user\BaseUser::getLoginName()
     */
    public function getLoginName() : string
    {
        return $this->getUserId();
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\security\user\BaseUser::getLoginPassword()
     */
    public function getLoginPassword(): ?string
    {
        return $this->getUserPassword();
    }

    /**
     *
     * @param string $user_type
     * @return \asbamboo\frameworkDemo\model\user\UserEntity
     */
    public function setUserType(string $user_type)
    {
        $this->user_type    = $user_type;
        $this->setRoles([$user_type]);
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

    /**
     * {@inheritDoc}
     * @see \asbamboo\security\user\UserInterface::getRoles()
     */
    public function getRoles(): array
    {
        $roles  = [];
        if($this->getUserType() == Constant::TYPE_ADMIN){
            $roles[]    = 'admin';
        }
        if($this->getUserType() == Constant::TYPE_USER){
            $roles[]    = 'user';
        }
        return $roles;
    }
}