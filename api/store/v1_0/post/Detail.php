<?php
namespace asbamboo\frameworkDemo\api\store\v1_0;

use asbamboo\api\apiStore\ApiClassAbstract;
use asbamboo\api\apiStore\ApiRequestParamsInterface;
use asbamboo\api\apiStore\ApiResponseParamsInterface;
use asbamboo\database\FactoryInterface;
use asbamboo\frameworkDemo\model\user\UserEntity;
use asbamboo\frameworkDemo\model\post\PostEntity;
use asbamboo\frameworkDemo\api\exception\post\NotFoundException;
use asbamboo\frameworkDemo\api\store\v1_0\detail\ResponseParams;

/**
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年9月30日
 */
class Detail extends ApiClassAbstract
{
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
        /**
         *
         * @var UserEntity $User
         * @var RequestParams $Params
         */
        $post_seq       = $Params->getPostSeq();

        if(empty($post_seq)){
            throw new NotFoundException(sprintf('没有找到文章, 文章序号%s', $post_seq));
        }

        $user_id        = $Params->getAppKey();
        $User           = $this->Db->getManager()->getRepository(UserEntity::class)->findOneBy(['user_id' => $user_id ]);
        $Post           = $this->Db->getManager()->getRepository(PostEntity::class)->findOneBy(['post_seq' => $post_seq, 'User' => $User]);

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
    public function successApiResponseParams(ApiRequestParamsInterface $params) : ?ApiResponseParamsInterface
    {
        return new ResponseParams([
            'post_seq'          => $this->Post->getPostSeq(),
            'post_title'        => $this->Post->getPostTitle(),
            'post_content'      => $this->Post->getPostContent(),
            'post_update_time'  => date('Y-m-d H:i:s', $this->Post->getPostUpdateTime()),
            'user_seq'          => $this->Post->getUser()->getUserSeq(),
            'user_id'           => $this->Post->getUser()->getUserId()
        ]);
    }
}