<?php $__env->startSection('title', 'Giỏ hàng'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h1 class="mb-4">Giỏ hàng của bạn</h1>

    <?php if($cart->items->count() > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tạm tính</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $cart->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <img src="<?php echo e($item->product->image); ?>" width="50" class="me-2 rounded">
                            <?php echo e($item->product->name); ?>

                        </td>
                        <td><?php echo e(number_format($item->product->price)); ?>đ</td>
                        <td>
                            <form action="<?php echo e(route('cart.update', $item->id)); ?>" method="POST" class="d-flex gap-2">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <input type="number" name="quantity" value="<?php echo e($item->quantity); ?>" min="1" class="form-control" style="width: 70px;">
                                <button type="submit" class="btn btn-sm btn-warning">Cập nhật</button>
                            </form>
                         </td>
                        <td><?php echo e(number_format($item->subtotal)); ?>đ</td>
                        <td>
                            <form action="<?php echo e(route('cart.remove', $item->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                            </form>
                         </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <th colspan="3" class="text-end">Tổng cộng:</th>
                        <th colspan="2"><?php echo e(number_format($cart->total)); ?>đ</th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <form action="<?php echo e(route('cart.clear')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Xóa toàn bộ giỏ hàng?')">
                        <i class="fas fa-trash"></i> Xóa toàn bộ
                    </button>
                </form>
            </div>
            <div class="col-md-6 text-end">
                <a href="<?php echo e(route('orders.checkout')); ?>" class="btn btn-primary-custom btn-lg">
                    <i class="fas fa-credit-card"></i> Tiến hành thanh toán
                </a>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center py-5">
            <i class="fas fa-shopping-cart fa-4x mb-3"></i>
            <p>Giỏ hàng của bạn đang trống!</p>
            <a href="<?php echo e(route('products')); ?>" class="btn btn-primary-custom">Tiếp tục mua sắm</a>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\Shop_MotoVn\resources\views/cart/index.blade.php ENDPATH**/ ?>