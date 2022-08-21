<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Testing</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="col-md-6 " style="margin-top: 12px;">
            <h3>Website quản lý thông tin khách hàng</h3>
            <form action="" method="post" id="inSertData">
                <label for="">Họ và tên</label>
                <input type="text" id="FullName" class="form-control" placeholder="Họ và tên">
                <label for="">Email</label>
                <input type="text" id="Email" class="form-control" placeholder="Email">
                <label for="">Năm sinh</label>
                <input type="text" id="birthDate" class="form-control" placeholder="Năm sinh">
                <br />
                <input type="button" value="SubmitData" id="SubmitData" class="btn btn-primary" placeholder="">
            </form>
            <br />
            <h4>Load dữ liệu khách hàng từ Database</h4>
            <div id="LoadDataServer">
            </div>
        </div>
    </div>

    <script>
        //edit data
        $(document).ready(function() {
            function fetchData() {
                $.ajax({
                    url: "AJACT.php",
                    type: "POST",
                    success: function(data) {
                        $('#LoadDataServer').html(data);
                    }
                })
            }
            fetchData();

            function editData(id, text, columnName) {
                $.ajax({
                    url: "AJACT.php",
                    type: "POST",
                    data: {
                        id: id,
                        text: text,
                        columnName: columnName
                    },
                    success: function(data) {
                        alert("Sửa dữ liệu thành công");
                        console.log(id, text, columnName);
                        fetchData();
                    }
                })

            }
            $(document).on('blur', '#fullName', function() {
                var id = $(this).data('id1');
                var text = $(this).text();
                editData(id, text, "hovaten");
                console.log(id)

            })
            $('#SubmitData').click(function() {
                var name = $('#FullName').val();
                var email = $('#Email').val();
                var birthDate = $('#birthDate').val();
                if (name == "" || email == "" || birthDate == "") {
                    alert("Bạn phải nhập đầy đủ")
                } else {
                    $.ajax({
                        url: "AJACT.php",
                        type: "POST",
                        data: {
                            name: name,
                            email: email,
                            birthDate: birthDate
                        },
                        success: function(data) {
                            alert("Up load data thành công");
                            $('#inSertData')[0].reset();
                            if (data == 1) {
                                alert("Bạn đã thành công")
                            } else {
                                alert("Bạn chưa thành công")
                            }
                            fetchData();
                        }
                    })
                }

            })

        });
    </script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>