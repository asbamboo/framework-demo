<?php
namespace asbamboo\frameworkDemo\api\store\v1_0\post\detail;

use asbamboo\api\apiStore\ApiResponseParams;

/**
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年9月30日
 */
class ResponseParams extends ApiResponseParams
{
    /**
     * @desc 文章序号
     * @var int
     */
    protected $post_seq;

    /**
     *
     * @desc 文章标题
     * @var string
     */
    protected $post_title;

    /**
     *
     * @desc 文章内容
     * @var string
     */
    protected $post_content;

    /**
     *
     * @desc 文章最后编辑时间 格式为:yyyy-mm-dd HH:mm:ss,如(2018-09-27 20:01:53)
     * @var string
     */
    protected $post_update_time;

    /**
     * @desc 作者用户序号
     * @var int
     */
    protected $user_seq;

    /**
     *
     * @desc 作者用户ID
     * @var string
     */
    protected $user_id;
}
