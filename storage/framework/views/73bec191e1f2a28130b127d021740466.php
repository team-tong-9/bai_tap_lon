<?php $__env->startSection('title', 'Quản lý đơn hàng'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Quản lý đơn hàng</h1>
        </div>
    </div>

    <!-- Thống kê -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Tổng doanh thu</h5>
                    <h2><?php echo e(number_format($totalRevenue)); ?>đ</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Chờ xử lý</h5>
                    <h2><?php echo e($statusCounts['pending']); ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Đang xử lý</h5>
                    <h2><?php echo e($statusCounts['processing']); ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Hoàn thành</h5>
                    <h2><?php echo e($statusCounts['completed']); ?></h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Danh sách đơn hàng -->
    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Mã đơn</th>
                            <th>Số hóa đơn</th>
                            <th>Khách hàng</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Thanh toán</th>
                            <th>Ngày đặt</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><strong><?php echo e($order->order_number); ?></strong></td>
                            <td><?php echo e($order->invoice_number ?? 'Chưa có'); ?></td>
                            <td><?php echo e($order->user->name); ?><br><small><?php echo e($order->user->email); ?></small></td>
                            <td><?php echo e(number_format($order->total_amount)); ?>đ</td>
                            <td><?php echo $order->status_badge; ?></td>
                            <td><?php echo $order->payment_status_badge; ?></td>
                            <td><?php echo e($order->created_at->format('d/m/Y H:i')); ?></td>
                            <td>
                                <a href="<?php echo e(route('admin.orders.show', $order->id)); ?>" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i> Chi tiết
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <?php echo e($orders->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\Shop_MotoVn\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>