@extends('layouts.pay')

@section('title_force', 'Билеты - МирТуризма46')
@section('description_force', $pay->name )

@section('main')

<section class="ticket_section">
    <div class="container">
        <h1>
            @switch($pay->type)
                @case('exkurs')
                Ваши билеты на экскурсионный тур
                @break

                @default
                    Ваши чеки
            @endswitch
        </h1>
        <div class="tickets_wrapper">
            @foreach ($pay->clients as $item)
                <x-tickets.exkurs :title="$pay->name" :item="$item"></x-tickets.exkurs>
            @endforeach

        </div>

    </div>
</section>
@endsection

