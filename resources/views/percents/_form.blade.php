@csrf
<div class="card-body">
    <div class="form-group">
        <label for="percent">Porcentaje</label>
        <input id="percent" class="form-control @error('percent') is-invalid @enderror" type="number" min="1" max="100"
            name="percent" value="{{ old('percent', $percent->percent) }}" required>
        @error('percent')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<footer class="card-footer text-right">
    <button class="btn btn-primary" type="submit">{{ $btnText }}</button>
</footer>
