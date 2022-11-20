<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File $file
 */
?>
<div class="row">
    <div class="column-responsive column-80">
        <div class="files view content" style="height:400px">
            <?= $this->Html->link(__(''), ['action' => 'index', $belongs_to], ['class' => 'fa fa-arrow-left fa-3x', 'style' => 'color: black;', 'title' => 'Back']) ?>

            <h2 style="text-align: center; color: #87aa56;"> Download Zip File </h2>

            <?= $this->Html->link(__('Download'), ['action' => 'sendZip', $zipfile],
                ['class' => 'btn btn-outline-primary btn-lg mb-0', 'style' => 'position: absolute; top: 60%; left: 42%;', 'title' => 'Download File']) ?>

        </div>
    </div>
</div>
