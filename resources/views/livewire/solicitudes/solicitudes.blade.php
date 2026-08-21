<div class="">

    <div class="mb-6">

        <x-header>Solicitudes</x-header>

        <div class="flex justify-between">

            <div class="flex gap-3">

                <input type="text" wire:model.live.debounce.500ms="solicitante" placeholder="Buscar" class="bg-white rounded-full text-sm">

                <x-input-select class="bg-white rounded-full text-sm w-min" wire:model.live="estado">

                    <option value="">Estado</option>
                    <option value="nuevo">Nuevo</option>
                    <option value="entregado">Entregado</option>
                    <option value="concluido">Concluido</option>

                </x-input-select>

                <x-input-select class="bg-white rounded-full text-sm w-min" wire:model.live="pagination">

                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>

                </x-input-select>

            </div>

        </div>

    </div>

    <div class="overflow-x-auto rounded-lg shadow-xl border-t-2 border-t-gray-500">

        <x-table>

            <x-slot name="head">

                <x-table.heading sortable wire:click="sortBy('folio')" :direction="$sort === 'folio' ? $direction : null" >Folio</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('predios_count')" :direction="$sort === 'predios_count' ? $direction : null" >Archivos</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('solicitante')" :direction="$sort === 'solicitante' ? $direction : null" >Solicitante</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('estado')" :direction="$sort === 'estado' ? $direction : null" >estado</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('created_at')" :direction="$sort === 'created_at' ? $direction : null">Registro</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('updated_at')" :direction="$sort === 'updated_at' ? $direction : null">Actualizado</x-table.heading>
                <x-table.heading >Acciones</x-table.heading>

            </x-slot>

            <x-slot name="body">

                @forelse ($this->solicitudes as $solicitud)

                    <x-table.row wire:loading.class.delaylongest="opacity-50" wire:key="row-{{ $solicitud->id }}">

                        <x-table.cell title="Folio">

                            {{ $solicitud->folio }}

                        </x-table.cell>

                        <x-table.cell title="Archivos">

                            {{ $solicitud->predios_count }}

                        </x-table.cell>

                        <x-table.cell title="Solicitante">

                            {{ $solicitud->solicitante }}

                        </x-table.cell>

                        <x-table.cell title="Estado">

                            <span class="bg-{{ $solicitud->estado_color }} py-1 px-2 rounded-full text-white text-xs">{{ ucfirst($solicitud->estado) }}</span>

                        </x-table.cell>

                        <x-table.cell title="Registrado">

                            {{ $solicitud->created_at }}

                        </x-table.cell>

                        <x-table.cell title="Actualizado">

                            <span class="font-semibold">@if($solicitud->actualizadoPor != null)Actualizado por: {{$solicitud->actualizadoPor->name}} @else Actualizado: @endif</span> <br>

                            {{ $solicitud->updated_at }}

                        </x-table.cell>

                        <x-table.cell>

                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Acciones</span>

                            <div class="ml-3 relative" x-data="{ open_drop_down:false }">

                                <div>

                                    <button x-on:click="open_drop_down=true" type="button" class="rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                        </svg>

                                    </button>

                                </div>

                                <div x-cloak x-show="open_drop_down" x-on:click="open_drop_down=false" x-on:click.away="open_drop_down=false" class="z-50 origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">

                                    @can('Ver solicitud')

                                        <button
                                            wire:click="abrirModalVer({{ $solicitud->id }})"
                                            wire:loading.attr="disabled"
                                            class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                                            role="menuitem">
                                            Ver solicitud
                                        </button>

                                    @endcan

                                    @can('Borrar solicitud')

                                        <button
                                            wire:click="borrar({{ $solicitud->id }})"
                                            wire:loading.attr="disabled"
                                            wire:confirm="¿Esta seguro que desea eliminar la solicitud?"
                                            class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                                            role="menuitem">
                                            Borrar solicitud
                                        </button>

                                    @endcan

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

                        {{ $this->solicitudes->links()}}

                    </x-table.cell>

                </x-table.row>

            </x-slot>

        </x-table>

    </div>

    <x-dialog-modal wire:model="modalVer">

        <x-slot name="title">

            <p>Solicitud: {{ $modelo_editar ? $modelo_editar->folio : '' }}</p>

            <p>Solicitante: {{ $modelo_editar ? $modelo_editar->solicitante : '' }}</p>

        </x-slot>

        <x-slot name="content">

            @if($modelo_editar->getKey())

                <div class="overflow-x-auto">

                    <table class="rounded-lg shadow-xl w-full overflow-hidden table-auto lg:table-fixed">

                        <thead class="border-b border-gray-300 bg-gray-50">

                            <tr class="text-xs text-gray-500 uppercase text-left traling-wider">
                                <th class="px-2 py-3">Predio</th>
                                <th class="px-2 py-3">Entregado el</th>
                                <th class="px-2 py-3">Recibido el</th>
                                @if($modelo_editar->estado == "entregado")
                                    <th></th>
                                @endif
                            </tr>

                        </thead>

                        <tbody class="divide-y divide-gray-200">

                            @foreach ($predios_solicitados as $predio_solicitud)

                                <tr class="text-sm text-gray-500 bg-white">

                                    <td class="px-2 py-3 w-full text-gray-800 text-sm">

                                        {{ $predio_solicitud->predio->cuentaPredial() }}

                                    </td>
                                    <td class="px-2 py-3 w-full text-gray-800 text-sm">

                                        @if($predio_solicitud->entregadoPor != null)

                                            Entregado por: <span class="font-semibold">{{$predio_solicitud->entregadoPor->name}}</span> <br>

                                            @else

                                            ----------

                                        @endif

                                        {{ $predio_solicitud->entregado_en?->format('d-m-Y H:i:s') }}

                                    </td>
                                    <td class="px-2 py-3 w-full text-gray-800 text-sm">

                                        @if($predio_solicitud->recibidoPor != null)

                                            Recibido por:   <span class="font-semibold">{{$predio_solicitud->recibidoPor->name}}</span> <br>

                                            @else

                                            ----------

                                        @endif

                                        {{ $predio_solicitud->recibido_en?->format('d-m-Y H:i:s') }}

                                    </td>

                                    @if($modelo_editar->estado == "entregado" && $predio_solicitud->recibido_por == null)

                                        <td>

                                            <x-button-blue
                                                wire:click="recibirArchivo({{ $predio_solicitud->id }})"
                                                wire:loading.attr="disabled"
                                                wire:target="recibirArchivo({{ $predio_solicitud->id }})"
                                                wire:confirm="¿Esta seguro que desea recibir el archivo?">

                                                <img wire:loading wire:target="recibirArchivo({{ $predio_solicitud->id }})" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                                                Recibir

                                            </x-button-blue>

                                        </td>

                                    @endif

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @endif

        </x-slot>

        <x-slot name="footer">

            <div class="flex gap-4">

                @if($modelo_editar->getKey() && $modelo_editar->estado == 'nuevo')

                    <x-button-blue
                        wire:click="entregarSolicitud"
                        wire:loading.attr="disabled"
                        wire:target="entregarSolicitud">

                        <img wire:loading wire:target="entregarSolicitud" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                        Entregar
                    </x-button-blue>

                @elseif($modelo_editar->getKey() && $modelo_editar->estado == 'entregado')

                    <x-button-blue
                        wire:click="recibirTodo"
                        wire:loading.attr="disabled"
                        wire:target="recibirTodo">

                        <img wire:loading wire:target="entregarSolicitud" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                        Recibir todo
                    </x-button-blue>

                @endif

                <x-button-red
                    wire:click="$toggle('modalVer')"
                    wire:loading.attr="disabled"
                    wire:target="$toggle('modalVer')"
                    type="button">
                    Cerrar
                </x-button-red>

            </div>

        </x-slot>

    </x-dialog-modal>

</div>
