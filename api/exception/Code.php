<?php
namespace asbamboo\frameworkDemo\api\exception;

/**
 * 所有api接口返回的code值都列在这里
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年9月30日
 */
final class Code
{
    const POST_INVALID_SEQ  = '2000';   // 缺少有效参数 post seq
    const POST_NOT_FOUND    = '2001';   // 找不到post entity 实例
}
