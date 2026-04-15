<?php $__env->startSection('title', 'Chi tiết đơn hàng #' . $order->order_number); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8">
            <!-- Thông tin đơn hàng -->
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Chi tiết đơn hàng #<?php echo e($order->order_number); ?></h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($item->product_name); ?><br>
                                        <small class="text-muted">Mã SP: <?php echo e($item->product_id); ?></small>
                                    </td>
                                    <td><?php echo e(number_format($item->price)); ?>đ</td>
                                    <td><?php echo e($item->quantity); ?></td>
                                    <td><?php echo e(number_format($item->subtotal)); ?>đ</td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-end">Tổng cộng:</th>
                                    <th><?php echo e(number_format($order->total_amount)); ?>đ</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Thông tin giao hàng -->
            <div class="card shadow mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Thông tin giao hàng</h5>
                </div>
                <div class="card-body">
                    <p><strong>Người nhận:</strong> <?php echo e($order->user->name); ?></p>
                    <p><strong>Số điện thoại:</strong> <?php echo e($order->phone); ?></p>
                    <p><strong>Địa chỉ:</strong> <?php echo e($order->shipping_address); ?></p>
                    <?php if($order->notes): ?>
                        <p><strong>Ghi chú của khách:</strong> <?php echo e($order->notes); ?></p>
                    <?php endif; ?>
                    <?php if($order->admin_notes): ?>
                        <p><strong>Ghi chú của admin:</strong> <?php echo e($order->admin_notes); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Cập nhật trạng thái -->
            <div class="card shadow mb-4">
                <div class="card-header bg-warning">
                    <h5 class="mb-0">Cập nhật trạng thái</h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.orders.updateStatus', $order->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="mb-3">
                            <label>Trạng thái đơn hàng</label>
                            <select name="status" class="form-control" required>
                                <option value="pending" <?php echo e($order->status == 'pending' ? 'selected' : ''); ?>>Chờ xử lý</option>
                                <option value="processing" <?php echo e($order->status == 'processing' ? 'selected' : ''); ?>>Đang xử lý</option>
                                <option value="completed" <?php echo e($order->status == 'completed' ? 'selected' : ''); ?>>Hoàn thành</option>
                                <option value="cancelled" <?php echo e($order->status == 'cancelled' ? 'selected' : ''); ?>>Đã hủy</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-warning w-100">Cập nhật trạng thái</button>
                    </form>
                </div>
            </div>

            <!-- Cập nhật thanh toán -->
            <div class="card shadow mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Cập nhật thanh toán</h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.orders.updatePayment', $order->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="mb-3">
                            <label>Trạng thái thanh toán</label>
                            <select name="payment_status" class="form-control" required>
                                <option value="unpaid" <?php echo e($order->payment_status == 'unpaid' ? 'selected' : ''); ?>>Chưa thanh toán</option>
                                <option value="paid" <?php echo e($order->payment_status == 'paid' ? 'selected' : ''); ?>>Đã thanh toán</option>
                                <option value="refunded" <?php echo e($order->payment_status == 'refunded' ? 'selected' : ''); ?>>Đã hoàn tiền</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Phương thức thanh toán chi tiết</label>
                            <input type="text" name="payment_method_detail" class="form-control" value="<?php echo e($order->payment_method_detail); ?>" placeholder="VD: Chuyển khoản MB Bank, Tiền mặt...">
                        </div>
                        <div class="mb-3">
                            <label>Ghi chú (Admin)</label>
                            <textarea name="admin_notes" class="form-control" rows="2"><?php echo e($order->admin_notes); ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Cập nhật thanh toán</button>
                    </form>
                </div>
            </div>

            <!-- Xuất hóa đơn -->
            <div class="card shadow">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">Hóa đơn</h5>
                </div>
                <div class="card-body text-center">
                    <?php if($order->invoice_number): ?>
                        <p><strong>Số hóa đơn:</strong> <?php echo e($order->invoice_number); ?></p>
                        <p><strong>Ngày thanh toán:</strong> <?php echo e($order->payment_date ? date('d/m/Y', strtotime($order->payment_date)) : 'Chưa thanh toán'); ?></p>
                    <?php else: ?>
                        <p class="text-muted">Chưa có hóa đơn</p>
                    <?php endif; ?>
                    <a href="<?php echo e(route('admin.orders.invoice', $order->id)); ?>" class="btn btn-danger w-100" target="_blank">
                        <i class="fas fa-print"></i> Xuất hóa đơn
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\Shop_MotoVn\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>