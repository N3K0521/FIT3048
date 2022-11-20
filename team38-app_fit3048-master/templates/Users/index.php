<style>
    .form-class{
        display: flex;
        align-items:center;
        margin-bottom: 20px;
    }
    .table tbody tr:last-child td{
        border-width: 0 1px;
    }
    th,td{
        text-align: center;

    }
    .table td, .table th{
        white-space: normal;
    }
</style>


            <div class="card " style="min-height: 800px">
             <?= $this->Html->link('New User',['action'=>'add'],['class'=>'btn btn-success','style'=>'width:200px;margin:20px 0 0 24px;']); ?>
                <div class="card-body" >

                        <table class="table table-hover table-bordered" >
                            <thead>
                            <tr>
                               <th >Full name</th>
                               <th>phone</th>
                               <th >email</th>
                               <th>user type</th>
                               <th>Registered</th>
                               <th >Actions</th>

                            </tr>
                            </thead>
                            <tbody >
                                <?php
                                if($users){
                                    foreach($users as $user){
                                        ?>
                                        <tr>
                                            <td><?= $user->user_firstname.' '.$user->user_lastname ?></td>
                                            <td><?= $user->user_phone ?></td>
                                            <td><?= $user->user_email ?></td>
                                            <td><?= $user->user_type ?></td>
                                            <td><?= $user->registered_timestamp ?></td>
                                            <td class="actions">
                                                <?= $this->Html->link(__(''), ['action' => 'edit', $user->id], ['class' => 'fa fa-pen', 'title' => 'Edit']) ?>
                                                <?php

                                                if($user->user_type != 'admin'){
                                                    echo($this->Form->postLink(__(''), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete user: {0}?', $user->user_lastname.' '.$user->user_firstname), 'class' => 'fa fa-trash', 'title' => 'Delete']));

                                                }


                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>

                            </tbody>
                        </table>

                </div>
            </div>

