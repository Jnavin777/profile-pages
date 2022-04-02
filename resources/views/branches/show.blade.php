<x-minton-layout>
    <x-slot name="header">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Главная</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('branch.index') }}">Отделения</a></li>
                    <li class="breadcrumb-item active">Отделение #{{ $item->id }}</li>
                </ol>
            </div>
            <h4 class="page-title">Отделение # {{ $item->id }} - {{ $item->name }}</h4>
        </div>
    </x-slot>
    <x-slot name="slot">
        <branch-show :branch="{{ $item }}"></branch-show>
    </x-slot>

</x-minton-layout>
