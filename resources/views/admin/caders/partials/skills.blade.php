

<table>
    @php $name = 'name_'.app()->getLocale();@endphp
    @foreach($skills as $skill)
        <tr>
            <td><input {{ $skill->value || old('skills.'.$skill->id) ? 'checked' : null }} data-id="{{ $skill->id }}" type="checkbox" class="skill-enable"></td>
            <td>{{ $skill->$name }}</td>
            <td>
                <input value="{{ old('skills.'.$skill->id,$skill->value) ?? null }}" {{ $skill->value || old('skills.'.$skill->id) ? null : 'disabled' }} data-id="{{ $skill->id }}" name="skills[{{ $skill->id }}]" type="number" step="1" min="0" class="skill-progress form-control" placeholder="Progress %">
            </td>
        </tr>
    @endforeach
</table>
@section('scripts')
    @parent
    <script>
        $('document').ready(function () {
            $('.skill-enable').on('click', function () {
                let id = $(this).attr('data-id')
                let enabled = $(this).is(":checked")
                $('.skill-progress[data-id="' + id + '"]').attr('disabled', !enabled)
                $('.skill-progress[data-id="' + id + '"]').attr('required', enabled ? true : false)
                $('.skill-progress[data-id="' + id + '"]').val(enabled ? 1 : null)
            })
        });
    </script>
@endsection