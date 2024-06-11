<?php $__env->startSection('pageTitle', 'Начало'); ?>

<?php $__env->startSection('content'); ?>
    <section id="hero" class="position-relative overflow-hidden py-4">
        <div class="container py-5 mt-5">
            <div id="select_container" class="row align-items-center py-5 mt-5">
                <div class="col-md-5 offset-md-1 p-5" style="background: rgba(255, 255, 255, 0.90)">
                    <p>Искате да създадете ново събрание или продължавате старо?</p>
                    <button id="newMeet" class="btn btn-primary btn-lg">Ново</button>
                    <a href="<?php echo e(route('invitations.show')); ?>" class="btn btn-primary btn-lg">Старо</a>
                </div>
            </div>

            <!-- NEW INVITATION -->
            <div id="new_invitation_container" class="row align-items-center py-5 mt-5 d-none">
                <div class="col-md-12" id="meetContainer">
                    <?php if($message = Session::get('success')): ?>
                        <div class="alert alert-success text-center" role="alert">
                            <?php echo e($message); ?>

                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(route('invitations.store')); ?>" id="meetForm" method="get" class="hero-form p-5">
                        <?php echo csrf_field(); ?>
                        <h3 class="display-2">ПОКАНА</h3>
                        <p class="h5 mb-4">ОБЩО СЪБРАНИЕ НА СОБСТВЕНИЦИТЕ НА ЕТАЖНА СОБСТВЕНОСТ</p>

                        <div class="row">
                            <div class="col">
                                <label for="manager" class="form-label mb-0">Управител на ЕС</label>
                                <input type="text" class="form-control"
                                    value="<?php echo e(old('manager')); ?>" name="manager" id="manager">
                            </div>
                            <div class="col">
                                <label for="reason" class="form-label mb-0">Основание</label>
                                <select name="reason" id="reason" class="form-control">
                                    <option value="option1">чл. 12 ал. 1 и чл. 13 от ЗУЕС</option>
                                    <option value="option2">Опция 2</option>
                                    <option value="option3">Опция 3</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="address" class="form-label mb-0">Адрес</label>
                                <textarea class="form-control" name="address" id="address">
                                    <?php echo e(old('address')); ?>

                                </textarea>
                            </div>
                            <div class="col">
                                <label for="meet_date" class="form-label mb-0">Дата на събрание</label>
                                <input type="date" class="form-control"
                                    value="<?php echo e(old('meet_date')); ?>" name="meet_date" id="meet_date">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="meet_time" class="form-label mb-0">Час на събрание</label>
                                <input type="text" class="form-control bs-timepicker"
                                    value="<?php echo e(old('meet_time')); ?>" name="meet_time" id="meet_time">
                            </div>
                            <div class="col">
                                <label for="location" class="form-label mb-0">Локация на събрание</label>
                                <input type="text" class="form-control" value="<?php echo e(old('location')); ?>"
                                        name="location" id="location">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="stick_place" class="form-label mb-0">Къде се разлепя поканата?</label>
                                <input type="text" class="form-control" value="<?php echo e(old('stick_place')); ?>"
                                        name="stick_place" id="stick_place">
                            </div>
                            <div class="col"></div>
                        </div>

                        <h4 class="mt-3">Дневен ред</h4>
                        <div class="row">
                            <div class="col" id="agendasContainer">
                                <label for="agenda_id" class="form-label mb-0">Точка от дневен ред</label>
                                <textarea name="agenda_id[]" id="agenda_id" class="form-control mb-2"></textarea>
                                <button class="btn btn-outline mt-3 mb-4" id="addAgenda">Добави точка</button>
                            </div>
                            <div class="col">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" id="meetCreateBtn"
                                        class="btn btn-primary btn-md float-end">
                                    Създай покана
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

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ramona/PhpstormProjects/QuestDoc/resources/views/pages/index.blade.php ENDPATH**/ ?>