<?php $__env->startSection('tab5','active'); ?>
<?php $__env->startSection('tab'); ?>
    <div class="h-20"></div>
    <div class="">
        <form class="form-horizontal">
            <?php echo e(csrf_field()); ?>

            <div class="form-group">
                <label class="control-label col-md-1 tab-con"><?php echo e(trans('main.start_date')); ?></label>
                <div class="col-md-3 tab-con">
                    <div class="input-group">
                        <input type="date" name="first_date" class="form-control text-center" id="first_date" value="<?php echo e($first_date); ?>" required>
                        <span class="input-group-addon first_date_btn" id="first_date_btn"><span class="formicon mdi mdi-calendar-month"></span></span>
                    </div>
                </div>
                <label class="control-label col-md-1 tab-con"><?php echo e(trans('main.end_date')); ?></label>
                <div class="col-md-3 tab-con">
                    <div class="input-group">
                        <input type="date" name="last_date" id="last_date" value="<?php echo $last_date; ?>" class="form-control text-center" required>
                        <span class="input-group-addon last_date_btn" id="last_date_btn"><span class="formicon mdi mdi-calendar-month"></span></span>
                    </div>
                </div>
                <label class="control-label col-md-1 tab-con"></label>
                <div class="col-md-3 tab-con">
                    <button type="submit" class="btn btn-custom pull-left btn-100-p"><?php echo e(trans('main.show_results')); ?></button>
                </div>
            </div>
        </form>
        <div class="h-20"></div>
        <div class="alert alert-success">
            <span><?php echo e(trans('main.From')); ?></span>
            <strong><?php echo e($first_date); ?></strong>
            <span><?php echo e(trans('main.until')); ?></span>
            <strong><?php echo e($last_date); ?></strong>
            <span><?php echo e(trans('main.total_sold')); ?></span>
            <strong><?php echo e($sellcount); ?></strong>
            <span><?php echo e(trans('main.and_total_amount')); ?></span>
            <strong><?php echo e($prices); ?></strong>
            <span><?php echo e(trans('main.and_your_income')); ?></span>
            <span><?php echo e(currencySign()); ?></span>
            <strong><?php echo e($income); ?></strong>
        </div>
        <div class="h-20"></div>
        <div class="report-chart course_details">
            <canvas id="myChart"></canvas>
        </div>
    </div>
    <div class="h-20"></div>
    <div class="h-20"></div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>$('#balance-hover').addClass('item-box-active');</script>
    <script type="text/javascript">
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',

            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [
                    {
                        label: "Sales",
                        backgroundColor: '#e91e63',
                        data: [<?php echo implode(',',$chart['sell']); ?>],
                    },
                    {
                        label: "Income",
                        backgroundColor: '#03a9f4',
                        data: [<?php echo implode(',',$chart['income']); ?>],
                    }
                ]
            },

            options: {}
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($user['vendor'] == 1 ? getTemplate() . '.user.layout.balancelayout' : getTemplate() . '.user.layout_user.balancelayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/web/default/user/balance/report.blade.php ENDPATH**/ ?>