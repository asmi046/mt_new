@extends('layouts.pay')

@section('title_force', 'Оплата заказа - МирТуризма46')
@section('description_force', 'Оплата заказа - МирТуризма46')

@section('main')
    <section class="pay_section" id="pay_app">
        <div class="container">
            <pay uuid="{{$pay_data->uuid}}"></pay>

        </div>
    </section>
@endsection
