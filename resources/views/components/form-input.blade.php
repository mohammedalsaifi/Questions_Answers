@props(['label', 'id', 'name', 'value' => ''])
<label for="{{ $id }}">{{ $label }}</label>
        <div>
            <input type="text" id="{{ $id }}" class="form-control @error($name) is-invalid @enderror" name="{{ $name }}" value="{{ old($name, $value) }}" />
            @error( $name )
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror 
        </div>