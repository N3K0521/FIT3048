<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File $file
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $file->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $file->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Files'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="files form content">
            <?= $this->Form->create($file) ?>
            <fieldset>
                <legend><?= __('Edit File') ?></legend>
                <?php
                    echo $this->Form->control('fileName');
                    echo $this->Form->control('fileAddress');
                    echo $this->Form->control('user_id', ['options' => $users, 'empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
