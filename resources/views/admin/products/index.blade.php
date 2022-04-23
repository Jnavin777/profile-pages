<x-minton-admin-layout>
    <x-slot name="header">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Продукты</li>
                </ol>
            </div>
            <h4 class="page-title">Все продукты</h4>
        </div>
    </x-slot>
    <x-slot name="slot">
        <admin-product-index></admin-product-index>
    </x-slot>

</x-minton-admin-layout>
