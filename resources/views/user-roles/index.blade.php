<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Roles') }}
        </h2>
    </x-slot>
    <div id="acl_wrapper" data-context="roles" class="table-wrapper">
        <section id="app">
            <user-roles-all></user-roles-all>
        </section>
    </div>
</x-app-layout>
