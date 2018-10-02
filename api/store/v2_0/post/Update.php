<?php
namespace asbamboo\frameworkDemo\api\store\v2_0\post;

use asbamboo\api\apiStore\ApiClassAbstract;
use asbamboo\api\apiStore\ApiRequestParamsInterface;
use asbamboo\api\apiStore\ApiResponseParamsInterface;
use asbamboo\database\FactoryInterface;
use asbamboo\frameworkDemo\model\post\PostEntity;
use asbamboo\frameworkDemo\api\exception\post\InvalidPostTitleException;
use asbamboo\frameworkDemo\api\exception\post\InvalidPostContentException;
use asbamboo\frameworkDemo\api\traits\GetApiUserTrait;
use asbamboo\di\exception\NotFoundException;

/**
 *
 * @name 修改文章
 * @desc 修改文章信息
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年9月30日
 */
class Update extends ApiClassAbstract
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
        if(empty($Params->getPostSeq())){
            throw new InvalidPostSeqException('参数文章序号无效');
        }

        if(empty($Params->getPostTitle())){
            throw new InvalidPostTitleException('请输入文章标题。');
        }

        if(empty($Params->getPostContent())){
            throw new InvalidPostContentException('请输入文章内容。');
        }

        $Post   = $this->Db->getManager()->getRepository(PostEntity::class)->findOneBy(['post_seq' => $Params->getPostSeq(), 'User' => $this->getUser($Params)]);
        if(empty($Post)){
            throw new NotFoundException(sprintf('没有找到文章, 文章序号%s', $post_seq));
        }

        $this->Post     = $Post;

        return true;
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\api\apiStore\ApiClassAbstract::successApiResponseParams()
     */
    public function successApiResponseParams(ApiRequestParamsInterface $Params) : ?ApiResponseParamsInterface
    {
        $PostEntity = $this->Post;
        $PostEntity->setPostTitle($Params->getPostTitle());
        $PostEntity->setPostContent($Params->getPostContent());
        $PostEntity->setPostUpdateTime(time());

        $this->Db->getManager()->flush($PostEntity);
        return null;
    }
}