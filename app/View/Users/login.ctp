<div class="col-lg-6 col-lg-offset-3 text-center">

<?php echo $this->Flash->render('auth'); ?>
<?php echo $this->Form->create('User', ['class' => 'form']); ?>
    <fieldset>
        <legend>
            <?php echo __('Please enter your username and password'); ?>
        </legend>
        <?php $options = ['div'=> false,'class' => 'form-control']; ?>
        <div class="form-group">
        <?php echo $this->Form->input('username', $options); ?>
        </div>
        <div class="form-group">
        <?php echo $this->Form->input('password', $options);    ?>
            </div>
    </fieldset>
<?php echo $this->Form->end(__('Login')); ?>

    </div>