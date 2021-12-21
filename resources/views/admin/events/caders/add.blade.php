
<form action="{{route('admin.events.add_cader')}}" id="add-cader" method="POST">
    @csrf  

    <input type="hidden" value="{{ $event_id }}" name="event_id">
    <input type="hidden" id="event_specialize" value="{{ $specialize_id }}"  name="specialize_id">

    {{-- cader --}} 
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

    <div class="row">
        <div class="col-md-6">
            {{-- profit --}}
            <div class="form-group">
                <label class="required" for="profit">{{ trans('cruds.event.others.profit') }}</label>
                <input class="form-control {{ $errors->has('profit') ? 'is-invalid' : '' }}" type="number" name="profit" id="profit_modal" value="{{ old('profit') }}" required>
                @if($errors->has('profit'))
                    <div class="invalid-feedback">
                        {{ $errors->first('profit') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            {{-- price --}}
            <div class="form-group">
                <label class="required" for="price">{{ trans('cruds.event.others.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price_modal" value="{{ old('price') }}" required>
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            {{-- start_attendance --}}
            <div class="form-group">
                <label class="required" for="start_attendance">{{ trans('cruds.event.fields.start_attendance') }}</label>
                <input class="form-control datetime {{ $errors->has('start_attendance') ? 'is-invalid' : '' }}" type="text" name="start_attendance" id="start_attendance_modal" value="{{ old('start_attendance',$start_attendance) }}" required>
                @if($errors->has('start_attendance'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_attendance') }}
                    </div>
                @endif
            </div> 
        </div>
        <div class="col-md-6">
            {{-- end_attendance --}}
            <div class="form-group">
                <label class="required" for="end_attendance">{{ trans('cruds.event.fields.end_attendance') }}</label>
                <input class="form-control datetime {{ $errors->has('end_attendance') ? 'is-invalid' : '' }}" type="text" name="end_attendance" id="end_attendance_modal" value="{{ old('end_attendance',$end_attendance) }}" required>
                @if($errors->has('end_attendance'))
                    <div class="invalid-feedback">
                        {{ $errors->first('end_attendance') }}
                    </div>
                @endif
            </div>
        </div> 
    </div>
    <hr>
    <button type="submit" class="btn btn-success">{{trans('global.save')}}</button>
</form>