<x-minton-layout>
    <x-slot name="header">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    {{--                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>--}}
                    <li class="breadcrumb-item active">Главная</li>
                </ol>
            </div>
            <h4 class="page-title">Профиль {{ $user->name }}</h4>
        </div>
    </x-slot>
    <x-slot name="slot">
        <my-profile :user="{{ $user }}"></my-profile>
    </x-slot>

</x-minton-layout>
