@props(['id', 'label', 'name', 'value' => ''])

<label for="{{ $id }}">{{ $label }}</label>
        <div>
            <textarea type="text" id="{{ $id }}" name="{{ $name }}" class="form-control @error($name) is-invalid @enderror" rows="6" name="{{ $name }}">{{ old($name, $value) }}</textarea>
            @error($name)
            <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>