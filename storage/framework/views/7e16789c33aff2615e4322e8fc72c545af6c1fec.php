<?php $__env->startSection('content'); ?>

<?php if($errors->any()): ?>
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-8 col-sm-12">
      <div class="alert alert-danger" role="alert">
        <ul>
          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
    </div>
  </div>
<?php endif; ?>

<div class="container">
  <div class="row justify-content-center">
    <div class="row col-md-10 p-4 text-center">
      <div class="col-md-12"><h5>Management / Ownership</h5></div>
      <div class="col-md-12">The values ​​must be equal to or greater than 25%, and a maximum of 4 values</div>
    </div>
    <div class="col-md-12 p-4">
      <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 text-center">
          <table class="table table-hover table-bordered" id="tblowner">
            <thead>
              <tr>
                <th width="30%">Name</th>
                <th width="20%">Id Number</th>
                <th width="10%">%</th>
                <th width="20%">Position</th>
                <th width="10%">Birthdate</th>
                <th width="10%">Remove</th>
              </tr>
            </thead>
            <tbody>
             <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

               <tr>
                <td><?php echo e($record->name); ?></td>
                <td><?php echo e($record->idno); ?></td>
                <td><?php echo e($record->percentage); ?></td>
                <td><?php echo e($record->position); ?></td>
                <td><?php echo e($record->birthdate); ?></td>
                <td align="center">
                <form action="<?php echo e(route('managment.destroy',$record->id)); ?>" method="POST">
                     <?php echo csrf_field(); ?>

                    <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger"><i class='fa fa-trash-o'></i></button>
                </form>
                <!--<a href="" id="btn_delete"><i class='fa fa-trash-o'></i></a> </td>-->
              </tr>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <!--consulta de los ownershio de ese usuario ingresados-->
            </tbody>
          </table>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4">
          <form action="<?php echo e(route('managment.store')); ?>" method="POST" id="frm_createownership">
            <input type="hidden" name="token" id="token" value="<?php echo e($token); ?>">
            <input type="hidden" name="email" id="email" value="<?php echo e($email); ?>">
            <?php echo csrf_field(); ?>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>Name: <span class="text-danger">(*)</span></strong>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo e($name); ?>" placeholder="Name">
                <span class="invalid-feedback" role="alert">
                  <strong id="msg_name" style="display:none;"></strong>
                </span>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>Id Number: <span class="text-danger">(*)</span></strong>
                <input type="text" name="idnumber" id="idnumber" class="form-control" value="<?php echo e($idnumber); ?>" placeholder="Id Number">
                <span class="invalid-feedback" role="alert">
                  <strong id="msg_idnumber" style="display:none;"></strong>
                </span>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>% Ownership: <span class="text-danger">(*)</span></strong>
                <input type="text" name="percentage" id="percentage" class="form-control" value="<?php echo e($percentage); ?>" placeholder="%">
                <span class="invalid-feedback" role="alert">
                  <strong id="msg_percentage" style="display:none;"></strong>
                </span>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>Position: <span class="text-danger">(*)</span></strong>
                <input type="text" name="position" id="position" class="form-control" value="<?php echo e($position); ?>" placeholder="Position">
                <span class="invalid-feedback" role="alert">
                  <strong id="msg_position" style="display:none;"></strong>
                </span>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>Birthdate: <span class="text-danger">(*)</span></strong>
                <input type="text" name="birthdate" id="birthdate" class="form-control"value="<?php echo e($birthdate); ?>" placeholder="YYYY-MM-DD">
                <span class="invalid-feedback" role="alert">
                  <strong id="msg_birthdate" style="display:none;"></strong>
                </span>
              </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="button" class="btn btn-primary" id="btn_save">Save</button>
            </div>

          </form>

          <form action="<?php echo e(route('financial.index')); ?>" method="POST">
                     <?php echo csrf_field(); ?>
                     <input type="hidden" name="token" id="token" value="<?php echo e($token); ?>">
                     <input type="hidden" name="email" id="email" value="<?php echo e($email); ?>">
                    <button type="submit" class="btn btn-danger"><i class='fa fa-trash-o'></i></button>
            </form>

      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<script src="<?php echo e(asset('js/ownership.js')); ?>" defer=""></script>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Miguel\Ac\laravel\marketplace\resources\views/managment/index.blade.php ENDPATH**/ ?>