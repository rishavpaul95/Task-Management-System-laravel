<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <input type="{{ $type }}" class="form-control" name="{{ $name }}" placeholder="{{ $placeholder }}"
        value="{{ old($name) }}">
    <span class="text-danger">
        @error($name)
            {{ $message }}
        @enderror
    </span>
</div>