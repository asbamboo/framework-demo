<?php
namespace asbamboo\frameworkDemo\api\store\v1_0\post\lists;

use asbamboo\api\apiStore\ApiRequestParamsAbstract;
use asbamboo\api\apiStore\traits\CommonApiRequestParamsTrait;
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
     * @desc 列表中数据返回的字段，取值范围中列出的字段，用英文逗号间隔。
     * @required 可选
     * @range post_seq,post_title,post_content,post_update_time,user_seq,user_id
     * @var string
     */
    protected $fields = "post_seq,post_title,post_update_time";

    /**
     * @desc 文章标题
     * @required 可选
     * @var string
     */
    protected $post_title = '';
}

