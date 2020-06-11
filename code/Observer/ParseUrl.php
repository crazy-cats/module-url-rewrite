<?php

/*
 * Copyright © 2020 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\UrlRewrite\Observer;

use CrazyCat\Framework\App\Area;
use CrazyCat\UrlRewrite\Model\UrlRewrite\Collection;

/**
 * @category CrazyCat
 * @package  CrazyCat\UrlRewrite
 * @author   Liwei Zeng <zengliwei@163.com>
 * @link     https://crazy-cat.cn
 */
class ParseUrl
{
    /**
     * @var \CrazyCat\Framework\App\Area
     */
    protected $area;

    /**
     * @var \CrazyCat\Framework\App\ObjectManager
     */
    private $objectManager;

    /**
     * @var \CrazyCat\Base\Model\Stage\Manager
     */
    private $stageManager;

    public function __construct(
        \CrazyCat\Base\Model\Stage\Manager $stageManager,
        \CrazyCat\Framework\App\Area $area,
        \CrazyCat\Framework\App\ObjectManager $objectManager
    ) {
        $this->area = $area;
        $this->objectManager = $objectManager;
        $this->stageManager = $stageManager;
    }

    /**
     * @param $observer
     * @return void
     * @throws \ReflectionException
     */
    public function execute($observer)
    {
        if ($this->area->getCode() != Area::CODE_FRONTEND) {
            return;
        }

        /* @var $request \CrazyCat\Framework\App\Io\Http\Request */
        $request = $observer->getRequest();

        $collection = $this->objectManager->create(Collection::class)
            ->addFieldToFilter('stage_id', ['eq' => $this->stageManager->getCurrentStage()->getId()])
            ->addFieldToFilter('request_path', ['eq' => $request->getPath()])
            ->setPageSize(1);

        if (($urlRewrite = $collection->getFirstItem())) {
            [$routeName, $controllerName, $actionName] = explode('/', $urlRewrite->getData('target_path'));
            if (($moduleName = $request->getModuleNameByRoute(Area::CODE_FRONTEND, $routeName))) {
                $request->setModuleName($moduleName)
                    ->setRouteName($routeName)
                    ->setControllerName($controllerName)
                    ->setActionName($actionName);

                foreach ($urlRewrite->getParams() as $key => $value) {
                    if ($request->getParam($key) === null) {
                        $request->setParam($key, $value);
                    }
                }
            }
        }
    }
}
