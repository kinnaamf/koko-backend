<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Sign In</title>
</head>
<body>
    <div class="flex justify-center items-center w-full h-screen">
        <section class="py-3 py-md-5 py-xl-8">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-5">
                            <h2 class="display-3 fw-semibold text-center">Sign In</h2>
                            <p class="text-center m-0 fw-medium text-gray-400 mt-5">Don't have an account? <a href="http://localhost:5173/#/register" class="text-blue-700 underline">Sign Up</a></p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10 col-xl-8">
                        <div class="row gy-5 justify-content-center">
                            <div class="col-12 col-lg-5">
                                <form method="POST" action="do_login.php">
                                    <div class="row gy-3 overflow-hidden">
                                        <div class="col-32 w-screen">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control border-0 border-bottom rounded-0" name="username" id="username" required>
                                                <label for="username" class="form-label">Username</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control border-0 border-bottom rounded-0" name="password" id="password" required>
                                                <label for="password" class="form-label">Password</label>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column gap-4 items-center justify-center col-12">
                                            <div class="d-grid">
                                                <button class="btn btn-lg btn-dark rounded-0 fs-6" type="submit">Log In</button>
                                            </div>
                                            <div class="self-center" style="text-align: center">
                                                <a style="font-weight: 600; text-transform: uppercase; margin-top: 12px; text-align: center; color: #333; text-decoration: none" href="http://localhost:5173/#/">Return to homepage without auth</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>

