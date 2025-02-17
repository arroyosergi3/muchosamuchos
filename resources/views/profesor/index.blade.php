<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Mis Alumnos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @foreach ($alumnos as $alum )
                    Nombre: {{ $alum->nombre }} <br>
                    Apellidos: {{ $alum->apellido }} <br>
                    Email: {{ $alum->email }} <br>
                    Curso: {{ $alum->curso }} <br>
                    Asignatura: {{ $alum->pivot->asignatura }} <br>
                    Nota: {{ $alum->pivot->nota }} <br>
                    ====================<br>
                    @endforeach
                    {{ $alumnos->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
