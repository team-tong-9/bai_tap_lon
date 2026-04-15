<?php $__env->startSection('title', 'Sản phẩm - Shop_MotoVn'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1>Danh sách sản phẩm</h1>
            <p>Khám phá bộ sưu tập xe máy đa dạng</p>
        </div>
    </div>

    <div class="row">
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-4 mb-4">
            <div class="product-card">
                <img src="<?php echo e($product->image); ?>" alt="<?php echo e($product->name); ?>">
                <div class="p-3">
                    <h5><?php echo e($product->name); ?></h5>
                    <p class="text-muted"><?php echo e($product->brand); ?> <?php echo e($product->model); ?></p>
                    <div class="product-price"><?php echo e(number_format($product->price)); ?>đ</div>
                    <p class="small text-muted">Còn: <?php echo e($product->stock); ?> xe</p>
                    <a href="<?php echo e(route('product.detail', $product->id)); ?>" class="btn btn-primary-custom w-100">Xem chi tiết</a>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <?php echo e($products->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\Shop_MotoVn\resources\views/products.blade.php ENDPATH**/ ?>