<?php $__env->startSection('pageTitle', 'Старо събрание'); ?>

<?php $__env->startSection('content'); ?>

    <section id="hero" class="position-relative overflow-hidden py-4">

        <div class="container py-5 mt-5">
            <div id="select_container" class="row align-items-center py-5 mt-5">
                <div class="col-md-5 offset-md-1 p-5" style="background: rgba(255, 255, 255, 0.90)">
                    <form action="<?php echo e(route('invitations.display')); ?>" id="meetForm" method="get" class="hero-form p-5">
                        <?php echo csrf_field(); ?>
                        <h4>ВЪВЕДЕТЕ КОД НА ПОКАНА</h4>

                        <div class="mb-4">
                            <label for="inv_key" class="form-label mb-0">Код</label>
                            <input type="text" class="form-control" autofocus name="inv_key" id="inv_key">
                        </div>
                        <div class="d-grid">
                            <button type="submit" id="meetShowBtn" class="btn btn-primary btn-lg">Въведи</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ramona/PhpstormProjects/QuestDoc/resources/views/invitations/show.blade.php ENDPATH**/ ?>