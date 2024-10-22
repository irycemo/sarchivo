<div class="">

    <div class="mb-6">

        <h1 class="text-3xl tracking-widest py-3 px-6 text-gray-600 rounded-xl border-b-2 border-gray-500 font-thin mb-6  bg-white">Predios</h1>

        <div class="flex justify-between">

            <div class="space-y-2">

                <input type="number" wire:model.live.debounce.500ms="filters.localidad" placeholder="Localidad" class="bg-white rounded-full text-sm">

                <input type="number" wire:model.live.debounce.500ms="filters.oficina" placeholder="Oficina" class="bg-white rounded-full text-sm">

                <select class="bg-white rounded-full text-sm" wire:model.live="filters.tipo">

                    <option value="" selected>Tipo de predio</option>
                    <option value="1">1</option>
                    <option value="2">2</option>

                </select>

                <input type="number" wire:model.live.debounce.500ms="filters.registro" placeholder="Número de registro" class="bg-white rounded-full text-sm">

                <select class="bg-white rounded-full text-sm" wire:model.live="pagination">

                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>

                </select>

            </div>

            @can('Crear predio')

                <div class="">

                    <button wire:click="abrirModalCrear" class="bg-gray-500 hover:shadow-lg hover:bg-gray-700 text-sm py-2 px-4 text-white rounded-full hidden md:block items-center justify-center focus:outline-gray-400 focus:outline-offset-2">

                        <img wire:loading wire:target="abrirModalCrear" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">
                        Agregar nuevo predio

                    </button>

                    <button wire:click="abrirModalCrear" class="bg-gray-500 hover:shadow-lg hover:bg-gray-700 float-right text-sm py-2 px-4 text-white rounded-full md:hidden focus:outline-gray-400 focus:outline-offset-2">+</button>

                </div>

            @endcan

        </div>

    </div>

    <div class="overflow-x-auto rounded-lg shadow-xl border-t-2 border-t-gray-500">

        <x-table>

            <x-slot name="head">

                <x-table.heading sortable wire:click="sortBy('estado')" :direction="$sort === 'estado' ? $direction : null" >Estado</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('localidad')" :direction="$sort === 'localidad' ? $direction : null" >Localidad</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('oficina')" :direction="$sort === 'oficina' ? $direction : null" >Oficina</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('tipo_predio')" :direction="$sort === 'tipo_predio' ? $direction : null" >Tipo de predio</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('numero_registro')" :direction="$sort === 'numero_registro' ? $direction : null" >Número de registro</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('created_at')" :direction="$sort === 'created_at' ? $direction : null">Registro</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('updated_at')" :direction="$sort === 'updated_at' ? $direction : null">Actualizado</x-table.heading>
                <x-table.heading >Acciones</x-table.heading>

            </x-slot>

            <x-slot name="body">

                @forelse ($predios as $predio)

                    <x-table.row wire:loading.class.delaylongest="opacity-50" wire:key="row-{{ $predio->id }}">

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Estado</span>

                            <span class="bg-{{ $predio->estado_color }} py-1 px-2 rounded-full text-white text-xs">{{ ucfirst($predio->estado) }}</span>

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Localidad</span>

                            {{ $predio->localidad }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Oficina</span>

                            {{ $predio->oficina }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Tipo de predio</span>

                            {{ $predio->tipo_predio }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Número de registro</span>

                            {{ $predio->numero_registro }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Registrado</span>

                            {{ $predio->created_at }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="font-semibold">@if($predio->actualizadoPor != null)Actualizado por: {{$predio->actualizadoPor->name}} @else Actualizado: @endif</span> <br>

                            {{ $predio->updated_at }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Acciones</span>

                            <div class="flex justify-center lg:justify-start gap-2">

                                <div class="ml-3 relative" x-data="{ open_drop_down:false }">

                                    <div>

                                        <button x-on:click="open_drop_down=true" type="button" class="rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                            </svg>

                                        </button>

                                    </div>

                                    <div x-cloak x-show="open_drop_down" x-on:click="open_drop_down=false" x-on:click.away="open_drop_down=false" class="z-50 @if($loop->last) -top-20  @endif absolute -right-20 lg:right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">

                                        @can('Ver predio')

                                            <button
                                                wire:click="abrirModalVer({{ $predio->id }})"
                                                wire:loading.attr="disabled"
                                                class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                                                role="menuitem">
                                                Ver predio
                                            </button>

                                        @endcan

                                        <button
                                            wire:click="abrirModalMovimiento({{ $predio->id }})"
                                            wire:loading.attr="disabled"
                                            class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                                            role="menuitem">
                                            Agregar movimiento
                                        </button>

                                        @can('Editar predio')

                                            <button
                                                wire:click="abrirModalEditar({{ $predio->id }})"
                                                wire:loading.attr="disabled"
                                                class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                                                role="menuitem">
                                                Editar predio
                                            </button>

                                        @endcan

                                        @can('Borrar predio')

                                            <button
                                                wire:click="abrirModalBorrar({{ $predio->id }})"
                                                wire:loading.attr="disabled"
                                                class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                                                role="menuitem">
                                                Borrar predio
                                            </button>

                                        @endcan

                                    </div>

                                </div>

                            </div>

                        </x-table.cell>

                    </x-table.row>

                @empty

                    <x-table.row wire:key="row-empty">

                        <x-table.cell colspan="9">

                            <div class="bg-white text-gray-500 text-center p-5 rounded-full text-lg">

                                No hay resultados.

                            </div>

                        </x-table.cell>

                    </x-table.row>

                @endforelse

            </x-slot>

            <x-slot name="tfoot">

                <x-table.row>

                    <x-table.cell colspan="9" class="bg-gray-50">

                        {{ $predios->links()}}

                    </x-table.cell>

                </x-table.row>

            </x-slot>

        </x-table>

    </div>

    <x-dialog-modal wire:model="modal">

        <x-slot name="title">

            @if($crear)
                Agregar predio
            @elseif($editar)
                Editar predio
            @endif

        </x-slot>

        <x-slot name="content">

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                <x-input-group for="modelo_editar.localidad" label="Localidad" :error="$errors->first('modelo_editar.localidad')" class="w-full">

                    <x-input-text type="number" id="modelo_editar.localidad" wire:model="modelo_editar.localidad" />

                </x-input-group>

                <x-input-group for="modelo_editar.oficina" label="Oficina" :error="$errors->first('modelo_editar.oficina')" class="w-full">

                    <x-input-text type="number" id="modelo_editar.oficina" wire:model="modelo_editar.oficina" :readonly="!auth()->user()->hasRole('Administrador')"/>

                </x-input-group>

                <x-input-group for="modelo_editar.tipo_predio" label="Tipo de predio" :error="$errors->first('modelo_editar.tipo_predio')" class="w-full">

                    <x-input-text type="number" id="modelo_editar.tipo_predio" wire:model="modelo_editar.tipo_predio" />

                </x-input-group>

                <x-input-group for="modelo_editar.numero_registro" label="# Registro" :error="$errors->first('modelo_editar.numero_registro')" class="w-full">

                    <x-input-text type="number" id="modelo_editar.numero_registro" wire:model="modelo_editar.numero_registro" />

                </x-input-group>

            </div>

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                <x-input-group for="modelo_editar.nombre" label="Nombre del predio" :error="$errors->first('modelo_editar.nombre')" class="w-full">

                    <x-input-text type="numeric" id="modelo_editar.nombre" wire:model="modelo_editar.nombre" />

                </x-input-group>

            </div>

            <div class="mb-8">

                <x-filepond wire:model.live="files" accept="['application/pdf']" multiple/>

            </div>

            <x-input-group for="files.*" label="" :error="$errors->first('files.*')" class="w-full">

                <div class="flex flex-row flex-wrap gap-2 items-center mb-2">

                    @foreach ($files_edit as $file)

                        <div class="flex gap-2 bg-red-200 rounded-full p-1">

                            @if(env('LOCAL') === "0" || env('LOCAL') === "2")

                                <a
                                    href="{{ Storage::disk('predios_catastro')->url($file['url'])}}"
                                    target="_blank"
                                    class="bg-red-400 hover:shadow-lg text-white text-xs px-3 py-1 rounded-full hover:bg-red-700 focus:outline-red-900 w-auto"
                                >
                                    PDF {{ $loop->iteration }}
                                </a>
                            @elseif(env('LOCAL') === "1")
                                <a
                                    href="{{ Storage::disk('s3')->temporaryUrl($file['url'], now()->addMinutes(1)) }}"
                                    target="_blank"
                                    class="bg-red-400 hover:shadow-lg text-white text-xs px-3 py-1 rounded-full hover:bg-red-700 focus:outline-red-900 w-auto"
                                >
                                    PDF {{ $loop->iteration }}
                                </a>
                            @endif

                            <button
                                wire:click="openModalDeleteFile({{$file['id']}})"
                                wire:loading.attr="disabled"
                                wire:target="openModalDeleteFile({{$file['id']}})"
                                class="bg-red-400 hover:shadow-lg text-white text-xs px-3 py-1 rounded-full hover:bg-red-700 flex focus:outline-red-900"
                            >

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>

                            </button>

                        </div>

                    @endforeach

                </div>

            </x-input-group>

        </x-slot>

        <x-slot name="footer">

            <div class="flex gap-3">

                @if($crear)

                    <x-button-blue
                        wire:click="guardar"
                        wire:loading.attr="disabled"
                        wire:target="guardar">

                        <img wire:loading wire:target="guardar" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                        Guardar
                    </x-button-blue>

                @elseif($editar)

                    <x-button-blue
                        wire:click="actualizar"
                        wire:loading.attr="disabled"
                        wire:target="actualizar">

                        <img wire:loading wire:target="actualizar" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                        Actualizar
                    </x-button-blue>

                @endif

                <x-button-red
                    wire:click="resetearTodo"
                    wire:loading.attr="disabled"
                    wire:target="resetearTodo"
                    type="button">
                    Cerrar
                </x-button-red>

            </div>

        </x-slot>

    </x-dialog-modal>

    <x-dialog-modal wire:model="modalVer">

        <x-slot name="title">
            Ver predio
        </x-slot>

        <x-slot name="content">

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                <x-input-group for="modelo_editar.localidad" label="Localidad" :error="$errors->first('modelo_editar.localidad')" class="w-full">

                    <x-input-text type="number" id="modelo_editar.localidad" wire:model="modelo_editar.localidad" readonly/>

                </x-input-group>

                <x-input-group for="modelo_editar.oficina" label="Oficina" :error="$errors->first('modelo_editar.oficina')" class="w-full">

                    <x-input-text type="number" id="modelo_editar.oficina" wire:model="modelo_editar.oficina" readonly/>

                </x-input-group>

                <x-input-group for="modelo_editar.tipo_predio" label="Tipo de predio" :error="$errors->first('modelo_editar.tipo_predio')" class="w-full">

                    <x-input-text type="number" id="modelo_editar.tipo_predio" wire:model="modelo_editar.tipo_predio" readonly/>

                </x-input-group>

                <x-input-group for="modelo_editar.numero_registro" label="# Registro" :error="$errors->first('modelo_editar.numero_registro')" class="w-full">

                    <x-input-text type="number" id="modelo_editar.numero_registro" wire:model="modelo_editar.numero_registro" readonly/>

                </x-input-group>

            </div>

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                <x-input-group for="modelo_editar.nombre" label="Nombre del predio" :error="$errors->first('modelo_editar.nombre')" class="w-full">

                    <x-input-text type="numeric" id="modelo_editar.nombre" wire:model="modelo_editar.nombre" readonly/>

                </x-input-group>

            </div>

            <x-input-group for="files.*" label="" :error="$errors->first('files.*')" class="w-full">

                <div class="flex flex-row flex-wrap gap-2 items-center mb-2">

                    @foreach ($modelo_editar->archivos as $file)

                        <div class="flex gap-2 bg-red-200 rounded-full p-1">

                            @if(env('LOCAL') === "0" || env('LOCAL') === "2")

                                <a
                                    href="{{ Storage::disk('predios_catastro')->url($file['url'])}}"
                                    target="_blank"
                                    class="bg-red-400 hover:shadow-lg text-white text-xs px-3 py-1 rounded-full hover:bg-red-700 focus:outline-red-900 w-auto"
                                >
                                    Tarjeta {{ $loop->iteration }}
                                </a>
                            @elseif(env('LOCAL') === "1")
                                <a
                                    href="{{ Storage::disk('s3')->temporaryUrl($file['url'], now()->addMinutes(1)) }}"
                                    target="_blank"
                                    class="bg-red-400 hover:shadow-lg text-white text-xs px-3 py-1 rounded-full hover:bg-red-700 focus:outline-red-900 w-auto"
                                >
                                    Tarjeta {{ $loop->iteration }}
                                </a>

                            @endif

                        </div>

                    @endforeach

                    @if($carpeta)

                        <div class="flex gap-2 bg-red-200 rounded-full p-1">

                            @if(env('LOCAL') === "0" || env('LOCAL') === "2")

                                <a
                                    href="{{ $carpeta }}"
                                    target="_blank"
                                    class="bg-red-400 hover:shadow-lg text-white text-xs px-3 py-1 rounded-full hover:bg-red-700 focus:outline-red-900 w-auto"
                                >
                                    Carpeta
                                </a>
                            @elseif(env('LOCAL') === "1")
                                <a
                                    href="{{ $carpeta }}"
                                    target="_blank"
                                    class="bg-red-400 hover:shadow-lg text-white text-xs px-3 py-1 rounded-full hover:bg-red-700 focus:outline-red-900 w-auto"
                                >
                                    Carpeta
                                </a>

                            @endif

                        </div>

                    @endif

                </div>

            </x-input-group>

            <div class="text-center">
                <span class="text-base">Movimientos</span>
            </div>

            @foreach ($modelo_editar->movimientos as $movimiento)

                <div class="p-2 bg-gray-100 rounded-lg mb-2">

                    <div class="flex gap-2 justify-end">

                        <span class="rounded-full p-1 " title="Editar" data-toggle="tooltip">

                            <x-button-blue
                                wire:click="editarMovimiento({{ $movimiento->id }})"
                                wire:loading.attr="disabled"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>

                            </x-button-blue>

                        </span>

                        <span class="rounded-full p-1" title="Eliminar" data-toggle="tooltip">

                            <x-button-red
                                wire:click="abrirModalBorrarMovimiento({{ $movimiento->id }})"
                                wire:loading.attr="disabled"
                            >

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>

                            </x-button-red>

                        </span>

                    </div>

                    <p><strong>Fecha:</strong> {{ $movimiento->fecha_formateada }}</p>

                    <p><strong>Comprobante:</strong> Número: {{ $movimiento->comprobante_numero ?? 'N/A' }} / Año: {{ $movimiento->comprobante_año }}</p>

                    @foreach ($legajos as $legajo)

                        @if($legajo['movimiento_id'] == $movimiento->id)

                            @foreach ($legajo['legajos'] as $legajo)

                                @if(env('LOCAL') === "0" || env('LOCAL') === "2")

                                <a
                                    href="{{ Storage::disk('legajos_catastro')->url($legajo) }}"
                                    class="bg-blue-400 px-2 text-white rounded-full mr-2 whitespace-nowrap hover:cursor-pointer hover:bg-blue-500"
                                    target="_blank">
                                    Legajo {{ $legajo }}
                                </a>

                                @elseif(env('LOCAL') === "1")

                                    <a
                                        href="{{ Storage::disk('s3')->temporaryUrl($legajo, now()->addMinutes(1)) }}"
                                        target="_blank"
                                        class="bg-blue-400 px-2 text-white rounded-full mr-2 whitespace-nowrap hover:cursor-pointer hover:bg-blue-500"
                                    >
                                        Legajo {{ $legajo }}
                                    </a>

                                @endif

                            @endforeach

                        @endif

                    @endforeach

                    <p><strong>Cuenta:</strong> Tomo: {{ $movimiento->cuenta_tomo }} / Folio: {{ $movimiento->cuenta_folio ?? 'N/A' }}</p>

                    @if($movimiento->cuenta_tomo && $movimiento->cuenta_folio)

                        @foreach ($tomos as $tomo)

                            @if($tomo['movimiento_id'] == $movimiento->id)

                                @foreach ($tomo['tomos'] as $tomo)

                                    @if(env('LOCAL') === "0" || env('LOCAL') === "2")

                                        <a
                                            href="{{ Storage::disk('tomos_catastro')->url($tomo) }}"
                                            class="bg-blue-400 px-2 text-white rounded-full mr-2 whitespace-nowrap hover:cursor-pointer hover:bg-blue-500"
                                            target="_blank">
                                            Tomo {{ $tomo }}
                                        </a>

                                    @elseif(env('LOCAL') === "1")

                                        <a
                                            href="{{ Storage::disk('s3')->temporaryUrl($tomo, now()->addMinutes(1)) }}"
                                            target="_blank"
                                            class="bg-blue-400 px-2 text-white rounded-full mr-2 whitespace-nowrap hover:cursor-pointer hover:bg-blue-500"
                                        >
                                            Tomo {{ $tomo }}
                                        </a>

                                    @endif

                                @endforeach

                            @endif

                        @endforeach

                    @endif

                    <p><strong>Propietario:</strong> {{ $movimiento->propietario }}</p>
                    @if($movimiento->observaciones)
                        <p><strong>Observaciones:</strong> {{ $movimiento->observaciones }}</p>
                    @endif

                </div>

            @endforeach

        </x-slot>

        <x-slot name="footer">

            <x-button-red
                wire:click="resetearTodo"
                wire:loading.attr="disabled"
                wire:target="resetearTodo"
                type="button">
                Cerrar
            </x-button-red>

        </x-slot>

    </x-dialog-modal>

    <x-dialog-modal wire:model="modalMovimineto" maxWidth="sm">

        <x-slot name="title">

            @if($crear)
                Agregar movimiento
            @elseif($editar)
                Editar movimiento
            @endif

        </x-slot>

        <x-slot name="content">

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                <x-input-group for="movimiento.fecha" label="Fecha" :error="$errors->first('movimiento.fecha')" class="w-full">

                    <x-input-text type="date" id="movimiento.fecha" wire:model="movimiento.fecha"/>

                </x-input-group>

            </div>

            <div class="text-center">
                <span >Comprobante</span>
            </div>

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                <x-input-group for="movimiento.comprobante_numero" label="Número" :error="$errors->first('movimiento.comprobante_numero')" class="w-full">

                    <x-input-text type="number" id="movimiento.comprobante_numero" wire:model="movimiento.comprobante_numero"/>

                </x-input-group>

                <x-input-group for="movimiento.comprobante_año" label="Año" :error="$errors->first('movimiento.comprobante_año')" class="w-full">

                    <x-input-text type="number" id="movimiento.comprobante_año" wire:model="movimiento.comprobante_año"/>

                </x-input-group>

            </div>

            <div class="text-center">
                <span >Cuenta</span>
            </div>

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                <x-input-group for="movimiento.cuenta_tomo" label="Tomo" :error="$errors->first('movimiento.cuenta_tomo')" class="w-full">

                    <x-input-text type="number" id="movimiento.cuenta_tomo" wire:model="movimiento.cuenta_tomo"/>

                </x-input-group>

                <x-input-group for="movimiento.cuenta_folio" label="Folio" :error="$errors->first('movimiento.cuenta_folio')" class="w-full">

                    <x-input-text type="number" id="movimiento.cuenta_folio" wire:model="movimiento.cuenta_folio"/>

                </x-input-group>

            </div>

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                <x-input-group for="movimiento.propietario" label="Propietario" :error="$errors->first('movimiento.propietario')" class="w-full">

                    <x-input-text type="numeric" id="movimiento.propietario" wire:model="movimiento.propietario"/>

                </x-input-group>

            </div>

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                <x-input-group for="movimiento.observaciones" label="Observaciones" :error="$errors->first('movimiento.observaciones')" class="w-full">

                    <textarea rows="5" class="bg-white rounded text-sm w-full" wire:model="movimiento.observaciones"></textarea>

                </x-input-group>

            </div>

        </x-slot>

        <x-slot name="footer">

            <div class="flex gap-3">

                @if($crear)

                    <x-button-blue
                        wire:click="guardarMovimiento"
                        wire:loading.attr="disabled"
                        wire:target="guardarMovimiento">

                        <img wire:loading wire:target="guardarMovimiento" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                        Guardar
                    </x-button-blue>

                @elseif($editar)

                    <x-button-blue
                        wire:click="actualizarMovimiento"
                        wire:loading.attr="disabled"
                        wire:target="actualizarMovimiento">

                        <img wire:loading wire:target="actualizarMovimiento" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                        Actualizar
                    </x-button-blue>

                @endif

                <x-button-red
                    wire:click="resetearTodo"
                    wire:loading.attr="disabled"
                    wire:target="resetearTodo"
                    type="button">
                    Cerrar
                </x-button-red>

            </div>

        </x-slot>

    </x-dialog-modal>

    <x-confirmation-modal wire:model="modalBorrar" maxWidth="sm">

        <x-slot name="title">
            Eliminar predio
        </x-slot>

        <x-slot name="content">
            ¿Esta seguro que desea eliminar el predio? No sera posible recuperar la información.
        </x-slot>

        <x-slot name="footer">

            <x-secondary-button
                wire:click="$toggle('modalBorrar')"
                wire:loading.attr="disabled"
            >
                No
            </x-secondary-button>

            <x-danger-button
                class="ml-2"
                wire:click="borrar()"
                wire:loading.attr="disabled"
                wire:target="borrar"
            >
                Borrar
            </x-danger-button>

        </x-slot>

    </x-confirmation-modal>

    <x-confirmation-modal wire:model="modalEliminar" maxWidth="sm">

        <x-slot name="title">
            Eliminar archivo
        </x-slot>

        <x-slot name="content">
            ¿Esta seguro que desea eliminar el archivo? No sera posible recuperar la información.
        </x-slot>

        <x-slot name="footer">

            <x-secondary-button
                wire:click="$toggle('modalEliminar')"
                wire:loading.attr="disabled"
            >
                No
            </x-secondary-button>

            <x-danger-button
                class="ml-2"
                wire:click="borrarArchivo"
                wire:loading.attr="disabled"
                wire:target="borrarArchivo"
            >
                Borrar
            </x-danger-button>

        </x-slot>

    </x-confirmation-modal>

    <x-confirmation-modal wire:model="modalEliminarMovimiento" maxWidth="sm">

        <x-slot name="title">
            Eliminar movimiento
        </x-slot>

        <x-slot name="content">
            ¿Esta seguro que desea eliminar el movimiento? No sera posible recuperar la información.
        </x-slot>

        <x-slot name="footer">

            <x-secondary-button
                wire:click="$toggle('modalEliminarMovimiento')"
                wire:loading.attr="disabled"
            >
                No
            </x-secondary-button>

            <x-danger-button
                class="ml-2"
                wire:click="borrarMovimiento"
                wire:loading.attr="disabled"
                wire:target="borrarMovimiento"
            >
                Borrar
            </x-danger-button>

        </x-slot>

    </x-confirmation-modal>

</div>
