@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card bg-success my-2">
                    <div class="card-header text-white">
                        Qiita
                    </div>
                    <ul class="list-group list-group-flush">
                        @each('item', $items, 'item')
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
