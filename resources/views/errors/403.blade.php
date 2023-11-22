<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/frontend/assets/imgs/theme/favicon.ico') }}">
    <title>Sajh Dhaj Ke</title>
    <style>
        .error-page {
  color: #1f1f1f;
  height: 100vh;
}
.error-page .main-wrapper {
  height: auto;
  width: 100%;
}
.error-page .main-wrapper .error-box {
  max-width: 480px;
  text-align: center;
  width: 100%;
  margin: 0 auto;
  padding: 1.875rem 0;
}
.error-page .main-wrapper .error-box h1 {
  color: #751d1c;
  font-size: 10em;
}
.error-page .main-wrapper .error-box h3 {
  font-size: 26px;
}
.error-page .main-wrapper .error-box p {
  margin-bottom: 25px;
  font-size: 20px;
}
.error-page .main-wrapper .error-box .btn {
  border-radius: 50px;
  font-size: 18px;
  font-weight: 600;
  min-width: 200px;
  padding: 10px 20px;
}
.error-page .main-wrapper .error-box .btn:hover {
  opacity: 0.8;
}
.btn-primary {
  color: #fff;
  background-color: #751d1c !important;
  border-color: #751d1c !important;
}
a {
  color: #751d1c;
  cursor: pointer;
  text-decoration: none;
  -webkit-transition: all 0.2s ease;
  -ms-transition: all 0.2s ease;
  transition: all 0.2s ease;
}
a:hover {
  color: #fff;
  -webkit-transition: all 0.2s ease;
  -ms-transition: all 0.2s ease;
  transition: all 0.2s ease;
}
a:focus {
  outline: 0;
}

    </style>
</head>

<body class="error-page">


    <div class="main-wrapper">
        <div class="error-box">
            <h1>403</h1>
            <h3 class="h2 mb-3"><i class="fas fa-exclamation-circle"></i> Unauthorize!</h3>
            <p class="h4 font-weight-normal">Oops! 😖 You don't have admin access..</p>
            <a href="{{ route('user.dashboard') }}" class="btn btn-primary">Back to Home</a>
        </div>
    </div>

</body>

</html>
