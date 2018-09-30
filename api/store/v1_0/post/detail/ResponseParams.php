<?php
namespace asbamboo\frameworkDemo\api\store\v1_0\detail;

use asbamboo\api\apiStore\ApiResponseParams;

/**
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年9月30日
 */
class ResponseParams extends ApiResponseParams
{
    /**
     *
     * @var int
     */
    protected $post_seq;

    /**
     *
     * @var string
     */
    protected $post_title;

    /**
     *
     * @var string
     */
    protected $post_content;

    /**
     *
     * @var string
     */
    protected $post_update_time;

    /**
     *
     * @var int
     */
    protected $user_seq;

    /**
     *
     * @var string
     */
    protected $user_id;
}
