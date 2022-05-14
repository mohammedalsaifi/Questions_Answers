<x-dashboard-layout>

    <x-slot name="title">
        Create Roles
    </x-slot>

    <x-slot name="breadcrumb">
        <li class="breadcrumb-item">Roles</li>
    </x-slot>

    <x-alert />

    @include('roles._form', [
    'action' => route('roles.store'),
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