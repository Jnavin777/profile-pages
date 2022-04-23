<x-minton-admin-layout>
    <x-slot name="header">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Продукты</li>
                </ol>
            </div>
            <h4 class="page-title">All products</h4>
        </div>
    </x-slot>
    <x-slot name="slot">
        <admin-permission-index></admin-permission-index>
    </x-slot>

</x-minton-admin-layout>
