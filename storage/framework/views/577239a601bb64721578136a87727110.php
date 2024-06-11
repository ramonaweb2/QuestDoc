<?php $__env->startSection('pageTitle', 'Покана за ОС'); ?>

<?php $__env->startSection('content'); ?>

    <section id="hero" class="position-relative overflow-hidden py-4">
        <div class="container py-5 mt-5">
            <div id="invitation_container" class="row align-items-center py-5 mt-5">
                <div class="col-md-8 offset-2 p-5" style="background: rgba(255, 255, 255, 0.90)">
                    <?php if($invitation): ?>
                        <h4>Покана</h4>
                        <div class="row">
                            <div class="col mt-3 mb-3 pull-left">
                                <a href="<?php echo e(route('invitations.download', $invitation->inv_key)); ?>"
                                    class="btn btn-primary">
                                    <i class="fa fa-file" aria-hidden="true"></i> Изтегли покана (DOCX)
                                </a>
                            </div>
                            <div class="col mt-3 mb-3 pull-right">
                                <a href="<?php echo e(route('invitations.download_pdf', $invitation->inv_key)); ?>"
                                    class="btn btn-primary">
                                    <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Изтегли покана (PDF)
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <a href="<?php echo e(route('protocols.display', $invitation->inv_key)); ?>"
                                    class="btn btn-secondary">
                                    Протокол
                                </a>
                            </div>
                        </div>
                    <?php else: ?>
                        Не е намерена покана с този ключ.
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ramona/PhpstormProjects/QuestDoc/resources/views/invitations/display.blade.php ENDPATH**/ ?>