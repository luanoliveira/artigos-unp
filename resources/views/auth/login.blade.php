<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Login</title>

      <link rel="stylesheet" href="<?= asset('libs/bootstrap-3.3.7/css/bootstrap.min.css') ?>">
      <link rel="stylesheet" href="<?= asset('libs/bootstrap-3.3.7/css/bootstrap-theme.min.css') ?>">
      <link rel="stylesheet" href="<?= asset('libs/font-awesome-4.6.3/css/font-awesome.min.css') ?>">

      <style media="screen">
      #login {
         max-width: 500px;
         margin: 100px auto;
         padding: 30px;
         border: 1px solid #cccccc;
         border-radius: 3px;
      }

      #login .image {
         display: block;
         text-align: center;
         margin-bottom: 30px;
      }
      </style>
   </head>
   <body>

      <form class="form-horizontal" id="login" method="POST" action="{{ url('/login') }}">
         {{ csrf_field() }}

         <a href="#" class="image">
            <img src="<?= asset('images/logo.png') ?>">
         </a>

         <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="col-md-4 control-label">E-Mail Address</label>

              <div class="col-md-8">
                 <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                 @if ($errors->has('email'))
                      <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                 @endif
              </div>
         </div>

         <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <label for="password" class="col-md-4 control-label">Password</label>

              <div class="col-md-8">
                 <input id="password" type="password" class="form-control" name="password" required>

                 @if ($errors->has('password'))
                      <span class="help-block">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                 @endif
              </div>
         </div>

         <div class="form-group">
              <div class="col-md-8 col-md-offset-4">
                 <div class="checkbox">
                      <label>
                          <input type="checkbox" name="remember"> Remember Me
                      </label>
                 </div>
              </div>
         </div>

         <div class="form-group">
              <div class="col-md-8 col-md-offset-4">
                 <button type="submit" class="btn btn-primary">
                      Login
                 </button>

                 <a class="btn btn-link" href="{{ url('/password/reset') }}">
                      Forgot Your Password?
                 </a>
              </div>
         </div>
      </form>

   </body>
</html>
