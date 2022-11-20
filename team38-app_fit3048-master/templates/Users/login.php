
<div class="login">
  <?= $this->Html->image('2.png',['class'=>'img1']); ?>

  <div class="img">
  <?= $this->Html->image('1.png'); ?>
      <p>
          Smart Business Advisors</p>
  </div>
  <?= $this->Html->image('3.png',['class'=>'img2']); ?>
  <div class="box">

    <?= $this->Form->create(null); ?>
      <div class="logo">
        <?= $this->Html->image('logo.png'); ?>
          <span>LOGIN</span>
      </div>

      <div class="form">
          <p>Email</p>
              <?= $this->Form->control('user_email', ['label' => false,'type' => 'email', 'placeholder' => 'Enter your email', 'class' => 'form-control form-control-lg', 'style' => "padding-left: 5px"]); ?>
      </div>
      <div class="form " style="margin-bottom:10px">
          <p>Password</p>
              <?= $this->Form->control('user_password', ['id'=>'pwd','label' => false,'type' => 'password', 'placeholder' => 'Your password', 'style' => "padding-left: 5px"]); ?>

            </div>

                      <?= $this->Form->control('', ['type' => 'checkbox', 'label' => ' Show Password','onclick' => 'return showPassword()','style'=>'margin:0px 10px 0px 60px']); ?>

      <div class="form for">
      <?php echo $this->Html->link('Forgot Password?',['action' => 'password'],['escape' => false]); ?>
      </div>
      <div class="btn">
      <?= $this->Form->button('LOGIN'); ?>

    </div>
    <?php $this->Form->end(); ?>
</div>
<div class="bottom">
  </div>



  <script>
      function showPassword() {
          var x = document.getElementById("pwd");
          if (x.type === "password") {
              x.type = "text";
          } else {
              x.type = "password";
          }
      }
  </script>

