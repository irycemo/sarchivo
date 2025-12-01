<div>

    <div class="md:flex md:flex-row flex-col justify-center md:space-x-4 items-end bg-white rounded-xl mb-5 p-4 shadow-xl">

        <x-input-group for="fecha1" label="Fecha inicial" :error="$errors->first('fecha1')">

            <x-input-text type="date" id="fecha1" wire:model.live="fecha1" />

        </x-input-group>

        <x-input-group for="fecha2" label="Fecha final" :error="$errors->first('fecha2')">

            <x-input-text type="date" id="fecha2" wire:model.live="fecha2" />

        </x-input-group>

    </div>

    <div class="md:flex flex-col md:flex-row justify-center md:space-x-3 items-center bg-white rounded-xl mb-5 p-4 shadow-xl">

        <x-input-group for="oficina" label="Oficina" :error="$errors->first('oficina')" class="">

            <x-input-select id="oficina" wire:model.live="oficina">

                <option value="">Seleccione una opción</option>
                @foreach ($oficinas as $oficina)

                    <option value="{{ $oficina->oficina }}">{{ $oficina->nombre }}</option>

                @endforeach

            </x-input-select>

        </x-input-group>

        <x-input-group for="usuario" label="Usuario" :error="$errors->first('usuario')" class="">

            <x-input-select id="usuario" wire:model.live="usuario">

                <option value="">Seleccione una opción</option>

                @foreach ($usuarios as $item)

                    <option value="{{ $item->id }}">{{ $item->name }}</option>

                @endforeach

            </x-input-select>

        </x-input-group>

    </div>

    @if($this->movimientos)

        <div class="bg-white rounded-lg shadow-xl p-8 w-min text-center mx-auto">

            <p class="text-xl">{{ $this->movimientos }}</p>

            <p>Movimientos</p>

            @if($usuario)

                <p class="text-sm whitespace-nowrap">Registrados por:</p>
                <p class="text-sm whitespace-nowrap">{{ $usuarios->where('id', $this->usuario)->first()->name }}</p>

            @endif

        </div>

    @else

        <div class="bg-white rounded-lg shadow-xl p-8 w-min text-center mx-auto">

            <p class="text-xl">0</p>

            <p>Movimientos</p>

            @if($usuario)

                <p class="text-sm whitespace-nowrap">Registrados por:</p>
                <p class="text-sm whitespace-nowrap">{{ $usuarios->where('id', $this->usuario)->first()->name }}</p>

            @endif

        </div>

    @endif

</div>
