<form action="{{ url(Request::segment(1) . '/' . Request::segment(2)) }}" method="get">
    <div class="input-group mb-3">
        <input type="text" name="s" class="form-control" value="{{(request()->s) ?? ''}}" placeholder="Masukan Kata Kunci" >
        <button class="btn btn-primary" type="submit" id="button-addon2">Cari</button>
    </div>
</form>
