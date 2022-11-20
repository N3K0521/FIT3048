

        <div class="  content">
            <?= $this->Form->create($comment) ?>
       
                <legend><?= 'Add Comment For File: '.$fileName ?></legend>
                <?php
                    echo $this->Form->textarea('comments',[ 'placeholder' => 'Enter your comments...', 'class' => 'form-control form-control-lg']);
                    
                ?>
          <br>
          <?php echo $this->Html->link('Back',['controller'=>'Files','action'=>'index',$user_id],['class'=>'btn btn-secondary']) ?>
            <?= $this->Form->button('Submit',['class'=>'btn btn-primary']) ?>
            <?= $this->Form->end() ?>
        </div>
  