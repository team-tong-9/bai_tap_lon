<?php $__env->startSection('title', 'Trang chủ - Shop_MotoVn'); ?>

<?php $__env->startSection('content'); ?>
<div class="hero" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; padding: 80px 0; margin-bottom: 50px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1>Chào mừng đến với Shop_MotoVn</h1>
                <p class="lead">Khám phá những mẫu xe máy mới nhất với thiết kế đẳng cấp</p>
                <a href="<?php echo e(route('products')); ?>" class="btn btn-primary-custom">Xem sản phẩm ngay</a>
            </div>
            <div class="col-md-6 text-center">
                <i class="fas fa-motorcycle" style="font-size: 150px; opacity: 0.3;"></i>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h2>Sản phẩm nổi bật</h2>
            <p>Những mẫu xe được yêu thích nhất</p>
        </div>
    </div>

    <div class="row">
        <?php $__currentLoopData = $featuredProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-3 mb-4">
            <div class="product-card">
                <img src="<?php echo e($product->image); ?>" alt="<?php echo e($product->name); ?>">
                <div class="p-3">
                    <h5><?php echo e($product->name); ?></h5>
                    <p class="text-muted"><?php echo e($product->brand); ?></p>
                    <div class="product-price"><?php echo e(number_format($product->price)); ?>đ</div>
                    <a href="<?php echo e(route('product.detail', $product->id)); ?>" class="btn btn-primary-custom w-100 mt-2">Xem chi tiết</a>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card text-center p-4 shadow-sm">
                <i class="fas fa-truck fa-3x text-danger mb-3"></i>
                <h5>Giao hàng miễn phí</h5>
                <p class="text-muted">Miễn phí cho đơn hàng trên 50 triệu</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-center p-4 shadow-sm">
                <i class="fas fa-shield-alt fa-3x text-danger mb-3"></i>
                <h5>Bảo hành chính hãng</h5>
                <p class="text-muted">Bảo hành 3 năm không giới hạn km</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-center p-4 shadow-sm">
                <i class="fas fa-hand-holding-usd fa-3x text-danger mb-3"></i>
                <h5>Trả góp 0%</h5>
                <p class="text-muted">Hỗ trợ trả góp lãi suất 0%</p>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\Shop_MotoVn\resources\views/home.blade.php ENDPATH**/ ?>