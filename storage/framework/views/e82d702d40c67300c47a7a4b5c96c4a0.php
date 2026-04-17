

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>🛒 Giỏ hàng của bạn</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php if(!empty($cart) && count($cart) > 0): ?>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($item['name']); ?></td>
                    <td><?php echo e(number_format($item['price'])); ?>đ</td>
                    <td>
                        <form action="<?php echo e(route('cart.update', $id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <input type="number" name="quantity" value="<?php echo e($item['quantity']); ?>" min="1" style="width: 70px;">
                            <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
                        </form>
                    </td>
                    <td class="text-danger fw-bold"><?php echo e(number_format($item['price'] * $item['quantity'])); ?>đ</td>
                    <td>
                        <form action="<?php echo e(route('cart.remove', $id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end"><strong>Tổng cộng:</strong></td>
                    <td colspan="2"><strong class="text-danger fs-5"><?php echo e(number_format($total)); ?>đ</strong></td>
                </tr>
            </tfoot>
        </table>
        <div class="text-end mt-3">
    <a href="<?php echo e(route('products.index')); ?>" class="btn btn-secondary">Tiếp tục mua sắm</a>
    <a href="<?php echo e(route('cart.checkout')); ?>" class="btn btn-success btn-lg ms-2">✅ Thanh toán ngay</a>
</div>
    <?php else: ?>
        <div class="alert alert-info text-center">
            Giỏ hàng trống! <a href="<?php echo e(route('products.index')); ?>">Mua sắm ngay</a>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\Maiductrung\resources\views/cart/index.blade.php ENDPATH**/ ?>