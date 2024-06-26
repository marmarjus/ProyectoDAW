@extends('layout')

@section('title', 'Editar perfil')

@section('content')
    <div class="min-h-screen flex items-center justify-center py-12 px-4 md:px-8">
        <div class="max-w-md w-full space-y-8">
            <div></div>
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Editar perfil
                </h2>
            </div>
            <form id="edit-account-form" class="mt-8 space-y-6">
                @csrf
                <div class="rounded-2xl shadow-sm -space-y-px">
                    <div class="mb-4">
                        <label for="username" class="sr-only">Nombre de Usuario</label>
                        <input id="username" name="username" type="text"
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 text-sm"
                            placeholder="Usuario">
                    </div>
                    <div>
                        <label for="password" class="sr-only">Contraseña</label>
                        <input id="password" name="password" type="password"
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 text-sm"
                            placeholder="Contraseña">
                    </div>
                </div>

                <div>
                    <button id="edit-btn" type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-2xl text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Guardar cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    @vite('resources/js/user/accountUpdate.js')
@endsection
