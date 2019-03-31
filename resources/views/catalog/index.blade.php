@extends('layouts.app')

@section('content')

    <catalog-component
        :products="{{ $products }}"
        :request="{{ $request }}"
    ></catalog-component>

@endsection
