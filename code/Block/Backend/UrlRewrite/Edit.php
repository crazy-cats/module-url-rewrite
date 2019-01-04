<?php

/*
 * Copyright © 2018 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\UrlRewrite\Block\Backend\UrlRewrite;

use CrazyCat\Core\Model\Source\Stage as SourceStage;

/**
 * @category CrazyCat
 * @package CrazyCat\UrlRewrite
 * @author Bruce Z <152416319@qq.com>
 * @link http://crazy-cat.co
 */
class Edit extends \CrazyCat\Core\Block\Backend\AbstractEdit {

    /**
     * @return array
     */
    public function getFields()
    {
        return [
            'general' => [
                'label' => __( 'General' ),
                'fields' => [
                        [ 'name' => 'id', 'label' => __( 'ID' ), 'type' => 'hidden' ],
                        [ 'name' => 'stage_id', 'label' => __( 'Stage' ), 'type' => 'select', 'source' => SourceStage::class ],
                        [ 'name' => 'request_path', 'label' => __( 'Request Path' ), 'type' => 'text', 'validation' => [ 'required' => true ] ],
                        [ 'name' => 'target_path', 'label' => __( 'Target Path' ), 'type' => 'text', 'validation' => [ 'required' => true ] ],
                        [ 'name' => 'entity_id', 'label' => __( 'Entity ID' ), 'type' => 'text' ],
                        [ 'name' => 'entity_type', 'label' => __( 'Entity Type' ), 'type' => 'select' ]
                ]
            ]
        ];
    }

    /**
     * @return string
     */
    public function getActionUrl()
    {
        return getUrl( 'url_rewrite/url_rewrite/save' );
    }

}
