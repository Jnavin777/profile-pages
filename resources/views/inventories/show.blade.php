<x-minton-layout>
    <x-slot name="header">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Главная</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('inventory.index') }}">Инвентаризации</a></li>
                    <li class="breadcrumb-item active">Инвентаризация #{{ $item->id }}</li>
                </ol>
            </div>
            <h4 class="page-title">Инвентаризация # {{ $item->id }} (Отделение: {{ $item->branch->name }})</h4>
        </div>
    </x-slot>
    <x-slot name="slot">
        <inventory-show
            :inventory="{{ $item }}"
        ></inventory-show>
    </x-slot>

</x-minton-layout>
