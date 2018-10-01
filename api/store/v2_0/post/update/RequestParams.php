<?php
namespace asbamboo\frameworkDemo\api\store\v2_0\post\update;

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
     * @required 必须
     * @example 45648
     * @desc 文章序号
     * @var string
     */
    protected $post_seq;

    /**
     *
     * @required 必须
     * @desc 文章的标题
     * @example 文章标题是自定义的
     * @var string
     */
    protected $post_title;

    /**
     *
     * @required 必须
     * @desc 文章内容
     * @example 文章内容是自定义的
     * @var text
     */
    protected $post_content;
}

