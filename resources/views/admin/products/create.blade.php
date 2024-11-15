@extends('admin.layouts.master')

@section('title')
    Dashboard
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
                <h4 class="mb-sm-0">Thêm mới sản phẩm</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Sản phẩm</a></li>
                        <li class="breadcrumb-item active">Thêm mới</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <form action="" method="post" enctype="multipart/form-data">
        @csrf

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
                                        <input type="text" class="form-control" name="name" id="name">
                                    </div>
                                    <div class="mt-3">
                                        <label for="sku" class="form-label">Mã sản phẩm</label>
                                        <input type="text" class="form-control" name="sku" id="sku"
                                            value="{{ strtoupper(\Str::random(8)) }}">
                                    </div>
                                    <div class="mt-3">
                                        <label for="price_regular" class="form-label">Giá sản phẩm</label>
                                        <input type="number" value="0" class="form-control" name="price_regular"
                                            id="price_regular">
                                    </div>
                                    <div class="mt-3">
                                        <label for="price_sale" class="form-label">Giá khuyến mãi</label>
                                        <input type="number" value="0" class="form-control" name="price_sale"
                                            id="price_sale">
                                    </div>
                                    <div class="mt-3">
                                        <label for="category_id" class="form-label">Danh mục</label>
                                        <select type="text" class="form-select" name="category_id" id="category_id">
                                            @foreach ($categories as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="mt-3">
                                        <label for="img_thumbnail" class="form-label">Ảnh sản phẩm</label>
                                        <input type="file" class="form-control" name="img_thumbnail" id="img_thumbnail">
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
                                                        @if ($key == 'is_active') checked @endif>
                                                    <label class="form-check-label"
                                                        for="{{ $key }}">{{ $data['label'] }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="row">
                                        <div class="mt-3">
                                            <label for="description" class="form-label">Mô tả</label>
                                            <textarea class="form-control textarea-scroll" name="description" id="description" rows="2"></textarea>
                                        </div>
                                        <div class="mt-3">
                                            <label for="material" class="form-label">Chất liệu</label>
                                            <textarea class="form-control textarea-scroll" name="material" id="material" rows="2"></textarea>
                                        </div>
                                        <div class="mt-3">
                                            <label for="content" class="form-label">Nội dung</label>
                                            <textarea class="form-control" name="content" id="content"></textarea>
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

                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">

                                <h6 class="fw-semibold">Chọn màu </h6>
                                <select class="js-example-basic-multiple form-select form-select-sm" name="states[]"
                                    multiple="multiple">
                                  @foreach ($colors as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                 
                                  @endforeach
                                </select>

                            </div>

                            <div id="sizeInputs" class="row">
                                <!-- Các ô nhập size vaf ảnh sẽ được thêm vào đây -->


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
                                        <select class="form-select" multiple aria-label="multiple select example">
                                            @foreach ($tags as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
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

        $(document).ready(function() {
            // Đối tượng để lưu trữ lựa chọn size và số lượng cho từng màu
            let selectedSizes = {};
            let quantityData = {}; // Lưu trữ số lượng đã nhập cho từng màu và size

            // Hàm tạo ô nhập kích cỡ và số lượng cho từng màu
            function createSizeInput(color,name) {
                return `
                    <div class="mt-2 size-input" data-color="${color}">
                        <div class="d-flex">
                            <div class="me-3">
                                <label for="size_${color}" class="form-label">Size màu ${name}</label>
                                <select class="size-select form-select form-select-sm" name="size_${color}[]" multiple="multiple" style="width: 120px; white-space: nowrap;">
                                    @foreach ($sizes as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                
                            </div>

                            <div>
                                <label for="formFile" class="form-label">Image</label>
                                <input class="form-control" type="file" id="formFile" style="width: 240px;">
                            </div>
                        </div>
                        
                        <div class="quantity-inputs" style="display: flex; gap: 10px; align-items: center;">
                            <!-- Các ô nhập số lượng sẽ được thêm vào đây -->
                        </div>
                    </div>
                `;
            }

            // Khởi tạo Select2 cho phần chọn màu
            $('.js-example-basic-multiple').on('change', function() {
                const selectedColors = $(this).val();
                $('#sizeInputs').empty(); // Xóa các ô nhập kích cỡ trước đó

                  // Lấy tên của tất cả các tùy chọn đã chọn
                const selectedColorNames = [];
                $(this).find('option:selected').each(function() {
                    selectedColorNames.push($(this).text()); // Thêm tên màu vào mảng selectedColorNames
                });

            
                

                // Thêm ô nhập kích cỡ cho mỗi màu đã chọn và giữ lại lựa chọn cũ nếu có
                selectedColors.forEach((color, index) => {

                    const name = selectedColorNames[index];
                    const sizeInputHTML = createSizeInput(color, name);
                    $('#sizeInputs').append(sizeInputHTML);

                    // Giữ lại các lựa chọn size đã chọn trước đó
                    if (selectedSizes[color]) {
                        const sizeSelect = $('#sizeInputs').find(`[data-color="${color}"]`).find('.size-select');
                        sizeSelect.val(selectedSizes[color]).trigger('change'); // Cập nhật lại giá trị cho size select
                    }

                    // Giữ lại số lượng đã nhập cho màu này
                    const quantityContainer = $('#sizeInputs').find(`[data-color="${color}"]`).find('.quantity-inputs');
                    const savedQuantities = quantityData[color];

                    if (savedQuantities) {
                        Object.keys(savedQuantities).forEach(size => {
                            const quantityValue = savedQuantities[size];
                            const quantityInput = `
                                <div>
                                    <label for="quantity_${size}" class="form-label">Số lượng ${size}</label>
                                    <input type="number" class="form-control form-control-sm" name="quantity_${size}" value="${quantityValue}" min="1" style="width: 80px;">
                                </div>
                            `;
                            quantityContainer.append(quantityInput);
                        });
                    }
                });

                // Khởi tạo lại Select2 cho phần chọn size
                $('.size-select').select2();

                // Thêm sự kiện khi chọn size để hiển thị ô nhập số lượng
                $('.size-select').on('change', function() {
                    const selectedSizesForThisColor = $(this).val();
                    const color = $(this).closest('.size-input').data('color');

                    const selectedSizeNames = [];
                    $(this).find('option:selected').each(function() {
                        selectedSizeNames.push($(this).text()); // Thêm tên màu vào mảng selectedColorNames
                    });

                    // Lưu lại các size đã chọn cho màu này
                    selectedSizes[color] = selectedSizesForThisColor;

                    const quantityContainer = $(this).closest('.size-input').find('.quantity-inputs');
                    quantityContainer.empty();

                    // Với mỗi size đã chọn, thêm một ô nhập số lượng
                    selectedSizesForThisColor.forEach((size, index) => {

                        const sizeName = selectedSizeNames[index];


                        // Kiểm tra xem đã có dữ liệu số lượng cho size này chưa
                        const quantityValue = quantityData[color] && quantityData[color][size] ? quantityData[color][size] : '';
                        const quantityInput = `
                            <div>
                                <label for="quantity_${size}" class="form-label">Số lượng size:  ${sizeName}</label>
                                <input type="number" class="form-control form-control-sm" name="quantity_${size}" value="${quantityValue}" min="1" style="width: 120px;">
                            </div>
                        `;
                        quantityContainer.append(quantityInput);
                    });
                });

                // Sự kiện khi thay đổi số lượng
                $(document).on('input', '.quantity-inputs input[type="number"]', function() {
                    const color = $(this).closest('.size-input').data('color');
                    const size = $(this).attr('name').split('_')[
                        1]; // Lấy size từ tên trường (quantity_S, quantity_M, ...)
                    const quantity = $(this).val();

                    // Lưu lại số lượng đã nhập cho màu và size tương ứng
                    if (!quantityData[color]) {
                        quantityData[color] = {};
                    }
                    quantityData[color][size] = quantity;
                });
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
