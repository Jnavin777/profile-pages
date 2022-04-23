<x-minton-layout>
    <x-slot name="header">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Главная</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('permission.index') }}">Разрешения</a></li>
                    <li class="breadcrumb-item active">Разрешение #{{ $item->id }}</li>
                </ol>
            </div>
            <h4 class="page-title">Разрешение # {{ $item->id }} - {{ $item->name }}</h4>
        </div>
    </x-slot>
    <x-slot name="slot">
        <permission-show :permission="{{ $item }}"></permission-show>
    </x-slot>

</x-minton-layout>
