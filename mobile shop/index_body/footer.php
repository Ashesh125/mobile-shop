<?php
?>

<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <div class="footer bg-light" style="border-top: 1px solid rgba(0,0,0,0.2);margin-top: 30px;">
            <span class="blockquote-footer text-center p-2">Quill Mobile Shop & Repairing Center &copy;2020.</span>
        </div>

        <script src="../js/script.js"></script>
        
        <script>
            var user = '<?=$_SESSION['user']?>';
        
            function choice() {
                if (user != null) {
                    document.getElementById('dropdown-logout').style.display = 'block';
                    document.getElementById('dropdown-login').style.display = 'none';
                    document.getElementById('dropdown-register').style.display = 'none';
                } else {
                    document.getElementById('dropdown-logout').style.display = 'none';
                    document.getElementById('dropdown-login').style.display = 'block';
                    document.getElementById('dropdown-register').style.display = 'block';
                }
            }

            document.body.onload = choice();
        </script>
    </body>
</html>