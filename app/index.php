<html>
<head>
    <title>NSUer</title>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="minimal-ui, width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <script src="//code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://nsuer.club//styles-app-v1.css">
    <link rel="apple-touch-icon" sizes="57x57" href="/images/fav/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/images/fav/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/images/fav/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/images/fav/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/images/fav/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/images/fav/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/images/fav/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/images/fav/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/fav/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/images/fav/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/images/fav/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/fav/favicon-16x16.png">
    <base href="https://nsuer.club/">
    <script>

        //localStorage.clear();

        if (localStorage.getItem('isLogged') == null)
            localStorage.setItem('isLogged', false);

        if (localStorage.getItem('user') == null)
            localStorage.setItem('user', '{}');

        if (localStorage.getItem('courses') == null)
            localStorage.setItem('courses', '[]');

        if (localStorage.getItem('faculties') == null)
            localStorage.setItem('faculties', '[]');

        if (localStorage.getItem('books') == null)
            localStorage.setItem('books', '[]');

        if (localStorage.getItem('classmates') == null)
            localStorage.setItem('classmates', '[]');

        if (localStorage.getItem('newsfeed') == null)
            localStorage.setItem('newsfeed', '[]');

        if (localStorage.getItem('nsu_notices') == null)
            localStorage.setItem('nsu_notices', '[]');

        if (localStorage.getItem('nsu_events') == null)
            localStorage.setItem('nsu_events', '[]');

        if (localStorage.getItem('academic_calendar') == null)
            localStorage.setItem('academic_calendar', '[]');

    </script>


    <script>


        function addToStorage(key, jsonString) {

            var jsonStrLocal = localStorage.getItem(key);

            var obje = JSON.parse(jsonStrLocal);
            obje.push(JSON.parse(jsonString));
            jsonStrNew = JSON.stringify(obje);
            localStorage.setItem(key, jsonStrNew);

        }


        function removeFromStorage(index, item) {

            var jsonStrLocal = localStorage.getItem(item);

            var obje = JSON.parse(jsonStrLocal);

            delete obje[index];

            jsonStrNew = JSON.stringify(obje, (k, v) => Array.isArray(v)
            && !(v = v.filter(e => e)).length ? void 0 : v, 2);

            localStorage.setItem(item, jsonStrNew);


        }

    </script>

    <!--<meta name="theme-color" content="#388096">-->
    <script src="/cgpa-calculator/circle.js"></script>

</head>


<script>


    // if(localStorage.getItem("user_uid") == null || localStorage.getItem("user_uid") == "" || localStorage.getItem("user_uid") === undefined){} else {


    //     var cookieee= localStorage.getItem("user_uid");

    //                   $.getJSON('https://nsuer.club/apps/version.php?uid='+cookieee, function(data) {

    //                         if(data['isPremium'] == "false"){
    //                             openNavSub();

    //                         }
    //                     });

    //     }
</script>

<script>


    function openNavSub() {
        document.getElementById("myNavSub").style.height = "100%";
    }

    /* Close */
    function closeNavSub() {
        document.getElementById("myNavSub").style.height = "0%";
    }


    function loadsub(typez, uidz) {

        var uid = localStorage.getItem("user_uid");

        var pay;
        var price;
        var price2;

        if (typez == 1) {

            pay = "1 Year Subscription";
            price = "100 TK"
            price2 = "Send 100 TK to selected number";
        } else {


            pay = "Lifetime Subscription";
            price = "250 TK"
            price2 = "Send 250 TK to selected number";


        }


        document.getElementById("sub-conk").innerHTML = "<div class=\"sub-attention1\">\n" +
            "    <br>\n" +
            "    <h2>Payment for subscription</h2>\n" +
            "    <br>\n" +
            "\n" +
            "    <form action=\"https://nsuer.club/subscription/verify.php\" method=\"POST\" id=\"subs-form\">\n" +
            "    \n" +
            "    <div class=\"subbox\">\n" +
            "        <b>" + pay + "</b> <p style=\"float: right;\"><b>" + price + "</b></p>\n" +
            "        <div style=\"clear: both\"></div>\n" +
            "    </div>\n" +
            "    \n" +
            "    <div class=\"subbox\">\n" +
            "        <p><b>Payement By</b> (via send money)</p><br>\n" +
            "        \n" +
            "        <input type=\"radio\" name=\"payment_type\" value=\"1\" required> bKash - 01308347415 (personal)<br>\n" +
            "       \n" +
            "        <input type=\"radio\" name=\"payment_type\" value=\"2\" required> Rocket - 013083474154<br>\n" +
            "    </div>\n" +
            "    \n" +
            "        \n" +
            "    <div class=\"subbox\">\n" +
            "        <center><b>" + price2 + "</b></center>\n" +
            "    </div>\n" +
            "    \n" +
            "    <div class=\"subbox\">\n" +
            "        <p><b>Verify Payment</b></p><br>\n" +
            "        \n" +
            "        <p>After sending money, you will get a confirmation message that contains a TrxID or TxnID number. Enter that down below to verify.\n" +
            "        </p><br>\n" +
            "        \n" +
            "        \n" +
            "        <input type=\"hidden\" name=\"account_type\" value=\"" + typez + "\">\n" +
            "        \n" +
            "        <input type=\"hidden\" name=\"uid\" value=\"" + uid + "\">\n" +
            "        \n" +
            "        <input type=\"text\" class=\"subi\" placeholder=\"Enter here\" name=\"trxID\" required>\n" +
            "        <input type=\"submit\" class=\"subi\" name=\"submit\" value=\"Submit Payment Info\">\n" +
            "    \n" +
            "    <br> <br>\n" +
            "    \n" +
            "    <p>If bKash or Rocket payment fails, please contact at nsuer.app@gmail.com</p>\n" +
            "    </div>\n" +
            "    \n" +
            "    \n" +
            "    \n" +
            "        \n" +
            "    </form>\n" +
            "    \n" +
            "    </div>";


        $("#subs-form").submit(function (e) {

            e.preventDefault(); // avoid to execute the actual submit of the form.

            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function (data) {
                    closeNavSub();

                    alert("Thank you for the contribution. Your account is activated");
                }
            });


        });


    }


</script>


<div id="myNavSub" class="overlay-sub">

    <a href="javascript:void(0)" class="closebtn" onclick="closeNavSub()">&times;</a>

    <!-- overlay-sub content -->
    <div class="overlay-sub-content" id="sub-conk">

        <br>
        <center><h2>Attention!</h2></center>
        <br>

        <img src="https://nsuer.club/images/fav/apple-icon-76x76.png">
        <br>

        <div class="sub-text-holder">
            <br>
            Last year, NSUer app and nsuer.club wesbite were released. My goal has been to help students to make their
            study life easier to manage. Glad so say that I'm successful, as so many of you are using this app and
            loving it.

            <br>
            <br>
            Since last year, I've been spending my pocket money to run this website and app. But as users are growing,
            it requires more expensive server, and other services to renew yearly. I can't bear the maintenance cost of
            this app alone.
            <br><br>

            I tried to get a fund from NSU, but they are never going to fund a personal project like NSUer App. Besides,
            it directly competes with NSU-IT (you know what I'm trying to say)
            <br><br>

            As many of you suggested, there will be a membership system in NSUer App. Cost will be 30TK per semester.

            <br><br>

            Your subscription fee will be considered as contribution to this app. And keep the app ads free.

            <br><br>

            Using our own fund, we will upgrade to higher powered servers, build more advanced features, develop books
            and course resource(slides, projects) collection and more.

            <br><br>

            If you have any valid reason, then you can get membership for free. Contact at nsuer.app@gmail.com

            <br><br>

            <div class="sub-pack">

                <div class="sub1" onclick="loadsub(1, 'yes')">
                    <h1>1</h1>
                    <span>Year</span>
                    <br>
                    <span>Membership</span>
                    <br><br>
                    <b>100 TK</b>

                </div>


                <div class="sub2" onclick="loadsub(2, 'yes')">
                    <h2>Lifetime</h2>
                    <br>
                    <span>Membership</span>
                    <br><br>
                    <b>250 TK</b>

                </div>

                <div style="clear:both"></div>
            </div>

        </div>

    </div>

</div>

<div style="clear:both"></div>
</div>


<style>

    .subbox input {

        margin-left: 10px;
    }

    .subbox .subi {

        padding: 15px;
        border: 1px solid #ddd;
        width: 94%;
        margin-bottom: 10px;

    }

    .subbox {

        margin: 10px;
        border-radius: 5px;
        padding: 15px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, .3);
        margin-bottom: 20px;

    }

    .sub-attention1 h2 {

        margin-left: 20px;

    }

    .sub-attention1 {

        margin-left: 10px;
        margin-right: 10px;
        width: 95%;
        max-width: 550px;
        text-align: left;
        padding-bottom: 30px;

    }

    .sub-attention {

        margin-left: 10px;
        margin-right: 10px;
        width: 95%;
        max-width: 550px;

    }

    .sub-pack {
        width: 100%;
        padding: 10px;
        padding-top: 20px;
        text-align: center;
        margin: auto;

        padding-bottom: 30px;
    }

    .sub1, .sub2 {

        width: 30%;
        display: inline-block;
        border: 1px solid #eee;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        background: #2196F3;
        color: #fff !important;
        min-height: 166px;
        float: left;
        -webkit-touch-callout: none; /* iOS Safari */
        -webkit-user-select: none; /* Safari */
        -khtml-user-select: none; /* Konqueror HTML */
        -moz-user-select: none; /* Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
        user-select: none;
        /* Non-prefixed version, currently
                                         supported by Chrome and Opera */

    }

    .sub1:hover, .sub2:hover, .sub1:focus, .sub2:focus {

        background: #225d93;

    }

    .sub1 {

        margin-right: 10px;

    }

    .sub2 {

        float: right;

        margin-left: 10px;
        margin-right: 15px;
    }

    .sub-text-holder {

        padding-left: 20px;
        padding-right: 20px;
        text-align: left;

    }

    /* The overlay-sub (background) */
    .overlay-sub {
        /* Height & width depends on how you want to reveal the overlay (see JS below) */
        height: 0;
        width: 100%;
        position: fixed; /* Stay in place */
        z-index: 99999; /* Sit on top */
        left: 0;
        top: 0;
        background-color: rgb(0, 0, 0); /* Black fallback color */
        background-color: rgba(0, 0, 0, 0.8); /* Black w/opacity */
        overflow-x: hidden; /* Disable horizontal scroll */
        transition: 0.5s; /* 0.5 second transition effect to slide in or slide down the overlay (height or width, depending on reveal) */
    }

    /* Position the content inside the overlay */
    .overlay-sub-content {
        position: relative;
        top: 5%;
        width: 100%;
        text-align: center;
        margin-top: 30px;
        background: #fff;
        max-width: 526px;
        margin: auto;
        height: auto;
        margin-bottom: 30px;
        border-radius: 10px;
    }

    /* The navigation links inside the overlay-sub */
    .overlay-sub a {
        padding: 8px;
        text-decoration: none;
        font-size: 36px;
        color: #818181;
        display: block; /* Display block instead of inline */
        transition: 0.3s; /* Transition effects on hover (color) */
    }

    /* When you mouse over the navigation links, change their color */
    .overlay-sub a:hover, .overlay-sub a:focus {
        color: #f1f1f1;
    }

    /* Position the close button (top right corner) */
    .overlay-sub .closebtn {
        position: absolute;
        top: 20px;
        right: 45px;
        font-size: 60px;
    }

    /* When the height of the screen is less than 450 pixels, change the font-size of the links and position the close button again, so they don't overlap */
    @media screen and (max-height: 450px) {
        .overlay-sub a {
            font-size: 20px
        }

        .overlay-sub .closebtn {
            font-size: 40px;
            top: 15px;
            right: 35px;
        }
    }

    @media screen and (max-width: 500px) {

        .sub-pack h2 {
            font-size: 22px
        }

        .overlay-sub-content {
            position: relative;
            top: 10px;

            margin-top: 0px;
            width: 95%;
            text-align: center;
            background: #fff;
            max-width: 526px;
            margin: auto;
            height: auto;
            margin-bottom: 30px;
            border-radius: 10px;
        }

        .overlay-sub {
            background-color: rgb(0, 0, 0); /* Black fallback color */
            background-color: rgba(0, 0, 0, 0.5); /* Black w/opacity */
        }

        .overlay-sub .closebtn {
            position: absolute;
            top: 8px;
            right: 20px;
            font-size: 30px;
            z-index: 99999999;
        }

    }


