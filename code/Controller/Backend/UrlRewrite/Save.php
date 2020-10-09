<?php

/*
 * Copyright © 2020 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\UrlRewrite\Controller\Backend\UrlRewrite;

use CrazyCat\UrlRewrite\Model\UrlRewrite as Model;
use CrazyCat\Framework\App\Io\Http\Url;

/**
 * @category CrazyCat
 * @package  CrazyCat\UrlRewrite
 * @author   Liwei Zeng <zengliwei@163.com>
 * @link     https://crazy-cat.cn
 */
class Save extends \CrazyCat\Framework\App\Component\Module\Controller\Backend\AbstractAction
{
    protected function execute()
    {
        /* @var $model \CrazyCat\Framework\App\Component\Module\Model\AbstractModel */
        $model = $this->objectManager->create(Model::class);

        $data = $this->request->getPost('data');
        if (empty($data[$model->getIdFieldName()])) {
            unset($data[$model->getIdFieldName()]);
        }

        try {
            $params = $data['params'];
            $data['params'] = [];
            foreach ($params as $param) {
                if (empty($param['name']) || empty($param['value'])) {
                    continue;
                }
                $data['params'][$param['name']] = $param['value'];
            }

            $id = $model->addData($data)->save()->getId();
            $this->messenger->addSuccess(__('Successfully saved.'));
        } catch (\Exception $e) {
            $id = isset($data[Url::ID_NAME]) ? $data[Url::ID_NAME] : null;
            $this->messenger->addError($e->getMessage());
        }

        if (!$this->request->getPost('to_list') && $id !== null) {
            return $this->redirect('url_rewrite/url_rewrite/edit', [Url::ID_NAME => $id]);
        }
        return $this->redirect('url_rewrite/url_rewrite');
    }
}
