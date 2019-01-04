<?php

/*
 * Copyright © 2018 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\UrlRewrite\Framework;

use CrazyCat\Core\Model\Stage\Manager as StageManager;
use CrazyCat\Framework\App\Area;
use CrazyCat\Framework\App\Config;
use CrazyCat\Framework\App\Io\Http\Request as HttpRequest;
use CrazyCat\Framework\App\ObjectManager;
use CrazyCat\UrlRewrite\Model\UrlRewrite\Collection;

/**
 * @category CrazyCat
 * @package CrazyCat\UrlRewrite
 * @author Bruce Z <152416319@qq.com>
 * @link http://crazy-cat.co
 */
class Url extends \CrazyCat\Framework\App\Url {

    /**
     * @var \CrazyCat\Framework\App\ObjectManager
     */
    protected $objectManager;

    /**
     * @var \CrazyCat\Core\Model\Stage\Manager
     */
    protected $stageManager;

    /**
     * @var array
     */
    protected $urlRewrites = [];

    public function __construct( StageManager $stageManager, ObjectManager $objectManager, Area $area, Config $config, HttpRequest $httpRequest )
    {
        parent::__construct( $area, $config, $httpRequest );

        $this->objectManager = $objectManager;
        $this->stageManager = $stageManager;
    }

    /**
     * @param string $path
     * @param array $params
     * @return string|null
     */
    protected function getUrlRewrite( $path, array &$params = [] )
    {
        $collection = $this->objectManager->create( Collection::class )
                ->addFieldToFilter( 'stage_id', [ 'eq' => $this->stageManager->getCurrentStage()->getId() ] )
                ->addFieldToFilter( 'target_path', [ 'eq' => $path ] )
                ->setPageSize( 1 );

        if ( !empty( $params[self::ID_NAME] ) ) {
            $collection->addFieldToFilter( 'entity_id', [ 'eq' => $params[self::ID_NAME] ] );
            unset( $params[self::ID_NAME] );
        }

        return $collection->getFirstItem();
    }

    /**
     * @param string $path
     * @param array $params
     * @return string
     */
    protected function getFrontendUrl( $path, array $params = [] )
    {
        $realPath = $this->getRealPath( $path );

        if ( $this->area->getCode() == Area::CODE_FRONTEND &&
                ( $urlRewrite = $this->getUrlRewrite( $realPath, $params ) ) ) {
            $realPath = $urlRewrite->getData( 'request_path' );
        }

        return $this->getBaseUrl() . $realPath . ( empty( $params ) ? '' : ( '?' . http_build_query( $params ) ) );
    }

}
