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
    'template' => '2columns_left',
    'blocks' => [
        'header' => [
            'header-buttons' => [
                'class' => 'CrazyCat\Core\Block\Template',
                'data' => [
                    'template' => 'CrazyCat\Core::header_buttons',
                    'buttons' => [
                        'delete' => [ 'label' => __( 'Mass Delete' ), 'action' => [ 'type' => 'massDelete', 'confirm' => __( 'Sure you want to remove selected item(s)?' ), 'params' => [ 'target' => '#grid-form', 'action' => getUrl( 'url_rewrite/url_rewrite/massdelete' ) ] ] ],
                        'new' => [ 'label' => __( 'Create New' ), 'action' => [ 'type' => 'redirect', 'params' => [ 'url' => getUrl( 'url_rewrite/url_rewrite/edit' ) ] ] ]
                    ]
                ]
            ]
        ],
        'main' => [
            'gird-form' => [
                'class' => 'CrazyCat\UrlRewrite\Block\Backend\UrlRewrite\Grid'
            ]
        ]
    ]
];
