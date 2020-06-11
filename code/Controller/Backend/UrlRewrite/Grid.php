<?php

/*
 * Copyright © 2020 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\UrlRewrite\Controller\Backend\UrlRewrite;

use CrazyCat\Base\Model\Source\Stage as SourceStage;
use CrazyCat\UrlRewrite\Block\Backend\UrlRewrite\Grid as GridBlock;
use CrazyCat\UrlRewrite\Model\UrlRewrite\Collection;

/**
 * @category CrazyCat
 * @package  CrazyCat\UrlRewrite
 * @author   Liwei Zeng <zengliwei@163.com>
 * @link     https://crazy-cat.cn
 */
class Grid extends \CrazyCat\Base\Controller\Backend\AbstractGridAction
{
    /**
     * @return void
     * @throws \ReflectionException
     */
    protected function construct()
    {
        $this->init(Collection::class, GridBlock::class);
    }

    /**
     * @param array $collectionData
     * @return array
     * @throws \ReflectionException
     */
    protected function processData($collectionData)
    {
        $sourceStage = $this->objectManager->get(SourceStage::class);
        foreach ($collectionData['items'] as &$item) {
            $item['stage_id'] = $sourceStage->getLabel($item['stage_id']);
        }
        return $collectionData;
    }
}