</style>


<body id="bodyId">


<style>

    .add_course_holder {

        background: #fff;
        color: #333;
        border-radius: 4px;
        margin-left: 20px;
        margin-right: 20px;
        margin-bottom: auto;
        position: absolute;
        width: -webkit-fill-available;
        top: 40%;
        padding: 20px;
        z-index: 999999;

    }

    .heading_title {

        margin-bottom: 25px;
        font-weight: bold;
        font-size: 18px;

    }

    #alert_bar {

        position: fixed;
        width: 100%;
        height: 100%;
        background: #000000c4;
        z-index: 888888;
        max-width: 500px;
        cursor: pointer;
        display: none;

    }

    .inputsHolder {

        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;

    }

    #alert_bar input, #alert_bar select {

        padding: 10px;
        border: 1px solid #eeee;
        border-radius: 4px;
        background: #fff;
        font-size: 17px;

    }

    #alert_bar button {

        width: 100%;
        padding: 10px;
        background: #4196af;
        color: #fff;
        border: 0;
        border-radius: 3px;
        min-height: 36px;
        font-size: 16px;

    }

    #alert_bar label {

        font-size: 15px;
        color: #777;
        margin-bottom: 3px;

    }

    .nf_post {

        border: 1px solid #eee;
        border-radius: 4px;
        padding: 10px;
        width: 100%;
        min-height: 150px

    }

    .fixed {

        position: fixed !important;
        bottom: 30;

    }

    .shop_holder {
        display: grid;
        grid-template-columns: auto auto;
        grid-column-gap: 8px;
        grid-row-gap: 8px;
        padding: 8px;
    }

    .shop-item {

        padding: 0px;
        background: #fff;
        border: 1px solid #eee;
        border-radius: 5px;
        overflow: hidden;

    }

    .shop-item img {

        object-fit: cover;
        position: absolute;
        width: 100%;
        height: 100%;

    }

    .shop_image_cropper {
        height: 200px;
        overflow: hidden;
        position: relative;
    }

    .shop_title {

        font-size: 15px;
        padding: 10px 10px 4px 10px;
        color: #444;
        white-space: nowrap;
        overflow: hidden;
    }

    .shop_price {

        color: #f66d1b;
        font-weight: bold;
        font-size: 16px;

        padding: 2px 10px;

    }

    .shop_info {

        color: #777;
        font-size: 12px;
        padding: 4px 10px 12px 10px;

    }

    .shop_buttons {

        height: 42px;
        color: #666;
        position: -webkit-sticky;
        position: sticky;
        top: 62;
        background: #4196af;
        white-space: nowrap;
        overflow-x: scroll;
        z-index: 88;
        -ms-overflow-style: none;
    / / IE 10 + overflow: -moz-scrollbars-none;
    / / Firefox

    }

    .shop_buttons::-webkit-scrollbar {
        display: none;
    / / Safari and Chrome
    }

    .shop_buttons button {

        background: #56a1ba;
        border: 0px;
        border-radius: 3px;
        margin-right: 5px;
        color: #fff;
        padding: 6px 10px;
        margin-right: 8px;
        font-size: 15px;

    }

    .shop_buttons button:first-child {

        margin-left: 14px;

    }
</style>


<div id="alert_bar">


</div>

<div id="dialog_window"></div>
<div id="toast" class="toast"></div>
<div id="fixed_button_holder"></div>


<header class="unselectable" id="header">
    <span class="spacer" onclick="menuBack()"><img id="menu_icon" src="/images/app-icons/menu.svg"></span>
    <span id="nav_title">NSUer</span>
    <span class="menu_icon_dot_span">
        <span id="menu_btn"></span>
        <img id="menu_icon_dot" onclick="openFullscreen()" src="/images/app-icons/menu_dot.svg">

</header>


<div id="content_pane">


</div>


