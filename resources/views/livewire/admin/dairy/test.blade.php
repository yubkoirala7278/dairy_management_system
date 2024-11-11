<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel 8 nepali font PDF Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-3">Laravel 8 HTML to nepali font PDF Example</h2>
        <form method="POST" action="{{ route('project.store') }}" class="w-100 create-form">
            @csrf<div class="row">
                {{-- title --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">त्यैतल</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                        <label class="error ">{{ $errors->first('title') }}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                {{-- description --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">वर्णन</label>
                        <!-- <input type="textarea" class="form-control" name="description" value="{{ old('description') }}"> -->
                        <textarea rows="5" class="form-control" name="description">{{ old('description') }}</textarea>
                        <label class="error ">{{ $errors->first('description') }}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary d-block w-100" id="btnSubmit">submit<i
                            class="far fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>

</html>
