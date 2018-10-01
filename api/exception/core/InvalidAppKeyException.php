<?php
namespace asbamboo\frameworkDemo\api\exception\core;

use asbamboo\api\exception\ApiException;
use asbamboo\frameworkDemo\api\exception\Code;

/**
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年10月1日
 */
class InvalidAppKeyException extends ApiException
{
    public function __construct(string $message="缺少有效参数, post_content.", \Exception $previous = null)
    {
        parent::__construct($message, Code::INVALID_APP_KEY, $previous);
    }
}
