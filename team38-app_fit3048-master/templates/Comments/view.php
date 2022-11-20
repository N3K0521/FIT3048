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

<div class="content" >
    <h3><?php echo $fileName; ?>'s comments</h3>
    <?= $this->Flash->render() ?>

    <table class="table table-hover table-bordered">
        <thead>
            <tr>
               
                <th >Comment</th>
                <th >Time Posted</th>
                <th >Status</th>
                
            </tr>
        </thead>
        <tbody>
            <?php

            
            foreach ($allCommets as $allCommet) :   ?>
                <tr>
                    
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
                   
                
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php 
      if($this->request->getSession()->read('Auth')['User']['user_type']==='staff'){ ?>
        <?= $this->Form->create($comment) ?>
       
    
        <?php
            echo $this->Form->textarea('comments',[ 'placeholder' => 'Enter your comments...', 'class' => 'form-control form-control-lg']);
            
        ?>
  <br>
  <?php echo $this->Html->link('Back',['controller'=>'Files','action'=>'index',$user_id],['class'=>'btn btn-secondary']) ?>
    <?= $this->Form->button('Submit',['class'=>'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
   <?php }
    ?>
  
</div>
