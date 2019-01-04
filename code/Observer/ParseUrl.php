<?php

/*
 * Copyright © 2018 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\UrlRewrite\Observer;

use CrazyCat\Core\Model\Stage\Manager as StageManager;
use CrazyCat\Framework\App\Area;
use CrazyCat\Framework\App\ObjectManager;
use CrazyCat\Framework\App\Url;
use CrazyCat\UrlRewrite\Model\UrlRewrite\Collection;

/**
 * @category CrazyCat
 * @package CrazyCat\UrlRewrite
 * @author Bruce Z <152416319@qq.com>
 * @link http://crazy-cat.co
 */
class ParseUrl {

    /**
     * @var \CrazyCat\Framework\App\Area
     */
    protected $area;

    /**
     * @var \CrazyCat\Framework\App\ObjectManager
     */
    private $objectManager;

    /**
     * @var \CrazyCat\Core\Model\Stage\Manager
     */
    private $stageManager;

    public function __construct( StageManager $stageManager, Area $area, ObjectManager $objectManager )
    {
        $this->area = $area;
        $this->objectManager = $objectManager;
        $this->stageManager = $stageManager;
    }

    /**
     * @return void
     */
    public function execute( $observer )
    {
        if ( $this->area->getCode() != Area::CODE_FRONTEND ) {
            return;
        }

        /* @var $request \CrazyCat\Framework\App\Io\Http\Request */
        $request = $observer->getRequest();

        $collection = $this->objectManager->create( Collection::class )
                ->addFieldToFilter( 'stage_id', [ 'eq' => $this->stageManager->getCurrentStage()->getId() ] )
                ->addFieldToFilter( 'request_path', [ 'eq' => $request->getPath() ] )
                ->setPageSize( 1 );

        if ( ( $urlRewrite = $collection->getFirstItem() ) ) {
            list( $routeName, $controllerName, $actionName ) = explode( '/', $urlRewrite->getData( 'target_path' ) );
            if ( ( $moduleName = $request->getModuleNameByRoute( Area::CODE_FRONTEND, $routeName ) ) ) {

                $request->setModuleName( $moduleName )
                        ->setRouteName( $routeName )
                        ->setControllerName( $controllerName )
                        ->setActionName( $actionName );

                foreach ( $urlRewrite->getParams() as $key => $value ) {
                    if ( $request->getParam( $key ) === null ) {
                        $request->setParam( $key, $value );
                    }
                }
            }
        }
    }

}
