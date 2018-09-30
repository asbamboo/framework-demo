<?php
namespace asbamboo\frameworkDemo\api\store\v1_0\post\create;

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
     *
     * 文章序号
     * @desc 文章的序号
     * @required 必须
     * @var string
     */
    protected $post_title;

    /**
     *
     * @desc 文章内容
     * @required 必须
     * @var text
     */
    protected $post_content;
}

