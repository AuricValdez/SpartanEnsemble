<!DOCTYPE html>
<html>
    <style>
        /*#E90808*/

html {
    animation: fade-in 1s forwards;
}

body {
    margin: 0;
    padding: 0;
    font-family: 'arial', arial;
    box-sizing: border-box;
    background-image: url(BSUbackground.png);
    background-repeat: no-repeat;
    background-size: cover;
}

.container {
    margin-left: -35px;
    animation: expand .8s ease forwards;
}

.menubar {
    background-color: rgb(255, 255, 255);
    width: 100%;
    height: 100px;
    position: relative;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
}

.logoutBtn {
    width: 29px;
    height: 29px;
    margin-top: 25px;
    margin-right: 25px;
    background-color: transparent;
    border: none;
    position: absolute;
    top: 10px;
    right: 10px;
    transition: ease-in-out 0.1s;
    border: none;
    background-repeat: no-repeat;
    background: url(logout.png);
}

.logoutBtn:hover {
    width: 29px;
    background-repeat: no-repeat;
    background: url(logoutHover.png);
}

.titleContainer {
    background-image: url(TitleHome.png);
    width: 500px;
    height: 100%;
}

.titleContainerView {
    background-image: url(TitleViewAttendanceLogs.png);
    width: 500px;
    height: 100%;
}

.menu {
    position: fixed;
    margin-left: 37%;
    margin-top: 6%;
    width: 500px;
    height: 1000px;
    background-image: url(menuHome.png);
    background-repeat: no-repeat;   
}

.logo {
    margin-top: 2%;
    margin-left: 47%;
    position: absolute;
    width: 175px;
    animation: expand .5s ease forwards;
}

.InitiateBtn {
    width: 325px;
    height: 60px;
    margin-top: 49%;
    margin-left: 15%;
    background-color: transparent;
    transition: ease-in-out 0.2s;
    border: none;
    background-repeat: no-repeat;
    background: url(InitiateBtn.png);
}

.InitiateBtn:hover {
    background: url(InitiateBtnHover.png);
}

.ViewBtn {
    width: 325px;
    height: 60px;
    margin-top: 5%;
    margin-left: 15%;
    background-color: transparent;
    transition: ease-in-out 0.2s;
    border: none;
    background-repeat: no-repeat;
    background: url(ViewBtn.png);
}

.ViewBtn:hover {
    background: url(ViewBtnHover.png);
}

@keyframes fade-in {
    from {
        background-color: rgba(#000, 0.25);
        opacity: 0;
    }

    to {
        background-color: rgba(#000, 0);
        opacity: 1;
    }
}

@keyframes expand {
  0% {
    transform: translateX(1400px);
  }
  100% {
    transform: translateX(0px);
  }
}
    </style>
    <head>
        <meta name = "viewport" content="width=device-width, initial-scale=1.0">
        <title>Room Attendance Management System</title>
    </head>
    <body>
        <div class="menubar">
            <div class="titleContainer"></div>
            <button onclick="window.location.href='login.php';" class="logoutBtn"></button>
        </div>
        <div class="container">
            <div class="menu">
                <button onclick="window.location.href='initiateAttendance.php';" class ="InitiateBtn"></button>
                <button onclick="window.location.href='viewAttendance.php';" class ="ViewBtn"></button>
            </div>
            <img class="logo" src="BSU.png" alt ="BSU Logo">
        </div>
    </body>
</html>