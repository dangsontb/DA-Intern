@extends('admin.layouts.master')

@section('title')
    Update
@endsection

@section('style-libs')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection


@section('styles')
    <style>
        .ck-editor__editable {
            max-height: 400px;
            /* Chiều cao tối đa của editor */
            overflow-y: auto;
            /* Hiển thị thanh cuộn khi nội dung vượt quá chiều cao */
            resize: none;
            /* Tắt khả năng kéo dài editor */
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Update sản phẩm</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Sản phẩm</a></li>
                        <li class="breadcrumb-item active">Thêm mới</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h6 class="card-title mb-0 flex-grow-1">Thông tin</h6>
                    </div>

                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-4">
                                    <div>
                                        <label for="name" class="form-label">Tên sản phẩm</label>
                                        @error('name')
                                            <div class="text-danger">{{ $message }} </div>
                                        @enderror
                                        <input type="text" class="form-control" name="name" id="name"
                                            value="{{ $product->name }}">


                                    </div>
                                    <div class="mt-3">
                                        <label for="sku" class="form-label">Mã sản phẩm</label>
                                        <input type="text" class="form-control" name="sku" id="sku"
                                            value="{{ $product->sku ?? strtoupper(\Str::random(8)) }}">
                                    </div>
                                    <div class="mt-3">
                                        <label for="price_regular" class="form-label">Giá sản phẩm</label>
                                        <input type="number"  class="form-control" name="price_regular"
                                            id="price_regular" value="{{ $product->price_regular }}">
                                        @error('price_regular')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label for="price_sale" class="form-label">Giá khuyến mãi</label>
                                        <input type="number"  class="form-control" name="price_sale"
                                            id="price_sale" value="{{ $product->price_sale }}">
                                    </div>
                                    <div class="mt-3">
                                        <label for="category_id" class="form-label">Danh mục</label>
                                        <select type="text" class="form-select" name="category_id" id="category_id">
                                            @foreach ($categories as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <label for="img_thumbnail" class="form-label">Ảnh sản phẩm</label>
                                        <input type="file" class="form-control" name="img_thumbnail" id="img_thumbnail">
                                        @error('img_thumbnail')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="row">
                                        @php
                                            $is = [
                                                'is_active' => ['color' => 'primary', 'label' => 'Kích hoạt'],
                                                'is_hot_deal' => ['color' => 'danger', 'label' => 'Hot'],
                                                'is_good_deal' => ['color' => 'warning', 'label' => 'Ưu đãi'],
                                                'is_new' => ['color' => 'success', 'label' => 'Mới'],
                                            ];
                                        @endphp

                                        @foreach ($is as $key => $data)
                                            <div class="col-md-2">
                                                <div class="form-check form-switch form-switch-{{ $data['color'] }}">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        name="{{ $key }}" value="1" id="{{ $key }}"
                                                        @if (!empty($product->$key) && $product->$key == 1 ) checked @endif>
                                                    <label class="form-check-label"
                                                        for="{{ $key }}">{{ $data['label'] }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="row">
                                        <div class="mt-3">
                                            <label for="description" class="form-label">Mô tả</label>
                                            <textarea class="form-control textarea-scroll" name="description" id="description" rows="2">{{ $product->description }}</textarea>
                                        </div>
                                        <div class="mt-3">
                                            <label for="material" class="form-label">Chất liệu</label>
                                            <textarea class="form-control textarea-scroll" name="material" id="material" rows="2">{{ $product->material }}</textarea>
                                        </div>
                                        <div class="mt-3">
                                            <label for="content" class="form-label">Nội dung</label>
                                            <textarea class="form-control" name="content" id="content">{{ $product->content }}</textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h6 class="card-title mb-0 flex-grow-1">Biến thể</h6>
                    </div>

                    <div class="card-body ">
                        <div class="live-preview row">
                            <div class="col col-6 gy-4">

                                <h6 class="fw-semibold">Chọn màu </h6>
                                <select class="js-example-basic-multiple form-select form-select-sm"
                                    name="product_color[]" multiple="multiple" id="select_color">
                                    @foreach ($colors as $id => $name)
                                        <option value="{{ $id }}"
                                            @if (in_array($id, old('product_color', $product->variants->pluck('product_color_id')->toArray()))) selected @endif>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('product_color')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col col-6 gy-4">

                                <h6 class="fw-semibold">Chọn size </h6>
                                <select class="js-example-basic-multiple form-select form-select-sm" name="product_size[]"
                                    multiple="multiple" id="select_size">
                                    @foreach ($sizes as $id => $name)
                                        <option value="{{ $id }}"
                                            @if (in_array($id, old('product_size', $product->variants->pluck('product_size_id')->toArray()))) selected @endif>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('product_size')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>


                </div>

                <div class="card" id="table_product_variant_preview">
                    <div class="card-header align-items-center d-flex">
                        <h6 class="card-title mb-0 flex-grow-1">Table Variants</h6>
                    </div>

                    <div class="card-body">
                        <!-- Tables Border Colors -->
                        <table class="table table-bordered  table-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">Màu sắc</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Ảnh</th>
                                </tr>
                            </thead>
                            <tbody id="render_tbody_product_variant">


                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Gallery</h4>
                        <button type="button" class="btn btn-primary" onclick="addImgGallary()">Thêm ảnh</button>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4" id="gallery_list">
                                <div class="col-md-4" id="gallery_default_item">
                                    <label for="gallery_default" class="form-label">Image</label>
                                    <div class="d-flex">
                                        <input type="file" class="form-control" name="product_galleries[]"
                                            id="gallery_default">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--end col-->
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Thông tin thêm</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-12">
                                    <div>
                                        <label for="tags" class="form-label">Tags</label>
                                        <select class="form-select" name="tags[]" multiple
                                            aria-label="multiple select example">
                                            @foreach ($tags as $id => $name)
                                                <option value="{{ $id }}"
                                                    @if (in_array($id, old('tags', $product->tags->pluck('id')->toArray()))) selected @endif>{{ $name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--end col-->
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div><!-- end card header -->
                </div>
            </div>
            <!--end col-->
        </div>

    </form>
@endsection

@section('script-libs')
    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.0/classic/ckeditor.js"></script>

    <!--jquery cdn-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!--select2 cdn-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ asset('theme/admin/assets/js/pages/select2.init.js') }}"></script>
@endsection

@section('scripts')
    <script>
        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });

        function renderTableVariants(colors, sizes) {
            let tableRows = '';

            colors.forEach((color, colorIndex) => {
                sizes.forEach((size, sizeIndex) => {
                    tableRows += ` 
                        <tr>   
                                    ${sizeIndex === 0 ?  ` <td rowspan="${sizes.length}" style="vertical-align: middle;"> ${color.text}  </td>` :''}
                                
                                <td> ${size.text}  </td>
                                <td> 
                                    <input type="number" class="form-control product-quantity" name="product_variants[${color.id}-${size.id}][quantity]" >  
                                </td>
                                <td>
                                    <input type="file" class="form-control" name="product_variants[${color.id}-${size.id}][image]">
                                </td>
                        </tr>
                    `
                })
            });
            return tableRows;
        }

        $(document).ready(function() {

            $('#table_product_variant_preview').hide();
            $('#select_color, #select_size').on('change', () => {
                const selectColor = $('#select_color').select2('data');
                const selectSize = $('#select_size').select2('data');

                if (selectColor.length > 0 && selectSize.length > 0) {
                    $('#table_product_variant_preview').show();
                    const renderTbody = renderTableVariants(selectColor, selectSize);
                    $('#render_tbody_product_variant').html(renderTbody);
                } else {
                    $('#table_product_variant_preview').hide();
                    $('#render_tbody_product_variant').empty();
                }
            });
        });

        function addImgGallary() {
            let id = 'gallary' + '_' + Math.random().toString(36).substring(2, 15);

            let html = `
                <div class="col-md-4" id="${id}_item">
                    <label for="${id}" class="form-label">Image</label>
                    <div class="d-flex">
                        <input type="file" class="form-control" name="product_galleries[]"
                            id="${id}">

                        <button type="button" class="btn btn-danger" onclick="removeImgGallery('${id}_item')">
                            <span class="bx bx-trash"></span>
                        </button>
                    </div>
                </div>
            `;

            $('#gallery_list').append(html);
        }

        function removeImgGallery(id) {
            if (confirm("Bạn chắc chắn xóa không?")) {
                $('#' + id).remove();
            }
        }
    </script>
@endsection
