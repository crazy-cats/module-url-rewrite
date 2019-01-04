<?php

/*
 * Copyright © 2018 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\UrlRewrite\Model;

/**
 * @category CrazyCat
 * @package CrazyCat\UrlRewrite
 * @author Bruce Z <152416319@qq.com>
 * @link http://crazy-cat.co
 */
class UrlRewrite extends \CrazyCat\Framework\App\Module\Model\AbstractModel {

    /**
     * @return void
     */
    protected function construct()
    {
        $this->init( 'url_rewrite', 'url_rewrite' );
    }

    /**
     * @return void
     */
    protected function beforeSave()
    {
        parent::beforeSave();

        if ( isset( $this->data['params'] ) && is_array( $this->data['params'] ) ) {
            $this->data['params'] = json_encode( $this->data['params'] );
        }
    }

    /**
     * @return void
     */
    protected function afterLoad()
    {
        $this->data['params'] = json_decode( $this->data['params'], true );

        parent::afterLoad();
    }

}
