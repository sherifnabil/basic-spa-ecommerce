@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Client Area</div>
                <div class="card-body">
                    <router-view
                        :key="$route.fullPath"
                        :user="{{ auth()->user() }}"
                    ></router-view>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
