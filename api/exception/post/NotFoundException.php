<?php
namespace asbamboo\frameworkDemo\api\exception\post;

use asbamboo\api\exception\ApiException;
use asbamboo\frameworkDemo\api\exception\Code;

/**
 * 找不到 post 实例
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年9月30日
 */
class NotFoundException extends ApiException
{
    public function __construct(string $message="找不到对应的文章。", \Exception $previous = null)
    {
        parent::__construct($message, Code::POST_NOT_FOUND, $previous);
    }
}
