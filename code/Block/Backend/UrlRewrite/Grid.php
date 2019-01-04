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
class Grid extends \CrazyCat\Core\Block\Backend\AbstractGrid {

    const BOOKMARK_KEY = 'url_rewrite';

    /**
     * @return array
     */
    public function getFields()
    {
        return [
                [ 'ids' => true, ],
                [ 'name' => 'stage_id', 'label' => __( 'Stage' ), 'sort' => true, 'width' => 200, 'filter' => [ 'type' => 'select', 'source' => SourceStage::class, 'condition' => 'eq' ] ],
                [ 'name' => 'request_path', 'label' => __( 'Request Path' ), 'sort' => true, 'filter' => [ 'type' => 'text', 'condition' => 'like' ] ],
                [ 'name' => 'target_path', 'label' => __( 'Target Path' ), 'sort' => true, 'filter' => [ 'type' => 'text', 'condition' => 'like' ] ],
                [ 'name' => 'entity_id', 'label' => __( 'Entity ID' ), 'sort' => true, 'filter' => [ 'type' => 'text', 'condition' => 'eq' ] ],
                [ 'name' => 'entity_type', 'label' => __( 'Entity Type' ), 'sort' => true, 'width' => 200, 'filter' => [ 'type' => 'select', 'source' => SourceStage::class, 'condition' => 'eq' ] ],
                [ 'label' => __( 'Actions' ), 'actions' => [
                        [ 'name' => 'edit', 'label' => __( 'Edit' ), 'url' => getUrl( 'url_rewrite/url_rewrite/edit' ) ],
                        [ 'name' => 'delete', 'label' => __( 'Delete' ), 'confirm' => __( 'Sure you want to remove this item?' ), 'url' => getUrl( 'url_rewrite/url_rewrite/delete' ) ]
                ] ] ];
    }

    /**
     * @return string
     */
    public function getSourceUrl()
    {
        return getUrl( 'url_rewrite/url_rewrite/grid' );
    }

}
