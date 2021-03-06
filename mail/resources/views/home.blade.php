@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User icon updater</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{route('update-icon')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <input name="icon" type="file" class="form-control border-0">
                        <br>
                        <input type="submit" class="btn btn-primary" value="UPDATE ICON">
                        <a href="{{route('clear-icon')}}" class="btn btn-danger">CLEAR ICON</a>
                    </form>
                </div>
            </div>

            <br><br>


            <div class="card">
                <div class="card-header">Mail Sender</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{route('send-mail')}}" method="POST">
                        @csrf
                        @method('POST')

                        <label for="text">Text</label>
                        <input type="text" name="text">
                        <br>
                        <input type="submit" value="SEND MAIL">

                    </form>

                </div>
            </div>

            <br><br>

            <div class="card">
                <div class="card-header">Empty mail Sender</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{route('send-empty-mail')}}" method="POST">
                        @csrf
                        @method('POST')
                    <input type="submit" value="SEND EMPTY MAIL">

                    </form>
                </div>
            </div>

            @if (Auth::user() -> icon) {{-- in prosa se l'utente ha un'icona diversa da null esegui questo, altrimenti non farlo --}}

            <br>

            <div class="card">
                <div class="card-header">Icon</div>

                <div class="card-body">
                    <h1>Hello Lizard</h1>
                    <br>
                    <img src="{{asset('storage/icon/' . Auth::user() -> icon)}}">
                </div>
            </div>
            @endif
       
       
       
        </div>
    </div>
</div>
@endsection
