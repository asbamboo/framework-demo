<?php
namespace asbamboo\frameworkDemo\api\store\v1_0\post\lists;

use asbamboo\api\apiStore\ApiResponseParams;

/**
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年9月30日
 */
class ResponseParams extends ApiResponseParams
{
    /**
     * @desc 文章列表。返回由文章信息组成的列表
     * @var array
     */
    protected $lists;
}
