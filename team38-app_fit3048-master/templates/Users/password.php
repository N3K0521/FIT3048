<div class="login">
    <?= $this->Html->image('2.png',['class'=>'img1']); ?>

    <div class="img">
        <?= $this->Html->image('1.png'); ?>
        <p>
            Smart Business Advisors</p>
    </div>
    <?= $this->Html->image('3.png',['class'=>'img2']); ?>
    <div class="box" style="height: 400px">

        <?= $this->Form->create(
                    null,
                    [
                        'id' => 'forgotpwd-form',
                        'url' => [
                            'controller' => 'Users',
                            'action' => 'password',
                            '?' => [
                                'redirect' => $this->request->getQuery('redirect')
                            ]
                            ],
                            'class'=>'mb-3'
                    ]); ?>
        <div class="logo">
            <?= $this->Html->image('logo.png'); ?>
            <span>Forgot Password? </span>
        </div>

        <div class="form">
            <p>Email</p>
            <?= $this->Form->control('user_email',['label' => false,'class' => 'form-control','placeholder' => 'Email','autofocus'=>true]); ?>
        </div>




        <div class="btn">
            <?= $this->Form->button('Send Reset Link',['class' => 'btn btn-primary d-grid w-100','style'=>'margin-bottom:10px']); ?>
            <?php echo $this->Html->link('<i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>Back to login',['action' => 'login'],[ 'escape' => false,'class'=>'d-flex align-items-center justify-content-center']); ?>
        </div>
        <?php $this->Form->end(); ?>
    </div>
    <div class="bottom">
    </div>


 