<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Members List') }}
        </h2>
    </x-slot>
    <div id="acl_wrapper" data-context="members" class="table-wrapper">
        <section id="app">
            <members-all></members-all>
        </section>
    </div>
</x-app-layout>
