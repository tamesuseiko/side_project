

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
                        title: "ไม่สำเร็จ",
                        text: "เกิดข้อผิดพลาด กรุณาทำใหม่อีกครั้ง",
                        icon: "error",
                        closeOnClickOutside: false,
                  }).then((result) => {
                        if (url == '') {
                              window.location = window.location.href;
                        } else {
                              window.location = url
                        }
                  });
            });
      </script>

</body>

</html>
