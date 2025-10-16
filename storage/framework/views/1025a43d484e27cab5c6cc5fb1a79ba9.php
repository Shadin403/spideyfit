<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('content'); ?>
    <style>
        .bg-success {
            background-color: #40c710 !important;
        }

        .bg-danger {
            background-color: #f44032 !important;
        }

        .bg-warning {
            background-color: #f5d700 !important;
            color: #000;
        }

        .bg-info {
            background-color: #10c2dd !important;
            color: #fcfafa;
        }
    </style>
    <div class="main-content-inner">

        <div class="main-content-wrap">
            <div class="tf-section-2 mb-30">
                <div class="flex gap20 flex-wrap-mobile">
                    <div class="w-half">

                        <div class="mb-20 wg-chart-default">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-shopping-bag"></i>
                                    </div>
                                    <div>
                                        <div class="mb-2 body-text"><b class="text-dark">Total Orders</b></div>
                                        <h4><?php echo e($orders->count()); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="mb-20 wg-chart-default">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-dollar-sign"></i>
                                    </div>
                                    <div>
                                        <div class="mb-2 body-text">Total Amount</div>
                                        <h4><?php echo e($orders->sum('total')); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="mb-20 wg-chart-default">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-shopping-bag"></i>
                                    </div>
                                    <div>
                                        <div class="mb-2 body-text">Pending Orders</div>
                                        <h4><?php echo e($orders->where('status', 'ordered')->count()); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="wg-chart-default">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-dollar-sign"></i>
                                    </div>
                                    <div>
                                        <div class="mb-2 body-text">Pending Orders Amount</div>
                                        <h4><?php echo e($orders->where('status', 'pending')->sum('total')); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="w-half">

                        <div class="mb-20 wg-chart-default">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-shopping-bag"></i>
                                    </div>
                                    <div>
                                        <div class="mb-2 body-text">Delivered Orders</div>
                                        <h4><?php echo e($orders->where('status', 'delivered')->count()); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="mb-20 wg-chart-default">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-dollar-sign"></i>
                                    </div>
                                    <div>
                                        <div class="mb-2 body-text">Delivered Orders Amount</div>
                                        <h4><?php echo e($orders->where('status', 'delivered')->sum('total')); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="mb-20 wg-chart-default">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-shopping-bag"></i>
                                    </div>
                                    <div>
                                        <div class="mb-2 body-text"><b class="text-danger">Canceled Orders</b></div>
                                        <h4><?php echo e($orders->where('status', 'canceled')->count()); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="wg-chart-default">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-dollar-sign"></i>
                                    </div>
                                    <div>
                                        <div class="mb-2 body-text">Canceled Orders Amount</div>
                                        <h4><?php echo e($orders->where('status', 'canceled')->sum('total')); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="wg-box">
                    <div class="flex items-center justify-between">
                        <h5>Monthly Revenue</h5>
                        
                    </div>
                    <div class="flex flex-wrap gap40">
                        <div>
                            <div class="mb-2">
                                <div class="block-legend">
                                    <div class="dot t1"></div>
                                    <div class="text-tiny">Total</div>
                                </div>
                            </div>
                            <div class="flex items-center gap10">
                                <h4>$<?php echo e($TotalAmount); ?></h4>
                                
                            </div>
                        </div>
                        <div>
                            <div class="mb-2">
                                <div class="block-legend">
                                    <div class="dot t4" style="background-color: #f5d700"></div>
                                    <div class="text-tiny">Pending</div>
                                </div>
                            </div>
                            <div class="flex items-center gap10">
                                <h4>$<?php echo e(json_decode($OrderedAmountM)[date('n') - 1] ?? 0); ?></h4>
                                
                            </div>
                        </div>
                        <div>
                            <div class="mb-2">
                                <div class="block-legend">
                                    <div class="dot" style="background-color: green;"></div>
                                    <div class="text-tiny">Delivered</div>
                                </div>
                            </div>
                            <div class="flex items-center gap10">
                                <h4>$<?php echo e($TotalDeliveredAmount); ?></h4>
                                
                            </div>
                        </div>
                        <div>
                            <div class="mb-2">
                                <div class="block-legend">
                                    <div class="dot t3"></div>
                                    <div class="text-tiny">Canceled</div>
                                </div>
                            </div>
                            <div class="flex items-center gap10">
                                <h4>$<?php echo e($TotalCanceledAmount); ?></h4>
                                
                            </div>
                        </div>
                    </div>
                    <div id="line-chart-8"></div>
                </div>

            </div>
            <div class="tf-section mb-30">

                <div class="wg-box">
                    <div class="flex items-center justify-between">
                        <h5>Recent orders</h5>
                        <div class="dropdown default">
                            <a class="btn btn-secondary dropdown-toggle" href="#">
                                <span class="view-all">View all</span>
                            </a>
                        </div>
                    </div>
                    <div class="wg-table table-all-user">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 80px">OrderNo</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Phone</th>
                                        <th class="text-center">Subtotal</th>
                                        <th class="text-center">Tax</th>
                                        <th class="text-center">Total</th>

                                        <th class="text-center">Status</th>
                                        <th class="text-center">Order Date</th>
                                        <th class="text-center">Total Items</th>
                                        <th class="text-center">Delivered On</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="text-center"><?php echo e($order->id); ?></td>
                                            <td class="text-center"><?php echo e($order->name); ?></td>
                                            <td class="text-center"><?php echo e($order->phone); ?></td>
                                            <td class="text-center">$<?php echo e($order->subtotal); ?></td>
                                            <td class="text-center">
                                                <?php if($order->tax): ?>
                                                    $<?php echo e($order->tax); ?>

                                                <?php else: ?>
                                                    $0.00
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">$<?php echo e($order->total); ?></td>

                                            <td class="text-center">
                                                <?php if($order->status == 'ordered'): ?>
                                                    <span class="badge bg-info">Ordered</span>
                                                <?php elseif($order->status == 'shipped'): ?>
                                                    <span class="badge bg-warning">Shipped</span>
                                                <?php elseif($order->status == 'delivered'): ?>
                                                    <span class="badge bg-success">Delivered</span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger">Canceled</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center"><?php echo e($order->created_at); ?></td>
                                            <td class="text-center"><?php echo e($order->orderItems->count()); ?></td>
                                            <td><?php echo e($order->delivered_date); ?></td>
                                            <td class="text-center">
                                                <form action="<?php echo e(route('admin.order.details', $order->id)); ?>"
                                                    method="post">
                                                    <?php echo csrf_field(); ?>
                                                    <a href="javascript:void(0)" onclick="this.closest('form').submit()">
                                                        <div class="list-icon-function view-icon">
                                                            <div class="item eye">
                                                                <i class="icon-eye"></i>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>


    <div class="bottom-page">
        <div class="body-text">Copyright © 2024 Dev-Shadin</div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        (function($) {
            var tfLineChart = (function() {
                var chartBar = function() {
                    var options = {
                        series: [{
                                name: 'Total',
                                data: JSON.parse('<?php echo $AmountM; ?>')
                            }, {
                                name: 'Pending',
                                data: JSON.parse('<?php echo $OrderedAmountM; ?>')
                            },
                            {
                                name: 'Delivered',
                                data: JSON.parse('<?php echo $DeliveredAmountM; ?>')
                            }, {
                                name: 'Canceled',
                                data: JSON.parse('<?php echo $CanceledAmountM; ?>')
                            }
                        ],
                        chart: {
                            type: 'bar',
                            height: 325,
                            toolbar: {
                                show: false,
                            },
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: '10px',
                                endingShape: 'rounded'
                            },
                        },
                        dataLabels: {
                            enabled: false
                        },
                        legend: {
                            show: false,
                        },
                        colors: ['#2377FC', '#FFA500', '#078407', '#FF0000'],
                        stroke: {
                            show: false,
                        },
                        xaxis: {
                            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep',
                                'Oct', 'Nov', 'Dec'
                            ],
                            labels: {
                                style: {
                                    colors: '#212529',
                                },
                            },
                        },
                        yaxis: {
                            show: false,
                        },
                        fill: {
                            opacity: 1
                        },
                        tooltip: {
                            y: {
                                formatter: function(val) {
                                    return "$ " + val + ""
                                }
                            }
                        }
                    };

                    var chart = new ApexCharts(document.querySelector("#line-chart-8"), options);
                    if ($("#line-chart-8").length > 0) {
                        chart.render();
                    }
                };

                return {
                    init: function() {},
                    load: function() {
                        chartBar();
                    },
                    resize: function() {},
                };
            })();

            jQuery(document).ready(function() {});

            jQuery(window).on("load", function() {
                tfLineChart.load();
            });

            jQuery(window).on("resize", function() {});
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/devshadin/ecommercesite.dev-shadin.com/resources/views/admin/index.blade.php ENDPATH**/ ?>