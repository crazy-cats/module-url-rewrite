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
                        'back' => [ 'label' => __( 'Back' ), 'action' => [ 'type' => 'redirect', 'params' => [ 'url' => getUrl( 'url_rewrite/url_rewrite' ) ] ] ],
                        'save' => [ 'label' => __( 'Save' ), 'action' => [ 'type' => 'save', 'params' => [ 'target' => '#edit-form' ] ] ],
                        'save_continue' => [ 'label' => __( 'Save and Continue' ), 'action' => [ 'type' => 'saveContinue', 'params' => [ 'target' => '#edit-form' ] ] ]
                    ]
                ]
            ]
        ],
        'main' => [
            'edit-form' => [
                'class' => 'CrazyCat\UrlRewrite\Block\Backend\UrlRewrite\Edit'
            ]
        ]
    ]
];
