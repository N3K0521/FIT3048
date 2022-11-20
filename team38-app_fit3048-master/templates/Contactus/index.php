<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contactus[]|\Cake\Collection\CollectionInterface $contactus
 */
?>
<div class="contactus index content">
    <?= $this->Html->link(__('New Contactus'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Contactus') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('phone') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('address') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contactus as $contactus): ?>
                <tr>
                    <td><?= $this->Number->format($contactus->id) ?></td>
                    <td><?= h($contactus->phone) ?></td>
                    <td><?= h($contactus->email) ?></td>
                    <td><?= h($contactus->address) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $contactus->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $contactus->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contactus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contactus->id)]) ?>
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
