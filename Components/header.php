<!-- Header -->
<!-- Navigation Bar -->
<div class="navbar">
    <div class="listItems" id="icons">
        <i class="fa-solid fa-bars" id="bars"></i>
    </div>
    <div class="nameLogo">
        <img id="logo" src="Images/Icon.png" alt="logo">
        <p id="name">bookpedlar</p>
    </div>
    <div class="searchBar" id="searchingBar">
        <form action="searchResult.php" method="POST" id="inputForm" style="display:flex;width:100%;">
            <select title="Search By" id="searchBy" name="selectValue">
                <option value="All" selected>All</option>
                <option value="Book Name">Book Name</option>
                <option value="Author Name">Author Name</option>
                <option value="Publisher">Publisher</option>
            </select>
            <input type="text" id="search" placeholder="     Search a book" name="searchInput">
            <i class="fa-solid fa-magnifying-glass searchIcon" title="Search" id="searchingIcon"></i>
        </form>
    </div>
    <div class="loginRegister">
        <?php
            session_start();  
            if(isset($_SESSION['userid'])){
                echo('<a href="logout.php" id="logout" class="linkAni">Logout</a>');
            }else{
                echo('<a href="new_login.php" id="login" class="linkAni">Login</a>
                <a href="new_signup.php" id="register" class="linkAni">Register</a>');
            }
        ?>
    </div>
</div>

<!-- Navigation List -->
<div class="navList">
    <a href="#" class="linkAni">Home</a>
    <a href="new_login.php" class="linkAni">Buy Books</a>
    <a href="new_login.php" class="linkAni">Sell Books</a>
    <a href="about.html" class="linkAni">About Us</a>
</div>