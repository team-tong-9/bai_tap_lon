<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Shop_MotoVn - Xe Máy Chính Hãng'); ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #e74c3c;
            --secondary-color: #2c3e50;
            --accent-color: #f39c12;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 70px;
            background: #f0f2f5;
        }

        .navbar {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand, .nav-link {
            color: white !important;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .nav-link:hover {
            color: var(--accent-color) !important;
        }

        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--accent-color);
            color: #333;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 10px;
            font-weight: bold;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary-color), #c0392b);
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            transition: all 0.3s ease;
            color: white;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(231,76,60,0.3);
            color: white;
        }

        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            height: 100%;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .product-card img {
            height: 200px;
            width: 100%;
            object-fit: cover;
        }

        .product-price {
            font-size: 1.3rem;
            font-weight: bold;
            color: var(--primary-color);
        }

        .footer {
            background: var(--secondary-color);
            color: white;
            padding: 40px 0 20px;
            margin-top: 50px;
        }

        .footer a {
            color: white;
            text-decoration: none;
        }

        .footer a:hover {
            color: var(--accent-color);
        }

        @media (max-width: 768px) {
            body { padding-top: 60px; }
            .product-card img { height: 160px; }
        }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
                <i class="fas fa-motorcycle"></i> Shop_MotoVn
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('home')); ?>">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('products')); ?>">Sản phẩm</a>
                    </li>

                    <?php if(auth()->guard()->check()): ?>
                        <li class="nav-item position-relative">
                            <a class="nav-link" href="<?php echo e(route('cart.index')); ?>">
                                <i class="fas fa-shopping-cart"></i> Giỏ hàng
                                <?php if(Auth::user()->cart && Auth::user()->cart->total_items > 0): ?>
                                    <span class="cart-badge"><?php echo e(Auth::user()->cart->total_items); ?></span>
                                <?php endif; ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('orders.index')); ?>">
                                <i class="fas fa-truck"></i> Đơn hàng
                            </a>
                        </li>
                        <?php if(Auth::user()->is_admin): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('admin.dashboard')); ?>">
                                    <i class="fas fa-tachometer-alt"></i> Admin
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                <i class="fas fa-user"></i> <?php echo e(Auth::user()->name); ?>

                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?php echo e(route('profile')); ?>">Hồ sơ</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Đăng xuất
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('login')); ?>">Đăng nhập</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('register')); ?>">Đăng ký</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                <?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5><i class="fas fa-motorcycle"></i> Shop_MotoVn</h5>
                    <p>Chuyên cung cấp xe máy chính hãng, uy tín hàng đầu.</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Liên hệ</h5>
                    <p><i class="fas fa-phone"></i> 0123 456 789</p>
                    <p><i class="fas fa-envelope"></i> info@shopmotovn.com</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Theo dõi</h5>
                    <a href="#" class="me-2"><i class="fab fa-facebook fa-lg"></i></a>
                    <a href="#" class="me-2"><i class="fab fa-instagram fa-lg"></i></a>
                    <a href="#"><i class="fab fa-youtube fa-lg"></i></a>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p>&copy; 2024 Shop_MotoVn. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
        <?php echo csrf_field(); ?>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\xampp\htdocs\Shop_MotoVn\resources\views/layouts/app.blade.php ENDPATH**/ ?>