<?php
namespace asbamboo\frameworkDemo\api\store\v2_0\post\create;

use asbamboo\api\apiStore\ApiResponseParams;

/**
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年9月30日
 */
class ResponseParams extends ApiResponseParams
{
    /**
     * @example 45648
     * @desc 文章序号
     * @var int
     */
    protected $post_seq;
}
