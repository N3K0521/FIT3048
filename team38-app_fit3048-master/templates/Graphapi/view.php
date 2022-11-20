<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Graphapi $graphapi
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Graphapi'), ['action' => 'edit', $graphapi->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Graphapi'), ['action' => 'delete', $graphapi->id], ['confirm' => __('Are you sure you want to delete # {0}?', $graphapi->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Graphapi'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Graphapi'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="graphapi view content">
            <h3><?= h($graphapi->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Tenant Id') ?></th>
                    <td><?= h($graphapi->tenant_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Client Id') ?></th>
                    <td><?= h($graphapi->client_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Client Secret') ?></th>
                    <td><?= h($graphapi->client_secret) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($graphapi->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($graphapi->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
