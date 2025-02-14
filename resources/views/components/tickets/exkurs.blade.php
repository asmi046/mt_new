<div class="ticket">
    <img src="{{ asset('img/ticket.svg') }}" alt="">

    <div class="person_data">
        <header>
            <div class="logo">
                <img src="{{ asset('img/logo.webp') }}" alt="МирТуризма46">
            </div>
            <div class="name">
                <span> {{$title}}</span>
            </div>
        </header>

        <div class="pd">
            <span>Ф.И.О.</span>
            <p>{{ $item->fio }}</p>
        </div>

        <div class="pd">
            <span>Документ:</span>
            <p>{{ $item->document_type }}: {{ $item->document_number }}</p>
        </div>

        <div class="pd">
            <span>Дата рождения:</span>
            <p>{{ $item->dr }}</p>
        </div>
    </div>
</div>
