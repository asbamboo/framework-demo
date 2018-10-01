<?php
namespace asbamboo\frameworkDemo\model\post;

use asbamboo\database\EntityRepository;
use asbamboo\frameworkDemo\api\store\v1_0\post\lists\RequestParams;

/**
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年8月30日
 */
class PostRepository extends EntityRepository
{
    /**
     *
     * @param array $fileds
     * @param RequestParams $RequestPrams
     * @return array
     */
    public function findByApiLists(array $fileds, $RequestPrams) : array
    {
        $query  = $this->createQueryBuilder('p');
        $query->leftJoin('p.User', 'u');
        foreach($fileds AS $key => $filed){
            if(0 === strpos($filed, 'user')){
                $filed  = "u.{$filed}";
            }else{
                $filed  = "p.{$filed}";
            }
            $fileds[$key]   = $filed;
        }
        $query->select($fileds);
        $andX   = $query->expr()->andX();
        if(strlen($RequestPrams->getPostTitle()) > 0){
            $andX->add($query->expr()->like('p.post_title', ':post_title'));
            $query->setParameter(':post_title', "{$RequestPrams->getPostTitle()}%");
        }
        if($andX->count() > 0){
            $query->where($andX);
        }
        return $query->getQuery()->getArrayResult();
    }
}