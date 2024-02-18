@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-success">
                    <h3 class="text-white">All Products</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Total</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>After Discount</th>
                            <th>Brand</th>
                            <th>Short Description</th>
                            <th>Preview</th>
                            <th>Actions</th>
                        </tr>

                        @foreach($products as $tp => $product)
                        <tr>
                            <td>{{ $tp+1 }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->product_price }}</td>
                            <td>{{ $product->after_discount }}</td>
                            <td>{{ $product->brand }}</td>
                            <td>{{ $product->short_description }}</td>
                            <td>
                                <img src="{{ asset('/uploads/products/preview/') }}/{{ $product->preview }}" alt="preview-iamge" width="100">
                            </td>
                            <td>
                                <a href="{{ route('inventory', $product->id) }}" class="btn btn-success btn-xs"><i class="fa-solid fa-arrow-up-a-z"></i></a>
                                <a href="#" class="btn btn-danger btn-xs mt-2"><i class="fa-solid fa-trash-can"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_script')
<script>
    $('#category_id').change(function(){
        var category_id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '/product/getCategory',
            data: {'cat_id': category_id},
            success: function(data){
                $('#subcategory_name').html(data);
            }
        });
    })
</script>
<script>
    $(document).ready(function() {
        $('#category_id').select2();
    });
</script>
@endsection
