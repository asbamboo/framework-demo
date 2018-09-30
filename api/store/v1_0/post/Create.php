<?php
namespace asbamboo\frameworkDemo\api\store\v1_0\post;

use asbamboo\api\apiStore\ApiClassAbstract;
use asbamboo\api\apiStore\ApiRequestParamsInterface;
use asbamboo\api\apiStore\ApiResponseParamsInterface;
use asbamboo\database\FactoryInterface;
use asbamboo\frameworkDemo\model\post\PostEntity;
use asbamboo\frameworkDemo\api\exception\post\InvalidPostTitleException;
use asbamboo\frameworkDemo\api\exception\post\InvalidPostContentException;
use asbamboo\frameworkDemo\api\traits\GetApiUserTrait;
use asbamboo\frameworkDemo\api\store\v1_0\post\create\ResponseParams;

/**
 *
 * @name 添加新文章
 * @desc 添加新的文章
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年9月30日
 */
class Create extends ApiClassAbstract
{
    use GetApiUserTrait;

    /**
     *
     * @var PostEntity
     */
    private $Post;

    /**
     *
     * @var FactoryInterface
     */
    private $Db;

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
        if(empty($Params->getPostTitle())){
            throw new InvalidPostTitleException('请输入文章标题。');
        }

        if(empty($Params->getPostContent())){
            throw new InvalidPostContentException('请输入文章内容。');
        }

        return true;
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\api\apiStore\ApiClassAbstract::successApiResponseParams()
     */
    public function successApiResponseParams(ApiRequestParamsInterface $params) : ?ApiResponseParamsInterface
    {
        $PostEntity = new PostEntity();
        $PostEntity->setPostTitle($Params->getPostTitle());
        $PostEntity->setPostContent($Params->getPostContent());
        $PostEntity->setUser($this->getUser($Params));

        $this->DbManager->persist($PostEntity);
        $this->DbManager->flush();

        return new ResponseParams(['post_seq' => $PostEntity->getPostSeq()]);
    }
}