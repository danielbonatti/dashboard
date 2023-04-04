@extends('dash.layout')
@section('content')

    <div class="container"  class="px-md-4">
        <div class="row">
            <div class="col-md-12">
                <form>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="compe">Competência</label>
                            <input class="form-control" id="compe" type="text" placeholder="aaaa/mm">
                        </div>
                        <div class="col-md-3">
                            <label for="setor">Setor</label>
                            <select class="form-control" id="setor">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

