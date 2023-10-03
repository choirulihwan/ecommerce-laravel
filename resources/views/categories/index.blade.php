@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Categories</div>

                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <th>Name</th>                            
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            @foreach($categories as $cat)
                                <tr>
                                    <td>{{ $cat->name }}</td>                                    
                                    <td><a href="{{ route('categories.edit', ['category' => $cat->id]) }}" class="btn btn-xs btn-info">Edit</a></td>
                                    <td>
                                        <form action="{{ route('categories.destroy', ['category' => $cat->id]) }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                                        </form>
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection