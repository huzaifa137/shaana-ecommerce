@extends('layouts2.master')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!---jvectormap css-->
    <link href="{{ URL::asset('assets2/plugins/jvectormap/jqvmap.css') }}" rel="stylesheet" />
    <!-- Data table css -->
    <link href="{{ URL::asset('assets2/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <!--Daterangepicker css-->
    <link href="{{ URL::asset('assets2/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title">Edit Product</h4>
        </div>
        {{-- <div class="page-rightheader ml-auto d-lg-flex d-none">
            <div class="ml-5 mb-0">
                <a href="" class="btn btn-md btn-primary">
                    <i class="fas fa-plus me-2"></i> Create
                </a>
            </div>
        </div> --}}
    </div>
@endsection

<style>
    .ck-editor__editable_inline {
        min-height: 300px;
    }

    .image-box {
        cursor: pointer;
        border: 2px dashed #ccc;
        width: 300px;
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        transition: border-color 0.3s;
    }

    .image-box.dragover {
        border-color: #3a86ff;
        background-color: #f0f8ff;
    }

    .image-box img {
        max-width: 100%;
        max-height: 100%;
        display: none;
    }

    .image-box span {
        color: #888;
        user-select: none;
    }

    .image-box .remove-btn {
        position: absolute;
        top: 4px;
        right: 4px;
        background: rgba(0, 0, 0, 0.6);
        color: white;
        border: none;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        font-weight: bold;
        font-size: 16px;
        line-height: 20px;
        cursor: pointer;
        display: none;
    }

    .image-box.has-image .remove-btn {
        display: block;
    }

    .image-box-container {
        display: flex;
        gap: 1rem;
        /* space between image boxes */
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .image-box {
        flex: 1;
        min-width: 200px;
        max-width: 300px;
        height: 200px;
        border: 2px dashed #ccc;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        position: relative;
        cursor: pointer;
        overflow: hidden;
        text-align: center;
    }

    .image-box img {
        max-width: 100%;
        max-height: 100%;
        display: none;
        object-fit: contain;
    }

    .image-box.has-image img {
        display: block;
    }

    .image-box .remove-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        background: red;
        color: white;
        border: none;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        cursor: pointer;
    }
