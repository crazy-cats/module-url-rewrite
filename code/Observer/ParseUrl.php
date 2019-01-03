<?php

/*
 * Copyright © 2018 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\UrlRewrite\Observer;

use CrazyCat\Core\Model\Stage\Manager as StageManager;
use CrazyCat\Framework\App\Area;
use CrazyCat\Framework\App\Cookies;
use CrazyCat\Framework\App\ObjectManager;
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
     * @var \CrazyCat\Framework\App\Cookies
     */
    private $cookies;

    /**
     * @var \CrazyCat\Framework\App\ObjectManager
     */
    private $objectManager;

    /**
     * @var \CrazyCat\Core\Model\Stage\Manager
     */
    private $stageManager;

    public function __construct( Cookies $cookies, StageManager $stageManager, Area $area, ObjectManager $objectManager )
    {
        $this->area = $area;
        $this->cookies = $cookies;
        $this->objectManager = $objectManager;
        $this->stageManager = $stageManager;
    }

    /**
     * @return void
     */
    public function execute( $observer )
    {
        if ( $this->area->getCode() != Area::CODE_GLOBAL ) {
            return;
        }

        /* @var $request \CrazyCat\Framework\App\Io\Http\Request */
        $request = $observer->getRequest();

        if ( ( $stageCode = $request->getParam( 'stage', $this->cookies->getData( 'stage' ) ) ) ) {
            $stageId = $this->stageManager->getStage( $stageCode );
            $this->stageManager->setCurrentStageCode( $stageId );
            $this->objectManager->create( Collection::class )
                    ->addFieldToFilter( 'stage_id', [ 'eq' => $stageId ] )
                    ->addFieldToFilter( 'request_path', [ 'eq' => $request->getPath() ] );
        }
    }

}
