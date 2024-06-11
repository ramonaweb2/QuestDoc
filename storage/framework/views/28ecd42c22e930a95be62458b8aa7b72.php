<?php $__env->startSection('pageTitle', 'Гласуване на дневен ред'); ?>

<?php $__env->startSection('content'); ?>
    <section id="hero" class="position-relative overflow-hidden py-4">
        <div class="container py-5 mt-5">
            <div id="new_protocol_container" class="row align-items-center py-5 mt-5">
                <div class="col-md-12 mb-5 mb-md-0" id="protocolContainer">
                    <form action="<?php echo e(route('protocols.store_voting', $invitation->inv_key)); ?>" id="protocolForm" method="POST" class="hero-form p-5">
                        <?php echo csrf_field(); ?>
                        <h3>Гласуване на дневен ред</h3>

                        <div class="row">
                            <div class="col-md-12">
                                <?php $__currentLoopData = $participants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $part): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="fw-bold">
                                        <strong><?php echo e($part->apartment); ?></strong>, 
                                        <?php echo e($part->person); ?> 
                                        <?php echo e($part->parts); ?> ид.ч.
                                    </div>
                                    <ol class="mb-5">
                                        <?php $__currentLoopData = $agendas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agenda): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <?php echo e($agenda['name']); ?><br/>
                                            <div class="form-check">
                                                <label for="<?php echo e($part->id); ?>-approves-<?php echo e($agenda['id']); ?>" class="form-check-label">ЗА</label>
                                                <input type="radio" id="<?php echo e($part->id); ?>-approves-<?php echo e($agenda['id']); ?>" class="form-check-input"
                                                        name="<?php echo e($part->id); ?>-agenda-<?php echo e($agenda['id']); ?>" 
                                                        value="approves"/>
                                            </div>
                                            <div class="form-check">
                                                <label for="<?php echo e($part->id); ?>-refuses-<?php echo e($agenda['id']); ?>" class="form-check-label">ПРОТИВ</label>
                                                <input type="radio" id="<?php echo e($part->id); ?>-refuses-<?php echo e($agenda['id']); ?>" class="form-check-input"
                                                        name="<?php echo e($part->id); ?>-agenda-<?php echo e($agenda['id']); ?>" 
                                                        value="refuses"/>
                                            </div>
                                            <div class="form-check">
                                                <label for="<?php echo e($part->id); ?>-abstain" class="form-check-label">ВЪЗДЪРЖАЛ</label>
                                                <input type="radio" id="<?php echo e($part->id); ?>-abstain-<?php echo e($agenda['id']); ?>" class="form-check-input"
                                                        name="<?php echo e($part->id); ?>-agenda-<?php echo e($agenda['id']); ?>"
                                                        value="abstain" />
                                            </div>
                                        </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ol>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php if($agendas): ?>
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
                                                                Зa <input type="number" name="<?php echo e($agenda['id']); ?>-approves"
                                                                value="<?php echo e($agenda['approves']); ?>" class="form-control">
                                                            </td>
                                                            <td class="cell2">
                                                                Против <input type="number" name="<?php echo e($agenda['id']); ?>-refuses"
                                                                value="<?php echo e($agenda['refuses']); ?>" class="form-control">
                                                            </td>
                                                            <td class="total">
                                                                Въздържал се
                                                                <input type="number" name="<?php echo e($agenda['id']); ?>-abstain"
                                                                value="<?php echo e($agenda['abstain']); ?>" class="form-control" >
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                <?php endif; ?>

                                <input type="hidden" name="meetQuorum2" id="meetQuorum2" value="<?php echo e($meetQuorum2); ?>">
                            </div>
                        </div>

                        <div class="row">
                            <input type="hidden" name="protocol_id" value="<?php echo e($protocol->id); ?>">
                            <div class="d-grid mt-5">
                                <button type="submit" id="protocolCreateBtn"
                                        class="btn btn-primary btn-lg">
                                    Запиши
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function () {
            $('input[value*="abstain"]').prop('checked', true);
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ramona/PhpstormProjects/QuestDoc/resources/views/protocols/voting.blade.php ENDPATH**/ ?>