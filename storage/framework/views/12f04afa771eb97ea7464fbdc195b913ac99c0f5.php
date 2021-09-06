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
                <input type="text" name="avg_montky_sales" id="avg_montky_sales" class="form-control" value="<?php echo e($indiv->avg_montky_sales); ?>" placeholder="Avg Monthly sales">
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
                <input type="text" name="ams_how_clients" id="ams_how_clients" class="form-control" value="<?php echo e($indiv->ams_how_clients); ?>" placeholder="Clients">
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
                <input type="checkbox" name="has_applicant" id="has_applicant" class="form-control" <?php echo e($indiv->has_applicant); ?> >
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
                <input type="text" name="estimated_montly_financing" id="estimated_montly_financing" class="form-control" value="<?php echo e($indiv->estimated_montly_financing); ?>" placeholder="">
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
            <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                <strong>Number of clients to finance? <span class="text-danger">(*)</span></strong>
                <input type="text" name="emf_number_clients" id="emf_number_clients" class="form-control" value="<?php echo e($indiv->emf_number_clients); ?>" placeholder="">
                <?php $__errorArgs = ['emf_number_clients'];
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
                <strong>What type of documents are you looking to finance (PO- Invoice?  <span class="text-danger">(*)</span></strong>
                <input type="checkbox" name="po_finance" id="po_finance" class="form-control" placeholder=""<?php echo e($indiv->po_finance); ?>>
                <?php $__errorArgs = ['po_finance'];
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
                <input type="checkbox" name="in_finance" id="in_finance" class="form-control" placeholder="" <?php echo e($indiv->in_finance); ?> >
                <?php $__errorArgs = ['in_finance'];
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
                <strong>Has applicant or any entity in which applicant is an owner / partner has any lawsuits pending? <span class="text-danger">(*)</span></strong>
                <input type="checkbox" name="lawsuits_pending" id="lawsuits_pending" class="form-control" placeholder="" <?php echo e($indiv->lawsuits_pending); ?> >
                <?php $__errorArgs = ['lawsuits_pending'];
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
                <strong>Have you ever factored your receivables? <span class="text-danger">(*)</span></strong>
                <input type="checkbox" name="receivable_finance" id="receivable_finance" class="form-control" placeholder="" <?php echo e($indiv->receivable_finance); ?> >
                <?php $__errorArgs = ['receivable_finance'];
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
                <strong>If yes, when/with whom? <span class="text-danger">(*)</span></strong>
                <input type="text" name="rf_when_with_whom" id="rf_when_with_whom" class="form-control" placeholder="" value="<?php echo e($indiv->rf_when_with_whom); ?>" >
                <?php $__errorArgs = ['rf_when_with_whom'];
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
                <strong>Do you have a Credit Insurance policy? <span class="text-danger">(*)</span></strong>
                <input type="checkbox" name="credit_insurance_policy" id="credit_insurance_policy" class="form-control" placeholder="" <?php echo e($indiv->credit_insurance_policy); ?> >
                <?php $__errorArgs = ['credit_insurance_policy'];
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
                <strong>If yes, when/with whom? <span class="text-danger">(*)</span></strong>
                <input type="text" name="cip_when_with_whom" id="cip_when_with_whom" class="form-control" placeholder="" value="<?php echo e($indiv->cip_when_with_whom); ?>" >
                <?php $__errorArgs = ['cip_when_with_whom'];
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
                <strong>Has applicant or any entity in which applicant is an owner / partner ever declared bankruptcy? <span class="text-danger">(*)</span></strong>
                <input type="checkbox" name="declared_bank_ruptcy" id="declared_bank_ruptcy" class="form-control" placeholder=""<?php echo e($indiv->declared_bank_ruptcy); ?> >
                <?php $__errorArgs = ['declared_bank_ruptcy'];
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


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Miguel\Ac\laravel\marketplace\resources\views/financial/index.blade.php ENDPATH**/ ?>