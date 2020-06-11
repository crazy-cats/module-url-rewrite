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

        if (!empty($this->data['entity_id'])) {
            if (!empty($this->data['params']) && !is_array($this->data['params'])) {
                $this->data['params'] = json_decode($this->data['params'], true);
            }
            $this->data['params'][Url::ID_NAME] = $this->data['entity_id'];
        }

        if (isset($this->data['params']) && is_array($this->data['params'])) {
            $this->data['params'] = json_encode($this->data['params']);
        }
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    protected function afterLoad()
    {
        $this->data['params'] = json_decode($this->data['params'], true);

        parent::afterLoad();
    }
}
