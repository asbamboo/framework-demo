<?php
namespace asbamboo\frameworkDemo\api\exception\post;

use asbamboo\api\exception\ApiException;
use asbamboo\frameworkDemo\api\exception\Code;

/**
 * 无效的文章内容 post content
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年9月30日
 */
class InvalidSearchFieldsException extends ApiException
{
    public function __construct(string $message="缺少有效参数, fields.", \Exception $previous = null)
    {
        parent::__construct($message, Code::POST_INVALID_SEARCH_FIELDS, $previous);
    }
}
