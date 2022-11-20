<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File[]|\Cake\Collection\CollectionInterface $files
 */
?>
<style>
    .text-end{
        display: flex;
        justify-content:flex-end;
    }
    .input-box{
        position: relative;

    }
    .input-box .form-submit-button{
        position: absolute;
        border-width: 0px;
        right: 20px;
        top: 6px;
        background-color: transparent;

    }

</style>
<?php
$file_types = [
    "image/jpeg" => "fa fa-file-image-o",
    "image/png" => "fa fa-file-image-o",
    "application/pdf" => "fa fa-file-pdf-o",
    "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" => "fa fa-file-excel-o",
    "application/vnd.openxmlformats-officedocument.wordprocessingml.document" => "fa fa-file-word-o",
    "text/plain" => "fa fa-file-text-o",
    "application/x-zip-compressed" => "fa fa-file-archive-o",
    "application/vnd.openxmlformats-officedocument.presentationml.presentation" => "fa fa-file-powerpoint-o",
    "unidentified" => "fa fa-file-o",
];

?>

<?= $this->Form->create(null, [
    'url' => [
        'controller' => 'Files',
        'action' => 'downloadzip',
        $name->id
    ]
]); ?>


<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-4 d-flex align-items-center">
                        <h4><?php echo $name->user_firstname ?> <?php echo $name->user_lastname ?>'s Files</h4>
                    </div>
                    <div class="col-8 text-end">
                        <div class="input-box">
                            <?= $this->Form->control('keyword',['value'=>$keyword,'label' => false,  'class' => 'form-control','style'=>'width:250px;margin-right:10px;background-color:lightgray']); ?>
                            <button type="submit" class='form-submit-button' name='search'><i class="fa fa-search"></i></button>
                        </div>
                        <?php echo $this->Form->button('Download Selected', ['action' => 'downloadzip', $name->id, 'class' => 'btn btn-outline-primary btn-sm mb-0','style'=>'margin-right:10px;']); ?>
                        <?php echo $this->Html->link(__('Upload File'), ['action' => 'add', $name->id], ['class' => 'btn btn-outline-secondary btn-sm mb-0']); ?>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2" style="margin-left: 20px; margin-right: 10px;">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-lg font-weight-bolder opacity-7"><i class="ni ni-check-bold" style="margin-left: -15px"></i></th>
                            <th style="width:20px;" class="text-uppercase text-primary text-xs font-weight-bolder opacity-7"></th>
                            <th class="text-uppercase text-primary text-xs font-weight-bolder opacity-7 ps-2"><?= $this->Paginator->sort('fileName', 'Name') ?></th>
                            <th class="text-uppercase text-primary text-xs font-weight-bolder opacity-7 ps-2"> <?= $this->Paginator->sort('timestamp', 'uploaded', ['direction' => 'desc']) ?></th>
                            <th class="text-uppercase text-primary text-xs font-weight-bolder opacity-7 ps-2">Comments</th>
                            <th class="text-uppercase text-primary text-xs font-weight-bolder opacity-7 ps-2">Actions</th>
                            <th class="text-uppercase text-primary text-xs font-weight-bolder opacity-7 ps-2"><?= $this->Paginator->sort('uploaded_by_name', 'Uploader') ?></th>

                        </tr>
                        </thead>
                        <tbody >


                        <?php foreach ($files as $file):

                            ?>
                            <tr>
                                <td ><?php echo $this->Form->control('', ['style' => 'width: 18px;  height: 18px; margin-top:30px','class' => 'custom-control-input', 'type' => 'checkbox', 'label' => '', 'name' => 'fileid[]', 'value' => $file->id]); ?></td>
                                <td>
                                    <?php if (!array_key_exists($file->fileType,$file_types)){
                                         $file->Files['fileType'] = 'unidentified';
                                    } ?>
                                    <i class="<?= h($file_types[$file->fileType]) ?>">
                                </td>
                                <td><?= $this->Text->truncate(str_replace('"', "", $file->fileName), 80) ?></td>
                                <td><?= h($file->timestamp) ?></td>
                                <td> <?php


                                    echo $this->Html->link(__(''), ['controller'=>'Comments','action' => 'view', $file->id,$file->fileName, $file->user_id], ['class' => 'fa fa-eye', 'title' => 'view comment','style'=>'margin-left:10px']) ; ?>
                                    (<?php echo $file->count ?> comments)
                                </td>
                                <td class="actions">

                                    <a href="" class="fa fa-edit" data-toggle="modal" data-target="#myModal" title="Rename"
                                       data-userid="<?php echo $user_id; ?>" data-fileid="<?php echo $file->id; ?>"
                                       data-filename="<?php echo $file->fileName; ?>">
                                    </a>

                                    <?= $this->Html->link(__(''), ['action' => 'sendFile', $file->id], ['class' => 'fa fa-download', 'title' => 'Download File']) ?>
                                    <?= $this->Form->end() ?>

                                    <?= $this->Form->postLink(__(''), ['action' => 'delete', $file->id], ['confirm' => __('Are you sure you want to delete file: {0}?', $file->fileName), 'class' => 'fa fa-trash', 'title' => 'Delete File']) ?>

                                </td>
                                <td><?= $this->Text->truncate(str_replace('"', "", $file->uploaded_by_name), 40) ?></td>
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


<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <?= $this->Form->create(null, [
                'url' => [
                    'controller' => 'Files',
                    'action' => 'rename'
                ]
            ]); ?>
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Rename file</h4>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <?php echo $this->Form->control('userid',['class'=>'form-control','id'=>'userid','hidden'=>true,'label'=>false]);  ?>
                <?php echo $this->Form->control('fileid',['class'=>'form-control','id'=>'fileid','hidden'=>true,'label'=>false]);  ?>
                <?php echo $this->Form->control('filename',['class'=>'form-control','id'=>'filename']);  ?>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <?= $this->Form->button('Submit', ['class' => 'btn btn-primary']) ?>

                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $('#myModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var filename = button.data('filename')
        var fileid = button.data('fileid')
        var userid = button.data('userid')
        var modal = $(this)
        modal.find('.modal-body #userid').val(userid)
        modal.find('.modal-body #filename').val(filename)
        modal.find('.modal-body #fileid').val(fileid)
    })
</script>
