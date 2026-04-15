@extends('layouts.app')

@section('title', 'Thêm sản phẩm')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0"><i class="fas fa-plus"></i> Thêm sản phẩm mới</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Tên xe <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Hãng xe <span class="text-danger">*</span></label>
                                <select name="brand" class="form-control" required>
                                    <option value="Honda">Honda</option>
                                    <option value="Yamaha">Yamaha</option>
                                    <option value="Suzuki">Suzuki</option>
                                    <option value="Kawasaki">Kawasaki</option>
                                    <option value="BMW">BMW</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Model <span class="text-danger">*</span></label>
                                <input type="text" name="model" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Năm sản xuất <span class="text-danger">*</span></label>
                                <input type="number" name="year" class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Giá <span class="text-danger">*</span></label>
                                <input type="number" name="price" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Phân khối <span class="text-danger">*</span></label>
                                <input type="text" name="engine_cc" class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Màu sắc <span class="text-danger">*</span></label>
                                <input type="text" name="color" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Số lượng tồn kho <span class="text-danger">*</span></label>
                                <input type="number" name="stock" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Mô tả chi tiết <span class="text-danger">*</span></label>
                            <textarea name="description" rows="5" class="form-control" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label>Ảnh sản phẩm</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                            <small class="text-muted">Hỗ trợ: JPG, PNG. Tối đa 5MB</small>
                        </div>

                        <button type="submit" class="btn btn-danger w-100">Lưu sản phẩm</button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary w-100 mt-2">Hủy</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
