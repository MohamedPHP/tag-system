@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="padding: 10px 15px;">
                    Welcome Page :)
                </div>

                <div class="panel-body">
                    <form action="{{ url('/home') }}" method="get">
                        <div class="row">
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="q" placeholder="search tags....">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary btn-block">Search.. <i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <ul class="list-group">
                        @if (count($articles) > 0)
                            @foreach ($articles as $a)
                                <li class="list-group-item">{{ $a->title }}  | <span style="font-size: 11px; font-weight: bold;">({{ $a->category->name }})</span>
                                    <span class="pull-right">
                                        @foreach ($a->tags as $tag)
                                            <span style="font-size: 11px; font-weight: bold;">
                                                {{ $tag->name }}
                                            </span>
                                            @if (!$loop->last)
                                                |
                                            @endif
                                        @endforeach
                                    </span>
                                </li>
                            @endforeach
                        @else
                            <li class="list-unstyled">
                                <div class="alert alert-danger">there is no articles related to your search</div>
                            </li>
                        @endif
                    </ul>
                    <div class="text-center">
                        {{ $articles->appends(Request::except('page'))->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
