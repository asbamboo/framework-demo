<?php
namespace asbamboo\frameworkDemo\api\store\v1_0\post;

use asbamboo\api\apiStore\ApiClassAbstract;
use asbamboo\api\apiStore\ApiRequestParamsInterface;
use asbamboo\api\apiStore\ApiResponseParamsInterface;
use asbamboo\database\FactoryInterface;
use asbamboo\frameworkDemo\model\post\PostEntity;
use asbamboo\frameworkDemo\api\store\v1_0\post\lists\ResponseParams;
use asbamboo\frameworkDemo\api\traits\GetApiUserTrait;
use asbamboo\frameworkDemo\api\exception\post\InvalidSearchFieldsException;

/**
 *
 * @name 文章列表
 * @desc 获取文章列表
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年9月30日
 */
class Lists extends ApiClassAbstract
{
    use GetApiUserTrait;

    /**
     *
     * @var FactoryInterface
     */
    private $Db;

    /**
     * 解析后的结果列表应该查询的字段
     *
     * @var array
     */
    private $fields;

    /**
     *
     * @param FactoryInterface $Db
     */
    public function __construct(FactoryInterface $Db)
    {
        $this->Db   = $Db;
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\api\apiStore\ApiClassAbstract::validate()
     */
    public function validate(ApiRequestParamsInterface $Params) : bool
    {
        if(empty($Params->getFields())){
            throw new InvalidSearchFieldsException('fields 参数不能为空');
        }
        $fields = array_map('trim', explode(',', $Params->getFields()));
        foreach($fields AS $field){
            if(!in_array($field, ['post_seq', 'post_title', 'post_content', 'post_update_time', 'user_seq', 'user_id'])){
                throw new InvalidSearchFieldsException('fields参数列出的字段超出有效范围。');
            }
        }
        $this->fields   = $fields;
        return true;
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\api\apiStore\ApiClassAbstract::successApiResponseParams()
     */
    public function successApiResponseParams(ApiRequestParamsInterface $Params) : ?ApiResponseParamsInterface
    {
        $lists  = [];
        $lists  = $this->Db->getManager()->getRepository(PostEntity::class)->findByApiLists($this->fields, $Params);
        return new ResponseParams(['lists' => $lists,]);
    }
}