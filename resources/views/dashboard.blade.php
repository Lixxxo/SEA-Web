<!--Cambiar esta view dependiendo del rol de auth

    por ejemplo

    auth->admin(){
        yield('admin')
    }else{
        yield('encargado docente')
    }else{
        yield('Estudiante')
        // (dentro de estudiante poner otro yield para que se muestren las funciones 
        // en caso de que sea ayudante)
    }


-->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div>
</x-app-layout>
