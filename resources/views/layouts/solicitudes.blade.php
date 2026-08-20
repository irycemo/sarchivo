<div x-data="{openRoles:true, openDistritos:true, openValores:true, openPredios:true}" class="mb-5">

    <p class="uppercase text-base mb-2 border-b border-rojo rounded-lg px-1.5 w-full">Solicitudes</p>

    <div class="flex items-center w-full justify-between hover:text-red-600 transition ease-in-out duration-500 hover:bg-gray-100 rounded-xl">

        <a href="{{ route('solicitudes') }}" class="capitalize font-medium text-sm flex items-center w-full py-2 px-4 focus:outline-rojo focus:outline-offset-2 rounded-lg">

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>

            Solicitudes

        </a>

    </div>

</div>
