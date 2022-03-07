<x-minton-layout>
    <x-slot name="header">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Главная</a></li>
                    <li class="breadcrumb-item active">Отделения</li>
                </ol>
            </div>
            <h4 class="page-title">Отделения</h4>
        </div>
    </x-slot>
    <x-slot name="slot">
        <branch-index></branch-index>
    </x-slot>

</x-minton-layout>
