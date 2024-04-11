@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">All Products</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Products</li>
                        <li>
                            <span class="badge bg-danger badge-pill rounded-pill mx-2">{{ count($products) }}</span>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.product') }}" type="button" class="btn btn-primary">Add Product</a>
                </div>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <hr />
    <div class="card mx-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Discount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <img src="{{ asset($item->product_thambnail) }}" alt=""
                                        style="width: 70px; height: 40px;">
                                </td>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->product_price }}</td>
                                <td>{{ $item->product_qty }}</td>
                                <td>
                                    @if ($item->discount_price == null)
                                    @else
                                        @php
                                            $amount = $item->selling_price - $item->discount_price;
                                            $discount = ($amount / $item->selling_price) * 100;
                                        @endphp
                                        <span class="badge bg-danger badge-pill rounded-pill">{{ round($discount) }}%</span>
                                    @endif
                                </td>

                                <td>
                                    @if ($item->status == 1)
                                        <span class="badge bg-success badge-pill rounded-pill">Active</span>
                                    @else
                                        <span class="badge bg-danger badge-pill rounded-pill">Inactive</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('edit.product', $item->id) }}" title="Edit Data"
                                        class="btn text-white btn-sm btn-info">
                                        <i class="fa-solid fa-pencil"></i>
                                    </a>
                                    <a href="{{ route('delete.category', $item->id) }}" id="delete" title="Delete Data"
                                        class="btn btn-sm btn-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                    <a href="{{ route('delete.category', $item->id) }}" id="delete" title="Details Page"
                                        class="btn btn-sm btn-warning text-white">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    @if ($item->status == 1)
                                        <a href="{{ route('delete.category', $item->id) }}" id="delete" title="Inactive"
                                            class="btn btn-sm btn-danger">
                                            <i class="fa-solid fa-thumbs-up"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('delete.category', $item->id) }}" id="delete" title="Active"
                                            class="btn btn-sm btn-danger">
                                            <i class="fa-solid fa-thumbs-down"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>S/N</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Discount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    </div>
@endsection;
