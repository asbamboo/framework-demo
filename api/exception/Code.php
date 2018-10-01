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
    const INVALID_APP_KEY               = '1001';   // app key 无效

    const POST_NOT_FOUND                = '2000';   // 找不到post entity 实例
    const POST_INVALID_SEQ              = '2001';   // 缺少有效参数 post seq
    const POST_INVALID_TITLE            = '2002';   // 缺少有效参数 post title
    const POST_INVALID_CONTENT          = '2003';   // 缺少有效参数 post content
    const POST_INVALID_SEARCH_FIELDS    = '2004';   // 缺少有效参数 fields
}
