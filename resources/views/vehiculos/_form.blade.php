<div class="bg-white p-6 rounded shadow space-y-4">

    {{-- PLACA --}}
    <div>
        <label class="block text-sm font-medium text-gray-700">Placa</label>
        <input type="text"
               name="placa"
               class="w-full mt-1 p-2 border rounded focus:ring focus:ring-blue-200"
               value="{{ old('placa', $vehiculo->placa ?? '') }}">
    </div>

    {{-- VIN --}}
    <div>
        <label class="block text-sm font-medium text-gray-700">VIN</label>
        <input type="text"
               name="vin"
               class="w-full mt-1 p-2 border rounded focus:ring focus:ring-blue-200"
               value="{{ old('vin', $vehiculo->vin ?? '') }}">
    </div>

    {{-- MODELO (CORRECTO) --}}
    <div>
        <label class="block text-sm font-medium text-gray-700">Modelo</label>

        <select name="modelo_id"
                class="w-full mt-1 p-2 border rounded">

            <option value="">Seleccionar modelo</option>

            @foreach($modelos as $modelo)
                <option value="{{ $modelo->id }}"
                    @selected(old('modelo_id', $vehiculo->modelo_id ?? '') == $modelo->id)>

                    {{ $modelo->marca->nombre }} - {{ $modelo->nombre }}

                </option>
            @endforeach

        </select>
    </div>

    {{-- COLOR (CORRECTO) --}}
    <div>
        <label class="block text-sm font-medium text-gray-700">Color</label>

        <select name="color_id"
                class="w-full mt-1 p-2 border rounded">

            <option value="">Seleccionar color</option>

            @foreach($colores as $color)
                <option value="{{ $color->id }}"
                    @selected(old('color_id', $vehiculo->color_id ?? '') == $color->id)>

                    {{ $color->nombre }}

                </option>
            @endforeach

        </select>
    </div>

    {{-- AÑO --}}
    <div>
        <label class="block text-sm font-medium text-gray-700">Año</label>

        <input type="number"
               name="anio"
               class="w-full mt-1 p-2 border rounded"
               value="{{ old('anio', $vehiculo->anio ?? '') }}">
    </div>

    {{-- PRECIO --}}
    <div>
        <label class="block text-sm font-medium text-gray-700">Precio Lista</label>

        <input type="number"
               step="0.01"
               name="precio_lista"
               class="w-full mt-1 p-2 border rounded"
               value="{{ old('precio_lista', $vehiculo->precio_lista ?? '') }}">
    </div>

    {{-- ESTADO --}}
    <div>
        <label class="block text-sm font-medium text-gray-700">Estado</label>

        <select name="estado" class="w-full mt-1 p-2 border rounded">

            <option value="disponible" @selected(old('estado', $vehiculo->estado ?? '') == 'disponible')>
                Disponible
            </option>

            <option value="reservado" @selected(old('estado', $vehiculo->estado ?? '') == 'reservado')>
                Reservado
            </option>

            <option value="vendido" @selected(old('estado', $vehiculo->estado ?? '') == 'vendido')>
                Vendido
            </option>

        </select>
    </div>

</div>