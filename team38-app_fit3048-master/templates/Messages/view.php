<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Message $message
 */
?>

<style>
    .table tbody tr:last-child td{
        border-width: 0 1px;
    }
</style>

<div class="row">
    <div class="column-responsive column-80">
        <?= $this->Html->link(__(''), ['action'=>'index', $user_id], ['class' => 'fa fa-arrow-left fa-3x', 'style' => 'color: white;', 'title' => 'Back']) ?>
        <div class="messages view content">
            <table class="table table-hover table-bordered">
                <tr>
                    <th><?= __('Sent') ?></th>
                    <td><?= h($message->date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sender') ?></th>
                    <td><?= h($message->sender) ?></td>
                </tr>
                <tr>
                    <th><?= __('Recipient') ?></th>
                    <td><?= h($message->receiver) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cc') ?></th>
                    <td><?= h($message->cc) ?></td>
                </tr>
                <tr>
                    <th><?= __('Bcc') ?></th>
                    <td><?= h($message->bcc) ?></td>
                </tr>
                <tr>
                    <th><?= __('Subject') ?></th>
                    <td><?= h($message->subject) ?></td>
                </tr>
                <tr>
                    <th><?= __('Body') ?></th>
                    <td><?php echo($message->body) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
