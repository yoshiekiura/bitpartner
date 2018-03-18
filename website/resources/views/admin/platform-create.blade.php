@extends('layouts.admin')

@section('breadcrumb')
<li><a href="/admin/blockchain-platforms/">Platforms</a></li>
<li><a href="/admin/blockchain-platforms/create/">Add New Platform</a></li>
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 col-lg-6 col-lg-offset-3">
            <div class="panel">
                <div class="panel-body">
                    {!! Form::open(['route' => ['blockchain-platforms.store'],'method' => 'POST']) !!}
                    
                    @include('admin._platform-form-fields')
                    <div class="form-group">
                        <div class="col-md-6">
                            <button href="/blockchain-platforms/" class="form-control btn btn-default col-md-6">Cancel</button>
                        </div>
                        <div class="col-md-6">
                            {{ Form::submit('Create!',['class'=>'form-control btn btn-success col-md-6']) }}
                        </div>
                    </div>

                    {!! Form::token() !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection