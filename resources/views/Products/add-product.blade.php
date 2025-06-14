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
            <h4 class="page-title">Add Product</h4>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">

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

        <div class="col-xl-12 col-lg-6">
            <div class="row">

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
                                            placeholder="Enter category name" />
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
                                                <option value="0">None</option>
                                                <!-- Replace with your server-side rendering -->
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-3 mb-0">
                                            <label class="form-label" for="status_select">Status</label>
                                            <select name="status" id="status_select"
                                                class="form-control custom-select select2">
                                                <option value="10">Published</option>
                                                <option value="0">Draft</option>
                                                <option value="1">Pending</option>
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

                            <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>



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
                                                placeholder="Enter old discount price">
                                        </div>

                                        <!-- Sale Price -->
                                        <div class="col-md-3 mb-3">
                                            <label for="salePrice" class="form-label">Sale Price</label>
                                            <input type="text" class="form-control" id="salePrice"
                                                placeholder="Enter sale price">
                                        </div>

                                        <!-- Quantity -->
                                        <div class="col-md-3 mb-3">
                                            <label for="quantity" class="form-label">Quantity</label>
                                            <input type="text" class="form-control" id="quantity"
                                                placeholder="Enter quantity">
                                        </div>

                                        <!-- SKU -->
                                        <div class="col-md-3 mb-3">
                                            <label for="sku" class="form-label">SKU</label>
                                            <input type="text" class="form-control" id="sku"
                                                placeholder="Enter SKU">
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


                            <script>
                                const allAttributes = {
                                    Weight: ['1kg', '2kg', '5kg'],
                                    Size: ['Small', 'Medium', 'Large'],
                                    Color: ['Red', 'Blue', 'Green']
                                };

                                let usedAttributes = new Set();

                                function addAttribute() {
                                    const availableAttributes = Object.keys(allAttributes).filter(attr => !usedAttributes.has(attr));
                                    if (availableAttributes.length === 0) {
                                        alert("All attributes have been added.");
                                        return;
                                    }

                                    const container = document.getElementById('attribute-container');

                                    const row = document.createElement('div');
                                    row.className = 'form-row align-items-start mb-3';

                                    // Attribute select column
                                    const attrCol = document.createElement('div');
                                    attrCol.className = 'col-md-5 mb-2 mb-md-0';

                                    const attrSelect = document.createElement('select');
                                    attrSelect.className = 'form-control'; // <-- Changed here
                                    attrSelect.innerHTML = `<option selected disabled>Select Attribute</option>` +
                                        availableAttributes.map(attr => `<option value="${attr}">${attr}</option>`).join('');

                                    attrCol.appendChild(attrSelect);

                                    // Value select column
                                    const valCol = document.createElement('div');
                                    valCol.className = 'col-md-5 mb-2 mb-md-0';

                                    const valSelect = document.createElement('select');
                                    valSelect.className = 'form-control'; // <-- Changed here
                                    valSelect.disabled = true;

                                    valCol.appendChild(valSelect);

                                    // Delete button column
                                    const deleteCol = document.createElement('div');
                                    deleteCol.className = 'col-md-2 d-flex align-items-end';

                                    const deleteBtn = document.createElement('button');
                                    deleteBtn.className = 'btn btn-danger w-100';
                                    deleteBtn.innerHTML = '🗑️';
                                    deleteBtn.title = "Remove Attribute";

                                    deleteCol.appendChild(deleteBtn);

                                    // Append columns to row
                                    row.appendChild(attrCol);
                                    row.appendChild(valCol);
                                    row.appendChild(deleteCol);

                                    // Append row to container
                                    container.appendChild(row);

                                    // Handle attribute selection
                                    attrSelect.addEventListener('change', function() {
                                        const selectedAttr = this.value;
                                        if (!usedAttributes.has(selectedAttr)) {
                                            usedAttributes.add(selectedAttr);
                                            attrSelect.disabled = true;

                                            // Populate values for selected attribute
                                            valSelect.innerHTML = allAttributes[selectedAttr].map(val => `<option>${val}</option>`).join(
                                                '');
                                            valSelect.disabled = false;
                                        }
                                    });

                                    // Handle delete button click
                                    deleteBtn.addEventListener('click', function() {
                                        const selectedAttr = attrSelect.value;
                                        if (usedAttributes.has(selectedAttr)) {
                                            usedAttributes.delete(selectedAttr);
                                        }
                                        container.removeChild(row);
                                    });
                                }
                            </script>

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
                                                        <img id="featured_image_preview_1" alt="Selected image preview" />
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
                                                        <img id="featured_image_preview_2" alt="Selected image preview" />
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
                                                        <img id="featured_image_preview_3" alt="Selected image preview" />
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

                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    // Initialize CKEditor (if needed)
                                    ClassicEditor
                                        .create(document.querySelector('#t_description'))
                                        .then(editor => {
                                            window.t_description = editor;
                                        })
                                        .catch(error => {
                                            console.error('There was a problem initializing CKEditor:', error);
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
                                });
                            </script>

                            <!-- Styled Section Container -->
                            <div class="card p-4 mb-4 shadow-sm border rounded">
                                <h4 class="mb-4">Product Options</h4>

                                <div class="form-row">
                                    <!-- Labels Section -->
                                    <div class="col-md-6">
                                        <div class="p-3 border rounded bg-light h-100">
                                            <h5 class="mb-3 text-primary">Labels</h5>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="label-best-selling">
                                                <label class="form-check-label" for="label-best-selling">Best
                                                    Selling</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="label-featured">
                                                <label class="form-check-label" for="label-featured">Featured
                                                    Products</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="label-popular">
                                                <label class="form-check-label" for="label-popular">Most Popular</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="label-new">
                                                <label class="form-check-label" for="label-new">Just Arrived</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Taxes Section -->
                                    <div class="col-md-6 mt-4 mt-md-0">
                                        <div class="p-3 border rounded bg-light h-100">
                                            <h5 class="mb-3 text-primary">Taxes</h5>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="tax-none">
                                                <label class="form-check-label" for="tax-none">None (0%)</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="tax-vat">
                                                <label class="form-check-label" for="tax-vat">VAT</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="tax-import">
                                                <label class="form-check-label" for="tax-import">Import Tax</label>
                                            </div>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="tax-export">
                                                <label class="form-check-label" for="tax-export">Export Tax</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Styled Section Container -->
                            <div class="card p-4 mb-4 shadow-sm border rounded">
                                <h4 class="mb-4">Product Reviews</h4>

                                <!-- Inner grayish container -->
                                <div class="p-3 border rounded bg-light h-100">
                                    <div id="review-container"></div>

                                    <div class="d-flex justify-content-end mt-3">
                                        <button type="button" class="btn btn-primary btn-sm" onclick="addReview()">
                                            <i class="fas fa-plus me-1"></i> Add Review
                                        </button>
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


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let reviewIndex = 0;

        function addReview() {
            const container = document.getElementById('review-container');

            const row = document.createElement('div');
            row.className = 'border rounded bg-white p-3 mb-3';
            row.dataset.index = reviewIndex;

            row.innerHTML = `
        <div class="form-row">
            <div class="col-md-3 mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="reviews[${reviewIndex}][name]" placeholder="Enter name">
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="reviews[${reviewIndex}][email]" placeholder="Enter email">
            </div>
            <div class="col-md-2 mb-3">
                <label class="form-label">Rating</label>
                <select class="form-control" name="reviews[${reviewIndex}][rating]">
                    <option value="">Select rating</option>
                    <option value="5">5 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="2">2 Stars</option>
                    <option value="1">1 Star</option>
                </select>
            </div>
            <div class="col-md-2 mb-3">
                <label class="form-label">Review Date</label>
                <input type="date" class="form-control" name="reviews[${reviewIndex}][date]">
            </div>
            <div class="col-md-2 mb-3 d-flex align-items-end">
                <button type="button" class="btn btn-danger btn-md w-100" onclick="this.closest('.border').remove()">
                    🗑️ Delete
                </button>
            </div>
        </div>
        <div class="form-row">
            <div class="col-12 mb-3">
                <label class="form-label">Review Message</label>
                <textarea class="form-control" name="reviews[${reviewIndex}][message]" rows="3" placeholder="Write your review..."></textarea>
            </div>
        </div>
    `;

            container.appendChild(row);
            reviewIndex++;
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#saveProductBtn').on('click', function(e) {
                e.preventDefault();

                const btn = $(this);

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
                    const attrSelect = $(this).find('select').eq(0);
                    const valSelect = $(this).find('select').eq(1);

                    const attrName = attrSelect.val();
                    const attrValue = valSelect.val();

                    if (attrName && attrValue) {
                        attributes.push({
                            attribute: attrName,
                            value: attrValue
                        });
                    }
                });

                // ✅ Collect reviews
                let reviews = [];
                $('#review-container .border').each(function() {
                    const row = $(this);

                    const name = row.find('input[name*="[name]"]').val().trim();
                    const email = row.find('input[name*="[email]"]').val().trim();
                    const rating = row.find('select[name*="[rating]"]').val();
                    const date = row.find('input[name*="[date]"]').val();
                    const message = row.find('textarea[name*="[message]"]').val().trim();

                    // Optional: Only push reviews that have at least name and message
                    if (name && message) {
                        reviews.push({
                            name,
                            email,
                            rating,
                            date,
                            message
                        });
                    }
                });

                // Validation
                let isValid = true;
                let errorMessages = [];

                if (!productName) {
                    $('#product_name').addClass('is-invalid');
                    errorMessages.push('Please enter a product name.');
                    isValid = false;
                } else {
                    $('#product_name').removeClass('is-invalid');
                }

                if (!category) {
                    $('#category_select').addClass('is-invalid');
                    errorMessages.push('Please select a category.');
                    isValid = false;
                } else {
                    $('#category_select').removeClass('is-invalid');
                }

                if (!status) {
                    $('#status_select').addClass('is-invalid');
                    errorMessages.push('Please select a status.');
                    isValid = false;
                } else {
                    $('#status_select').removeClass('is-invalid');
                }

                if (!description) {
                    errorMessages.push('Please enter a description.');
                    isValid = false;
                }

                if (!price) {
                    $('#price').addClass('is-invalid');
                    errorMessages.push('Please enter a price.');
                    isValid = false;
                } else {
                    $('#price').removeClass('is-invalid');
                }

                if (!salePrice) {
                    $('#salePrice').addClass('is-invalid');
                    errorMessages.push('Please enter a sale price.');
                    isValid = false;
                } else {
                    $('#salePrice').removeClass('is-invalid');
                }

                if (!quantity) {
                    $('#quantity').addClass('is-invalid');
                    errorMessages.push('Please enter a quantity.');
                    isValid = false;
                } else {
                    $('#quantity').removeClass('is-invalid');
                }

                if (!sku) {
                    $('#sku').addClass('is-invalid');
                    errorMessages.push('Please enter a SKU.');
                    isValid = false;
                } else {
                    $('#sku').removeClass('is-invalid');
                }

                if (!Object.values(labels).some(Boolean)) {
                    errorMessages.push('Please select at least one product label.');
                    isValid = false;
                }

                if (!Object.values(taxes).some(Boolean)) {
                    errorMessages.push('Please select at least one tax option.');
                    isValid = false;
                }

                if (!image1 && !image2 && !image3) {
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
                        formData.append('attributes', JSON.stringify(attributes));
                        formData.append('reviews', JSON.stringify(reviews)); 

                        if (image1) formData.append('featured_image_1', image1);
                        if (image2) formData.append('featured_image_2', image2);
                        if (image3) formData.append('featured_image_3', image3);

                        formData.append('labels', JSON.stringify(labels));
                        formData.append('taxes', JSON.stringify(taxes));

                        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

                        $.ajax({
                            url: '/store-product',
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
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
                            //  error: function(xhr) {
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
