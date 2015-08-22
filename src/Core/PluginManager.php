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
namespace PluginManager\Core;

use Composer\Console\Application;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\StreamOutput;
use Cake\Filesystem\File;
use Cake\Filesystem\Folder;

class PluginManager
{


    /*
    * PluginManager
    */

    public static function pluginList()
    {
        $blockedList = [
            'Bake',
            'Bootstrap',
            'CakeAdmin',
            'DebugKit',
            'LightStrap',
            'Migrations',
            'Notifier',
            'Settings',
            'Users',
            'Utils',
        ];
        $pluginFiles = ROOT.'/vendor/cakephp-plugins.php';
        $data = (include $pluginFiles);
        $pluginList = [];
        foreach ($data['plugins'] as $pluginName => $pluginPath) {
            $composerFile = $pluginPath . 'composer.json';
            $pluginInfo = json_decode(file_get_contents($composerFile), true);
            if($pluginInfo['type'] == 'cakephp-plugin'){
                $pluginList[$pluginName] = [
                    'name' => $pluginName,
                    'path' => $pluginPath,
                    'package' => $pluginInfo['name'],
                ];
            }
        }

        return $pluginList;
    }

    public static function pluginCall($command = '')
    {
        if($command !== ''){
            echo '';
            putenv('COMPOSER_HOME=' . ROOT);
            putenv('COMPOSER_CACHE_DIR=' . ROOT.'/tmp/composer');
            $vendorFolder = ROOT.'/vendor/bin/composer';

            $input = new StringInput($command.' -v -d '.ROOT);
            /*
            $file  = ROOT.'/pluginManager.log';
            $handle = fopen($file, 'w+');
            $output = new StreamOutput($handle);*/

            //$stream = fopen('php://temp', 'w+');
            $stream = fopen('php://output', 'w');
            fwrite($stream, '<pre>'); //User will see Hello World!

            $output = new StreamOutput($stream);

            $application = new Application();
            $application->setAutoExit(false);
            $application->run($input, $output);
        } else {
            return false;
        }
    }

    public static function pluginInstall($packageName = false)
    {
        if ($packageName !== false){
            return self::pluginCall('require '.$packageName);
        } else {
            return false;
        }
    }

    public static function pluginRemove($packageName = false)
    {
        if ($packageName !== false){
            return self::pluginCall('remove '.$packageName);
        } else {
            return false;
        }
    }
}
