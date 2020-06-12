<?php

/*
 * Copyright © 2020 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\UrlRewrite\Block\Backend\UrlRewrite;

use CrazyCat\Base\Model\Source\Stage as SourceStage;

/**
 * @category CrazyCat
 * @package  CrazyCat\UrlRewrite
 * @author   Liwei Zeng <zengliwei@163.com>
 * @link     https://crazy-cat.cn
 */
class Grid extends \CrazyCat\Base\Block\Backend\AbstractGrid
{
    public const BOOKMARK_KEY = 'url_rewrite';

    /**
     * @return array
     * @throws \ReflectionException
     */
    public function getFields()
    {
        return [
            ['ids' => true,],
            [
                'name'   => 'stage_id',
                'label'  => __('Stage'),
                'sort'   => true,
                'width'  => 200,
                'filter' => ['type' => 'select', 'source' => SourceStage::class, 'condition' => 'eq']
            ],
            [
                'name'   => 'request_path',
                'label'  => __('Request Path'),
                'sort'   => true,
                'filter' => ['type' => 'text', 'condition' => 'like']
            ],
            [
                'name'   => 'target_path',
                'label'  => __('Target Path'),
                'sort'   => true,
                'filter' => ['type' => 'text', 'condition' => 'like']
            ],
            [
                'label'   => __('Actions'),
                'actions' => [
                    [
                        'name'  => 'edit',
                        'label' => __('Edit'),
                        'url'   => $this->getUrl('url_rewrite/url_rewrite/edit')
                    ],
                    [
                        'name'    => 'delete',
                        'label'   => __('Delete'),
                        'confirm' => __('Sure you want to remove this item?'),
                        'url'     => $this->getUrl('url_rewrite/url_rewrite/delete')
                    ]
                ]
            ]
        ];
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getSourceUrl()
    {
        return $this->getUrl('url_rewrite/url_rewrite/grid');
    }
}
