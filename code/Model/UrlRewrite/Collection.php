<?php

/*
 * Copyright © 2020 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\UrlRewrite\Model\UrlRewrite;

/**
 * @category CrazyCat
 * @package  CrazyCat\UrlRewrite
 * @author   Liwei Zeng <zengliwei@163.com>
 * @link     https://crazy-cat.cn
 */
class Collection extends \CrazyCat\Framework\App\Component\Module\Model\AbstractCollection
{
    /**
     * @return void
     * @throws \ReflectionException
     */
    protected function construct()
    {
        $this->init(\CrazyCat\UrlRewrite\Model\UrlRewrite::class);
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    protected function afterLoad()
    {
        parent::afterLoad();

        foreach ($this->items as &$item) {
            $item->setData('params', json_decode($item->getData('params'), true));
        }
    }
}
