@extends('layouts.app')

@section('title', 'Отправка сообщения')

@section('content')

    <div class="d-flex justify-content-center align-items-center" style="height: 100%; ">
        <form action="http://localhost:8080/api/v1/message" style="width: 600px;" method="POST">
            @csrf
            <div class="form-group row">
                <label for="advertDescription" class="col-sm-2 col-form-label">Сообщение</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="advertDescription" rows="3" name="message" placeholder="Сообщение" required></textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </div>
            </div>
        </form>
    </div>
@endsection
