@props(['name'])
<div class="mb-3 row">
    <label for="{{$name}}" class="col-sm-3 col-form-label">{{ucwords($name)}}</label>
        <div class="col-sm-9">
        <textarea 
            class="form-control" id="{{$name}}" name="{{$name}}">
            {{$slot ?? old($name)}}
        </textarea>    
    </div>
</div>
