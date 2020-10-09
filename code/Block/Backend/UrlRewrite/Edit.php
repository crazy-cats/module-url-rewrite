<?php

/*
 * Copyright © 2020 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\UrlRewrite\Block\Backend\UrlRewrite;

use CrazyCat\Base\Model\Source\Stage as SourceStage;
use CrazyCat\UrlRewrite\Block\Form\Renderer\Parameters;

/**
 * @category CrazyCat
 * @package  CrazyCat\UrlRewrite
 * @author   Liwei Zeng <zengliwei@163.com>
 * @link     https://crazy-cat.cn
 */
class Edit extends \CrazyCat\Base\Block\Backend\AbstractEdit
{
    /**
     * @return array
     * @throws \ReflectionException
     */
    public function getFields()
    {
        return [
            'general' => [
                'label'  => __('General'),
                'fields' => [
                    [
                        'name'  => 'id',
                        'label' => __('ID'),
                        'type'  => 'hidden'
                    ],
                    [
                        'name'   => 'stage_id',
                        'label'  => __('Stage'),
                        'type'   => 'select',
                        'source' => SourceStage::class
                    ],
                    [
                        'name'       => 'request_path',
                        'label'      => __('Request Path'),
                        'type'       => 'text',
                        'validation' => ['required' => true]
                    ],
                    [
                        'name'       => 'target_path',
                        'label'      => __('Target Path'),
                        'type'       => 'text',
                        'validation' => ['required' => true]
                    ],
                    [
                        'name'     => 'params',
                        'label'    => __('Parameters'),
                        'renderer' => Parameters::class
                    ]
                ]
            ]
        ];
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getActionUrl()
    {
        return $this->getUrl('url_rewrite/url_rewrite/save');
    }
}
