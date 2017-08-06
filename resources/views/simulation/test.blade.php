@extends('layout.main')

@section('content')

<div ng-init="load({{ $profile['id'] }})">
    <button class="ui button bule" ng-click="submit({{ $profile['id'] }})">送出</button>
</div>


@endsection