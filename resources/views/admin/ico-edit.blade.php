@extends('layouts.admin')

@section('breadcrumb')
<li><a href="/admin/icos/">ICOs</a></li>
<li><a href="/admin/icos/{{$ico->id}}/edit"><i class="fa fa-fw fa-1x fa-pencil"></i> Edit ICO {{$ico->title}}</a></li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2">
            <div class="panel">
                <div class="panel-body">
                    {!! Form::model($ico, ['route' => ['icos.update', $ico],'method' => 'PUT']) !!}

                    @include('admin._ico-form-fields')
                    
                    <div class="form-group">
                        <div class="col-md-6">
                            <a href="/admin/icos/" class="form-control btn btn-default">Cancel</a>
                        </div>
                        <div class="col-md-6">
                            {{ Form::submit('Update!',['class'=>'form-control btn btn-success']) }}
                        </div>
                    </div>

                    {!! Form::token() !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection