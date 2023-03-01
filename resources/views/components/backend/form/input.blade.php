@props(['name'])
<div class="mb-3 row">
    <label for="{{$name}}" class="col-sm-3 col-form-label">{{ucwords($name)}}</label>
    <div class="col-sm-9">
        <input
            {{$attributes}}
            class="form-control"
            id="{{$name}}"
            name="{{$name}}"
            value="{{old($name)}}"
        >
    </div>
    @error($name)
    <span class="small text-danger">
        {{$message}}
    </span>
    @enderror
</div>
