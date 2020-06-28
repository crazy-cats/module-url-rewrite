<?php

/*
 * Copyright © 2020 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\UrlRewrite\Setup;

use CrazyCat\Framework\App\Db\MySql;

/**
 * @category CrazyCat
 * @package  CrazyCat\UrlRewrite
 * @author   Liwei Zeng <zengliwei@163.com>
 * @link     https://crazy-cat.cn
 */
class Install extends \CrazyCat\Framework\App\Component\Module\Setup\AbstractSetup
{
    private function createUrlRewriteTable()
    {
        $columns = [
            [
                'name'           => 'id',
                'type'           => MySql::COL_TYPE_INT,
                'unsign'         => true,
                'null'           => false,
                'auto_increment' => true
            ],
            [
                'name'    => 'stage_id',
                'type'    => MySql::COL_TYPE_INT,
                'unsign'  => true,
                'null'    => false,
                'default' => '0'
            ],
            [
                'name'   => 'request_path',
                'type'   => MySql::COL_TYPE_VARCHAR,
                'length' => 255,
                'null'   => false
            ],
            [
                'name'   => 'target_path',
                'type'   => MySql::COL_TYPE_VARCHAR,
                'length' => 255,
                'null'   => false
            ],
            [
                'name'   => 'entity_id',
                'type'   => MySql::COL_TYPE_INT,
                'unsign' => true,
                'null'   => true
            ],
            [
                'name' => 'params',
                'type' => MySql::COL_TYPE_TEXT
            ]
        ];
        $indexes = [
            ['columns' => ['stage_id', 'request_path'], 'type' => MySql::INDEX_UNIQUE],
            ['columns' => ['stage_id', 'target_path', 'entity_id'], 'type' => MySql::INDEX_NORMAL]
        ];
        $this->conn->createTable('url_rewrite', $columns, $indexes);
    }

    /**
     * @return void
     */
    public function execute()
    {
        $this->createUrlRewriteTable();
    }
}