<script>


    $(document).ready(function () {

        if (localStorage.getItem("isLogged") == null || localStorage.getItem("isLogged") == "false")
            loadLogin();
        else
            fragmentHome();

        // fragmentShop();

    });


    function loadShopItem(start, loadCat, loadSearch, query, cat) {


        $.getJSON("https://nsuer.club/apps/buy-sell/get-all-webapp.php?start=" + start + "&loadCat=" + loadCat + "&loadSearch=" + loadSearch + "&query=" + query + "&cat=" + cat + "&uid=" + localStorage.getItem("user_uid"), function (data) {

            removeLoading();


            document.getElementById('content_pane').innerHTML = '<div id="shop_buttons" class="shop_buttons"><button>Books</button><button>Education</button><button>Phones</button>' +
                '<button>Electronics</button><button>Man\'s Fashion</button><button>Women\'s Fashion</button>' +
                '<button>Apartment</button><button>Sports</button><button>Food</button><button>Others</button></div><div id="shop_items" class="shop_holder"></div>';

            localStorage.setItem("newsfeed", "[]");
            $.each(data['dataArray'], function (key, val) {

                var title = val['t'];
                var postedBy = val['sn'];
                var price = val['p'];
                var postedByMemID = val['si'];
                var timeStamp = val['tm'];

                var time = humanTiming(val['tm']);
                var description = val['d'];
                var catID = val['c'];


                var string = '\n' +
                    '        <div class="shop-item">\n' +
                    '            <div class="shop_image_cropper">\n' +
                    '            <img src="https://nsuer.club/images/shop/' + timeStamp + '.jpg">\n' +
                    '            </div>\n' +
                    '            <div class="shop_title">' + title + '</div>\n' +
                    '            <div class="shop_price">৳ ' + price + '</div>\n' +
                    '            <div class="shop_info">' + postedBy + ', ' + time + '</div>\n' +
                    '        </div>\n';

                document.getElementById('shop_items').innerHTML += string;

            });

        });


    }


    function comingSoon() {


        alert("This feature is coming within few days for iOS.");

    }


    function fragmentShop() {

        document.getElementById('nav_title').innerHTML = "BuySell Shop";

        document.getElementById('menu_btn').innerHTML = '<img class="full_screen_button" src="/images/app-icons/plus.svg" onclick="comingSoon();">';

        showLoading();

        backIcon();


        loadShopItem("0", "false", "false", "", "");


        $(window).scrollTop(0);
        window.location.hash = 'shop';

    }


    function createPost() {

        showAlertWindow();

        var string = '<div class="add_course_holder">\n' +
            '            <div class="inputsHolder">\n' +
            '            <div class="heading_title">Create post</div>\n' +
            '            <div class="heading_title" onclick="hideAlertWindow()">X</div></div>\n' +
            '            <form id="create_post_from" action="/apps/newsfeed/create-post-2.php" method="POST">\n' +
            '                <input type="hidden" id="ac_uid" name="uid">\n' +
            '                <textarea class="nf_post" name="post"></textarea><br>\n' +
            '                <br>\n' +
            '                <select id="nf_course" name="course">\n' +
            '                </select><br>\n' +
            '                <br><button id="nf_btn" type="submit">Post</button>\n' +
            '            </form></div>';


        document.getElementById("alert_bar").innerHTML = string;


        document.getElementById("ac_uid").value = localStorage.getItem("user_uid");


        var courseSelect = document.getElementById("nf_course");

        var courses = localStorage.getItem('courses');
        var json = JSON.parse(courses);


        for (var i = 0; i < json.length; i++) {

            var course = json[i].course;
            var section = json[i].section;


            var el = document.createElement("option");


            el.textContent = course + "." + section;
            el.value = course + "." + section;
            courseSelect.appendChild(el);
        }


        $("#create_post_from").submit(function (e) {


            document.getElementById("nf_btn").innerHTML = "Creating Post...";

            var form = $(this);
            var url = form.attr('action');


            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function (datas) {


                    setTimeout(function () {

                        hideAlertWindow();
                        syncNewsfeed(true);


                    }, 500);

                }
            });

            e.preventDefault(); // avoid to execute the actual submit of the form.
        });


    }


    function sendPing(url) {

        $.get(url, function (data) {
            return data;
        });

    }

    function removeCourse(key, course, section) {


        var r = confirm("Are you sure you want to remove " + course + "?");
        if (r == true) {

            removeFromStorage(key, "courses");


            fragemntCourses();


            var userUid = localStorage.getItem("user_uid");

            sendPing("/apps/courses/delete.php?uid=" + userUid + "&course=" + course + "." + section);


        } else {

        }


    }

    function addCourse() {

        showAlertWindow();

        var string = '<div class="add_course_holder">\n' +
            '            <div class="inputsHolder">\n' +
            '            <div class="heading_title">Add Course</div>\n' +
            '            <div class="heading_title" onclick="hideAlertWindow()">X</div></div>\n' +
            '            <form id="add_course_form" action="/apps/get-course-info.php" method="GET">\n' +
            '                <input type="hidden" id="ac_uid" name="uid">\n' +
            '                <div class="inputsHolder">\n' +
            '                <label for="ac_name"><p>Course Initial</p>\n' +
            '                <input type="text" id="ac_name" name="course"></label>\n' +
            '                <label for="ac_section"><p>Section</p>\n' +
            '                <select id="ac_section" name="section">\n' +
            '                </select></label></div>\n' +
            '                <br><button id="ac_btn" type="submit">Add Course</button>\n' +
            '            </form></div>';


        document.getElementById("alert_bar").innerHTML = string;


        document.getElementById("ac_uid").value = localStorage.getItem("user_uid");


        var semesterSelect = document.getElementById("ac_section");


        for (var i = 1; i < 50; i++) {
            var el = document.createElement("option");
            el.textContent = i;
            el.value = i;
            semesterSelect.appendChild(el);
        }


        $("#add_course_form").submit(function (e) {


            document.getElementById("ac_btn").innerHTML = "Adding course...";

            var form = $(this);
            var url = form.attr('action');


            $.ajax({
                type: "GET",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function (datas) {
                    // alert(data); // show response from the php script.


                    var data = JSON.parse(datas);

                    $.each(data['dataArray'], function (key, val) {

                        if (val.hasOwnProperty('startTime')) {
                            var tempJson = JSON.stringify(val);
                            addToStorage("courses", tempJson);

                        }
                        if (val.hasOwnProperty('initial')) {
                            var tempJson = JSON.stringify(val);
                            addToStorage('faculties', tempJson);
                        }
                        if (val.hasOwnProperty('books')) {
                            var tempJson = JSON.stringify(val);
                            addToStorage('books', tempJson);
                        }
                    });


                    hideAlertWindow();
                    fragemntCourses();

                }
            });

            e.preventDefault(); // avoid to execute the actual submit of the form.
        });


    }


    function showAlertWindow() {


        document.getElementById("alert_bar").innerHTML = "";
        document.getElementById("alert_bar").style.display = "block";

    }

    function hideAlertWindow() {

        document.getElementById("alert_bar").style.display = "none";
        document.getElementById("alert_bar").innerHTML = "";

    }


    var departmentsFull = ["Bachelor of Architecture", "BS in Civil & Environmental Engineering (CEE)", "BS in Computer Science & Engineering (CSE)", "BS in Electrical & Electronic Engineering (EEE)", "BS in Electronic & Telecom Engineering (ETE)", "BS in Biochemistry and Biotechnology", "BS in Environmental Science & Management", "BS in Microbiology", "Bachelor of Pharmacy - Professional", "BBA in Accounting", "BBA in Economics", "BBA in Entrepreneurship", "BBA in Finance", "BBA in Human Resource Management", "BBA in International Business", "BBA in Management", "BBA in Management Information Systems", "BBA in Marketing", "BBA in Supply Chain Management", "BBA General", "BS in Economics", "BA in English", "Bachelor of Laws (LLB Hons)", "Master of Business Administration (MBA)", "Executive Master of Business Administration (EMBA)", "MS in Economics ", "Master in Development Studies (MDS)", "MS in Computer Science and Engineering", "MS in Electronic and Telecommunication Engineering", "MS in Electrical and Electronic Engineering", "MS in Biotechnology", "MPharm in Pharmaceutical Technology and Biopharmaceutics", "MPharm in Pharmacology and Clinical Pharmacy", "Master of Public Health (MPH)", "Executive Master of Public Health (EMPH)", "MS in Environmental Science and Management", "MA in English", "Master in Public Policy and Governance (MPPG)", "Master of Laws (LL.M)", "General Bachelor of Pharmacy"];

    var departmentShort = ["B. Architecture", "BS in CEE", "BS in CSE", "BS in EEE", "BS in ETE", "BS in Biochemistry", "BS in ESM", "BS in Microbiology", "BPharm Professional", "BBA in Accounting", "BBA in Economics", "BBA in Entrep.", "BBA in Finance", "BBA in HRM", "BBA in IB", "BBA in Management", "BBA in MIS", "BBA in Marketing", "BBA in SCM", "BBA General", "BS in Economics", "BA in English", "LLB Hons", "MBA", "EMBA", "MS in Economics", "MDS", "MS in CSE", "MS in ETE", "MS in EEE", "MS in Biotech.", "MPharm in PTB", "MPharm in PCP", "Master of MPH", "EMPH", "MS in ESM", "MA in English", "Master in PPG", "LL.M", "General BPharm"];

    function loadEditProfile() {

        document.getElementById('nav_title').innerHTML = "Edit Profile";

        backIcon();

        var string = '<div class="edit_profile"><div class="image_holder">\n' +
            '        <form id="upload_pic_form" action="/apps/edit-profile/upload-c.php">' +
            '        <input type="hidden" name="uid" id="ep_uid_1">' +
            '            <label for="imgInp">\n' +
            '                <div class="preview_image_holder">\n' +
            '                <div class="image_croper">\n' +
            '                <img id="preview_img" src="/images/app-icons/default_user_pic.png"></div><div class="camera_icon">\n' +
            '                <img src="/images/app-icons/camera_dark.svg"></div></div>\n' +
            '            </label>\n' +
            '            <input type="file" accept="image/*" onchange="loadFile(event)" id="imgInp">\n' +
            '        </form>\n' +
            '    </div><form class="edit_profile_form" id="edit_profile_form" action="/apps/edit-profile/edit.php" method="POST">' +
            '        <input type="hidden" name="uid" id="ep_uid_2">' +
            '        <p>Name</p><input name="name" id="ep_name" type="text">\n' +
            '        <div class="ep_left">\n' +
            '        <p>Department</p><select id="department" name="dept"></select>\n' +
            '        </div>\n' +
            '        <div class="ep_right">\n' +
            '        <p>Semester(th)</p>\n' +
            '        <select id="semesters" name="semester">\n' +
            '        </select></div><div class="clear"></div>\n' +
            '        <div class="ep_left">\n' +
            '        <p>CGPA</p>\n' +
            '        <input name="cgpa" id="ep_cgpa" type="text" placeholder="0.0">\n' +
            '        </div><div class="ep_right">\n' +
            '        <p>Credits</p>\n' +
            '        <input name="credit" id="ep_credit" type="text" placeholder="0">\n' +
            '        </div>\n' +
            '        <div class="clear"></div>\n' +
            '        <p><ul>\n' +
            '            <li>Your CGPA, credits won\'t be public.</li>\n' +
            '            <li>These data are needed to give you relevent suggestions.</li>\n' +
            '            <li>You can give fake data if you want.</li></ul><p>\n' +
            '<button name="submit" type="submit" class="floatingButtonTick"><img src="/images/app-icons/check.svg"/></button>' +
            '    </form>\n' +
            '</div>';


        document.getElementById('content_pane').innerHTML = string;


        var deptSelect = document.getElementById("department");

        for (var i = 0; i < departmentsFull.length; i++) {
            var opt = departmentsFull[i];
            var el = document.createElement("option");
            el.textContent = opt;
            el.value = i;
            deptSelect.appendChild(el);
        }


        var semesterSelect = document.getElementById("semesters");

        for (var i = 0; i < 30; i++) {
            var el = document.createElement("option");
            el.textContent = i + 1;
            el.value = i;
            semesterSelect.appendChild(el);
        }


        try {

            setTimeout(function () {

                document.getElementById("ep_uid_1").value = localStorage.getItem("user_uid");
                document.getElementById("ep_uid_2").value = localStorage.getItem("user_uid");

                document.getElementById("ep_name").value = localStorage.getItem("user_name");

                document.getElementById("department").selectedIndex = localStorage.getItem("user_dept");
                document.getElementById("semesters").selectedIndex = localStorage.getItem("user_semester");

                document.getElementById("ep_cgpa").value = localStorage.getItem("user_cgpa");
                document.getElementById("ep_credit").value = localStorage.getItem("user_credit");

            }, 250);


        } catch (e) {
        }


        $(window).scrollTop(0);
        window.location.hash = 'edit_profile';


        var user_picture = localStorage.getItem("user_picture");

        if (user_picture == 0 || user_picture == "0" || user_picture == null || user_picture == "" || user_picture == "null" || user_picture == null) {
        } else {

            document.getElementById("preview_img").src = "/images/profile_picture/" + user_picture;

        }


        $("#edit_profile_form").submit(function (e) {


            var form = $(this);
            var url = form.attr('action');


            Toast("Saving data...", 1000);

            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function (data) {
                    // alert(data); // show response from the php script.


                    localStorage.setItem("user_name", $('#ep_name').val());

                    if ($("#imgInp").val() != '') {

                        localStorage.setItem("user_picture", localStorage.getItem("user_memberID") + ".jpg");
                    } else {

                        if (user_picture == 0 || user_picture == "0" || user_picture == null || user_picture == "" || user_picture == "null" || user_picture == null) {

                            localStorage.setItem("user_picture", "0");
                        }
                    }
                    localStorage.setItem("user_cgpa", $('#ep_cgpa').val());
                    localStorage.setItem("user_credit", $('#ep_credit').val());
                    localStorage.setItem("user_semester", $('#semesters').prop('selectedIndex'));
                    localStorage.setItem("user_dept", $('#department').prop('selectedIndex'));


                    localStorage.setItem("isLogged", true);
                    hideDialogWindow();
                    fragmentHome();


                }
            });

            e.preventDefault(); // avoid to execute the actual submit of the form.
        });


    }


    var loadFile = function (event) {
        var output = document.getElementById('preview_img');
        output.src = URL.createObjectURL(event.target.files[0]);

        upImage();
    };

    // upload image


    function upImage() {


        var file_data = $('#imgInp').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('uid', localStorage.getItem("user_uid"));

        $.ajax({
            url: '/apps/edit-profile/upload-c.php',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (data) {
                alert("Profile picture upload: " + data);

                if (data == "success") {


                    var user_picture = localStorage.getItem("user_picture");

                    document.getElementById("preview_img").src = "/images/profile_picture/" + localStorage.getItem("user_memberID") + ".jpg?" + Math.random();
                }
            }
        });

    }

    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#preview_img').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    // $("#imgInp").change(function() {
    //
    //     alert("yes");
    //
    //     readURL(this);
    //
    //     //upImage();
    //
    // });


    function Toast(text, duration) {

        document.getElementById("toast").style.bottom = "50";
        if (text == undefined)
            text = "Error occured!";
        document.getElementById("toast").innerHTML = text;
        setTimeout(function () {
            document.getElementById("toast").style.bottom = "-60";
        }, duration);

    }

    function showDialogWindow() {

        document.getElementById("dialog_window").style.opacity = "0.9";
        setTimeout(function () {

            document.getElementById("dialog_window").style.opacity = "1";

        }, 250);

        document.getElementById("dialog_window").style.display = "block";
        document.getElementById("content_pane").style.display = "none";
        document.getElementById("header").style.display = "none";


    }

    function hideDialogWindow() {

        document.getElementById("dialog_window").style.display = "none";
        document.getElementById("content_pane").style.display = "block";
        document.getElementById("header").style.display = "block";

    }


    function loadForget() {

        showDialogWindow();

        var container = document.getElementById("dialog_window");

        var string = '<div style="background-image: url(/images/app-icons/nsucampus.jpg); height: 100%; background-position: center;\n' +
            '    background-repeat: no-repeat; background-size: cover; "></div>\n' +
            '    <div class="login_bg">\n' +
            '            <div class="logo_text"><img src="/images/app-icons/nsuertextlogo.svg"></div>\n' +
            '        <div class="login_form_holder"><form id="forget_form" class="login_form forget_form" action="/user/reset.php" autocomplete="off">\n' +
            '            <input type="text" name="email" placeholder="Email" autocomplete=off>' +
            '            <input type="hidden" name="submit" value="Submit"/>' +
            '            <input type="submit" name="submits" id="signup_button" value="Reset Password">\n' +
            '            <div class="alink"><a onclick="loadLogin()">Already a member? Login here.</a></div>\n' +
            '        </form></div>\n' +
            '    </div>';


        container.innerHTML = string;


        $("#forget_form").submit(function (e) {

            var form = $(this);
            var url = form.attr('action');

            Toast("Sending request...", 1000);


            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function (data) {
                    // alert(data); // show response from the php script.

                    Toast("Password reset link sent to your email.", 3500);


                }
            });

            e.preventDefault(); // avoid to execute the actual submit of the form.
        });

    }


    function loadSignUp() {

        showDialogWindow();

        var container = document.getElementById("dialog_window");

        var string = '<div style="background-image: url(/images/app-icons/nsucampus.jpg); height: 100%; background-position: center;\n' +
            '    background-repeat: no-repeat; background-size: cover; "></div>\n' +
            '    <div class="login_bg">\n' +
            '            <div class="logo_text"><img src="/images/app-icons/nsuertextlogo.svg"></div>\n' +
            '<div class="login_form_holder">' +
            '        <form id="signup_form" class="login_form signup_form" action="/user/app-register.php" autocomplete="off">\n' +
            '            <div class="float_left">\n' +
            '                <input type="text" name="username" placeholder="Full name" autocomplete="off">\n' +
            '            </div>\n' +
            '            <div class="float_right">\n' +
            '                <select name="gender">\n' +
            '                    <option value="male">Male</option>\n' +
            '                    <option value="female">Female</option>\n' +
            '                </select>\n' +
            '            </div>\n' +
            '            <div class="clear"></div>\n' +
            '            <input type="text" name="email" placeholder="Email" autocomplete=off>\n' +
            '            <input type="password" name="password" placeholder="Password" autocomplete=off>\n' +
            '            <input type="submit" id="signup_button" value="Register">\n' +

            '            <div class="alink"><a onclick="loadLogin()">Already a member? Login here.</a></div>\n' +
            '        </form></div>\n' +
            '    </div>';


        container.innerHTML = string;


        $("#signup_form").submit(function (e) {

            var form = $(this);
            var url = form.attr('action');


            Toast("Signing up...", 1000);

            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function (data) {
                    // alert(data); // show response from the php script.

                    var json = JSON.parse(data);
                    var userData = json.user;


                    var isError = json.error;

                    if (isError == false) {

                        localStorage.setItem("user_uid", json.uid);
                        localStorage.setItem("user_email", userData.email);
                        localStorage.setItem("user_memberID", userData.memberID);
                        localStorage.setItem("user_name", userData.name);
                        localStorage.setItem("user_gender", userData.gender);

                        sendPing("https://nsuer.club/user/uid-login.php?uid=" + json.uid);

                        localStorage.setItem("isLogged", true);
                        hideDialogWindow();

                        loadEditProfile();

                    } else {

                        Toast(json.error_msg, 2500);

                    }
                }
            });

            e.preventDefault(); // avoid to execute the actual submit of the form.
        });

    }

    function loadLogin() {

        showDialogWindow();

        var container = document.getElementById("dialog_window");

        var string = '<div style="background-image: url(/images/app-icons/nsucampus.jpg); height: 100%; background-position: center;  \n' +
            '    background-repeat: no-repeat; background-size: cover; "></div>\n' +
            '    <div class="login_bg">\n' +
            '            <div class="logo_text"><img src="/images/app-icons/nsuertextlogo.svg"></div>\n' +
            '       <div class="login_form_holder"> ' +
            '<form id="login_form" class="login_form" action="/user/app-login.php">\n' +

            '            <input type="text" name="email" placeholder="Email">\n' +
            '            <input type="password" name="password" placeholder="Password">\n' +
            '            <input type="submit" id="login_button" value="Login">\n' +

            '            <div class="alink"><a onclick="loadForget()">Forgot password?</a></div>\n' +
            '            <div class="alink"><a onclick="loadSignUp()">Not a member? Sign up now.</a></div>\n' +
            '        </form></div>\n' +
            '    </div>';


        container.innerHTML = string;


        $("#login_form").submit(function (e) {


            var form = $(this);
            var url = form.attr('action');


            Toast("Login...", 1000);

            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function (data) {

                    var json = JSON.parse(data);
                    var userData = json.user;
                    var isError = json.error;

                    if (isError == false) {


                        localStorage.setItem("user_uid", json.uid);
                        localStorage.setItem("user_email", userData.email);
                        localStorage.setItem("user_memberID", userData.memberID);
                        localStorage.setItem("user_name", userData.name);
                        localStorage.setItem("user_gender", userData.gender);
                        localStorage.setItem("user_picture", userData.picture);
                        localStorage.setItem("user_cgpa", userData.cgpa);
                        localStorage.setItem("user_credit", userData.credit);
                        localStorage.setItem("user_semester", userData.semester);
                        localStorage.setItem("user_dept", userData.dept);
                        localStorage.setItem("user_bgroup", userData.bgroup);
                        localStorage.setItem("user_phone", userData.phone);
                        localStorage.setItem("user_address", userData.address);


                        sendPing("https://nsuer.club/user/uid-login.php?uid=" + json.uid);

                        localStorage.setItem("isLogged", true);

                        Toast("Syncing account data...", 1500);

                        if (localStorage.getItem('isCourse') == null) {

                            $.getJSON("https://nsuer.club/apps/sync-data-ios.php?memID=" + userData.memberID, function (data) {
                                $.each(data['dataArray'], function (key, val) {

                                    if (val.hasOwnProperty('startTime')) {
                                        var tempJson = JSON.stringify(val);
                                        addToStorage("courses", tempJson);

                                    }
                                    if (val.hasOwnProperty('initial')) {
                                        var tempJson = JSON.stringify(val);
                                        addToStorage('faculties', tempJson);
                                    }
                                    if (val.hasOwnProperty('books')) {
                                        var tempJson = JSON.stringify(val);
                                        addToStorage('books', tempJson);
                                    }
                                });

                                hideDialogWindow();
                                fragmentHome();

                                localStorage.setItem('isCourse', 'added');

                            });

                        }


                    } else {


                        Toast(json.error_msg, 2500);

                    }

                }
            });

            e.preventDefault(); // avoid to execute the actual submit of the form.
        });


    }


    var currentDate = new Date();


    function fragmentClassroutine() {
        document.getElementById('nav_title').innerHTML = "Class Routine";
        document.getElementById('content_pane').innerHTML = ' <div class="container class_calendar" id="main"><div class="jumbotron">\n' +
            '        <div class="text-center"><a id="left"><</a><span>&nbsp;</span>\n' +
            '            <span id="month"> </span><span>&nbsp;</span><span id="year"> </span>\n' +
            '            <span>&nbsp;</span><a id="right">></a></div></div><div class="row">\n' +
            '        <div><table class="class_calendar_table"></table>\n' +
            '        </div><div class="class_date" id="class_day_name"></div></div></div>\n' +
            '    <div id="class_list_holder" class="class_list_holder"></div>';
        backIcon();


        currentDate = new Date();
        generateCalendar(currentDate);

        $(window).scrollTop(0);

        window.location.hash = 'class_routine';
    }


    function generateCalendar(d) {


        function monthDays(month, year) {
            var result = [];
            var days = new Date(year, month, 0).getDate();
            for (var i = 1; i <= days; i++) {
                result.push(i);
            }
            return result;
        }

        Date.prototype.monthDays = function () {
            var d = new Date(this.getFullYear(), this.getMonth() + 1, 0);
            return d.getDate();
        };
        var details = {
            // totalDays: monthDays(d.getMonth(), d.getFullYear()),
            totalDays: d.monthDays(),
            weekDaysfull: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
            weekDays: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        };


        var tempDate = new Date();

        if (d.getDate() == tempDate.getDate() && d.getMonth() == tempDate.getMonth()) {

            loadClassRoutineItem(tempDate.getDay());
            $('#class_day_name').text(details.weekDaysfull[tempDate.getDay()]);

        }


        var start = new Date(d.getFullYear(), d.getMonth()).getDay();


        var today = new Date();

        var todayDate = today.getDate();

        var isThisMonth = false;

        if (todayDate == d.getDate())
            isThisMonth = true;


        var cal = [];
        var day = 1;
        for (var i = 0; i <= 6; i++) {
            cal.push(['<tr>']);
            for (var j = 0; j < 7; j++) {
                if (i === 0) {
                    cal[i].push('<th>' + details.weekDays[j] + '</th>');
                } else if (day > details.totalDays) {
                    cal[i].push('<td>&nbsp;</td>');
                } else {
                    if (i === 1 && j < start) {
                        cal[i].push('<td>&nbsp;</td>');
                    } else {


                        if (isThisMonth && todayDate == day)
                            cal[i].push('<td class="day hover">' + day++ + '</td>');
                        else
                            cal[i].push('<td class="day">' + day++ + '</td>');
                    }
                }
            }
            cal[i].push('</tr>');
        }
        cal = cal.reduce(function (a, b) {
            return a.concat(b);
        }, []).join('');


        $('.class_calendar_table').append(cal);
        $('#month').text(details.months[d.getMonth()]);
        $('#year').text(d.getFullYear());
        $('.class_calendar_table td.day').click(function () {

            $('.class_calendar td.day.hover').removeClass('hover');
            $(this).addClass('hover');

            var index = $(this).index();

            $('#class_day_name').text(details.weekDaysfull[index]);


            loadClassRoutineItem(index);


        });


        $('#left').click(function () {
            $('.class_calendar_table').text('');
            if (currentDate.getMonth() === 0) {
                currentDate = new Date(currentDate.getFullYear() - 1, 11);
                generateCalendar(currentDate);
            } else {
                currentDate = new Date(currentDate.getFullYear(), currentDate.getMonth() - 1)
                generateCalendar(currentDate);
            }
        });
        $('#right').click(function () {
            $('.class_calendar_table').html('<tr></tr>');
            if (currentDate.getMonth() === 11) {
                currentDate = new Date(currentDate.getFullYear() + 1, 0);
                generateCalendar(currentDate);
            } else {
                currentDate = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1)
                generateCalendar(currentDate);
            }
        });

    }


    function loadClassRoutineItem(dayName) {

        document.getElementById('class_list_holder').innerHTML = '';

        var courses = localStorage.getItem('courses');
        var json = JSON.parse(courses);

        json.sort(function (a, b) {
            return new Date('1970/01/01 ' + a.startTime) - new Date('1970/01/01 ' + b.startTime);
        });

        var stringTop = '<div id="routine_top" class="acitemn"></div>' +
            '     <div id="noclass_today_routine" class="no_class no_class_r">' +
            '                                   <img src="/images/app-icons/thumbsup_dark.svg"><br>' +
            '                                      <p>No Classes</p>' +
            '                                    </div>';
        document.getElementById('class_list_holder').innerHTML = stringTop;

        var daysNsu = ['S', 'M', 'T', 'W', 'R', 'F', 'A'];
        var today = new Date();
        var dn = dayName;
        var dd = today.getDate();

        var currentHour = today.getHours();

        if (currentHour < 10)
            currentHour = "0" + currentHour;

        var currentMin = today.getMinutes();

        var currentTime = currentHour + ":" + currentMin + ":00";

        var mm = today.getMonth(); //January is 0!
        var yyyy = today.getFullYear();

        todayName = daysNsu[dn];


        var todayCount = 0;


        for (var i = 0; i < json.length; i++) {

            var course = json[i].course;
            var faculty = json[i].faculty;
            var section = json[i].section;
            var startTime = json[i].startTime;
            var endTime = json[i].endTime;
            var room = json[i].room;
            var day = json[i].day;

            var start24 = convertTo24Hour(startTime);
            var end24 = convertTo24Hour(endTime);


            var isDoneIcon = "clock_circle_new";


            var string = '<table class="acitem"><tr>\n' +
                '            <td class="crleft" valign="top"></td>\n' +
                '            <td class="acborder" valign="top"><div class="acCircle"></div></td>\n' +
                '            <td class="acright"><b>' + course + '</b> <p>' + startTime + ' - ' + endTime + '</p></td>\n' +
                '        </tr></table>';

            if (day.includes(todayName)) {
                document.getElementById('class_list_holder').innerHTML += string;
                todayCount++;

            }


        }


        var stringBottom = '<div id="routine_bottom" class="acitemn fullheight"></div>';

        document.getElementById('class_list_holder').innerHTML += stringBottom;


        if (todayCount > 0) {
            document.getElementById('noclass_today_routine').style.display = "none";

            document.getElementById('routine_top').style.display = "visible";
            document.getElementById('routine_bottom').style.display = "visible";
        } else {
            document.getElementById('noclass_today_routine').style.display = "block";

            document.getElementById('routine_top').style.display = "none";
            document.getElementById('routine_bottom').style.display = "none";

        }

    }


    function fragmentCgpaAnalyzer() {
        document.getElementById('nav_title').innerHTML = "CGPA Analyzer";


        showLoading();

        document.getElementById('content_pane').innerHTML += '<iframe id="ca_iframe" onload="myScrollTop();" class="browseFrame" src="https://nsuer.club/cgpa-analyzer/index-app.php"/>';
        backIcon();

        $(window).scrollTop(0);

        window.location.hash = 'cgpa_analyzer';

        $('#ca_iframe').on('load', function () {
            hideLoadingBarCss();
        });

    }


    function myScrollTop() {

        $(window).scrollTop(0);
    }

    function fragmentCgpaCalculator() {
        document.getElementById('nav_title').innerHTML = "CGPA Calculator";


        showLoading();

        document.getElementById('content_pane').innerHTML += '<iframe id="cc_iframe" onload="myScrollTop();" class="browseFrame" src="https://nsuer.club/cgpa-calculator/index-app.php"/>';
        backIcon();

        $(window).scrollTop(0);

        window.location.hash = 'cgpa_calculator';

        $('#cc_iframe').on('load', function () {
            hideLoadingBarCss();
        });
    }


    function hideLoadingBarCss() {

        document.getElementsByClassName("loading_bar")[0].style.display = "none";

    }

    function fragmentFacultyPoll() {
        document.getElementById('nav_title').innerHTML = "Faculty Poll";


        showLoading();

        document.getElementById('content_pane').innerHTML += ' <iframe id="fpp_iframe" onload="myScrollTop();" class="browseFrame" src="https://nsuer.club/apps/faculty-rankings.php"/>';

        backIcon();

        $(window).scrollTop(0);

        window.location.hash = 'faculty_poll';


        $('#fpp_iframe').on('load', function () {
            hideLoadingBarCss();
        });

    }

    function fragmentFacultyPredictor() {
        document.getElementById('nav_title').innerHTML = "Faculty Predictor";

        showLoading();

        document.getElementById('content_pane').innerHTML += ' <iframe id="fp_iframe" onload="myScrollTop(); " class="browseFrame" src="https://nsuer.club/faculty/index-app.php"/>';

        backIcon();

        $(window).scrollTop(0);

        window.location.hash = 'faculty_predictor';

        $('#fp_iframe').on('load', function () {
            hideLoadingBarCss();
        });
    }


    function fragemntAdvisingAssistant() {
        document.getElementById('nav_title').innerHTML = "Advising Assistant";


        showLoading();

        document.getElementById('content_pane').innerHTML += ' <iframe id="aa_iframe" onload="myScrollTop();" class="browseFrame" src="https://nsuer.club/apps/advising-assistant.php"/>';

        backIcon();

        $(window).scrollTop(0);

        window.location.hash = 'advising_assistant';

        $('#aa_iframe').on('load', function () {
            hideLoadingBarCss();
        });
    }


    function fragemntAdvisingArchive() {
        document.getElementById('nav_title').innerHTML = "Advising Archive";


        showLoading();

        document.getElementById('content_pane').innerHTML += ' <iframe id="aa_iframe" onload="myScrollTop();" class="browseFrame" src="https://nsuer.club/advising-archive/index-app.php"/>';

        backIcon();

        $(window).scrollTop(0);

        window.location.hash = 'advising_archive';

        $('#aa_iframe').on('load', function () {
            hideLoadingBarCss();
        });
    }


    function syncAcademicCalendar() {
        $.getJSON("https://nsuer.club/apps/academic-calendar/get-json.php", function (data) {


            var oldJson = localStorage.getItem('academic_calendar');

            var newJson = JSON.stringify(data['calendar']);

            if (oldJson != newJson) {

                $.each(data['calendar'], function (key, val) {

                    var tempJson = JSON.stringify(val);
                    addToStorage("academic_calendar", tempJson);
                });

                fragemntAcademicCalendar();

            }

            var date = new Date();
            var timestamp = date.getTime() / 1000;
            localStorage.setItem('isAcademicCalendar', 'added');
            localStorage.setItem('timeAcademicCalendar', timestamp);

        });
    }

    function fragemntAcademicCalendar() {
        document.getElementById('nav_title').innerHTML = "Academic Calendar";
        document.getElementById('content_pane').innerHTML = '<table class="acitem acTitle"><tr>' +
            '        <td class="acleft">Date</td>' +
            '        <td class="acborder" valign="top">' +
            '        </td>' +
            '        <td class="acright">Events</td>' +
            '    </tr></table>';

        backIcon();
        var calendar = localStorage.getItem('academic_calendar');
        var json = JSON.parse(calendar);
        var string = "";

        var lastUpdate = localStorage.getItem("timeAcademicCalendar");

        if ((localStorage.getItem("isAcademicCalendar") == null || timeDifference(lastUpdate) > 20) && navigator.onLine)
            syncAcademicCalendar();

        for (var i = 0; i < json.length; i++) {

            var date = json[i].date;
            var month = json[i].month;
            var day = json[i].day;
            var year = json[i].year;
            var event = json[i].event;

            var monthInt = getMonthInt(month);
            var today = new Date();
            var isPassed = false;

            var pickedDatestr = date + ' ' + month + ' ' + year;
            var pickedDate = new Date(Date.parse(pickedDatestr));

            if (pickedDate <= today)
                isPassed = true;


            var acclass = "";

            if (isPassed == true)
                acclass = " acpassed";


            var string = '\n' +
                '    <table class="acitem"><tr>\n' +
                '        <td class="acleft" valign="top"><span class="ndate">' + date + '</span><span class="nmonth">' + month + '</span></td>\n' +
                '        <td class="acborder" valign="top">\n' +
                '            <div class="acCircle' + acclass + '"></div>\n' +
                '        </td>\n' +
                '        <td class="acright"><b>' + day + '</b> <p>' + event + '</p></td>\n' +
                '    </tr></table>';
            document.getElementById('content_pane').innerHTML += string;
        }


        var acp = document.getElementsByClassName("acpassed");

        if (acp = !undefined) {

            var length = document.querySelectorAll('.acpassed').length;

            document.getElementsByClassName('acpassed')[length - 2].scrollIntoView({
                block: 'start',
                behavior: 'smooth'
            });

        } else {

            $(window).scrollTop(0);

        }


        window.location.hash = 'academic_calendar';
    }


    function syncNotices() {
        $.getJSON("https://nsuer.club/apps/nsu-notice-events/notice.json", function (data) {


            var oldJson = localStorage.getItem('nsu_notices');

            var newJson = JSON.stringify(data['dataArray']);

            if (oldJson != newJson) {


                $.each(data['dataArray'], function (key, val) {

                    var tempJson = JSON.stringify(val);
                    addToStorage("nsu_notices", tempJson);

                });
                fragemntNotices();

            }
            var date = new Date();
            var timestamp = date.getTime() / 1000;
            localStorage.setItem('isNotices', 'added');
            localStorage.setItem('timeNotices', timestamp);

        });
    }

    function fragemntNotices() {
        document.getElementById('nav_title').innerHTML = "Notices";
        document.getElementById('content_pane').innerHTML = '';
        backIcon();
        var notices = localStorage.getItem('nsu_notices');
        var json = JSON.parse(notices);
        var string = "";

        var lastUpdate = localStorage.getItem("timeNotices");

        if ((localStorage.getItem("isNotices") == null || timeDifference(lastUpdate) > 20) && navigator.onLine)
            syncNotices();

        for (var i = 0; i < json.length; i++) {

            var title = json[i].title;
            var url = json[i].url;
            var date = json[i].date;


            const regex = /\d+/gm;
            const str = date;
            let m;


            var d = "01";
            var mn = "JAN";


            m = regex.exec(str);
            if (m) {
                d = m[0];
            }

            m = regex.exec(str);

            if (m) {
                mn = m[0];
            }


            var string = '<table class="notice_item">' +
                '<tr><td class="nleft">' +
                '<span class="ndate">' + d + '</span>' +
                '<span class="nmonth">' + getMonth(mn) + '</span></td>' +
                '<td class="nright">' +
                '<a href="http://www.northsouth.edu/' + url + '">' + title + '</a></td>' +
                '</tr>' +
                '</table>';
            document.getElementById('content_pane').innerHTML += string;
        }
        $(window).scrollTop(0);
        window.location.hash = 'nsu_notices';
    }


    function getMonth(num) {

        if (num == "01")
            return "JAN";
        else if (num == "02")
            return "FEB";
        else if (num == "03")
            return "MAR";
        else if (num == "04")
            return "APR";
        else if (num == "05")
            return "MAY";
        else if (num == "06")
            return "JUN";
        else if (num == "07")
            return "JUL";
        else if (num == "08")
            return "AUG";
        else if (num == "09")
            return "SEP";
        else if (num == "10")
            return "OCT";
        else if (num == "11")
            return "NOV";
        else
            return "DEC";

    }

    function getMonthInt(num) {


        if (num == "JAN")
            return 0;
        else if (num == "FEB")
            return 1;
        else if (num == "MAR")
            return 2;
        else if (num == "APR")
            return 3;
        else if (num == "MAY")
            return 4;
        else if (num == "JUN")
            return 5;
        else if (num == "JUL")
            return 6;
        else if (num == "AUG")
            return 7;
        else if (num == "SEP")
            return 8;
        else if (num == "OCT")
            return 9;
        else if (num == "NOV")
            return 10;
        else
            return 11;

    }

    function syncNewsfeed(isFirst) {

        var courses = localStorage.getItem('courses');
        var json = JSON.parse(courses);
        var stringC = json[0].course + "." + json[0].section;


        if (isFirst)
            showLoading();

        for (var i = 1; i < json.length; i++) {

            var course = json[i].course;
            var section = json[i].section;
            stringC += "," + json[i].course + "." + section;
        }


        $.getJSON("https://nsuer.club/apps/newsfeed/get-json-webapp.php?course=" + stringC, function (data) {


            if (isFirst) {
                removeLoading();
            }


            var oldJson = localStorage.getItem('newsfeed');

            var newJson = JSON.stringify(data['dataArray']);

            if (oldJson != newJson || isFirst == true) {


                localStorage.setItem("newsfeed", "[]");

                $.each(data['dataArray'], function (key, val) {

                    if (val.hasOwnProperty('likes')) {

                        var tempJson = JSON.stringify(val);
                        addToStorage("newsfeed", tempJson);

                    }

                });


                fragemntNewsfeed();
            }

            var date = new Date();
            var timestamp = date.getTime() / 1000;

            localStorage.setItem('isNewsfeed', 'added');
            localStorage.setItem('timeNewsfeed', timestamp);

        });

    }


    function linkify(text) {
        var urlRegex = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
        return text.replace(urlRegex, function (url) {
            return '<a href="' + url + '">' + url + '</a>';
        });
    }


    function timeDifference(previous) {


        previous = previous * 1000;

        var date = new Date();
        var current = date.getTime();

        var msPerMinute = 60 * 1000;
        var msPerHour = msPerMinute * 60;
        var msPerDay = msPerHour * 24;
        var msPerMonth = msPerDay * 30;
        var msPerYear = msPerDay * 365;

        var elapsed = current - previous;

        return Math.round(elapsed / msPerMinute);


    }


    function humanTiming(previous) {


        previous = previous * 1000;

        var date = new Date();
        var current = date.getTime();

        var msPerMinute = 60 * 1000;
        var msPerHour = msPerMinute * 60;
        var msPerDay = msPerHour * 24;
        var msPerMonth = msPerDay * 30;
        var msPerYear = msPerDay * 365;

        var elapsed = current - previous;

        if (elapsed < msPerMinute) {
            return Math.round(elapsed / 1000) + ' seconds ago';
        }

        else if (elapsed < msPerHour) {
            return Math.round(elapsed / msPerMinute) + ' minutes ago';
        }

        else if (elapsed < msPerDay) {
            return Math.round(elapsed / msPerHour) + ' hours ago';
        }

        else if (elapsed < msPerMonth) {
            return Math.round(elapsed / msPerDay) + ' days ago';
        }

        else if (elapsed < msPerYear) {
            return Math.round(elapsed / msPerMonth) + ' months ago';
        }

        else {
            return Math.round(elapsed / msPerYear) + ' years ago';
        }
    }

    function fragemntNewsfeed() {


        document.getElementById('nav_title').innerHTML = "Newsfeed";
        document.getElementById('content_pane').innerHTML = '';
        backIcon();


        document.getElementById("fixed_button_holder").innerHTML = '<button onclick="createPost()" class="floatingButtonTick fixed"><img src="/images/app-icons/plus.svg"/></button>';


        var courses = localStorage.getItem('newsfeed');
        var json = JSON.parse(courses);
        var string = "";


        var lastUpdate = localStorage.getItem("timeNewsfeed");

        if (localStorage.getItem("isNewsfeed") == null)
            syncNewsfeed(true);
        else if (timeDifference(lastUpdate) > 5 && navigator.onLine)
            syncNewsfeed(false);

        for (var i = 0; i < json.length; i++) {

            var course = json[i].course;
            var name = json[i].username;
            var image = json[i].picture;
            var gender = json[i].gender;
            var post = json[i].post;
            var time = json[i].time;
            post = post.replace(/\\n/g, '<br />');
            post = linkify(post);

            post = post.replace(/\\/g, '');

            if (image == "0" || image == "") {

                if (gender == "male")
                    image = "/images/app-icons/icons8_Male_User_1_edited.svg";
                else
                    image = "/images/app-icons/icons8_Female_Profile_1_edited.svg";
            }
            else
                image = '/images/profile_picture/' + image;

            var string = ' <div class="newsfeed_card"><div class="cm_left">' +
                '<div class="image_croper"><img src="' + image + '"></div></div>' +
                '<div class="nf_title"><b>' + name + ' > ' + course + '</b><br>' + humanTiming(time) + '</div>' +
                '<clear/>' +
                '<div class="post_text">' + post + '</div>' +
                '<div class="nf_buttons">' +
                '<div class="nf_like">Like</div>' +
                '<div class="nf_comment">Comment</div>' +
                '<div class="nf_report">Report</div>' +
                '<clear/>' +
                '</div>';

            document.getElementById('content_pane').innerHTML += string;
            $(".newsfeed_card").hide();

        }

        $(".newsfeed_card").slideToggle("fast");

        $(window).scrollTop(0);
        window.location.hash = 'newsfeed';

    }

