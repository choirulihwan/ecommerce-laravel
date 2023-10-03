@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><h3>{{ $title }} Category</h3></div>

                <div class="panel-body">
                @if ($is_edit)
                    <form action="{{ route('categories.update', ['category' => $category->id]) }}" method="post">
                    {{ method_field('PUT') }}
                @else
                    <form action="{{ route('categories.store') }}" method="post">
                @endif 
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ isset($category) ? $category->name : old('name') }}">
                        </div>
                        <div class="form-group">
                            <div class="text-center">
                                <button class="btn btn-success" type="submit">
                                    Save Category
                                </button>
                            </div>
                        </div>

                   </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection