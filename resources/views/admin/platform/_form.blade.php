@php ($isEditMode = empty($platforms) && !empty($platform))

<div class="wrapper">
    <div class="{{$subClass}}_form-wrapper">
        {{ Form::open(['url' => ( $isEditMode ? ("platform/".$platform->id) : "platform"),
                       'method' => ( $isEditMode ? 'put' : 'post' ),
                       'id' => 'platform',
                       'class' => 'platform'])
        }}
        <div class="_body mx-3">
            <div class="field">
                <i class="fa fa-bookmark"></i>
                <label data-error="wrong" data-success="right" for="name">Name</label>
                <input value="{{ $isEditMode ? $platform->name : ''}}" type="text" id="name" name="name" class="form-control validate" />
            </div>

            <div class="field">
                <i class="fa fa-file-text"></i>
                <label data-error="wrong" data-success="right" for="description">Description</label>
                <input value="{{ $isEditMode ? $platform->description : ''}}" type="text" id="description" name="description" class="form-control validate" />
            </div>

            <div class="field">
                <i class="fa fa-link"></i>
                <label data-error="wrong" data-success="right" for="link">Link</label>
                <input value="{{ $isEditMode ? $platform->link : ''}}" type="text" id="description" name="link" class="form-control validate">
            </div>


            <div class="field">
                <i class="fa fa-sort-amount-desc"></i>
                <label data-error="wrong" data-success="right" for="link">Rate</label>
                <div class="">
                    <div class="rating">
                        @for ($i = $rate['max']; $i >= $rate['min']; $i--)
                            @if($isEditMode and $i === $platform->rate)
                                {{ Form::radio('rating', $i, false, ['id' => 'star'.$i, 'class' => 'starselect', 'checked' => 'checked' ]) }}
                            @else
                                {{ Form::radio('rating', $i, false, ['id' => 'star'.$i, 'class' => 'starselect' ]) }}
                            @endif

                            <label for="star{{ $i }}" title="{{ $i }}">{{ $i }} stars</label>
                        @endfor
                    </div>
                    <input type="hidden" value="0" name="rate" id="rate" />
                </div>
            </div>

            <div class="field">
                <i class="fa fa-folder-open"></i>
                <label data-error="wrong" data-success="right" for="category">Category</label>
                @include('partials._list_dropdown_select',  [
                            'optionName' => 'category',
                            'options' => $categories,
                            'optionSelected' => (!$isEditMode ? '' : $category_id)
                ])
            </div>

            <div class="field">
                <i class="fa fa-image"></i>
                <label data-error="wrong" data-success="right" for="category_id">Logo</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="logo" />
                    <label class="custom-file-label" for="logo" aria-describedby="logo">Choose image</label>
                </div>
            </div>

            <div class="custom-control custom-checkbox field">
                <input {{ $isEditMode && $platform->is_discount_enable ? 'checked ': ''}} type="checkbox" class="custom-control-input" id="is_discount_enable" name="is_discount_enable" value="1"/>
                <label class="custom-control-label" for="is_discount_enable">Discount enable</label>
            </div>

            <div id="message-error" class="alert alert-danger" style="display: none">
            </div>
        </div>
        <div class="_footer d-flex justify-content-center">
            @if($isEditMode)
                <button type="submit" class="btn btn-sm btn-success">Save</button>
                <button type="button" class="btn btn-sm btn-danger" onclick="history.back()">Cancel</button>
            @else
                <button class="btn btn-sm btn-success" id="createCategoryBtn">Create</button>
            @endif
        </div>
        {{ Form::close() }}

        <script>
            var startSelect = document.getElementsByClassName('starselect');
            for (i = 0; i < startSelect.length; i++) {
                startSelect[i].onclick = function() {
                    document.getElementById('rate').value = this.value;
                }
            }
        </script>
    </div>
</div>