</script>
<script>
    function syncClassmates(isFirst) {

        if (isFirst)
            showLoading();

        var courses = localStorage.getItem('courses');
        var json = JSON.parse(courses);
        var stringC = json[0].course + "." + json[0].section;

        for (var i = 1; i < json.length; i++) {

            var course = json[i].course;
            var section = json[i].section;

            stringC += "," + json[i].course + "." + section;

        }

        $.getJSON("https://nsuer.club/apps/classmates/get-json-2.php?course=" + stringC, function (data) {

            if (isFirst)
                removeLoading();


            var oldJson = localStorage.getItem('classmates');

            var newJson = JSON.stringify(data['dataArray']);

            if (oldJson != newJson || isFirst == true) {


                localStorage.setItem("classmates", "[]");
                $.each(data['dataArray'], function (key, val) {


                    if (val.hasOwnProperty('email')) {

                        var tempJson = JSON.stringify(val);
                        addToStorage("classmates", tempJson);

                    }
                });


                fragemntClassmates();
            }
            var date = new Date();
            var timestamp = date.getTime() / 1000;

            localStorage.setItem('isClassmates', 'added');
            localStorage.setItem('timeClassmates', timestamp);

        });

    }

    function showLoading() {


        document.getElementById('content_pane').innerHTML = '<div class="loading_bar"><img src="/images/app-icons/rolling.svg"></div>';


        $(window).scrollTop(0);
    }

    function removeLoading() {


        document.getElementById('content_pane').innerHTML = '';

    }


    function fragemntClassmates() {


        document.getElementById('nav_title').innerHTML = "Classmates";

        document.getElementById('content_pane').innerHTML = '';
        backIcon();

        var courses = localStorage.getItem('classmates');
        var json = JSON.parse(courses);
        var string = "";

        var lastUpdate = localStorage.getItem("timeClassmates");

        if ((localStorage.getItem("isClassmates") == null || timeDifference(lastUpdate) > 200) && navigator.onLine)
            syncClassmates();


        for (var i = 0; i < json.length; i++) {

            var course = json[i].course;
            var name = json[i].username;
            var image = json[i].picture;
            var gender = json[i].gender;

            if (image == "0" || image == "") {

                if (gender == "male")
                    image = "/images/app-icons/icons8_Male_User_1_edited.svg";
                else
                    image = "/images/app-icons/icons8_Female_Profile_1_edited.svg";

            }
            else
                image = '/images/profile_picture/' + image;

            var string = '<div class="classmates_card">' +
                '<div class="cm_left"><div class="image_croper"><img src="' + image + '"></div></div>' +
                '<div class="cm_middle"><b>' + name + '</b><br>' + course + '</div>' +
                '<div class="cm_right"><img src="/images/app-icons/message_material.svg"></div>' +
                '</div>';
            document.getElementById('content_pane').innerHTML += string;

        }

        $(window).scrollTop(0);

        window.location.hash = 'classmates';

    }


    var images = [];

    function preload() {
        for (var i = 0; i < arguments.length; i++) {
            images[i] = new Image();
            images[i].src = preload.arguments[i];
        }
    }

    preload(
        "/images/app-icons/left.svg",
    )


    function backIcon() {

        document.getElementById("menu_icon").src = "/images/app-icons/left.svg";

    }

    function menuIcon() {

        document.getElementById('menu_btn').innerHTML = '';
        document.getElementById("fixed_button_holder").innerHTML = '';


        document.getElementById("menu_icon").src = "/images/app-icons/menu.svg";

    }


    function menuBack() {


        var src = document.getElementById("menu_icon").src;

        if (src.includes("left"))
            fragmentHome();
        else {
            $('html, body').animate({
                scrollTop: $('#cat_scroll').offset().top - 60
            }, 400);
        }

    }


    function fragemntCourses() {

        document.getElementById('nav_title').innerHTML = "Courses";
        document.getElementById('content_pane').innerHTML = '';

        document.getElementById('menu_btn').innerHTML = '<img class="full_screen_button" src="/images/app-icons/plus.svg" onclick="addCourse();">';


        backIcon();

        var courses = localStorage.getItem('courses');
        var json = JSON.parse(courses);
        var string = "";

        for (var i = 0; i < json.length; i++) {

            var course = json[i].course;
            var faculty = json[i].faculty;
            var section = json[i].section;
            var startTime = json[i].startTime;
            var endTime = json[i].endTime;
            var room = json[i].room;
            var day = json[i].day;

            var string = '<div class="course_card material_shadow"><div class="course_card_header">  <span class="course_name">' + course + '</span> ' +
                '<span onclick="removeCourse(' + i + ',\'' + course + '\',' + section + ')" class="course_option"><img src="/images/app-icons/menu_dot.svg"></div></clear>' +
                '<table class="course_card_info"><tr><td><div class="course_card_section">' + section + '<sup>sec</sup></div></td>' +
                '<td> <div class="course_card_time"><div class="class_time"><span class="dot_top"></span><span class="time_line"></span>' +
                '<span class="dot_bottom"></span><span class="class_time_start">' + startTime + '</span><span class="class_time_end">' + endTime + '</span></div> ' +
                '</div> </td> <td><div class="course_card_day">' + day + '</div></td></table> ' +
                '<div class="course_card_bottom"><span class="course_faculty"> <img src="/images/app-icons/person.svg"> ' + faculty + '</span> ' +
                '<span class="course_room"><img src="/images/app-icons/classroom.svg"> ' + room + '</div> </clear></div>';

            document.getElementById('content_pane').innerHTML += string;
            $(".course_card").hide();

        }

        $(".course_card").slideToggle("fast");
        $(window).scrollTop(0);
        window.location.hash = 'courses';

    }


    function convertTo24Hour(str) {
        var timeParts = str.split(":");
        var minuteParts = timeParts[1].split(" ");

        var hours = parseInt(timeParts[0]);
        if (minuteParts[1] == "PM" & hours < 12)
            hours += 12;
        else if (minuteParts[1] == "AM" & hours == 12)
            hours -= 12;

        if (hours < 10)
            hours = "0" + hours;
        return hours + ":" + minuteParts[0];

    }


    function loadClasses() {

        document.getElementById('todays_classes').innerHTML = '';
        document.getElementById('tomorrows_classes').innerHTML = '';

        var courses = localStorage.getItem('courses');
        var json = JSON.parse(courses);

        json.sort(function (a, b) {
            return new Date('1970/01/01 ' + a.startTime) - new Date('1970/01/01 ' + b.startTime);
        });

        var string = "";


        var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        var daysShort = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        var daysNsu = ['S', 'M', 'T', 'W', 'R', 'F', 'A'];
        var today = new Date();
        var dn = today.getDay();
        var dd = today.getDate();

        var currentHour = today.getHours();

        if (currentHour < 10)
            currentHour = "0" + currentHour;

        var currentMin = today.getMinutes();

        var currentTime = currentHour + ":" + currentMin + ":00";

        var mm = today.getMonth(); //January is 0!
        var yyyy = today.getFullYear();

        todayFull = daysShort[dn] + ", " + dd + " " + monthNames[mm];
        document.getElementById('todays_date').innerHTML = todayFull;
        todayName = daysNsu[dn];


        var tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        var tdn = tomorrow.getDay();
        var tdd = tomorrow.getDate();
        var tmm = tomorrow.getMonth();
        var tyyyy = tomorrow.getFullYear();

        tomorrowFull = daysShort[tdn] + ", " + tdd + " " + monthNames[tmm];
        document.getElementById('tomorrows_date').innerHTML = tomorrowFull;
        tomorrowName = daysNsu[tdn];


        var todayCount = 0;
        var tomorrowCount = 0;

        for (var i = 0; i < json.length; i++) {

            var course = json[i].course;
            var faculty = json[i].faculty;
            var section = json[i].section;
            var startTime = json[i].startTime;
            var endTime = json[i].endTime;
            var room = json[i].room;
            var day = json[i].day;

            var start24 = convertTo24Hour(startTime);
            var end24 = convertTo24Hour(endTime);


            var isDoneIcon = "clock_circle_new";

            if (day.includes(todayName)) {

                if (currentTime > start24)
                    isDoneIcon = "progress";

                if (currentTime > end24)
                    isDoneIcon = "tick_circle";

            }


            var string = '<tr><td><div class="class_course">' + course + '<div class="cc_room">' + room + '</div></td>' +
                '<td><div class="class_time"><span class="dot_top"></span><span class="time_line"></span>' +
                '<span class="dot_bottom"></span>' +
                '<span class="class_time_start">' + startTime + '</span>' +
                '<span class="class_time_end">' + endTime + '</span></div></td>' +
                '<td><div class="class_is_done"><img src="/images/app-icons/' + isDoneIcon + '.svg"></div></td></tr>';

            if (day.includes(todayName)) {
                document.getElementById('todays_classes').innerHTML += string;
                todayCount++;

            }

            if (day.includes(tomorrowName)) {
                document.getElementById('tomorrows_classes').innerHTML += string;
                tomorrowCount++;

            }

        }

        if (todayCount > 0)
            document.getElementById('noclass_today').style.display = "none";

        if (tomorrowCount > 0)
            document.getElementById('noclass_tomorrow').style.display = "none";


    }


    function fragmentHome() {

        document.getElementById('nav_title').innerHTML = "NSUer";
        menuIcon();
        document.getElementById('profile_page').style.display = "block";
        document.getElementById('content_pane').innerHTML = document.getElementById('profile_page').innerHTML;

        loadClasses();

        var progressBarOptions = {
            startAngle: -1.55,
            size: 83,
            value: 0.75,
            thickness: 4,
            fill: {
                color: '#bbdefb'
            }
        }
        $('#circle-c').circleProgress(progressBarOptions).on('circle-animation-progress', function (event, progress, stepValue) {
            $(this).find('strong').text((stepValue * 4.0).toFixed(2));
        });

        $('#circle-b').circleProgress(progressBarOptions).on('circle-animation-progress', function (event, progress, stepValue) {
            $(this).find('strong').text((stepValue * 140).toFixed(0));
        });

        $('#circle-sm').circleProgress(progressBarOptions).on('circle-animation-progress', function (event, progress, stepValue) {
            $(this).find('strong').text((stepValue * 12).toFixed(0));
        });


        $('#user_name').text(localStorage.getItem("user_name"));
        $('#user_dept').text(departmentShort[localStorage.getItem("user_dept")]);


        var user_cgpa = localStorage.getItem("user_cgpa");

        var user_credit = localStorage.getItem("user_credit");


        document.getElementById("user_dept").innerHTML = departmentShort[localStorage.getItem("user_dept")];

        var user_semester;

        try {
            user_semester = parseFloat(localStorage.getItem("user_semester"));
        } catch (e) {
            user_semester = 0;
        }
        user_semester += 1;


        var user_picture = localStorage.getItem("user_picture");

        if (user_picture == 0 || user_picture == "0" || user_picture == null || user_picture == "" || user_picture == "null" || user_picture == null) {
        } else {

            document.getElementById("user_dp").src = "/images/profile_picture/" + user_picture;


        }

        $('#circle-c').circleProgress({
            value: (user_cgpa / 4.0)
            ,
            fill: {
                color: '#148ae5'
            }
        });
        $('#circle-b').circleProgress({
            value: (user_credit / 140)
            ,
            fill: {
                color: '#66b552'
            }
        });

        $('#circle-sm').circleProgress({
            value: (user_semester / 12),
            fill: {
                color: '#f3a424'
            }
        });

        $(window).scrollTop(0);
        window.location.hash = "";

    }

    function fragmentBooks() {

        document.getElementById('nav_title').innerHTML = "Books";
        document.getElementById('content_pane').innerHTML = '';

        var books = localStorage.getItem('books');
        backIcon();
        var json = JSON.parse(books);


        var string = "";

        for (var i = 0; i < json.length; i++) {

            var course = json[i].course;
            var booksj = json[i].books;
            var booksJsonn = JSON.parse(booksj);
            var booksJson = booksJsonn.books;

            var string = '<div class="books_container">        <div class="book_course">' + course + ' <span><img id="menu_icon_dot" src="/images/app-icons/menu_dot_dark.svg"></span></div> <clear/> <div class="books_scroller">';

            for (var j = 0; j < booksJson.length; j++) {

                var title = booksJson[j].name;
                var url = booksJson[j].link;

                var name;
                var edition;
                var author;

                var bookArray = title.split(" Ed ");

                if (bookArray.length > 1) {
                    var index = bookArray[0].lastIndexOf(" ");
                    name = bookArray[0].substring(0, index);
                    edition = bookArray[0].substring(bookArray[0].lastIndexOf(" ") + 1);
                    var bookArray2 = bookArray[1].split("by ");
                    author = "By " + bookArray2[1];

                } else {
                    name = title;
                    edition = "1st";
                    author = "For " + course;
                    if (title.includes("by ")) {
                        var bookArray3 = title.split("by");
                        name = bookArray3[0];
                        author = "By " + bookArray3[1];
                    }
                }

                string += '<div class="book_card">    <span class="book_title"> ' + name + '  </span>        <span class="book_edition">' + edition + ' Edition</span>    <span class="book_author">' + author + ' </span></div>';

            }

            string += '</div></div></div>';
            document.getElementById('content_pane').innerHTML += string;

            $(".books_container").hide();

        }

        $(".books_container").slideToggle("fast");
        $(window).scrollTop(0);
        window.location.hash = 'books';

    }


    function cutString(s, n) {
        var cut = s.indexOf(' ', n);
        if (cut == -1) return s;
        return s.substring(0, cut)
    }


    function fragemntFaculties() {

        document.getElementById('nav_title').innerHTML = "Faculties";
        document.getElementById('content_pane').innerHTML = '';
        backIcon();

        var courses = localStorage.getItem('faculties');
        var json = JSON.parse(courses);
        var string = "";

        for (var i = 0; i < json.length; i++) {

            var course = json[i].course;
            var section = json[i].section;

            var initial = json[i].initial;
            var name = cutString(json[i].name, 15);
            var rank = json[i].rank;
            var office = json[i].office;
            var dept = json[i].dept;

            var email = json[i].email;
            var phone = json[i].phone;

            var image = json[i].image;

            var imageUrl;

            switch (dept) {

                case "6":
                    imageUrl = "http://institutions.northsouth.edu/cee/" + image;
                    break;
                case "16":
                    imageUrl = "http://ece.northsouth.edu/wp-content/" + image;
                    break;
                default:
                    imageUrl = "http://www.northsouth.edu/" + image;
            }


            if (image == null || image == "") {

                imageUrl = "/images/app-icons/default_user_pic.png";

            }


            if (phone == "")
                phone = "+880255668200";

            var ext = json[i].ext;
            var dept2;

            switch (dept) {

                case "1":
                    dept2 = "Department Of Accounting & Finance";
                    break;
                case "2":
                    dept2 = "Department Of Economics";
                    break;
                case "3":
                    dept2 = "Department Of Management";
                    break;
                case "4":
                    dept2 = "Dept Of Marketing & International Business";
                    break;
                case "5":
                    dept2 = "Department Of Architecture";
                    break;
                case "6":
                    dept2 = "Dept Of Civil and Environmental Engineering";
                    break;
                case "7":
                    dept2 = "Department Of Mathematics & Physics";
                    break;
                case "8":
                    dept2 = "Department Of English & Modern Languages";
                    break;
                case "9":
                    dept2 = "Department Of Political Science & Sociology";
                    break;
                case "10":
                    dept2 = "Department Of Law";
                    break;
                case "11":
                    dept2 = "Department Of History & Philosophy";
                    break;
                case "12":
                    dept2 = "Department Of Biochemistry & Microbiology";
                    break;
                case "13":
                    dept2 = "Dept Of Environmental Science & Management";
                    break;
                case "14":
                    dept2 = "Department Of Pharmaceutical Sciences";
                    break;
                case "15":
                    dept2 = "Department Of Public Health";
                    break;
                case "16":
                    dept2 = "Dept Of Electrical & Computer Engineering";
                    break;

            }

            var string = '<div class="faculty_card material_shadow"><table><tr><td><div class="image_croper">' +
                '<img src="' + imageUrl + '"></div><br/> ' +
                '<b class="faculty_name">' + name + '</b><span class="faculty_rank">' + rank + '</span></td> <td> <div class="divider_line"></div> </td>  ' +
                '<td><div class="faculty_short"><span><img src="/images/app-icons/user_win.svg"> ' + initial + '</span><span><img src="/images/app-icons/book_win.svg"> ' + course + '</span><span><img src="/images/app-icons/door_win.svg"> SECTION ' + section + '</span></div></td><tr></table>' +
                '<div class="faculty_contact">' +
                '        <div class="faculty_email"><img src="/images/app-icons/message_win.svg"> <a href="mailto:' + email + '">' + email + '</a></div>' +
                '        <div class="faculty_phone"><img src="/images/app-icons/phone_win.svg"> <a href="tel:' + phone + '">' + phone + '</a> ' + ' Ext - ' + ext + '</div>' +
                '        <div class="faculty_office"><img src="/images/app-icons/marker_win.svg"> ' + office + '</div>' +
                '        <div class="faculty_dept"><img src="/images/app-icons/university_win.svg"> ' + dept2 + '</div>' +
                '</div></div>';

            document.getElementById('content_pane').innerHTML += string;
            $(".faculty_card").hide();

        }

        $(".faculty_card").slideToggle("fast");
        $(window).scrollTop(0);
        window.location.hash = 'faculties';

    }

    $(window).on('hashchange', function () {
        if (window.location.hash == "")
            fragmentHome();
    });


    $(document).ready(function () {

        var uid = localStorage.getItem("user_uid");

        if (document.cookie.indexOf('rememberme2') < 0)
            sendPing("https://nsuer.club/user/uid-login.php?uid=" + uid);

    });


