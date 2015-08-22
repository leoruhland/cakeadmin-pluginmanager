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
use Cake\Utility\Hash;
use Cake\Utility\Inflector;
?>
<div class="row">
    <div class="col-md-6">
        <?= $this->Form->create(null, ['method' => 'POST', 'class' => 'form-inline', 'target' => 'iframeResult', 'url' => ['action' => 'add']]); ?>
        <?= $this->Form->input('package', ['label' => false, 'placeholder' => 'Package name']); ?>
        <?= $this->Form->submit('Install'); ?>
        <?= $this->Form->end(); ?>
    </div>
</div>
<br clear="all" />
<iframe style="width:100%;border:1px solid #ccc;padding:0px;font-size:10px;height:200px;overflow:scroll;" name="iframeResult" class="pluginManagerIframe"></iframe>
<br clear="all" />
<table class="table table-striped table-bordered table-hover table-condensed" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>Plugin</th>
            <th>Path</th>
            <th class="actions" style="width:70px;"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($plugins as $plugin): ?>
            <tr>
                <td>
                    <?= $plugin['name']; ?>
                </td>
                <td>
                    <?= $plugin['path']; ?>
                </td>
                <td class="actions">
                    <?= $this->Html->link($this->Html->faIcon('search'), ['action' => 'view'], ['class' => 'btn btn-xs btn-default','escape' => false]) ?>
                    <?= $this->Html->link($this->Html->faIcon('trash'), ['action' => 'delete', $plugin['name']], ['class' => 'btn btn-xs btn-danger onIframe','escape' => false]) ?>
                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>
<script>
$(document).ready(function(){
    $('.onIframe').on('click', function(){
        $('.pluginManagerIframe').attr('src', $(this).attr('href'));
        return false;
    });
});
</script>
