@extends('layouts.app')

@section('content')

    <catalog-component
        :products="{{ $products }}"
    ></catalog-component>

@endsection
