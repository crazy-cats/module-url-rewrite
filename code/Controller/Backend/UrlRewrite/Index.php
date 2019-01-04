<?php

/*
 * Copyright © 2018 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\UrlRewrite\Controller\Backend\UrlRewrite;

/**
 * @category CrazyCat
 * @package CrazyCat\UrlRewrite
 * @author Bruce Z <152416319@qq.com>
 * @link http://crazy-cat.co
 */
class Index extends \CrazyCat\Framework\App\Module\Controller\Backend\AbstractAction {

    protected function run()
    {
        $this->setPageTitle( __( 'URL Rewrite List' ) )->render();
    }

}
