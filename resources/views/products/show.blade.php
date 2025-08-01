@extends('layouts.app')
@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm 6 mt-4">
         <div class="card p-4">
            <p>Name : <b>{{$product->name}}</b></p>
             <p>Details : <b>{{$product->details}}</b></p>
             <img src="/products/{{$product->image}}" class="rounded" width="50%" height="50%">
         </div>
        </div>
    </div>
</div>
@endsection