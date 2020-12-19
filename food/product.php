<div class="overlay-content">

    <div class="boxpad">
        <div class="rating">
            <a href="javascript:void(0)" class="closebtn" onclick="closeRating()">&times;</a>


            <img class="orgImg" src="https://nsuer.club/images/thumb/<?php echo $_GET['urls']; ?>.jpg">

            <h2 class="ratingTitle"><?php echo $_GET['food']; ?></h2>
            <div class="shopn"><b>Shop:</b> <?php echo $_GET['shop']; ?></div>
            <div class="shopn"><b>Price:</b> <?php echo $_GET['price']; ?> ৳</div>

            <section class='rating-widget'>

                <!-- Rating Stars Box -->
                <div class='rating-stars text-center'>
                    <ul id='stars'>
                        <li class='star' title='Poor' data-value='1'>
                            <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star' title='Fair' data-value='2'>
                            <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star' title='Good' data-value='3'>
                            <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star' title='Excellent' data-value='4'>
                            <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star' title='WOW!!!' data-value='5'>
                            <i class='fa fa-star fa-fw'></i>
                        </li>
                    </ul>
                </div>
            </section>

            <div id="reviews">
                <ul>
                    <li>Star rating and review features are coming soon...</li>
                </ul>

            </div>
        </div>
    </div>

    <style>
        .boxpad {
            margin: 10px;
            margin-top: 13px;
        }

        .shopn {
            margin-left: 15px;
            margin-bottom: 20px;
            margin-top: 20px;
        }

        .ratingTitle {
            margin-left: 15px;
            margin-bottom: 20px;
            margin-top: 20px;
        }

        .rating {
            margin: 10px;
            padding: 0px;
            background: #fff;
            border-radius: 5px;

            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            max-width: 640px;
            margin: auto;
        }

        .orgImg {
            width: 100%;
            border-radius: 0px;

        }

        .rating li {
            color: #232323;
            padding-top: 10px;
            padding-bottom: 10px;
            font-size: 15px;
            background: #f9f1f1;
            border-radius: 5px;
            padding-left: 15px;
            margin-bottom: 6px;
            margin-top: 8px;
            padding-right: 15px;
        }

        .rating ul {

            margin: 15px;
        }

    </style>
<?php


?>