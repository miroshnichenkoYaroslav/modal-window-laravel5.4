<div class="col-md-4">
    <label class="col-form-label regions" for="subject">Субъект</label>
</div>
<div class="col-md-8 form-group regions">
    <select id="subject" class="form-control">
        <option data-id="allRegions">Все</option>
        @foreach ($regions as $region)
            <option data-id="{{$region->id}}">{{$region->name}}</option>
        @endforeach
    </select>
</div>