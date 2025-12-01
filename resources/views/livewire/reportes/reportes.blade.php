<div>

    <x-header>Reportes</x-header>

    <div class="p-4 mb-5 bg-white shadow-lg rounded-lg flex justify-center">

        <x-input-group for="area" label="Área" :error="$errors->first('area')" class="">

            <x-input-select id="area" wire:model.live="area">

                <option selected value="">Selecciona una área</option>
                <option value="movimientos">Movimientos</option>
                <option value="predios">Predios</option>

            </x-input-select>

        </x-input-group>

    </div>

    @if ($verMovimientos)

        @livewire('reportes.movimientos')

    @endif

    @if ($verPredios)

        @livewire('reportes.predios')

    @endif

</div>
