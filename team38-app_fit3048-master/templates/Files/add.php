<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File $file
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */

?>

<div class="container-fluid py-4" >
    <div class="row" >
        <div class="column-responsive column-80" >
            <div class="files form content" style="background-image: url(/img/uploadfile.png); background-size: cover;">

                <?= $this->Html->link(__(''), ['action' => 'index', $belongs_to], ['class' => 'fa fa-arrow-left fa-3x', 'style' => 'color: white;', 'title' => 'Back']) ?>

                <h2 style="text-align: center; color: white; text-shadow: -1px 2px black"> Upload File(s) </h2>

                <?= $this->Form->create($file, ["type"=>"file"]) ?>
                <fieldset>
                    <?php
                    echo $this->Form->control('upload[]',['type'=>'file',
                                                                    'style'=>'width:70%;
                                                                              margin: auto;
                                                                              padding:5%;
                                                                              padding-top: 20%;
                                                                              padding-left: 28%;
                                                                              border:2px dashed #000;
                                                                              border-radius:10px;
                                                                              background:#fff;
                                                                              z-index:999;
                                                                              position:fixed;
                                                                              background-image: url(/img/Upload.png);
                                                                              background-repeat: no-repeat;
                                                                              background-position: center;
                                                                              background-size: auto;',
                        'label'=>false, 'multiple']);
                    ?>
                </fieldset>

                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-outline-primary btn-lg mb-0', 'style' => 'position: absolute; top: 40%; right: 10%; color: white; border-color: white;']) ?>
                <?= $this->Form->end() ?>

            </div>

        </div>
    </div>
</div>
