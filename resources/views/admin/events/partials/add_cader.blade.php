
    <div class="form-group">
        <label class="required" for="cader_id">{{ trans('cruds.cader.title_singular') }}</label>
        <select class="form-control select2 {{ $errors->has('cader_id') ? 'is-invalid' : '' }}" name="cader_id" id="cader_id" required>
            @foreach($caders as $cader)
                <option value="{{ $cader->id }}" {{ old('cader_id') == $cader->id ? 'selected' : '' }}>{{ $cader->user->first_name . " " . $cader->user->last_name }}</option>
            @endforeach
        </select>
        @if($errors->has('cader_id'))
            <div class="invalid-feedback">
                {{ $errors->first('cader_id') }}
            </div>
        @endif 
    </div>