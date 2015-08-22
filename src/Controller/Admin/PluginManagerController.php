<?php
/**
* CakeManager (http://cakemanager.org)
* Copyright (c) http://cakemanager.org
*
* Licensed under The MIT License
* For full copyright and license information, please see the LICENSE.txt
* Redistributions of files must retain the above copyright notice.
*
* @copyright     Copyright (c) http://cakemanager.org
* @link          http://cakemanager.org CakeManager Project
* @since         1.0
* @license       http://www.opensource.org/licenses/mit-license.php MIT License
*/
namespace PluginManager\Controller\Admin;

use CakeAdmin\Controller\AppController;
use PluginManager\Core\PluginManager;

class PluginManagerController extends AppController
{

    public function index()
    {
        $data = PluginManager::pluginList();
        $this->set('plugins', $data);
    }

    public function add($package = false)
    {
        if ($this->request->is('post') && !$package) {
            $this->redirect(['action' => 'add', $this->request->data('package')]);
        } else {
            PluginManager::pluginInstall($package);
            exit(0);
            //$this->redirect(['action' => 'index']);
        }
    }

    public function delete($pluginName)
    {
        $pluginList = PluginManager::pluginList();
        PluginManager::pluginRemove($pluginList[$pluginName]['package']);
        exit(0);
        //$this->redirect(['action' => 'index']);
    }
}
