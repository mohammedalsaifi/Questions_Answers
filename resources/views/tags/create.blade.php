<x-dashboard-layout>

    <x-slot name="title">
        Create Tags
    </x-slot>

    <x-slot name="breadcrumb">
        <li class="breadcrumb-item">Tags</li>
    </x-slot>

    <x-alert />


    @include('tags._form', [
    'action' => '/tags',
    'update' => false,
    ])
    {{--
    المفروض هنا يطلعلي ايرور لانو الملف الاساسسي _فورم.بليد بيحتوي على variable
    و ميثود هادا الملف الموجودة داخل TagsController
    لا تحتوي على على هذا variable
    عشان هيك عملنا variable
    داخل create method
    واعطيناه قيمة null
    --}}
</x-dashboard-layout>