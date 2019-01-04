<?php

/*
 * Copyright © 2018 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\UrlRewrite\Controller\Backend\UrlRewrite;

use CrazyCat\UrlRewrite\Model\UrlRewrite as Model;

/**
 * @category CrazyCat
 * @package CrazyCat\UrlRewrite
 * @author Bruce Z <152416319@qq.com>
 * @link http://crazy-cat.co
 */
class Edit extends \CrazyCat\Framework\App\Module\Controller\Backend\AbstractAction {

    protected function run()
    {
        /* @var $model \CrazyCat\Framework\App\Module\Model\AbstractModel */
        $model = $this->objectManager->create( Model::class );

        if ( ( $id = $this->request->getParam( 'id' ) ) ) {
            $model->load( $id );
            if ( !$model->getId() ) {
                $this->messenger->addError( __( 'Item with specified ID does not exist.' ) );
                return $this->redirect( 'url_rewrite/url_rewrite' );
            }
        }

        $this->registry->register( 'current_model', $model );

        $pageTitle = $model->getId() ?
                __( 'Edit URL Rewrite `%1` [ ID: %2 ]', [ $model->getData( 'request_path' ), $model->getId() ] ) :
                __( 'Create URL Rewrite' );

        $this->setPageTitle( $pageTitle )->render();
    }

}
