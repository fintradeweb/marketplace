
<?php $__env->startSection('content'); ?>

<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
   
<form action="<?php echo e(route('businessinformation.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
  
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control" value="<?php echo e($nombre); ?>" placeholder="">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                <input type="text" name="txt_email" class="form-control" value="<?php echo e($txt_email); ?>" placeholder="">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tax Id:</strong>
                <input type="text" name="txt_taxid" class="form-control" value="<?php echo e($txt_taxid); ?>" placeholder="">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Datecompany:</strong>
                <input type="text" name="txt_datecompany" class="form-control" value="<?php echo e($txt_datecompany); ?>" placeholder="">
            </div>
        </div>

        

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>contactname:</strong>
                <input type="text" name="txt_contactname" class="form-control" value="<?php echo e($txt_contactname); ?>" placeholder="">
            </div>
        </div>

       

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>zipcode:</strong>
                <input type="text" name="txt_zipcode" class="form-control" value="<?php echo e($txt_zipcode); ?>" placeholder="">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>typebussiness:</strong>
                <input type="text" name="txt_typebussiness" class="form-control" value="<?php echo e($txt_typebussiness); ?>" placeholder="">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>phone:</strong>
                <input type="text" name="txt_phone" class="form-control" value="<?php echo e($txt_phone); ?>" placeholder="">
            </div>
        </div>

      

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>country:</strong>
                <input type="text" name="txt_country" class="form-control" value="<?php echo e($txt_country); ?>" placeholder="">
            </div>
        </div>

        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>state:</strong>
                <input type="text" name="txt_state" class="form-control" value="<?php echo e($txt_state); ?>" placeholder="">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>city:</strong>
                <input type="text" name="txt_city" class="form-control" value="<?php echo e($txt_city); ?>" placeholder="">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Adress:</strong>
                <input type="text" name="txt_address" class="form-control" value="<?php echo e($txt_address); ?>" placeholder="">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>president:</strong>
                <input type="text" name="txt_president" class="form-control" value="<?php echo e($txt_president); ?>" placeholder="">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>website:</strong>
                <input type="text" name="website" class="form-control" value="<?php echo e($txt_website); ?>" placeholder="">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>dba:</strong>
                <input type="text" name="txt_dba" class="form-control" value="<?php echo e($txt_dba); ?>" placeholder="">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>cellphone:</strong>
                <input type="text" name="txt_cellphone" class="form-control" value="<?php echo e($txt_cellphone); ?>" placeholder="">
            </div>
        </div>
        <input type="hidden" id="token" name="token" value="<?php echo e($token); ?>">

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
   
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Miguel\Ac\laravel\marketplace\resources\views/businessinformation/create.blade.php ENDPATH**/ ?>