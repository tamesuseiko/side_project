<!doctype html>
<html lang="en">

<head>


</head>

<body data-sidebar="dark">

      <!-- Script Zone -->
      <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script>
            const url = '{{@$url}}';
            $(function() {
                  Swal.fire({
                        title: "สำเร็จ",
                        text: "ระบบได้ทำการบันทึกข้อมูลเรียบร้อย",
                        icon: "success",
                        allowOutsideClick: false,
                  }).then((result) => {
                        if (url == '') {
                              window.location = window.location.href;
                        } else {
                              window.location = url
                        }
                  });
            })
      </script>

</body>

</html>