</script>


<div class="hidden">
    <div id="profile_page">
        <div class="cover_background">
            <div class="dp_holder">
                <div class="image_croper">
                    <img id="user_dp" src="/images/app-icons/default_user_pic.png">
                </div>
                <div class="user_info">
                    <span id="user_name">Name</span><br>
                    <span id="user_dept_holder"><span
                                class="fill-class-ic"><?php echo file_get_contents("../images/app-icons/graduation_cap.svg"); ?></span> <span
                                id="user_dept">BS in CSE</span></span>
                </div>
                <a id="edit_profile_btn" onclick="loadEditProfile()">EDIT PROFILE</a>
                <a id="rds_btn" target="_blank" href="https://rds3.northsouth.edu/">NSU RDS</a>
            </div>
        </div>
        <div class="student_stats_holder material_shadow">
            <div class="circle" id="circle-c">
                <strong></strong><br>
                <p>CGPA</p>
            </div>
            <div class="circle" id="circle-b">
                <strong></strong><br>
                <p>CREDIT</p>
            </div>
            <div class="circle" id="circle-sm">
                <strong></strong><br>
                <p>SEMs</p></div>
        </div>
        <div class="todays_class_holder cards material_shadow">
            <div class="todays_class_bg cards_inside">
                <div class="card_title">
                    <div class="card_name">TODAY</div>
                    <div class="card_solid" id="todays_date">Mon, 24 September</div>
                </div>
                <clear/>
                <div class="classes_list_holder">
                    <div class="class_single_holder">
                        <table border="0" id="todays_classes"></table>
                    </div>
                    <div id="noclass_today" class="no_class">
                        <img src="/images/app-icons/thumbs_up.svg"><br>
                        <p>No Classes Today</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="tomorrows_class_holder cards material_shadow">
            <div class="tomorrows_class_bg cards_inside">
                <div class="card_title">
                    <div class="card_name">TOMORROW</div>
                    <div class="card_solid" id="tomorrows_date">Tue, 25 September</div>
                </div>
                <div class="classes_list_holder">
                    <div class="class_single_holder">
                        <table border="0" id="tomorrows_classes"></table>
                    </div>
                    <div id="noclass_tomorrow" class="no_class">
                        <img src="/images/app-icons/thumbs_up.svg"><br>
                        <p>No Classes Tomorrow</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="weather_class_holder cards material_shadow" style="display: none;">
            <div class="weather_class_bg cards_inside">
                <div class="card_title">
                    <div class="card_name">WEATHER</div>
                </div>
            </div>
        </div>
        <div class="categories">
            <div id="cat_scroll"></div>
            <table class="categories_table" width="100%">
                <tr>
                    <td onclick="fragemntCourses();">
                        <div class="fill-class"><img src="/images/app-icons/course.svg"></div>
                        <br>Courses
                    </td>
                    <td onclick="fragemntClassmates();">
                        <div class="fill-class"><img src="/images/app-icons/classmates.svg"></div>
                        <br>Classmates
                    </td>
                    <td onclick="fragemntNewsfeed();">
                        <div class="fill-class"><img src="/images/app-icons/newsfeed.svg"></div>
                        <br>Newsfeed
                    </td>
                </tr>
                <tr>
                    <td onclick="fragemntFaculties();">
                        <div class="fill-class"><img src="/images/app-icons/faculties.svg"></div>
                        <br>Faculties
                    </td>
                    <td onclick="fragemntNotices();">
                        <div class="fill-class"><img src="/images/app-icons/notices.svg"></div>
                        <br>NSU Notices
                    </td>
                    <td onclick=fragemntAcademicCalendar()>
                        <div class="fill-class"><img src="/images/app-icons/calendar.svg"></div>
                        <br>Academic Calendar
                    </td>
                </tr>
                <tr>
                    <td onclick="fragmentBooks();">
                        <div class="fill-class"><img src="/images/app-icons/book.svg"></div>
                        <br>Books
                    </td>
                    <td onclick="fragmentClassroutine()">
                        <div class="fill-class"><img src="/images/app-icons/classroom.svg"></div>
                        <br>Class Routine
                    </td>
                    <td onclick="fragemntAdvisingArchive()">
                        <div class="fill-class"><img src="/images/app-icons/archive_white.svg"></div>
                        <br>Advising Archive
                    </td>
                </tr>
                <tr>
                    <td onclick="fragmentCgpaCalculator()">
                        <div class="fill-class"><img src="/images/app-icons/calculator.svg"></div>
                        <br>CGPA Calculator
                    </td>
                    <td onclick="fragmentCgpaAnalyzer()">
                        <div class="fill-class"><img src="/images/app-icons/analyzer.svg"></div>
                        <br>CGPA Analyzer
                    </td>
                    <td onclick="fragmentFacultyPredictor()">
                        <div class="fill-class"><img src="/images/app-icons/predictor.svg"></div>
                        <br>Faculty Predictor
                    </td>
                </tr>
                <tr>
                    <td onclick="fragmentFacultyPoll()">
                        <div class="fill-class"><img src="/images/app-icons/faculty_rankings.svg"></div>
                        <br>Faculty Poll
                    </td>
                    <td onclick="fragemntAdvisingAssistant()">
                        <div class="fill-class"><img src="/images/app-icons/advising_assistant.svg"></div>
                        <br>Advising Assistant
                    </td>
                    <td onclick="fragmentShop()">
                        <div class="fill-class"><img src="/images/app-icons/cart.svg"></div>
                        <br>Buy Sell
                    </td>
                    <td>

                </tr>

                <!--<tr>-->
                <!--<td>-->
                <!--<div class="fill-class"><?php echo file_get_contents("images/app-icons/download.svg"); ?></div>-->
                <!--<br>-->
                <!--Storage</td>-->
                <!--<td>-->
                <!--<div class="fill-class"><?php echo file_get_contents("images/app-icons/weather.svg"); ?></div>-->
                <!--<br>Weather</td>-->
                <!--<div class="fill-class"><?php echo file_get_contents("images/app-icons/handshake.svg"); ?></div>-->
                <!--<br>Contribute</td>-->
                <!--</tr>-->

            </table>
        </div>
    </div>
</div>
<script>

    var elem = document.documentElement;

    /* View in fullscreen */
    function openFullscreen() {
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.mozRequestFullScreen) { /* Firefox */
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
            elem.webkitRequestFullscreen();
        } else if (elem.msRequestFullscreen) { /* IE/Edge */
            elem.msRequestFullscreen();
        }
    }

</script>
</body>
</html>
<?php
//echo 'Total execution time in seconds: ' . (microtime(true) - $time_start);
?>