<?php $__env->startSection('content'); ?>
    <section id="hero" class="position-relative overflow-hidden py-4">

        <div class="container py-5 mt-5">

            <!-- NEW PROTOCOL -->
            <div id="new_protocol_container" class="row align-items-center py-5 mt-5">
                <div class="col-md-12 mb-5 mb-md-0" id="protocolContainer">
                    <?php if($message = Session::get('success')): ?>
                        <div class="alert alert-success text-center" role="alert">
                            <?php echo e($message); ?>

                            <div class="row">
                                <div class="col mb-3 pull-left">
                                    <a href="<?php echo e(route('protocols.download', $invitation->inv_key)); ?>"
                                        class="btn btn-primary">
                                        <i class="fa fa-file" aria-hidden="true"></i> Изтегли протокол (DOCX)
                                    </a>
                                </div>
                                <div class="col mb-3 pull-right">
                                    <a href="<?php echo e(route('protocols.download_pdf', $invitation->inv_key)); ?>"
                                        class="btn btn-primary">
                                        <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Изтегли протокол (PDF)
                                    </a>
                                </div>
                            </div>

                        </div>
                    <?php endif; ?>

                    <!-- Show errors if any -->
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(route('protocols.store')); ?>" id="protocolForm" method="post" class="hero-form p-5">
                        <?php echo csrf_field(); ?>
                        <h3>ПРОТОКОЛ</h3>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="end_time" class="form-label mb-0">Краен час</label>
                                    <input type="text" class="form-control bs-timepicker" tabindex="2"
                                           value="<?php echo e(old('end_time')); ?>" name="end_time" id="end_time">
                                </div>
                                <div class="mb-3">
                                    <label for="minuteman" class="form-label mb-0">Протоколчик</label>
                                    <input type="text" class="form-control" tabindex="3"
                                           value="<?php echo e(old('minuteman')); ?>" name="minuteman" id="minuteman">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="meetQuorum1" class="form-label mb-0">Кворум час 1 (%)</label>
                                    <input type="number" class="form-control" tabindex="4"
                                           value="<?php echo e(old('meetQuorum1')); ?>" name="meetQuorum1" id="meetQuorum1">
                                </div>
                                <div class="mb-3">
                                    <label for="meetQuorum2" class="form-label mb-0">Кворум час 2 (%)</label>
                                    <input type="number" class="form-control" tabindex="5"
                                           value="<?php echo e(old('meetQuorum2')); ?>" name="meetQuorum2" id="meetQuorum2">
                                </div>
                                <div class="mb-3">
                                    <input type="hidden" name="inv_key"  id="inv_key" value="<?php echo e($invitation->inv_key); ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="notes" class="form-label mb-0">Приложения</label>
                                    <textarea class="form-control" tabindex="5" rows="6" name="notes" id="notes">
                                        <?php echo e(old('notes')); ?>

                                    </textarea>
                                </div>
                            </div>
                        </div>

                        <h4 class="mt-3">Дневен ред</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover" id="agendasTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">ТОЧКА ОТ ДНЕВЕН РЕД</th>
                                            <th>Гласувал</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $__currentLoopData = $agendas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agenda): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($agenda['name']); ?></td>
                                            <td>
                                                <table class="table table-responsive" id="agendasPoints">
                                                    <tr data-agenda-id="<?php echo e($agenda['id']); ?>">
                                                        <td class="cell1">
                                                            Зa <input type="number" name="<?php echo e($agenda['id']); ?>-approves"  class="form-control">
                                                        </td>
                                                        <td class="cell2">
                                                            Против <input type="number" name="<?php echo e($agenda['id']); ?>-refuses" class="form-control">
                                                        </td>
                                                        <td class="total">
                                                            Въздържал се
                                                            <input type="number" name="<?php echo e($agenda['id']); ?>-abstain" class="form-control" >
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-grid mt-5">
                                <button type="submit" id="protocolCreateBtn"
                                        class="btn btn-primary btn-lg">
                                    Създай протокол
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </section>

    <script>
        $(document).ready(function(){
            // Timepicker
            if ($('.bs-timepicker')) {
                $('.bs-timepicker').timepicker();
            };
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ramona/PhpstormProjects/QuestDoc/resources/views/protocols/create.blade.php ENDPATH**/ ?>