<?php
namespace asbamboo\frameworkDemo\api\store\v2_0\post\create;

use asbamboo\api\apiStore\traits\CommonApiRequestParamsTrait;
use asbamboo\api\apiStore\ApiRequestParamsAbstract;
use asbamboo\api\apiStore\traits\CommonApiRequestSignParamsTrait;
use asbamboo\api\apiStore\traits\CommonApiRequestTimestampParamsTrait;

/**
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年9月26日
 */
class RequestParams extends ApiRequestParamsAbstract
{
    use CommonApiRequestParamsTrait;
    use CommonApiRequestSignParamsTrait;
    use CommonApiRequestTimestampParamsTrait;

    /**
     * @example 文章标题自己定义
     * @desc 文章的标题
     * @required 必须
     * @var string
     */
    protected $post_title;

    /**
     *
     * @example 文章内容也自己定义
     * @desc 文章内容
     * @required 必须
     * @var text
     */
    protected $post_content;
}

