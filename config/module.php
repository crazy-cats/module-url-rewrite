<?php

/*
 * Copyright © 2018 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

/**
 * @category CrazyCat
 * @package CrazyCat\UrlRewrite
 * @author Bruce Z <152416319@qq.com>
 * @link http://crazy-cat.co
 */
return [
    'namespace' => 'CrazyCat\UrlRewrite',
    'version' => '1.0.0',
    'depends' => [],
    'events' => [
        'process_http_request' => 'CrazyCat\UrlRewrite\Observer\ParseUrl'
    ],
    'routes' => [
        'backend' => 'url_rewrite'
    ]
];
