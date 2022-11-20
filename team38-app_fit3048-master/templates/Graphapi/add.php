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
            <?= $this->Html->link(__('List Graphapi'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="graphapi form content">
            <?= $this->Form->create($graphapi) ?>
            <fieldset>
                <legend><?= __('Add Graphapi') ?></legend>
                <?php
                    echo $this->Form->control('tenant_id');
                    echo $this->Form->control('client_id');
                    echo $this->Form->control('client_secret');
                    echo $this->Form->control('email');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
