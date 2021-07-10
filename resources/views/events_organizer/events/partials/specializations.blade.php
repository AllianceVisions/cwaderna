

<label class="required">{{ trans('cruds.event.fields.specializations') }}</label>
<table class="table">
    @php $name = 'name_'.app()->getLocale();@endphp
    @foreach($specializations as $specialize)
        <tr>
            <td><input {{ $specialize->value || old('specializations.'.$specialize->id) ? 'checked' : null }} data-id="{{ $specialize->id }}" type="checkbox" class="specialization-enable"></td>
            <td>{{ $specialize->$name }}</td>
            <td><input value="{{ old('specializations.'.$specialize->id ,$specialize->num_of_caders) ?? null }}" {{ $specialize->num_of_caders || old('specializations.'.$specialize->id) ? null : 'disabled' }} data-id="{{ $specialize->id }}" name="specializations[{{ $specialize->id }}][num_of_caders]" type="number" step="1" min="0" class="specialization-number form-control" placeholder="Number"></td>
            <td><input value="{{ old('specializations.'.$specialize->id ,$specialize->budget) ?? null }}" {{ $specialize->budget || old('specializations.'.$specialize->id) ? null : 'disabled' }} data-id="{{ $specialize->id }}" name="specializations[{{ $specialize->id }}][budget]" type="number" step="1" min="0" class="specialization-budget form-control" placeholder="Budget"></td>
        </tr>
    @endforeach
</table>
@section('scripts')
    @parent
    <script>
        $('document').ready(function () {
            $('.specialization-enable').on('click', function () {
                let id = $(this).attr('data-id')
                let enabled = $(this).is(":checked")
                $('.specialization-number[data-id="' + id + '"]').attr('disabled', !enabled)
                $('.specialization-number[data-id="' + id + '"]').attr('required', enabled ? true : false)
                $('.specialization-number[data-id="' + id + '"]').val(enabled ? 1 : null)

                $('.specialization-budget[data-id="' + id + '"]').attr('disabled', !enabled)
                $('.specialization-budget[data-id="' + id + '"]').attr('required', enabled ? true : false)
                $('.specialization-budget[data-id="' + id + '"]').val(enabled ? 1 : null)
            })
        });
    </script>
@endsection