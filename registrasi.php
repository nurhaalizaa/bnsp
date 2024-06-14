<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Registrasi</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/registrations/registration-7/assets/css/registration-7.css">
  </head>
  <body>
    <section class="bg-light p-3 p-md-4 p-xl-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
            <div class="card border border-light-subtle rounded-4">
              <div class="card-body p-3 p-md-4 p-xl-5">
                <div class="row">
                  <div class="col-12">
                    <div class="mb-5">
                      <div class="text-center mb-4">
                        <a href="#!">
                          <img src="assets/images/1.png" alt="" width="150">
                        </a>
                      </div>
                      <h2 class="h4 text-center">Form Registrasi</h2>
                      <h3 class="fs-6 fw-normal text-secondary text-center m-0">Enter your details to register</h3>
                    </div>
                  </div>
                </div>
                <form action="prosesregis.php" method="POST" enctype="multipart/form-data">
                  <div class="row gy-3 overflow-hidden">
                    <div class="col-12">
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="firstName" id="firstName" placeholder="Nama" required>
                        <label for="firstName" class="form-label">Nama</label>
                      </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <select class="form-select" name="gender" id="gender" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                            <label for="gender" class="form-label">Jenis Kelamin</label>
                        </div>
                    </div>
                    <div class="col-12">
                      <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
                        <label for="email" class="form-label">Email</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-floating mb-3">
                        <input type="tel" class="form-control" name="phoneNumber" id="phoneNumber" placeholder="Phone Number" required>
                        <label for="phoneNumber" class="form-label">Phone Number</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-floating mb-3">
                        <textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat" required></textarea>
                        <label for="alamat" class="form-label">Alamat</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="password" id="password" value="" placeholder="Password" required>
                        <label for="password" class="form-label">Password</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group mb-3">
                        <label for="photo">Upload Foto</label>
                        <input type="file" class="form-control-file" id="photo" name="photo" accept="image/*" required>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="d-grid">
                        <button class="btn bsb-btn-xl btn-primary" type="submit">Sign up</button>
                      </div>
                    </div>
                  </div>
                </form>
                <div class="row">
                  <div class="col-12">
                    <hr class="mt-5 mb-4 border-secondary-subtle">
                    <p class="m-0 text-secondary text-center">Already have an account? <a href="login.php" class="link-primary text-decoration-none">Sign in</a></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
