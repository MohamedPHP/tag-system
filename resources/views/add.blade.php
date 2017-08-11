@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if (Session::has('success'))
            <div class="col-md-12">
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            </div>
        @endif
        @if (count($errors) > 0)
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="padding: 10px 15px;">
                    Add Articles
                </div>
                <div class="panel-body">
                    <form action="{{ url('/addArticle') }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="article_title" placeholder="article title....">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <select class="form-control" name="article_tags[]" multiple>
                                    <option value="">Select Tag</option>
                                    @foreach ($tags as $value)
                                        <option value="{{ $value->id }}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <select class="form-control" name="cat_id">
                                    <option value="">Select Cat</option>
                                    @foreach ($cats as $value)
                                        <option value="{{ $value->id }}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Add.. <i class="fa fa-plus"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading" style="padding: 10px 15px;">
                    Add Categories
                </div>

                <div class="panel-body">
                    <form action="{{ url('/addCategory') }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-9">
                                <input type="text" name="cat_name" class="form-control" placeholder="cat name....">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary btn-block">Add.. <i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading" style="padding: 10px 15px;">
                    Add tags
                </div>

                <div class="panel-body">
                    <form action="{{ url('/addTag') }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="tag_name" placeholder="Tag Name....">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary btn-block">Add.. <i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
