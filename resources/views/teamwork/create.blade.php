<x-minton-layout>
    <x-slot name="header">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Главная</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('teams.index') }}">Команды</a></li>
                    <li class="breadcrumb-item active">Создание новой команды</li>
                </ol>
            </div>
            <h4 class="page-title">Создание новой команды</h4>
        </div>
    </x-slot>
    <x-slot name="slot">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel-heading clearfix">
                    <a href="{{route('teams.index')}}" class="btn btn-sm btn-default pull-right">
                        <i class="fa fa-arrow-left"></i> Назад
                    </a>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form class="form-horizontal" method="post" action="{{route('teams.store')}}">
                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Название</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    </x-minton-layout>
