<?php
namespace asbamboo\frameworkDemo\model\user;

/**
 * @Entity
 * @Table(name="t_user")
 */
class UserEntity
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $user_seq;

    private $user_id;

    private $user_password;

    private $user_type;
}