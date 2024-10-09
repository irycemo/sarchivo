<div>

    <x-header>Consulta</x-header>

    <div>

        <div class="bg-white shadow-lg p-4 rounded-lg mb-5">

            <div class="flex justify-center">

                <input type="number" placeholder="localidad" min="1" class="bg-white rounded-l border-r-0 text-sm w-20 focus:ring-0 @error('localidad') border-red-500 @enderror" wire:model="localidad">

                <input type="number" placeholder="oficina" min="1" class="bg-white text-sm  w-20 focus:ring-0 @error('oficina') border-red-500 @enderror" wire:model="oficina" @if(!auth()->user()->hasRole('Administrador')) readonly @endif>

                <input type="number" placeholder="Tipo" min="1" max="2" class="bg-white text-sm w-20 focus:ring-0 border-l-0 @error('tipo') border-red-500 @enderror" wire:model="tipo">

                <input type="number" placeholder="Registro" min="1" class="bg-white text-sm w-20 focus:ring-0 border-l-0 @error('registro') border-red-500 @enderror" wire:model="registro">

                <button
                    wire:click="buscarPredio"
                    wire:loading.attr="disabled"
                    wire:target="buscarPredio"
                    type="button"
                    class="bg-blue-400 hover:shadow-lg text-white font-bold px-4 rounded-r text-sm hover:bg-blue-700 focus:outline-blue-400 focus:outline-offset-2">

                    <img wire:loading wire:target="buscarPredio" class="mx-auto h-5 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                    <svg wire:loading.remove wire:target="buscarPredio" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>

                </button>

            </div>

        </div>
        @if($predio)

            <div class="bg-white shadow-lg p-4 rounded-lg text-sm">

                <div class="md:w-1/2 lg:w-1/3 w-full mx-auto space-y-2">

                    <div class="rounded-lg bg-gray-100 py-1 px-2">

                        <strong>Cuenta predial</strong>

                        <p>{{ $predio->cuentaPredial() }}</p>

                    </div>

                    <div class="rounded-lg bg-gray-100 py-1 px-2">

                        <strong>Nombre del predio</strong>

                        <p>{{ $predio->nombre }}</p>

                    </div>

                    <div class="flex gap-2 bg-gray-100 rounded-lg p-1">

                        @if($predio->archivos)

                                @foreach ($predio->archivos as $file)

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

                                @endforeach

                        @endif

                        @if($carpeta)

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

                        @endif

                    </div>

                    <span class="font-bold tracking-wide my-2 text-center block">Movimientos</span>

                    @foreach ($predio->movimientos as $movimiento)

                        <div class="space-y-2 bg-gray-100 p-2 rounded-lg">

                            <div class="">

                                <p><strong>Fecha:</strong> {{ $movimiento->fecha_formateada }}</p>

                            </div>

                            <div class="">

                                <p><strong>Comprobante (Número/Año):</strong> {{ $movimiento->comprobante_numero }}/{{ $movimiento->comprobante_año }}</p>

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

                            </div>

                            <div class="">

                                <p><strong>Cuenta (Tomo/Folio):</strong> {{ $movimiento->cuenta_tomo }}/{{ $movimiento->cuenta_folio }}</p>

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

                            </div>

                            <div class="">

                                <p><strong>Propietario:</strong> {{ $movimiento->propietario }}</p>

                            </div>

                            <div class="">

                                <p><strong>Observaciones: </strong> {{ $movimiento->observaciones }}</p>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        @endif

    </div>

</div>
