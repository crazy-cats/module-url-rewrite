<?php

/*
 * Copyright © 2020 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\UrlRewrite\Model;

use CrazyCat\Framework\App\Io\Http\Url;

/**
 * @category CrazyCat
 * @package  CrazyCat\UrlRewrite
 * @author   Liwei Zeng <zengliwei@163.com>
 * @link     https://crazy-cat.cn
 */
class UrlRewrite extends \CrazyCat\Framework\App\Component\Module\Model\AbstractModel
{
    /**
     * @return void
     * @throws \ReflectionException
     */
    protected function construct()
    {
        $this->init('url_rewrite', 'url_rewrite');
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    protected function beforeSave()
    {
        parent::beforeSave();

        $targetPath = $this->data['target_path'];
        $strParams = [];
        if (($pos = strpos($targetPath, '?')) !== false) {
            parse_str(substr($targetPath, strpos($targetPath, '?') + 1), $strParams);
        }

        $pos = strpos($targetPath, '?');
        $targetPath = trim($pos !== false ? substr($targetPath, 0, $pos) : $targetPath, '/');
        $this->data['target_path'] = implode('/', array_pad(explode('/', $targetPath), 3, 'index'));

        $this->data['params'] = empty($this->data['params']) ? [] : $this->data['params'];
        $this->data['params'] = array_merge($strParams, $this->data['params']);
        ksort($this->data['params']);
        $this->data['params'] = json_encode($this->data['params']);
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    protected function afterLoad()
    {
        $this->data['params'] = json_decode($this->data['params'], true);
        $this->data['params'] = empty($this->data['params']) ? [] : $this->data['params'];

        parent::afterLoad();
    }
}
