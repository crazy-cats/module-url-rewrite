<?php

/*
 * Copyright © 2018 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\UrlRewrite\Setup;

use CrazyCat\Framework\App\Db\MySql;

/**
 * @category CrazyCat
 * @package CrazyCat\UrlRewrite
 * @author Bruce Z <152416319@qq.com>
 * @link http://crazy-cat.co
 */
class Upgrade extends \CrazyCat\Framework\App\Module\Setup\AbstractUpgrade {

    private function createUrlRewriteTable()
    {
        $columns = [
                [ 'name' => 'id', 'type' => MySql::COL_TYPE_INT, 'unsign' => true, 'null' => false, 'auto_increment' => true ],
                [ 'name' => 'stage_id', 'type' => MySql::COL_TYPE_INT, 'unsign' => true, 'null' => false, 'default' => '0' ],
                [ 'name' => 'request_path', 'type' => MySql::COL_TYPE_VARCHAR, 'length' => 255, 'null' => false ],
                [ 'name' => 'target_path', 'type' => MySql::COL_TYPE_VARCHAR, 'length' => 255, 'null' => false ],
                [ 'name' => 'params', 'type' => MySql::COL_TYPE_TEXT ],
                [ 'name' => 'entity_type', 'type' => MySql::COL_TYPE_VARCHAR, 'length' => 32 ],
                [ 'name' => 'entity_id', 'type' => MySql::COL_TYPE_INT, 'unsign' => true ]
        ];
        $indexes = [
                [ 'columns' => [ 'stage_id', 'request_path' ], 'type' => MySql::INDEX_UNIQUE ],
                [ 'columns' => [ 'stage_id', 'target_path', 'entity_id' ], 'type' => MySql::INDEX_NORMAL ]
        ];
        $this->conn->createTable( 'url_rewrite', $columns, $indexes );
    }

    /**
     * @param string|null $currentVersion
     */
    public function execute( $currentVersion )
    {
        if ( $currentVersion === null ) {
            $this->createUrlRewriteTable();
        }
    }

}
