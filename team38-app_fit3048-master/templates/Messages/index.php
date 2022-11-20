<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Message[]|\Cake\Collection\CollectionInterface $messages
 */
?>

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-4 d-flex align-items-center">
                        <h4>Message History</h4>
                    </div>

                    <div class="col-8 text-end">
                        <?= $this->Html->link(__('Update Messages'), ['controller'=>'Messages','action'=>'add', $user_id], ['class' => 'btn btn-secondary', 'style' => 'float: right; margin-top: 15px']) ?>

                    </div>
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2" style="margin-left: 20px; margin-right: 10px;">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                        <tr>
                            <th class="text-uppercase text-primary text-xs font-weight-bolder opacity-7 ps-2"><?= $this->Paginator->sort('subject', 'Subject') ?></th>
                            <th class="text-uppercase text-primary text-xs font-weight-bolder opacity-7 ps-2"><?= $this->Paginator->sort('sender', 'Sender') ?></th>
                            <th class="text-uppercase text-primary text-xs font-weight-bolder opacity-7 ps-2"><?= $this->Paginator->sort('receiver', 'Recipient(s)') ?></th>
                            <th class="text-uppercase text-primary text-xs font-weight-bolder opacity-7 ps-2"> <?= $this->Paginator->sort('date', 'Date') ?></th>
                            <th class="text-uppercase text-primary text-xs font-weight-bolder opacity-7 ps-2">actions</th>

                        </tr>
                        </thead>
                        <tbody>


                        <?php foreach ($messages as $message): ?>
                            <tr>
                                <td><?= $this->Text->truncate($message->subject, 50) ?></td>
                                <td><?= $this->Text->truncate(str_replace('"', "", $message->sender), 50) ?></td>
                                <td><?= $this->Text->truncate(str_replace('"', "", $message->receiver), 50) ?></td>
                                <td><?= h($message->date) ?></td>
                                <td>
                                    <?= $this->Html->link(__('View'), ['action' => 'view', $message->id, $user_id], ['class' => 'btn btn-secondary']) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>


                        </tbody>
                    </table>
                </div>
            </div>
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
</div>
