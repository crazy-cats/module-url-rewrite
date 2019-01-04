<?php

/*
 * Copyright © 2018 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\UrlRewrite\Model;

use CrazyCat\Framework\App\Url;

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

        if ( !empty( $this->data['entity_id'] ) ) {
            if ( !empty( $this->data['params'] ) && !is_array( $this->data['params'] ) ) {
                $this->data['params'] = json_decode( $this->data['params'], true );
            }
            $this->data['params'][Url::ID_NAME] = $this->data['entity_id'];
        }

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
