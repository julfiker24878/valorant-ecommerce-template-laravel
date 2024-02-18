@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-white">Add Product</h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('/product/insert') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <select name="category_id" class="form-control" id="category_id">
                                <option value="">-- Select Category --</option>
                                @foreach($categories as $category)
                                <option value="{{ ($category->id) }}">{{ __($category->category_name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="subcategory_id" class="form-control" id="subcategory_name">
                                <option value="">-- Select SubCategory --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="product_name" placeholder="Product Name">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="product_price" placeholder="Product Price">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="discount" placeholder="Product Discount %">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="brand_name" placeholder="Brand Name">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="short_description" placeholder="Short Description"></textarea>
                        </div>
                        <div class="form-group">
                            <textarea id="desc" class="form-control" name="description" placeholder="Description" rows="20"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="pm" class="form-label">Product Image</label>
                            <input type="file" class="form-control" name="product_preview" id="pm">
                        </div>
                        <div class="form-group">
                            <label for="pt" class="form-label">Product Thumbnails</label>
                            <input type="file" multiple class="form-control" name="product_thumbnails[]" id="pt">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Add Product</button>
                        </div>
                    </form>
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
        $('#desc').summernote();
    });
</script>
@endsection
