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
      <div class="col-md-12"><h5>Financial Request</h5></div>
     </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="row">


        <div class="col-xs-12 col-sm-12 col-md-12">
          <form action="<?php echo e(route('financial.store')); ?>" method="POST" id="frm_createownership">
          <input type="hidden" name="token" id="token" value="<?php echo e($token); ?>">
            <input type="hidden" name="email" id="email" value="<?php echo e($email); ?>">
            <?php echo csrf_field(); ?>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>Avg Monthly sales: <span class="text-danger">(*)</span></strong>
                <input type="text" name="avg_montky_sales" id="avg_montky_sales" class="form-control"  placeholder="Avg Monthly sales">
                <?php $__errorArgs = ['avg_montky_sales'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback" role="alert">
                    <strong><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>In how many clients? <span class="text-danger">(*)</span></strong>
                <input type="text" name="ams_how_clients" id="ams_how_clients" class="form-control"  placeholder="Clients">
                <?php $__errorArgs = ['ams_how_clients'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback" role="alert">
                    <strong><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>Has applicant or any entity in which applicant is an owner / partner owe any taxes that are past due?: <span class="text-danger">(*)</span></strong>
                <input type="checkbox" name="has_applicant" id="has_applicant" class="form-control"  >
                <?php $__errorArgs = ['has_applicant'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback" role="alert">
                    <strong><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>Estimated Monthly Financing Volume: <span class="text-danger">(*)</span></strong>
                <input type="text" name="estimated_montly_financing" id="estimated_montly_financing" class="form-control" placeholder="">
                <?php $__errorArgs = ['estimated_montly_financing'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback" role="alert">
                    <strong><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            </div>


            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button  type="submit" class="btn btn-primary" id="btn_save">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Miguel\Ac\laravel\marketplace\resources\views/financial/create.blade.php ENDPATH**/ ?>