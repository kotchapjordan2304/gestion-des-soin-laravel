<?php $__env->startSection('title'); ?>
    <?php echo e(__('sentence.New Prescription')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="mb-3">
        <button class="btn btn-primary" onclick="history.back()">Retour</button>
    </div>

    <form method="post" action="<?php echo e(route('prescription.store')); ?>">

        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Patient informations')); ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="PatientID"><?php echo e(__('sentence.Patient')); ?> :</label>
                            <select class="form-control multiselect-search" name="patient_id" id="PatientID" required>
                                <option><?php echo e(__('sentence.Select Patient')); ?></option>
                                <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($patient->id); ?>"><?php echo e($patient->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php echo e(csrf_field()); ?>

                        </div>
                        <div class="form-group">
                            <label for="DoctorID"><?php echo e(__('sentence.Doctors')); ?> :</label>
                            <select class="form-control multiselect-search" name="Doctor_id" id="DoctorID" required>
                                <option><?php echo e(__('sentence.Select Doctor')); ?></option>
                                <?php $__currentLoopData = $praticiens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </select>
                            <?php echo e(csrf_field()); ?>

                        </div>
                        <div class="form-group text-center ">
                            <img src="<?php echo e(asset('img/patient-icon.png')); ?>"
                                class="img-profile rounded-circle img-fluid w-50 h-50">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="<?php echo e(__('sentence.Create Prescription')); ?>"
                                class="btn btn-success btn-block" align="center">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Drugs list')); ?></h6>
                    </div>
                    <div class="card-body">
                        <fieldset class="drugs_labels">
                            <div class="repeatable"></div>
                            <div class="form-group">
                                <a type="button" class="btn btn-sm btn-primary add text-white" align="center"><i
                                        class='fa fa-plus'></i> <?php echo e(__('sentence.Add Drug')); ?></a>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('sentence.Tests list')); ?></h6>
                    </div>
                    <div class="card-body">
                        <fieldset class="test_labels">
                            <div class="repeatable"></div>
                            <div class="form-group">
                                <a type="button" class="btn btn-sm btn-primary add text-white" align="center"><i
                                        class='fa fa-plus'></i> <?php echo e(__('sentence.Add Test')); ?></a>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            // Initialiser le menu déroulant Select2
            $('#patient-select').select2();

            // Filtrer les options des tests en fonction du patient sélectionné
            $('#patient-select').change(function() {
                var selectedPatientId = $(this).val();
                var $testSelect = $('#test-select');

                // Vider les options du menu déroulant des tests
                $testSelect.empty();

                // Parcourir toutes les options des tests
                $('#test-select option').each(function() {
                    var testPatientId = $(this).data('patient-id');

                    // Vérifier si le test est associé au patient sélectionné ou s'il est disponible pour tous les patients (patient_id = null)
                    if (testPatientId == selectedPatientId || testPatientId === null) {
                        // Ajouter l'option au menu déroulant des tests
                        $testSelect.append($(this));
                    }
                });

                // Réinitialiser le menu déroulant Select2 pour mettre à jour les options affichées
                $testSelect.val('').trigger('change');
            });
        });
    </script>

    <script type="text/template" id="drugs_labels">
   <section class="field-group">
                         <div class="row">
                             <div class="col-md-2">
                                 <div class="form-group-custom">
                                     <input type="text" class="form-control" name="type[]" id="task_{?}" placeholder="<?php echo e(__('sentence.Type')); ?>" class="ui-autocomplete-input" autocomplete="off">
                                     <label class="control-label"></label><i class="bar"></i>
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <select class="form-control multiselect-search" name="trade_name[]" id="drug" tabindex="-1" aria-hidden="true" required>
                                   <option value=""><?php echo e(__('sentence.Select Drug')); ?>...</option>
                                   <?php $__currentLoopData = $drugs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($drug->id); ?>"><?php echo e($drug->trade_name); ?></option>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 </select>
                             </div>

                             
                         </div>

                         
                         <div class="row">
                             <div class="col-md-9">
                                 <div class="form-group-custom">
                                     <input type="text" id="drug_advice" name="drug_advice[]" class="form-control" placeholder="<?php echo e(__('sentence.Advice_Comment')); ?>">
                                 </div>
                             </div>
                              <div class="col-md-3">
                                    <a type="button" class="btn btn-danger btn-sm text-white span-2 delete"><i class="fa fa-times-circle"></i> <?php echo e(__('sentence.Remove')); ?></a>
                               </div>
                               <div class="col-12">
                                    <hr color="#a1f1d4">
                              </div>
                         </div>
                 </section>
</script>
    <script type="text/template" id="test_labels">
                         <div class="field-group row">
                             <div class="col-md-4">
                                 <select class="form-control multiselect-search" name="test_name[]" id="test" tabindex="-1" aria-hidden="true" required>
                                   <option value=""><?php echo e(__('sentence.Select Test')); ?>...</option>
                                   <?php $__currentLoopData = $tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($test->id); ?>" data-patient-id="<?php echo e($test->patient_id); ?>"><?php echo e($test->name); ?></option>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 </select>
                             </div>

                             <div class="col-md-4">
                                 <div class="form-group-custom">
                                     <input type="text" id="strength" name="description[]"  class="form-control" placeholder="<?php echo e(__('sentence.Description')); ?>">
                                 </div>
                             </div>
                             <div class="col-md-3">
                                 <a type="button" class="btn btn-danger delete text-white btn-sm" align="center"><i class='fa fa-plus'></i> <?php echo e(__('sentence.Remove')); ?></a>

                              </div>
                              <div class="col-12">
                                    <hr color="#a1f1d4">
                              </div>
                         </div>
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\user\Desktop\gestion des soins\v1.0\resources\views/prescription/create.blade.php ENDPATH**/ ?>