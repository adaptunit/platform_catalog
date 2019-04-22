@if (!empty($options) && $options->count())
<select class="form-control m-bot15" name="{{$optionName}}">
        <option value="" {{ empty($optionSelected) ? 'selected="selected"' : ''}} disabled="disabled">select option...</option>
    @foreach($options as $opt)
        <option value="{{ $opt->id }}" {{ (!empty($optionSelected) && $optionSelected == $opt->id) ? 'selected="selected"' : '' }}>{{ $opt->name }}</option>
    @endforeach
</select>
@endif
