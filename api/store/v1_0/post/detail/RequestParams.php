<?php
namespace asbamboo\frameworkDemo\api\store\v1_0\detail;

use asbamboo\api\apiStore\traits\CommonApiRequestParamsTrait;
use asbamboo\api\apiStore\ApiRequestParamsAbstract;
use asbamboo\api\apiStore\traits\CommonApiRequestSignParamsTrait;

/**
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年9月26日
 */
class RequestParams extends ApiRequestParamsAbstract
{
    use CommonApiRequestParamsTrait;
    use CommonApiRequestSignParamsTrait;

    /**
     * 文章序号
     *
     * @var string
     */
    private $post_seq;

    /**
     *
     * @return string
     */
    public function getPostSeq() : string
    {
        return $this->post_seq;
    }
}

