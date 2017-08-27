<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="row">
                <button type="submit" class="btn btn-primary clear">Очистить</button>
                <button type="submit" class="btn btn-primary send">Применить</button>
            </div>
            <form id="filters" class="form-horizontal filters" role="form">
                <div class="row">
                    <div class="col-md-4">
                        <label class="col-form-label" for="region">Федеральный округ</label>
                    </div>
                    <div class="form-group districts col-md-8">
                        <select id="region" class="form-control" name="region">
                            <option value="allDistricts">Все</option>
                            @foreach ($regions as $region)
                                <option data-id="{{$region->id}}">{{$region->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row hidden district-hidden">
                    <div class="col-md-4">
                        <label class="col-form-label" for="district">Субъект</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <select class="form-control district" name="district">
                            <option value="all">Все</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label class="col-form-label" for="year">Год</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <select id="year" class="form-control" name="year">
                            <option value="all">Все</option>
                            @for($i = 2017; $i <= 2037; $i++)
                                <option data-year="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label class="col-form-label" for="diagnostic">Диагностика</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <select id="diagnostic" class="form-control" name="diagnostic">
                            <option value="allDiagnostics">Все</option>
                            @foreach($diagnostics as $diagnostic)
                                <option data-name="{{$diagnostic}}">{{$diagnostic}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label class="col-form-label" for="object">Предмет</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <select id="object" class="form-control" name="subject">
                            <option value="allSubjects">Все</option>
                            @foreach($subjects as $subject)
                                <option data-name="{{$subject->name}}">{{$subject->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>