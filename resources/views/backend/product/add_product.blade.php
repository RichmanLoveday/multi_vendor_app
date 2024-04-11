@extends('admin.admin_dashboard')
@section('admin')
    <script src="{{ asset('admin_backend/assets/js/jquery.min.js') }}"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3 form-group">
            <div class="breadcrumb-title pe-3">Add Product</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add New Product</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Add New Product</h5>
                <hr />
                <form action="{{ route('store.product') }}" method="post" id="myForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">
                                    <div class="mb-3 form-group">
                                        <label for="inputProductTitle" class="form-label">Product Name</label>
                                        <input type="text" name="product_name" class="form-control"
                                            id="inputProductTitle" placeholder="Enter product title">
                                    </div>
                                    <div class="mb-3 form-group">
                                        <label class="form-label">Product Tags</label>
                                        <input type="text" class="form-control visually-hidden" name="product_tags"
                                            data-role="tagsinput" value="new product,top product">
                                    </div>
                                    <div class="mb-3 form-group">
                                        <label class="form-label">Product Size</label>
                                        <input type="text" class="form-control visually-hidden" name="product_size"
                                            data-role="tagsinput" value="Small,Medium,Large">
                                    </div>
                                    <div class="mb-3 form-group">
                                        <label class="form-label">Product Color</label>
                                        <input type="text" class="form-control visually-hidden" name="product_color"
                                            data-role="tagsinput" value="Red,Blue,Black">
                                    </div>
                                    <div class="mb-3 form-group">
                                        <label for="inputProductDescription" class="form-label">Short Description</label>
                                        <textarea class="form-control" name="short_descp" id="inputProductDescription" rows="3" style="resize: none"></textarea>
                                    </div>
                                    <div class="mb-3 form-group">
                                        <label for="inputProductDescription" class="form-label">Long Description</label>

                                        <textarea name="long_descp" placeholder="Product Details" class="form-control" style="display: none;" rows="12"
                                            cols="50"></textarea>
                                    </div>
                                    <div class="mb-3 form-group">
                                        <label for="formFile" class="form-label">Main Thambnail</label>
                                        <input class="form-control" name="product_thambnail" onchange="mainThamUrl(this)"
                                            type="file" id="formFile">
                                        <img src="" id="mainThmb" alt="">
                                    </div>
                                    <div class="mb-3 form-group">
                                        <label for="formFile" class="form-label">Product Images</label>
                                        <input class="form-control" name="multi_img[]" type="file" id="multiImg"
                                            multiple=''>
                                        <div class="row" id="preview_img">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="border border-3 p-4 rounded">
                                    <div class="row g-3">
                                        <div class="col-md-6 form-group">
                                            <label for="inputPrice" class="form-label">Product Price</label>
                                            <input type="text" name="selling_price" class="form-control" id="inputPrice"
                                                placeholder="00.00">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="inputCompareatprice" class="form-label">Discount Price</label>
                                            <input type="text" name="discount_price" class="form-control"
                                                id="inputCompareatprice" placeholder="00.00">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="inputCostPerPrice" class="form-label">Product Code</label>
                                            <input type="text" name="product_code" class="form-control"
                                                id="inputCostPerPrice" placeholder="00.00">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="inputStarPoints" class="form-label">Product Quantity</label>
                                            <input type="text" name="product_qty" class="form-control"
                                                id="inputStarPoints" placeholder="00.00">
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="inputProductType" class="form-label">Product Brand</label>
                                            <select name="brand_id" class="form-select" id="inputProductType">
                                                <option value="">---select brand----</option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="inputVendor" class="form-label">Product Category</label>
                                            <select name="category_id" class="form-select" id="inputVendor"
                                                onchange="getSubCategory(this)">
                                                <option value="">----select category----</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="inputCollection" class="form-label">Product Subcategory</label>
                                            <select name="subcategory_id" class="form-select" id="inputCollection">
                                                <option value="">---select subcategory----</option>
                                            </select>
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="inputCollection" class="form-label">Select Vendor</label>
                                            <select name="vendor_id" class="form-select" id="inputCollection">
                                                <option value="">---select vendor----</option>
                                                @foreach ($activeVendors as $vendor)
                                                    <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="hot_deals" type="checkbox"
                                                            value="1" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">Hot
                                                            Deals</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="featured"
                                                            value="1" id="flexCheckDefault">
                                                        <label class="form-check-label"
                                                            for="flexCheckDefault">Featured</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="special_offers"
                                                            type="checkbox" value="1" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">Special
                                                            Offers</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="special_deals" value="1" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">Special
                                                            Deals</label>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary">Save Product</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--end row-->
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script>
        function mainThamUrl(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainThmb').attr('src', e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }


        //? list subcategory
        function getSubCategory(event) {
            let category_id = $(event).val();
            if (category_id.length != 0) {
                $.ajax({
                    url: `{{ url('/subcategory/ajax') }}/${category_id}`,
                    type: "GET",
                    dataType: "json",
                    success: (data) => {
                        $('select[name="subcategory_id"]').html('');
                        let d = $('select[name="subcategory_id"]').empty();

                        $.each(data, function(key, value) {
                            $('select[name="subcategory_id"]').append(
                                `<option value='${value.id}'>${value.subcategory_name}</option>`
                            );
                        });
                    }
                })
            } else {
                $('select[name="subcategory_id"]').empty();
                $('select[name="subcategory_id"]').append(
                    `<option value='0'>---select subcategory---</option>`
                );
                alert('danger');
            }
        }

        $(document).ready(function() {
            //? ckeditor
            $('long_descp').css('display', 'block')
            window.onload = function() {
                CKEDITOR.replace('long_descp');
            };

            $('#multiImg').on('change', function() { //on file input change
                if (window.File && window.FileReader && window.FileList && window
                    .Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data

                    $.each(data, function(index, file) { //loop though each file
                        if (/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file
                                .type)) { //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file) { //trigger function on successful read
                                return function(e) {
                                    var img = $('<img />').addClass('thumb').attr('src',
                                            e.target.result).width(100)
                                        .height(80); //create image element
                                    $('#preview_img').append(
                                        img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                } else {
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });




        // //? validate input files
        $(document).ready(function() {
            $('#image').change(function(e) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0])
            })

            $('#myForm').validate({
                rules: {
                    product_name: {
                        required: true,
                    },
                    short_descp: {
                        required: true,
                    },
                    product_thambnail: {
                        required: true,
                    },
                    multi_img: {
                        required: true,
                    },
                    selling_price: {
                        required: true,
                    },
                    product_code: {
                        required: true,
                    },
                    product_qty: {
                        required: true,
                    },
                    brand_id: {
                        required: true,
                    },
                    category_id: {
                        required: true,
                    },
                    subcategory_id: {
                        required: true,
                    },
                    // discount_price: {
                    //     required: true,
                    // }

                },
                messages: {
                    product_name: {
                        required: 'Please Enter prooduct Name',
                    },
                    short_descp: {
                        required: 'Please Enter short description',
                    },
                    product_thambnail: {
                        required: 'Please select a product thumbnail',
                    },
                    brand_id: {
                        required: 'Please select a brand',
                    },
                    product_qty: {
                        required: 'Please enter product quantity',
                    },
                    category_id: {
                        required: 'Please select a category',
                    },
                    multi_img: {
                        required: 'Please select multi image',
                    },
                    subcategory_id: {
                        required: 'Please select subcategory',
                    },
                    selling_price: {
                        required: 'Please enter selling price',
                    },
                    product_code: {
                        required: 'Please enter product code',
                    },
                    // discount_price: {
                    //     required: 'Please enter discount price',
                    // }

                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        })
    </script>
@endsection
