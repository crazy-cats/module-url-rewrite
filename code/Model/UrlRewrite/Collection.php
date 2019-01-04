<?php

/*
 * Copyright © 2018 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\UrlRewrite\Model\UrlRewrite;

/**
 * @category CrazyCat
 * @package CrazyCat\UrlRewrite
 * @author Bruce Z <152416319@qq.com>
 * @link http://crazy-cat.co
 */
class Collection extends \CrazyCat\Framework\App\Module\Model\AbstractCollection {

    /**
     * @return void
     */
    protected function construct()
    {
        $this->init( 'CrazyCat\UrlRewrite\Model\UrlRewrite' );
    }

    /**
     * @return void
     */
    protected function afterLoad()
    {
        parent::afterLoad();

        foreach ( $this->items as &$item ) {
            $item->setData( 'params', json_decode( $item->getData( 'params' ), true ) );
        }
    }

}
