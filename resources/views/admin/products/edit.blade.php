@extends('layouts.app')

@section('title', 'Sửa sản phẩm')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-warning">
                    <h5 class="mb-0"><i class="fas fa-edit"></i> Sửa sản phẩm: {{ $product->name }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Tên xe <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Hãng xe <span class="text-danger">*</span></label>
                                <select name="brand" class="form-control" required>
                                    <option value="Honda" {{ $product->brand == 'Honda' ? 'selected' : '' }}>Honda</option>
                                    <option value="Yamaha" {{ $product->brand == 'Yamaha' ? 'selected' : '' }}>Yamaha</option>
                                    <option value="Suzuki" {{ $product->brand == 'Suzuki' ? 'selected' : '' }}>Suzuki</option>
                                    <option value="Kawasaki" {{ $product->brand == 'Kawasaki' ? 'selected' : '' }}>Kawasaki</option>
                                    <option value="BMW" {{ $product->brand == 'BMW' ? 'selected' : '' }}>BMW</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Model <span class="text-danger">*</span></label>
                                <input type="text" name="model" class="form-control" value="{{ $product->model }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Năm sản xuất <span class="text-danger">*</span></label>
                                <input type="number" name="year" class="form-control" value="{{ $product->year }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Giá <span class="text-danger">*</span></label>
                                <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Phân khối <span class="text-danger">*</span></label>
                                <input type="text" name="engine_cc" class="form-control" value="{{ $product->engine_cc }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Màu sắc <span class="text-danger">*</span></label>
                                <input type="text" name="color" class="form-control" value="{{ $product->color }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Số lượng tồn kho <span class="text-danger">*</span></label>
                                <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Mô tả chi tiết <span class="text-danger">*</span></label>
                            <textarea name="description" rows="5" class="form-control" required>{{ $product->description }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label>Ảnh sản phẩm</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                            <small class="text-muted">Để trống nếu không muốn thay đổi ảnh</small>
                            @if($product->image)
                                <div class="mt-2">
                                    <img src="{{ $product->image }}" width="100" class="rounded">
                                </div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-warning w-100">Cập nhật</button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary w-100 mt-2">Hủy</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
