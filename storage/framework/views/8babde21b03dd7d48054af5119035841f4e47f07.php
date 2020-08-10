<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.financial_reports_page_title')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
    <div class="row">
        <div class="col-md-12 col-lg-6 col-xl-6">
            <section class="card text-center bg-primary">
                <div class="card-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title"><?php echo e(trans('admin.vendors_income')); ?></h4>
                                <div class="info">
                                    <strong class="amount"><?php echo currencySign(); ?><?php echo e(number_format($userIncome,2)); ?></strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-12 col-lg-6 col-xl-6">
            <section class="card text-center bg-warning">
                <div class="card-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title"><?php echo e(trans('admin.business_income')); ?></h4>
                                <div class="info">
                                    <strong class="amount"><?php echo currencySign(); ?><?php echo e(number_format($siteIncome,2)); ?></strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-12 col-lg-4 col-xl-4">
            <section class="card text-center bg-info">
                <div class="card-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title"><?php echo e(trans('admin.sales_amount')); ?></h4>
                                <div class="info">
                                    <strong class="amount"><?php echo e($allIncome); ?></strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                                <a href="/admin/buysell/list" class="text text-uppercase"><?php echo e(trans('admin.sales_list')); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-12 col-lg-4 col-xl-4">
            <section class="card text-center bg-danger">
                <div class="card-body">
                    <div class="widget-summary">

                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title"><?php echo e(trans('admin.total_sales')); ?></h4>
                                <div class="info">
                                    <strong class="amount"><?php echo e($sellCount); ?></strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                                <a href="/admin/buysell/list" class="text text-uppercase"><?php echo e(trans('admin.sales_list')); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-12 col-lg-4 col-xl-4">
            <section class="card text-center bg-success">
                <div class="card-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title"><?php echo e(trans('admin.total_transactions')); ?></h4>
                                <div class="info">
                                    <strong class="amount"><?php echo e($transactionCount); ?></strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                                <a href="/admin/balance/transaction" class="text text-uppercase"><?php echo e(trans('admin.transactions_list')); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <section class="card">
        <div class="card-body">
            <canvas id="myChart" width="400" height="200"></canvas>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="/assets/vendor/chartjs/Chart.min.js"></script>
    <script>
        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [
                    <?php for($i=1;$i<get_option('chart_day_count',10)+1;$i++): ?>
                        "<?php echo date("m/d",strtotime('-'.$i.' day')+12600); ?>",
                    <?php endfor; ?>
                ],
                datasets: [{
                    label: 'Sales',
                    data: [
                        <?php for($i=1;$i<get_option('chart_day_count',10)+1;$i++): ?>
                        <?php echo groupDay($dayRegister,$i); ?>,
                        <?php endfor; ?>
                    ],
                    backgroundColor: [
                        'rgba(2,22,222, 0.2)',
                    ],
                    borderColor: [
                        'rgba(1,11,111, 1)',
                    ],
                    borderWidth: 1
                }, {
                    label: 'Transactions',
                    data: [
                        <?php for($i=1;$i<get_option('chart_day_count',10)+1;$i++): ?>
                        <?php echo groupDay($transactionRegister,$i); ?>,
                        <?php endfor; ?>
                    ],
                    backgroundColor: [
                        'rgba(51,255,204, 0.2)',
                    ],
                    borderColor: [
                        'rgba(204,255,51, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Reports','Financial']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/report/balance.blade.php ENDPATH**/ ?>