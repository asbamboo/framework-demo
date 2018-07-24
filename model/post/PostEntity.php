<?php
namespace asbamboo\frameworkDemo\model\post;

class PostEntity
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $post_seq;

    private $user_seq;

    private $post_title;

    private $post_content;

    private $post_create_time;

    private $post_update_time;
}
