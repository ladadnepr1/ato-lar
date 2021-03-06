@extends('layouts.app')
@section('content')
<!-- Bootstrap шаблон... -->
<div class="panel-body">
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    <!-- Форма новой задачи -->
    <form action="{{ url('task') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        <!-- Имя задачи -->
        <div class="form-group">
            <label for="task" class="col-sm-3 control-label">Задача</label>
            <div class="col-sm-6">
                <input type="text" name="name" id="task-name" class="form-control">
            </div>
        </div>
        <!-- Кнопка добавления задачи -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Добавить задачу
                </button>
            </div>
        </div>
    </form>
</div>
<!-- Текущие задачи -->
@if (count($tasks) > 0)
<div class="panel panel-default">
    <div class="panel-heading">
        Текущая задача
    </div>

    <div class="panel-body">
        <table class="table table-striped task-table">

            <!-- Заголовок таблицы -->
            <thead>
            <th>Task</th>
            <th>&nbsp;</th>
            <th>edit</th>
            </thead>

<!-- Тело таблицы -->
            <tbody>
                @foreach ($tasks as $task)
                @if ({{ $id_edit }}!=={{$task->id}})
                <tr>

 <!-- Имя задачи -->
                    <td class="table-text">
                        <div>{{ $task->name }}</div>
                    </td>

                    <td>
                        <form action="{{ url('task/'.$task->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-trash"></i> Удалить
                            </button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ url('task/edit/'.$task->id) }}" method="POST">
                            {{ csrf_field() }}

                            <button type="submit" class="btn btn-warning">
                                <i class="fa fa-cog"></i> Редактировать
                            </button>
                        </form>
                    </td>
                </tr>
                @else
                <tr>
 <!-- Изменение задачи -->
            <form action="{{ url('task/save/').$task->id) }}" method="POST" class="form-horizontal">
                {{ csrf_field() }}
                <td class="table-text">
                    <div> <input type="text" name="name" id="task-name" class="form-control" placeholder="{{ $task->name }}"></div>
                </td>
                <td>
                    <button type="submit" class="btn btn-warning">
                        <i class="fa fa-cog"></i> Сохранить
                    </button>
            </form>
            </td>
            <td>
                <form action="{{ url('task/'.$task->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-trash"></i> Удалить
                    </button>
                </form>
            </td>
            </tr>
            @endif
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection