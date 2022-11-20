<style>
    .limit{

        white-space: normal;
    }
    .table tbody tr:last-child td{
        border-width: 0 1px;
    }
    th,td{
        text-align: center;

    }
</style>

<div class="content">
    <h3>Comment Notifications</h3>
    <?= $this->Flash->render() ?>

    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th style="text-align: left">File Name</th>
                <th style="text-align: left">Comment</th>
                <th style="text-align: left">Time Posted</th>
                <th style="text-align: left">Status</th>
                <th style="text-align: left" class="actions">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php

            // var_dump($allCommets[0]);
            foreach ($allCommets as $allCommet) :   ?>
                <tr>
                    <td><?= h($allCommet['file']["fileName"]) ?></td>
                    <td><div class="limit"><?= h($allCommet["comments"]) ?></div></td>
                    <td><?= h($allCommet["create_date"]) ?></td>
                    <td >
                        <?php if ($allCommet["status"] ==0) {
                          echo 'Unread';
                        } else {
                            echo 'Read';
                        }
                        ?>

                    </td>
                    <td>
                    <?php if ($allCommet["status"] ==0) { ?>
                    <?php echo $this->Html->link('Mark as read', ['action' => 'read', $allCommet["id"]],['class' => 'btn btn-info','style'=>'color:white','escape'=>false]); ?></td>
                <?php }
                        ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
