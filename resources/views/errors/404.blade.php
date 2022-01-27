<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</head>
<body class="bg-dark">
    <div class="container" style="margin-top:10rem">
      <div class="row text-center justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
            <div class="card py-5 shadow-lg">
                <div class="card-body">
                    <div class="mb-5">
                        <h6>Halaman tidak ditemukan</h6>
                    </div>
                    <div class="container">
                        <div class="d-flex justify-content-around align-items-center">
                          <a href="{{ URL::previous() }}">
                            <button type="button" class="btn btn-lg btn-light">
                              <i class="fas fa-2x fa-arrow-left"></i>
                            </button>
                          </a>
            
                          <a href="/">
                              <button type="button" class="btn btn-lg btn-light">
                                <i class="fas fa-2x fa-home"></i>
                              </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</body>
</html>