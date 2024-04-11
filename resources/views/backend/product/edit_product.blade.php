@extends('admin.admin_dashboard')
@section('admin')
    <script src="{{ asset('admin_backend/assets/js/jquery.min.js') }}"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3 form-group">
            <div class="breadcrumb-title pe-3">Edit Product</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Edit Product</h5>
                <hr />
                <form action="{{ route('update.product') }}" method="post" id="myForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ $products->id }}" name="id">
                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">
                                    <div class="mb-3 form-group">
                                        <label for="inputProductTitle" class="form-label">Product Name</label>
                                        <input type="text" name="product_name" class="form-control"
                                            value="{{ $products->product_name }}" id="inputProductTitle"
                                            placeholder="Enter product title">
                                    </div>
                                    <div class="mb-3 form-group">
                                        <label class="form-label">Product Tags</label>
                                        <input type="text" class="form-control visually-hidden" name="product_tags"
                                            value="{{ $products->product_tags }}" data-role="tagsinput"
                                            value="new product,top product">
                                    </div>
                                    <div class="mb-3 form-group">
                                        <label class="form-label">Product Size</label>
                                        <input type="text" class="form-control visually-hidden" name="product_size"
                                            value="{{ $products->product_size }}" data-role="tagsinput"
                                            value="Small,Medium,Large">
                                    </div>
                                    <div class="mb-3 form-group">
                                        <label class="form-label">Product Color</label>
                                        <input type="text" class="form-control visually-hidden" name="product_color"
                                            value="{{ $products->product_color }}" data-role="tagsinput"
                                            value="Red,Blue,Black">
                                    </div>
                                    <div class="mb-3 form-group">
                                        <label for="inputProductDescription" class="form-label">Short Description</label>
                                        <textarea class="form-control" name="short_descp" id="inputProductDescription" rows="3" style="resize: none">{{ $products->short_descp }}</textarea>
                                    </div>
                                    <div class="mb-3 form-group">
                                        <label for="inputProductDescription" class="form-label">Long Description</label>

                                        <textarea name="long_descp" placeholder="Product Details" class="form-control" style="display: none;" rows="12"
                                            cols="50">{{ $products->long_descp }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="border border-3 p-4 rounded">
                                    <div class="row g-3">
                                        <div class="col-md-6 form-group">
                                            <label for="inputPrice" class="form-label">Product Price</label>
                                            <input type="text" name="selling_price"
                                                value="{{ $products->selling_price }}" class="form-control" id="inputPrice"
                                                placeholder="00.00">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="inputCompareatprice" class="form-label">Discount Price</label>
                                            <input type="text" name="discount_price"
                                                value="{{ $products->discount_price }}" class="form-control"
                                                id="inputCompareatprice" placeholder="00.00">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="inputCostPerPrice" class="form-label">Product Code</label>
                                            <input type="text" name="product_code"
                                                value="{{ $products->product_code }}" class="form-control"
                                                id="inputCostPerPrice" placeholder="00.00">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="inputStarPoints" class="form-label">Product Quantity</label>
                                            <input type="text" name="product_qty"
                                                value="{{ $products->product_qty }}" class="form-control"
                                                id="inputStarPoints" placeholder="00.00">
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="inputProductType" class="form-label">Product Brand</label>
                                            <select name="brand_id" class="form-select" id="inputProductType">
                                                <option value="">---select brand----</option>
                                                @foreach ($brands as $brand)
                                                    <option {{ $brand->id == $products->brand_id ? 'selected' : '' }}
                                                        value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="inputVendor" class="form-label">Product Category</label>
                                            <select name="category_id" class="form-select" id="inputVendor"
                                                onchange="getSubCategory(this)">
                                                <option value="">----select category----</option>
                                                @foreach ($categories as $category)
                                                    <option {{ $category->id == $products->category_id ? 'selected' : '' }}
                                                        value="{{ $category->id }}">{{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="inputCollection" class="form-label">Product Subcategory</label>
                                            <select name="subcategory_id" class="form-select" id="inputCollection">
                                                <option value="">---select subcategory----</option>
                                                @foreach ($subCategories as $subcategory)
                                                    <option
                                                        {{ $subcategory->id == $products->subcategory_id ? 'selected' : '' }}
                                                        value="{{ $subcategory->id }}">
                                                        {{ $subcategory->subcategory_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="inputCollection" class="form-label">Select Vendor</label>
                                            <select name="vendor_id" class="form-select" id="inputCollection">
                                                <option value="">---select vendor----</option>
                                                @foreach ($activeVendors as $vendor)
                                                    <option {{ $vendor->id == $products->vendor_id ? 'selected' : '' }}
                                                        value="{{ $vendor->id }}">{{ $vendor->name }}</option>
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
                                                            value="1" id="flexCheckDefault"
                                                            {{ $products->featured == '1' ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="flexCheckDefault">Featured</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="special_offers"
                                                            {{ $products->special_offers == '1' ? 'checked' : '' }}
                                                            type="checkbox" value="1" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">Special
                                                            Offers</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="special_deals" value="1"
                                                            {{ $products->special_deals == '1' ? 'checked' : '' }}
                                                            id="flexCheckDefault">
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

    <div class="page-content">
        <h6 class="mb-0 text-uppercase">Update Main Image Thambnail</h6>
        <hr>
        <!--- Update product thambnail --->
        <div class="card mb-5">
            <form action="{{ route('update.product.thambnail') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Choose Thambnail Image</label>
                        <input class="form-control" name="product_thambnail" type="file">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label"></label>
                        <img src="{{ asset($products->product_thambnail) }}" alt=""
                            style="width: 100px; height:100px;">
                    </div>
                </div>
                <input type="hidden" name="id" value="{{ $products->id }}">
                <input type="hidden" name="old_image" value="{{ $products->product_thambnail }}">
                <button class="btn btn-primary mx-3 mb-3" type="submit">Save Changes</button>
            </form>
        </div>


        <h6 class="mb-0 text-uppercase">Update Multi Image</h6>
        <hr>
        <!---- update multi image --->
        <div class="card">
            <div class="card-body">
                <table class="table mb-0 table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Change Image</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="{{ route('update.product.multiimage') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @foreach ($multiImages as $key => $img)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>
                                        <img src="{{ asset($img->photo_name) }}" style="width: 70px; height: 40px;"
                                            alt="">
                                    </td>
                                    <td>
                                        <input type="file" class="form-group" name="multi_img[{{ $img->id }}]"
                                            id="">
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-primary mx-2">Update Image</button>
                                        <a href="" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </form>
                    </tbody>
                </table>
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
                    discount_price: {
                        required: true,
                    }

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
                    discount_price: {
                        required: 'Please enter discount price',
                    }

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