</style>
@section('content')
    <div class="row">



        <div class="col-xl-12 col-lg-6">
            <div class="row">

                <input type="hidden" id="product_id" value="{{ $product->id }}">

                <div class="col-xl-12 col-md-12 col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <!-- Styled Section Container -->
                            <div class="card p-4 mb-4 shadow-sm border rounded">
                                <h4 class="mb-4">Product Name</h4>

                                <div class="p-3 border rounded bg-light h-100">
                                    <div class="form-group mb-0">
                                        <label for="product_name" class="form-label">Product Name</label>
                                        <input type="text" id="product_name" class="form-control"
                                            placeholder="Enter category name" value="{{ $product->product_name }}" />

                                    </div>
                                </div>
                            </div>


                            <!-- Styled Section Container -->
                            <div class="card p-4 mb-4 shadow-sm border rounded">
                                <h4 class="mb-4">Product Categories & Status</h4>

                                <div class="p-3 border rounded bg-light h-100">
                                    <div class="form-row">
                                        <div class="form-group col-md-9 mb-0">
                                            <label class="form-label" for="category_select">Categories</label>
                                            <select name="category" id="category_select"
                                                class="form-control custom-select select2">
                                                <option value="">Select Parent Category</option>
                                                <option value="0" {{ $product->category == 0 ? 'selected' : '' }}>None
                                                </option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ $product->category == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>

                                        <div class="form-group col-md-3 mb-0">
                                            <label class="form-label" for="status_select">Status</label>
                                            <select name="status" id="status_select"
                                                class="form-control custom-select select2">
                                                <option value="10" {{ $product->status == 10 ? 'selected' : '' }}>
                                                    Published</option>
                                                <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Draft
                                                </option>
                                                <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>
                                                    Pending</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Styled Section Container -->
                            <div class="card p-4 mb-4 shadow-sm border rounded">
                                <h4 class="mb-4">Description</h4>

                                <div class="p-3 border rounded bg-light h-100">
                                    <div class="form-group mb-0">
                                        <label for="t_description" class="form-label">Description</label>
                                        <textarea id="t_description" name="description" class="form-control" rows="6"></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Styled Section Container -->
                            <div class="card p-4 mb-4 shadow-sm border rounded">
                                <h4 class="mb-4">Pricing & Inventory</h4>

                                <!-- Inner grayish container -->
                                <div class="p-3 border rounded bg-light h-100">
                                    <div class="form-row">
                                        <!-- Price -->
                                        <div class="col-md-3 mb-3">
                                            <label for="price" class="form-label">Price</label>
                                            <input type="text" class="form-control" id="price"
                                                value="{{ $product->price }}">

                                        </div>

                                        <!-- Sale Price -->
                                        <div class="col-md-3 mb-3">
                                            <label for="salePrice" class="form-label">Sale Price</label>
                                            <input type="text" class="form-control" id="salePrice"
                                                value="{{ $product->sale_price }}">

                                        </div>

                                        <!-- Quantity -->
                                        <div class="col-md-3 mb-3">
                                            <label for="quantity" class="form-label">Quantity</label>
                                            <input type="text" class="form-control" id="quantity"
                                                value="{{ $product->quantity }}">
                                        </div>

                                        <!-- SKU -->
                                        <div class="col-md-3 mb-3">
                                            <label for="sku" class="form-label">SKU</label>
                                            <input type="text" class="form-control" id="sku"
                                                value="{{ $product->sku }}">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Labels Row -->
                            <!-- Styled Section Container -->
                            <div class="card p-4 mb-4 shadow-sm border rounded">
                                <h4 class="mb-4">Product Attributes</h4>

                                <!-- Inner grayish container -->
                                <div class="p-3 border rounded bg-light h-100">
                                    <!-- Labels Row -->
                                    <div class="form-row mb-1">
                                        <div class="col-md-5">
                                            <label><strong>Attribute</strong></label>
                                        </div>
                                        <div class="col-md-5">
                                            <label><strong>Value</strong></label>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div id="attribute-container" class="col-md-9 mt-3"></div>

                                        <div class="col-md-3 d-flex align-items-start mt-3">
                                            <button type="button" class="btn btn-primary btn-sm mb-2"
                                                onclick="addAttribute()">
                                                <i class="fas fa-plus me-1"></i> Add Attribute
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form mt-1">
                                <div class="form-group mt-3">

                                    <!-- Styled Container for Image Uploads -->
                                    <!-- Styled Container for Image Uploads -->
                                    <div class="card p-4 mb-4 shadow-sm border rounded">
                                        <h4 class="mb-4">Product Images</h4>

                                        <div class="row">
                                            <!-- Image Upload 1 -->
                                            <div class="col-md-4 mb-3">
                                                <div class="p-3 border rounded bg-light h-100">
                                                    <label class="form-label text-primary"><strong>Homepage Product
                                                            Image</strong></label>
                                                    <div class="image-box image-box-icon_image" tabindex="0"
                                                        role="button" aria-label="Select or drag and drop an image">
                                                        <img id="featured_image_preview_1"
                                                            src="{{ asset('storage/' . $product->featured_image_1) }}"
                                                            alt="Selected image preview" />

                                                        <span id="image_placeholder_1">Click or drag and drop an image
                                                            here</span>
                                                        <button type="button" class="remove-btn"
                                                            aria-label="Remove selected image">&times;</button>
                                                        <input type="file" id="featured_image_input_1"
                                                            accept="image/*" style="display:none;">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Image Upload 2 -->
                                            <div class="col-md-4 mb-3">
                                                <div class="p-3 border rounded bg-light h-100">
                                                    <label class="form-label text-primary"><strong>Shop Product
                                                            Image</strong></label>
                                                    <div class="image-box image-box-icon_image" tabindex="0"
                                                        role="button" aria-label="Select or drag and drop an image">
                                                        <img id="featured_image_preview_2"
                                                            src="{{ asset('storage/' . $product->featured_image_2) }}"
                                                            alt="Selected image preview" />

                                                        <span id="image_placeholder_2">Click or drag and drop an image
                                                            here</span>
                                                        <button type="button" class="remove-btn"
                                                            aria-label="Remove selected image">&times;</button>
                                                        <input type="file" id="featured_image_input_2"
                                                            accept="image/*" style="display:none;">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Image Upload 3 -->
                                            <div class="col-md-4 mb-3">
                                                <div class="p-3 border rounded bg-light h-100">
                                                    <label class="form-label text-primary"><strong>Product Detail
                                                            Image</strong></label>
                                                    <div class="image-box image-box-icon_image" tabindex="0"
                                                        role="button" aria-label="Select or drag and drop an image">
                                                        <img id="featured_image_preview_3"
                                                            src="{{ asset('storage/' . $product->featured_image_3) }}"
                                                            alt="Selected image preview" />

                                                        <span id="image_placeholder_3">Click or drag and drop an image
                                                            here</span>
                                                        <button type="button" class="remove-btn"
                                                            aria-label="Remove selected image">&times;</button>
                                                        <input type="file" id="featured_image_input_3"
                                                            accept="image/*" style="display:none;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- Styled Section Container -->
                            <div class="card p-4 mb-4 shadow-sm border rounded">
                                <h4 class="mb-4">Product Options</h4>

                                <div class="form-row">
                                    <!-- Labels Section -->
                                    <div class="col-md-6">
                                        <div class="p-3 border rounded bg-light h-100">
                                            <h5 class="mb-3 text-primary">Labels</h5>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="label-best-selling"
                                                    name="labels[bestSelling]"
                                                    {{ !empty($labels['bestSelling']) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="label-best-selling">Best
                                                    Selling</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="label-featured"
                                                    name="labels[featured]"
                                                    {{ !empty($labels['featured']) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="label-featured">Featured
                                                    Products</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="label-popular"
                                                    name="labels[popular]"
                                                    {{ !empty($labels['popular']) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="label-popular">Most Popular</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="label-new"
                                                    name="labels[new]" {{ !empty($labels['new']) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="label-new">Just Arrived</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Taxes Section -->
                                    <div class="col-md-6 mt-4 mt-md-0">
                                        <div class="p-3 border rounded bg-light h-100">
                                            <h5 class="mb-3 text-primary">Taxes</h5>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="tax-none"
                                                    name="taxes[none]" {{ !empty($taxes['none']) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="tax-none">None (0%)</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="tax-vat"
                                                    name="taxes[vat]" {{ !empty($taxes['vat']) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="tax-vat">VAT</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="tax-import"
                                                    name="taxes[import]" {{ !empty($taxes['import']) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="tax-import">Import Tax</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="tax-export"
                                                    name="taxes[export]" {{ !empty($taxes['export']) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="tax-export">Export Tax</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="form-footer mt-2">
                                <button id="saveProductBtn" class="btn btn-primary" type="button">
                                    <i class="fas fa-save"></i> Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>

    </div>
    </div>
    </div>


    <script>
        const allAttributes = {
            Weight: ['1kg', '2kg', '5kg'],
            Size: ['Small', 'Medium', 'Large'],
            Color: ['Red', 'Blue', 'Green']
        };

        let usedAttributes = new Set();

        function addAttribute(preSelectedAttr = null, preSelectedVal = null) {
            const container = document.getElementById('attribute-container');

            const row = document.createElement('div');
            row.className = 'form-row align-items-start mb-3';

            const attrCol = document.createElement('div');
            attrCol.className = 'col-md-5 mb-2 mb-md-0';

            const attrSelect = document.createElement('select');
            attrSelect.className = 'form-control';
            attrSelect.name = 'attributes[][attribute]';
            attrSelect.innerHTML = `<option value="">Select Attribute</option>` +
                Object.keys(allAttributes).map(attr =>
                    `<option value="${attr}" ${attr === preSelectedAttr ? 'selected' : ''}>${attr}</option>`
                ).join('');

            attrCol.appendChild(attrSelect);

            const valCol = document.createElement('div');
            valCol.className = 'col-md-5 mb-2 mb-md-0';

            const valSelect = document.createElement('select');
            valSelect.className = 'form-control';
            valSelect.name = 'attributes[][value]';
            valSelect.disabled = true;
            valCol.appendChild(valSelect);

            const deleteCol = document.createElement('div');
            deleteCol.className = 'col-md-2 d-flex align-items-end';

            const deleteBtn = document.createElement('button');
            deleteBtn.type = 'button';
            deleteBtn.className = 'btn btn-danger w-100 remove-attribute';
            deleteBtn.innerHTML = '🗑️';
            deleteBtn.title = "Remove Attribute";
            deleteCol.appendChild(deleteBtn);

            row.appendChild(attrCol);
            row.appendChild(valCol);
            row.appendChild(deleteCol);
            container.appendChild(row);

            if (preSelectedAttr) {
                usedAttributes.add(preSelectedAttr);
                attrSelect.disabled = true;
                valSelect.disabled = false;
                valSelect.innerHTML = allAttributes[preSelectedAttr].map(val =>
                    `<option value="${val}" ${val === preSelectedVal ? 'selected' : ''}>${val}</option>`
                ).join('');
            }

            attrSelect.addEventListener('change', function() {
                const selectedAttr = this.value;

                if (!selectedAttr || usedAttributes.has(selectedAttr)) return;

                usedAttributes.add(selectedAttr);
                this.disabled = true;

                valSelect.innerHTML = allAttributes[selectedAttr].map(val =>
                    `<option value="${val}">${val}</option>`
                ).join('');
                valSelect.disabled = false;
            });

            deleteBtn.addEventListener('click', function() {
                const selectedAttr = attrSelect.value;
                if (usedAttributes.has(selectedAttr)) {
                    usedAttributes.delete(selectedAttr);
                }
                container.removeChild(row);
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const savedAttributes = @json($product->attributes);

            if (Array.isArray(savedAttributes)) {
                savedAttributes.forEach(attr => {
                    addAttribute(attr.attribute, attr.value);
                });
            }
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-attribute')) {
                const row = e.target.closest('.form-row');
                const attrSelect = row.querySelector('select[name="attributes[][attribute]"]');
                if (attrSelect && usedAttributes.has(attrSelect.value)) {
                    usedAttributes.delete(attrSelect.value);
                }
                row.remove();
            }
        });

        const labels = @json($labels);
        const taxes = @json($taxes);

        // When document ready, set the checkbox states if using JS to control
        $(document).ready(function() {
            for (const [key, val] of Object.entries(labels)) {
                $(`#label-${key.replace(/([A-Z])/g, '-$1').toLowerCase()}`).prop('checked', !!val);
            }
            for (const [key, val] of Object.entries(taxes)) {
                $(`#tax-${key}`).prop('checked', !!val);
            }
        });
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            ClassicEditor
                .create(document.querySelector('#t_description'))
                .then(editor => {
                    window.t_description = editor;

                    editor.setData(@json($product->description));
                })
                .catch(error => {
                    console.error('There was a problem initializing CKEditor:', error);
                });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const imageData = [{
                    id: 1,
                    url: '{{ asset('storage/' . $product->featured_image_1) }}'
                },
                {
                    id: 2,
                    url: '{{ asset('storage/' . $product->featured_image_2) }}'
                },
                {
                    id: 3,
                    url: '{{ asset('storage/' . $product->featured_image_3) }}'
                }
            ];

            imageData.forEach(image => {
                const preview = document.getElementById(`featured_image_preview_${image.id}`);
                const placeholder = document.getElementById(`image_placeholder_${image.id}`);
                const box = preview.closest('.image-box-icon_image');

                if (image.url && preview && placeholder && box) {
                    preview.src = image.url;
                    preview.style.display = 'block';
                    placeholder.style.display = 'none';
                    box.classList.add('has-image');
                }
            });
        });

        // Get all image boxes
        const imageBoxes = document.querySelectorAll('.image-box-icon_image');

        imageBoxes.forEach((imageBox, index) => {
            const imageInput = imageBox.querySelector('input[type="file"]');
            const imagePreview = imageBox.querySelector('img');
            const imagePlaceholder = imageBox.querySelector('span');
            const removeBtn = imageBox.querySelector('.remove-btn');

            // Handle click and keyboard selection
            imageBox.addEventListener('click', () => imageInput.click());

            imageBox.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    imageInput.click();
                }
            });

            // Handle image file input
            imageInput.addEventListener('change', (e) => {
                if (e.target.files.length) {
                    loadImage(e.target.files[0], imagePreview, imagePlaceholder, imageBox);
                }
            });

            // Handle drag & drop
            imageBox.addEventListener('dragover', (e) => {
                e.preventDefault();
                imageBox.classList.add('dragover');
            });

            imageBox.addEventListener('dragleave', (e) => {
                e.preventDefault();
                imageBox.classList.remove('dragover');
            });

            imageBox.addEventListener('drop', (e) => {
                e.preventDefault();
                imageBox.classList.remove('dragover');
                const files = e.dataTransfer.files;
                if (files.length && files[0].type.startsWith('image/')) {
                    loadImage(files[0], imagePreview, imagePlaceholder, imageBox);
                } else {
                    alert('Please drop an image file.');
                }
            });

            // Handle remove button
            removeBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                imagePreview.src = '';
                imagePreview.style.display = 'none';
                imagePlaceholder.style.display = 'block';
                imageInput.value = '';
                imageBox.classList.remove('has-image');
            });
        });

        // Helper to load image preview
        function loadImage(file, previewEl, placeholderEl, containerEl) {
            const reader = new FileReader();
            reader.onload = function(event) {
                previewEl.src = event.target.result;
                previewEl.style.display = 'block';
                placeholderEl.style.display = 'none';
                containerEl.classList.add('has-image');
            }
            reader.readAsDataURL(file);
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const existingImages = {
            image1: @json(!empty($product->featured_image_1)),
            image2: @json(!empty($product->featured_image_2)),
            image3: @json(!empty($product->featured_image_3))
        };
    </script>


    <script>
        $(document).ready(function() {
            $('#saveProductBtn').on('click', function(e) {
                e.preventDefault();

                const btn = $(this);
                const productId = $('#product_id').val(); // ✅ Add this line

                // Collect values
                const productName = $('#product_name').val().trim();
                const category = $('#category_select').val();
                const status = $('#status_select').val();
                const description = t_description.getData().trim();

                const price = $('#price').val().trim();
                const salePrice = $('#salePrice').val().trim();
                const quantity = $('#quantity').val().trim();
                const sku = $('#sku').val().trim();

                const image1 = $('#featured_image_input_1')[0].files[0];
                const image2 = $('#featured_image_input_2')[0].files[0];
                const image3 = $('#featured_image_input_3')[0].files[0];

                const labels = {
                    bestSelling: $('#label-best-selling').is(':checked'),
                    featured: $('#label-featured').is(':checked'),
                    popular: $('#label-popular').is(':checked'),
                    new: $('#label-new').is(':checked')
                };

                const taxes = {
                    none: $('#tax-none').is(':checked'),
                    vat: $('#tax-vat').is(':checked'),
                    import: $('#tax-import').is(':checked'),
                    export: $('#tax-export').is(':checked')
                };

                // Collect attributes
                let attributes = [];
                $('#attribute-container .form-row').each(function() {
                    const attrSelect = $(this).find('select').eq(0); // Attribute name
                    const valSelect = $(this).find('select').eq(1); // Attribute value

                    const attrName = attrSelect.val();
                    const attrValue = valSelect.val();

                    if (attrName && attrValue) {
                        attributes.push({
                            attribute: attrName,
                            value: attrValue
                        });
                    }
                });

                // Validation
                let isValid = true;
                let errorMessages = [];

                // Product Name
                if (!productName) {
                    $('#product_name').addClass('is-invalid');
                    errorMessages.push('Please enter a product name.');
                    isValid = false;
                } else {
                    $('#product_name').removeClass('is-invalid');
                }

                // Category
                if (!category) {
                    $('#category_select').addClass('is-invalid');
                    errorMessages.push('Please select a category.');
                    isValid = false;
                } else {
                    $('#category_select').removeClass('is-invalid');
                }

                // Status
                if (!status) {
                    $('#status_select').addClass('is-invalid');
                    errorMessages.push('Please select a status.');
                    isValid = false;
                } else {
                    $('#status_select').removeClass('is-invalid');
                }

                // Description
                if (!description) {
                    errorMessages.push('Please enter a description.');
                    isValid = false;
                }

                // Price
                if (!price) {
                    $('#price').addClass('is-invalid');
                    errorMessages.push('Please enter a price.');
                    isValid = false;
                } else {
                    $('#price').removeClass('is-invalid');
                }

                // Sale Price
                if (!salePrice) {
                    $('#salePrice').addClass('is-invalid');
                    errorMessages.push('Please enter a sale price.');
                    isValid = false;
                } else {
                    $('#salePrice').removeClass('is-invalid');
                }

                // Quantity
                if (!quantity) {
                    $('#quantity').addClass('is-invalid');
                    errorMessages.push('Please enter a quantity.');
                    isValid = false;
                } else {
                    $('#quantity').removeClass('is-invalid');
                }

                // SKU
                if (!sku) {
                    $('#sku').addClass('is-invalid');
                    errorMessages.push('Please enter a SKU.');
                    isValid = false;
                } else {
                    $('#sku').removeClass('is-invalid');
                }

                // At least one label selected
                if (!Object.values(labels).some(Boolean)) {
                    errorMessages.push('Please select at least one product label.');
                    isValid = false;
                }

                // At least one tax selected
                if (!Object.values(taxes).some(Boolean)) {
                    errorMessages.push('Please select at least one tax option.');
                    isValid = false;
                }

                // Images validation with existing images check
                const hasExistingImage = existingImages.image1 || existingImages.image2 || existingImages
                    .image3;

                if (!hasExistingImage && !image1 && !image2 && !image3) {
                    errorMessages.push('Please upload at least one product image.');
                    isValid = false;
                }

                if (attributes.length === 0) {
                    errorMessages.push('Please add at least one product attribute.');
                    isValid = false;
                }

                if (!isValid) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Please fix the following:',
                        html: '<ul style="text-align: left;">' + errorMessages.map(msg =>
                            `<li>${msg}</li>`).join('') + '</ul>'
                    });
                    return;
                }

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you want to save this product?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Save it!',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        btn.prop('disabled', true).html(
                            'Saving... <i class="fas fa-spinner fa-spin"></i>');

                        const formData = new FormData();
                        formData.append('product_name', productName);
                        formData.append('category', category);
                        formData.append('status', status);
                        formData.append('description', description);
                        formData.append('price', price);
                        formData.append('sale_price', salePrice);
                        formData.append('quantity', quantity);
                        formData.append('sku', sku);

                        // Append attributes array properly
                        attributes.forEach((attr, index) => {
                            formData.append(`attributes[${index}][attribute]`, attr
                                .attribute);
                            formData.append(`attributes[${index}][value]`, attr.value);
                        });

                        // Append labels object properly
                        Object.entries(labels).forEach(([key, value]) => {
                            formData.append(`labels[${key}]`, value ? 1 : 0);
                        });

                        // Append taxes object properly
                        Object.entries(taxes).forEach(([key, value]) => {
                            formData.append(`taxes[${key}]`, value ? 1 : 0);
                        });


                        if (image1) formData.append('featured_image_1', image1);
                        if (image2) formData.append('featured_image_2', image2);
                        if (image3) formData.append('featured_image_3', image3);

                        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

                        $.ajax({
                            url: `/products/${productId}`,
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            headers: {
                                'X-HTTP-Method-Override': 'PUT'
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Product Saved',
                                    text: response.message ||
                                        'The product was saved successfully.',
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            // error: function(xhr) {
                            //     let errorMsg = 'An error occurred.';
                            //     if (xhr.status === 422 && xhr.responseJSON?.errors) {
                            //         errorMsg = Object.values(xhr.responseJSON.errors)
                            //             .flat().join('<br>');
                            //     } else if (xhr.responseJSON?.message) {
                            //         errorMsg = xhr.responseJSON.message;
                            //     }
                            //     Swal.fire({
                            //         icon: 'error',
                            //         title: 'Error',
                            //         html: errorMsg,
                            //     });
                            // },
                            error: function(data) {
                                $('body').html(data.responseText);
                            },
                            complete: function() {
                                btn.prop('disabled', false).html(
                                    '<i class="fas fa-save"></i> Save');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
@section('js')
    <!-- ECharts js -->
    <script src="{{ URL::asset('assets2/plugins/echarts/echarts.js') }}"></script>
    <!-- Peitychart js-->
    <script src="{{ URL::asset('assets2/plugins/peitychart/jquery.peity.min.js') }}"></script>
    <script src="{{ URL::asset('assets2/plugins/peitychart/peitychart.init.js') }}"></script>
    <!-- Apexchart js-->
    <script src="{{ URL::asset('assets2/js/apexcharts.js') }}"></script>
    <!--Moment js-->
    <script src="{{ URL::asset('assets2/plugins/moment/moment.js') }}"></script>
    <!-- Daterangepicker js-->
    <script src="{{ URL::asset('assets2/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ URL::asset('assets2/js/daterange.js') }}"></script>
    <!---jvectormap js-->
    <script src="{{ URL::asset('assets2/plugins/jvectormap/jquery.vmap.js') }}"></script>
    <script src="{{ URL::asset('assets2/plugins/jvectormap/jquery.vmap.world.js') }}"></script>
    <script src="{{ URL::asset('assets2/plugins/jvectormap/jquery.vmap.sampledata.js') }}"></script>
    <!-- P-scroll js-->
    <script src="{{ URL::asset('assets2/plugins/p-scrollbar/p-scrollbar.js') }}"></script>
    <!-- Index js-->
    <script src="{{ URL::asset('assets2/js/index1.js') }}"></script>
    <!-- Data tables js-->
    <script src="{{ URL::asset('assets2/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets2/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets2/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets2/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets2/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets2/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets2/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets2/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets2/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets2/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets2/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets2/plugins/datatable/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets2/js/datatables.js') }}"></script>
    <!--Counters -->
    <script src="{{ URL::asset('assets2/plugins/counters/counterup.min.js') }}"></script>
    <script src="{{ URL::asset('assets2/plugins/counters/waypoints.min.js') }}"></script>
    <!--Chart js -->
    <script src="{{ URL::asset('assets2/plugins/chart/chart.bundle.js') }}"></script>
    <script src="{{ URL::asset('assets2/plugins/chart/utils.js') }}"></script>
@endsection
