<?php

/*
 * Copyright © 2018 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\UrlRewrite\Controller\Backend\UrlRewrite;

use CrazyCat\Core\Model\Source\Stage as SourceStage;
use CrazyCat\UrlRewrite\Block\Backend\UrlRewrite\Grid as GridBlock;
use CrazyCat\UrlRewrite\Model\UrlRewrite\Collection;

/**
 * @category CrazyCat
 * @package CrazyCat\UrlRewrite
 * @author Bruce Z <152416319@qq.com>
 * @link http://crazy-cat.co
 */
class Grid extends \CrazyCat\Core\Controller\Backend\AbstractGridAction {

    protected function construct()
    {
        $this->init( Collection::class, GridBlock::class );
    }

    /**
     * @param array $collectionData
     * @return array
     */
    protected function processData( $collectionData )
    {
        $sourceStage = $this->objectManager->get( SourceStage::class );
        foreach ( $collectionData['items'] as &$item ) {
            $item['stage_id'] = $sourceStage->getLabel( $item['stage_id'] );
        }
        return $collectionData;
    }

}
