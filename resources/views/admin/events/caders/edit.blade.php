
<form action="{{route('admin.events.update_cader')}}" method="POST" id="edit-cader">
    @csrf 

    <input type="hidden" value="{{ $event_id }}" name="event_id"> 
    <input type="hidden" value="{{ $cader_id }}" name="cader_id" id="cader_id">
    <input type="hidden" value="{{ $specialize_id }}" name="specialize_id" id="specialize_id">
    <div class="row"> 
        <div class="col-md-6">
            {{-- profit --}}
            <div class="form-group">
                <label class="required" for="profit">{{ trans('cruds.event.others.profit') }}</label>
                <input class="form-control {{ $errors->has('profit') ? 'is-invalid' : '' }}" type="number" name="profit" id="profit_modal" value="{{ old('profit',$profit) }}" required>
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
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price_modal" value="{{ old('price',$price) }}" required>
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