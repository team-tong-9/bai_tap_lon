

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2 class="mb-4 text-center">🏍️ Danh sách xe máy</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="row">
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5><?php echo e($product->name); ?></h5>
                    <p class="text-danger fw-bold"><?php echo e(number_format($product->price)); ?>đ</p>
                    <form action="<?php echo e(route('cart.add', $product->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-primary">🛒 Thêm vào giỏ</button>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\Maiductrung\resources\views/products/index.blade.php ENDPATH**/ ?>