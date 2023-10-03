@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><h3>{{ $title }} product</h3></div>

                <div class="panel-body">
                @if ($is_edit)
                    <form action="{{ route('products.update', ['product' => $product->id]) }}" method="post" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                @else
                    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @endif 
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category" id="category" class="form-control">
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}" 
                                    @if (($is_edit) && ($product->category_id == $item->id))
                                        selected
                                    @endif>
                                    {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ isset($product) ? $product->name : old('name') }}">
                        </div>

                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" name="price" id="price" class="form-control nominal text-right" value="{{ isset($product) ? number_format($product->price,0, ',', '.') : old('price') }}">
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            @if ($is_edit && trim($product->name) != '')
                                <img class="img-responsive" src="{{ asset($product->image) }}" alt="{{ isset($product) ? $product->name : 'image'}}"> 
                            @endif
                            <br>                           
                            <input type="file" name="image" class="form-control">                            
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" rows="10" name="description">{{ isset($product) ? $product->description : old('description') }}</textarea>
                        </div>


                        <div class="form-group">
                            <div class="text-center">
                                <button class="btn btn-success" type="submit">
                                    Save product
                                </button>
                            </div>
                        </div>

                   </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    var number = new NumericInput(document.getElementById("price"), "id-ID");

    $('#description').summernote({
        placeholder: '',
        tabsize: 2,
        height: 150,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });    
</script>

@endsection