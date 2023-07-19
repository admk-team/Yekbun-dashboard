<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>paypal</title>
    <style>
        .container{
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card{
            border-radius: 7px;
           box-shadow: 1px 5px 1px rgba(0,0,0,0.1);
        }
    </style>
    
</head>
<body>
    <div class="container">
        <div class="col-md-5">
            <div class="card text-center">
                <div class="card-header">
                  Payment
                </div>
                <div class="card-body">
                  <h5 class="card-title"><img src="{{asset('assets/img/checked.png')}}" width="120"></h5>
                  <p class="card-text">Payment was Successfully Done.</p>
                </div>

              </div>
        </div>
    </div>
   
</body>
</html>