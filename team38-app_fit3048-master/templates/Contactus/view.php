<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contactus $contactus
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Contactus'), ['action' => 'edit', $contactus->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Contactus'), ['action' => 'delete', $contactus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contactus->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Contactus'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Contactus'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="contactus view content">
            <h3><?= h($contactus->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Phone') ?></th>
                    <td><?= h($contactus->phone) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($contactus->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Address') ?></th>
                    <td><?= h($contactus->address) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($contactus->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
