<?php

/*
 * Copyright © 2020 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\UrlRewrite\Framework;

use CrazyCat\Framework\App\Area;
use CrazyCat\UrlRewrite\Model\UrlRewrite\Collection;

/**
 * @category CrazyCat
 * @package  CrazyCat\UrlRewrite
 * @author   Liwei Zeng <zengliwei@163.com>
 * @link     https://crazy-cat.cn
 */
class Url extends \CrazyCat\Framework\App\Io\Http\Url
{
    /**
     * @var \CrazyCat\Framework\App\ObjectManager
     */
    protected $objectManager;

    /**
     * @var \CrazyCat\Base\Model\Stage\Manager
     */
    protected $stageManager;

    /**
     * @var array
     */
    protected $urlRewrites = [];

    public function __construct(
        \CrazyCat\Base\Model\Stage\Manager $stageManager,
        \CrazyCat\Framework\App\Area $area,
        \CrazyCat\Framework\App\Config $config,
        \CrazyCat\Framework\App\Io\Http\Request $httpRequest,
        \CrazyCat\Framework\App\ObjectManager $objectManager
    ) {
        parent::__construct($area, $config, $httpRequest);

        $this->objectManager = $objectManager;
        $this->stageManager = $stageManager;
    }

    /**
     * @param string $path
     * @param array  $params
     * @return string|null
     * @throws \ReflectionException
     */
    protected function getUrlRewrite($path, array $params = [])
    {
        $collection = $this->objectManager->create(Collection::class)
            ->addFieldToFilter('stage_id', ['eq' => $this->stageManager->getCurrentStage()->getId()])
            ->addFieldToFilter('target_path', ['eq' => $path])
            ->setPageSize(1);

        return $collection->getFirstItem();
    }

    /**
     * @param string $path
     * @param array  $params
     * @return string
     * @throws \ReflectionException
     */
    protected function getFrontendUrl($path, array $params = [])
    {
        $realPath = $this->getRealPath($path);

        if ($this->area->getCode() == Area::CODE_FRONTEND &&
            ($urlRewrite = $this->getUrlRewrite($realPath, $params))) {
            $realPath = $urlRewrite->getData('request_path');
        }

        return $this->getBaseUrl() . $realPath . (empty($params) ? '' : ('?' . http_build_query($params)));
    }
}
