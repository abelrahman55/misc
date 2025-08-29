<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <title>MISC</title>
</head>
<body>
    @if ($errors->any())
        <div id="errors" class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="bg-sing" style="height: 100vh;">
        <div class="container-fluid h-100">
            <div class="row justify-content-center align-items-center h-100 order-md-first order-last">
                <div class="col-md-6 d-flex flex-column justify-content-center">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/images/3almny.png') }}" width="150px" alt="">
                    </div>
                    <div style="border-radius: 20px; text-align: center;" class="bg-light shadow-lg p-4 bg-singin w-75 mx-auto">
                        <h3 class="text-singin my-4">تسجيل الدخول</h3>
                        <form method="POST" action="{{ route('admin_regist') }}">
                            @csrf
                            <input type="text" class="w-75 form-control my-3 mx-auto" name="email" placeholder="البريد الالكترونى">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>

                            @endif
                            <input type="password" class="w-75 form-control mx-auto" name="password" placeholder="الرقم السري">
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>

                            @endif
                            <button type="submit" class="btn btn-singin my-5 btn-primary">تسجيل الدخول</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 d-flex flex-column justify-content-center order-md-last order-first">
                    <div class="text-center my-3">
                        <img class="img-fluid" src="{{ asset('assets/images/3almny.png') }}" style="width:55%;" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
