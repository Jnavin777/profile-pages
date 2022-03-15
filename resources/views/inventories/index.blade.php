<x-minton-layout>
    <x-slot name="header">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Главная</a></li>
                    <li class="breadcrumb-item active">Инвентаризации</li>
                </ol>
            </div>
            <h4 class="page-title">Все инвентаризации</h4>
        </div>
    </x-slot>
    <x-slot name="slot">
        <inventory-index
            :branches="{{ json_encode($branches) }}"
        ></inventory-index>
    </x-slot>

</x-minton-layout>
