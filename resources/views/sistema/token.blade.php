<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>
        <x-validation-errors class="mb-4" />
            @if($data_result["message"] == "tokenOk")
                <h1>Su cuenta cuenta de correo electrónico ha sido verificada de manera correcta. <br>Diríjase a la página de inicio su sesión.</h1><br>
                <a href="{{ url('/login') }}">
                    <button type="button" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-4">
                        Inicio de Sesión
                    </button>
                </a>
            @elseif($data_result["message"] == "tokenError")
                <h1>Se ha producido un error al activar su cuenta, por favor contáctese con el administrador del sitio WEB.</h1><br>
                <a href="{{ url('/login') }}">
                    <button type="button" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-4">
                        Inicio de Sesión
                    </button>
                </a>
            @elseif($data_result["message"] == "tokenUsado")
                <h1>El link de activación de correo ya ha sido usado. <br>Diríjase a la página de inicio su sesión.</h1><br>
                <a href="{{ url('/login') }}">
                    <button type="button" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-4">
                        Inicio de Sesión
                    </button>
                </a>
            @else 
                <h1>El link de activación no se encuentra registrado. <br> Contáctate con nosotros para indicarnos esta novedad.</h1><br>
                <a href="{{ url('/contactanos') }}">
                    <button type="button" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-4">
                        Contáctanos
                    </button>
                </a>
            @endif
        </x-authentication-card>
</x-guest-layout>