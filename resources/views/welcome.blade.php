<!DOCTYPE html>
<html>
    <head>
        <title>URL Shortener</title>


        <link rel="stylesheet" href="{{ asset('/assets/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <div class="title mb-4">URL Shortener</div>
                    <div class="card mb-1">
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-group row">
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="Your original URL" name="url" id="url" />
                                        <div class="invalid-feedback d-none"></div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary" id="submit">Go!</button>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" placeholder="Optional: Short URL" name="short" id="short" />
                                        <div class="invalid-feedback d-none"></div>
                                        <small class="form-text text-muted">
                                            Maximum 12 characters long.
                                        </small>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card d-none" id="response">
                        <div class="card-body">
                            <h4>Your short URL: <strong class="short_url"></strong></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('/assets/plugins/jQuery/jquery-2.2.3.min.js')  }}"></script>
        <script src="{{ asset('/assets/bootstrap/js/bootstrap.min.js')  }}"></script>
        <script src="{{ asset('/assets/js/main.js')  }}"></script>
    </body>
</html>
