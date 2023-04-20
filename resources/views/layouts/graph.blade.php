<div class="container-fluid px-5 mt-4 text-center">

    <form action="/{{request()->path()}}" method="get">

        <div class="input-group">
            
            <select class="form-select" id="typ" name="typ">
                <option {{request()->typ == 'bar' ? 'selected' : ''}} value="bar">Bar</option>
                <option {{request()->typ == 'line' ? 'selected' : ''}} value="line">Line</option>
                <option {{request()->typ == 'pie' ? 'selected' : ''}} value="pie">Pie</option>
                <option {{request()->typ == 'doughnut' ? 'selected' : ''}} value="doughnut">Doughnut</option>
            </select>

            <select class="form-select" id="what" name="what">
                <option {{request()->what == 'Day' ? 'selected' : ''}} value="Day">Day</option>
                <option {{request()->what == 'Month' ? 'selected' : ''}} value="Month">Month</option>
                <option {{request()->what == 'Year' ? 'selected' : ''}} value="Year">Year</option>
            </select>
            
            <select class="form-select" id="duration" name="duration">
                @for($i=0;$i<=30;$i++)
                <option {{request()->duration == $i ? 'selected' : ''}} value="{{$i}}">{{$i}}</option>
                @endfor
            </select>

            @if(isset($cts))
            <select class="form-select" id="category" name="category">
                @foreach($cts as $c)
                <option {{request()->category == $c->id ? 'selected' : ''}} value="{{$c->id}}">{{$c->category}}</option>
                @endforeach
            </select>
            @endif

            @if(isset(request()->product_id))
            <input class="form-control" type="text" value="{{request()->product_id}}" id="product_id" name="product_id">
            @endif

            <input class="form-control" type="hidden" value="1" name="p">
            <button class="btn btn-outline-secondary" type="submit">GO</button>

        </div>

        <div class="mt-4">
            <a class="btn btn-outline-secondary" style="width:150px;" href="/{{request()->path()}}?typ={{request()->typ}}&what={{request()->what}}&duration={{request()->duration}}&p={{(request()->p) + 1}}">PREVIOUS</a>
            <a class="btn btn-outline-secondary" style="width:150px;" href="/{{request()->path()}}?typ={{request()->typ}}&what={{request()->what}}&duration={{request()->duration}}&p={{(request()->p) - 1}}">NEXT</a>
        </div>

    </form>

</div>