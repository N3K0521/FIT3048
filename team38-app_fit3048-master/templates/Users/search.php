<style>
    .form-class{
        display: flex;
        align-items:center;
        margin-bottom: 20px;
    }
    .form-class .input-box{
        position: relative;
    }
    .form-class .input-box .form-submit-button{
        position: absolute;
        border-width: 0px;
        right: 20px;
        top: 6px;
        background-color: transparent;

    }

</style>

<div class="row">
        <div class="col-12">
            <div class="card mb-4" style="min-height: 800px">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-12 align-items-center">
                              <?php echo $this->Form->create(null,['class'=>'form-class']); ?>
                              <span style="margin-right:20px">Client name:</span>
                              <div class="input-box">
                                <?= $this->Form->control('keyword',['label' => false, 'required' => true, 'class' => 'form-control','style'=>'width:250px;margin-right:20px;background-color:lightgray']); ?>
                                <button type="submit" class='form-submit-button'><i class="fa fa-search"></i></button>
                              </div>
                              <?= $this->Form->end(); ?>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2" style="margin-left: 20px;">
                    <div class="table-responsive p-0" >
                        <table class="table align-items-center mb-0" >
                            <thead>
                            <tr>
                               <th class="text-uppercase text-primary text-xs font-weight-bolder opacity-7 ps-2">Full name</th>
                               <th class="text-uppercase text-primary text-xs font-weight-bolder opacity-7 ps-2">phone</th>
                               <th class="text-uppercase text-primary text-xs font-weight-bolder opacity-7 ps-2">email</th>
                               <th class="text-uppercase text-primary text-xs font-weight-bolder opacity-7 ps-2">actions</th>
                            </tr>
                            </thead>
                            <tbody >
                                <?php
                                if($allClient){
                                    foreach($allClient as $allClient2){
                                        ?>
                                        <tr>
                                            <td><?= $allClient2->user_firstname.' '.$allClient2->user_lastname ?></td>
                                            <td><?= $allClient2->user_phone ?></td>
                                            <td><?= $allClient2->user_email ?></td>
                                            <td>
                                                <?= $this->Html->link(__('View Files'), ['controller'=>'Files','action'=>'index', $allClient2->id], ['class' => 'btn btn-primary']) ?>
                                                <?= $this->Html->link(__('View Messages'), ['controller'=>'Messages','action'=>'add', $allClient2->id], ['class' => 'btn btn-primary']) ?>
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
            </div>

        </div>
    </div>
