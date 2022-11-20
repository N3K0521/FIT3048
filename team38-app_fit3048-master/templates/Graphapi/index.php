<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Graphapi[]|\Cake\Collection\CollectionInterface $graphapi
 */
?>
<div class="graphapi index content">
    <?= $this->Html->link(__('New Graphapi'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Graphapi') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('tenant_id') ?></th>
                    <th><?= $this->Paginator->sort('client_id') ?></th>
                    <th><?= $this->Paginator->sort('client_secret') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($graphapi as $graphapi): ?>
                <tr>
                    <td><?= $this->Number->format($graphapi->id) ?></td>
                    <td><?= h($graphapi->tenant_id) ?></td>
                    <td><?= h($graphapi->client_id) ?></td>
                    <td><?= h($graphapi->client_secret) ?></td>
                    <td><?= h($graphapi->email) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $graphapi->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $graphapi->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $graphapi->id], ['confirm' => __('Are you sure you want to delete # {0}?', $graphapi->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
