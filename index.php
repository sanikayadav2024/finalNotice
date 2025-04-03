<?php
$conn = mysqli_connect("localhost","root","","notice");

$sql = "SELECT * FROM notice_table";

$result = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page of client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="Style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
     <div class="header">
        <div class="img"><img src="https://www.sitcoe.ac.in/wp-content/uploads/logo.png" alt="logo" height="65px"
                id="icon">
        </div>
        <nav class="navbar">
            <ul>
                <li class="hideOnMobile"><a href="./after_login_client.php">HOME</a></li>
                <li class="hideOnMobile"><a href="./about.html">ABOUT</a></li>
                <li class="hideOnMobile"><a href="./contact.html">CONTACT</a></li>
                <li><button class="ctn" id="logout">Logout</button></li>
                <li><a href="./after_login_server.php">Server</a></li>
            </ul>
        </nav>
    </div> 


    <div class="depart_filter">
        <div class="flt">
        <button class="filter" data-name="all">All</button>
        <button class="filter" data-name="cse">CSE</button>
        <button class="filter" data-name="ai">AI</button>
        <button class="filter" data-name="ece">ECE</button>
        <button class="filter" data-name="ce">CE</button>
        <button class="filter" data-name="me">ME</button>
        <button class="filter" data-name="ar">AR</button>
        <button class="filter" data-name="ee">EE</button>
        <button class="filter" data-name="mx">MX</button>
        </div>
    </div>
    <div class="gallery">

    <?php
      while($row = mysqli_fetch_assoc($result)){
        ?>

        
<div class="card" style="width: 25rem;" data-department="cse">
            <a href="./notice4.jpg"><img height="300px" width="400px" src="uploads/<?php echo $row['image'];?>" class="card-img-top"></a>
            <div class="card-body">
                <h5 class="card-title"><?php echo $row['title'];?></h5>
                <p class="card-text"><?php echo $row['desc'];?></p>
            </div>
        </div>

        <?php
      }

    ?>

      
</div>


    <footer>
        <div class="f-back">
            <p class="info">
                This website is just made for a project purpose. The notices on the page may be duplicate or irrelevant
                so take care while seeing it. <br>
                Please feel free to send us feedback don't get uncomfortable while sending it. Be frank.
            </p>
            <div class="div">
                <a href="./feedback.html"> <button class="ctn">Feedback</button></a><br>
                <div class="icons">
                    <a href=""> <i class="fa-brands fa-instagram"></i></a>
                    <a href=""><i class="fa-brands fa-linkedin"></i></a>
                    <a href=""><i class="fa-solid fa-envelope"></i></a>
                    <a href=""><i class="fa-brands fa-twitter"></i></a>
                    <a href=""><i class="fa-brands fa-youtube"></i></a>
                </div>
                <br>
                <p> All copyrights are reserved @ 2024 sitcoe.org.com</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
    <script>
        //*** Logout function***//

        document.getElementById('logout').addEventListener('click', function () {
            window.location.href = 'index.html';
        })

        function toggleFilters() {
    const flt = document.querySelector('.flt')
      flt.style.display = 'block'
}



    </script>
    <script>
        document.querySelectorAll('.filter').forEach(button => {
            button.addEventListener('click', () => {
                const department = button.getAttribute('data-name');
                filterNotices(department);
            });
        });

        function filterNotices(department) {
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                if (department === 'all' || card.getAttribute('data-department') === department) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }


    </script>
    
</body>

</html>