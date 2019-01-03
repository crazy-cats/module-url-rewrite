<?php

/*
 * Copyright © 2018 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\UrlRewrite\Framework;

/**
 * @category CrazyCat
 * @package CrazyCat\UrlRewrite
 * @author Bruce Z <152416319@qq.com>
 * @link http://crazy-cat.co
 */
class Url extends \CrazyCat\Framework\App\Url {

    /**
     * @param string $path
     * @param array $params
     * @return string
     */
    protected function getFrontendUrl( $path, array $params = [] )
    {
        $tmp = trim( $path, '/' ) ?: 'index';
        $parts = explode( '/', $tmp );
        $realPath = ( ( $num = count( $parts ) ) < 3 ) ?
                ( $tmp . str_repeat( '/index', 3 - $num ) ) :
                ( $parts[0] . '/' . $parts[1] . '/' . $parts[2] );
        return $this->getBaseUrl() . $realPath . ( empty( $params ) ? '' : ( '?' . http_build_query( $params ) ) );
    }
    
}
