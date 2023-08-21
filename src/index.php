<?php
require '../vendor/autoload.php';
require __DIR__ . '/classes/book.class.php';
require __DIR__ . '/classes/library.class.php';


use League\Csv\XMLConverter;
use League\Csv\Reader;
use League\Csv\Statement;

session_start();

$csv = Reader::createFromPath('../datas/goodreads_Top100_YAFiction.csv', 'r');
$csv->setDelimiter(',');
$csv->setHeaderOffset(0);


//get 25 records starting from the 11th row
$stmt = Statement::create()
    // ->offset(10)
    // ->limit(25);
;

$booksList = [];
$records = $stmt->process($csv);
foreach ($records as $record) {
    $booksList[] = new Book($record['rank'], $record['bookId'], $record['title'], $record['series'], $record['numberOfSeries'], $record['author'], $record['authorLastFirst'], $record['description'], $record['language'], $record['genres'], $record['characters'], $record['setting'], $record['coverImg'], $record['bookFormat'], $record['edition'], $record['pages'], $record['publisher'], $record['publishedYear'], $record['firstPublishYear'], $record['awards'], $record['rating'], $record['numRatings'], $record['ISBN'], $record['ISBN13']);
}
$library = new Library($booksList);
if (isset($_GET['genreName'])) {
    $library->filteredBooks = $library->getBooksByGenre($_GET['genreName']);
    $_SESSION['gets'] = $_GET;
}

if (isset($_GET['search-value'])) {
    $library->filteredBooks = $library->getBooksByNames($_GET['search-value']);
    $_SESSION['gets'] = $_GET;
}

if (isset($_GET['sorting-selector'])) {
    $library->filteredBooks = $library->filterBy($_GET['sorting-selector']);
}

// dump($_GET);
$converter = (new XMLConverter())
    ->rootElement('csv')
    ->recordElement('record', 'offset')
    ->fieldElement('field', 'name');

$dom = $converter->convert($csv);
$dom->formatOutput = true;
$dom->encoding = 'iso-8859-15';



if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['title-selector'])) {
    // dump($_GET);
    $_SESSION['bookId'] = $_GET['title-selector'];
}


// echo '<pre>', PHP_EOL;
// echo htmlentities($dom->saveXML());




// class Books {
//    public function __construct($rank, $bookId, $title, $series, $)
//    {

//    }
// }
?>
<html>

<!-- <body>
    <form action="index.php" method="get">

        <select name="title-selector" id="title-selector">
            <php foreach ($booksList as $book) { ?>
                <option value="<= $book['bookId'] ?>"><= $book['title'] ?></option>
            <php } ?>
        </select>
        <input type="submit" name="submit-btn" id="submit-btn" value="Rechercher">
    </form>

    <div class="row"></div>
</body> -->

<head>
    <meta charset="utf-8">
    <link rel="dns-prefetch" href="//s3.envato.com">
    <link rel="preload" href="https://public-assets.envato-static.com/assets/generated_sprites/logos-20f56d7ae7a08da2c6698db678490c591ce302aedb1fcd05d3ad1e1484d3caf9.png" as="image">
    <link rel="preload" href="https://public-assets.envato-static.com/assets/generated_sprites/common-5af54247f3a645893af51456ee4c483f6530608e9c15ca4a8ac5a6e994d9a340.png" as="image">

    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <title>Boighor – Books Store Library eCommerce Template Preview - ThemeForest</title>
    <meta name="description" content="&amp;lt;p&amp;gt;Boighor – Books Store Library eCommerce Template is a neat, clean and simple designed bo...">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
    <meta name="turbo-visit-control" content="reload">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" media="all" href="https://public-assets.envato-static.com/assets/market/core/index-a23006723f9c650f843231dfe5ea70ba33fe1c0dac30968b043259a859edff53.css">
    <link rel="stylesheet" media="all" href="https://public-assets.envato-static.com/assets/market/pages/preview/index-c20c294967c4ed0be90d33e130e591a57859fccaebd0a19bf00bf499d001afc3.css">
    <link rel="stylesheet" href="https://htmldemo.net/boighor/boighor/css/bootstrap.min.css">
    <link rel="apple-touch-icon-precomposed" type="image/x-icon" href="https://public-assets.envato-static.com/icons/themeforest.net/apple-touch-icon-72x72-precomposed.png" sizes="72x72">
    <link rel="apple-touch-icon-precomposed" type="image/x-icon" href="https://public-assets.envato-static.com/icons/themeforest.net/apple-touch-icon-114x114-precomposed.png" sizes="114x114">
    <link rel="apple-touch-icon-precomposed" type="image/x-icon" href="https://public-assets.envato-static.com/icons/themeforest.net/apple-touch-icon-144x144-precomposed.png" sizes="144x144">
    <link rel="apple-touch-icon-precomposed" type="image/x-icon" href="https://public-assets.envato-static.com/icons/themeforest.net/apple-touch-icon-precomposed.png">

    <script async="" src="https://s.pinimg.com/ct/lib/main.bd3e0b05.js"></script>
    <script type="text/javascript" async="" src="https://s.pinimg.com/ct/core.js" nonce="xwUlogTxD7tYnfk9vLQa5w=="></script>
    <script type="text/javascript" async="" src="https://bat.bing.com/bat.js" nonce="xwUlogTxD7tYnfk9vLQa5w=="></script>
    <script type="text/javascript" charset="UTF-8" async="" src="https://consentcdn.cookiebot.com/consentconfig/4a6af4ea-f614-41d8-b0a9-8bb6d7fe4799/state.js"></script>
    <script type="text/javascript" charset="UTF-8" async="" src="https://consent.cookiebot.com/logconsent.ashx?action=accept&amp;nocache=1691584788854&amp;dnt=false&amp;method=strict&amp;clp=true&amp;cls=true&amp;clm=true&amp;cbid=4a6af4ea-f614-41d8-b0a9-8bb6d7fe4799&amp;cbt=optin&amp;hasdata=true&amp;usercountry=FR&amp;referer=https%3A%2F%2Fpreview.themeforest.net"></script>
    <script src="https://public-assets.envato-static.com/assets/market/pages/full_screen_preview/index-b2878e4fd061aa37abd149a58ff6cf692a5d3bc1bbf40f9424cf2ee0f3984a72.js" nonce="xwUlogTxD7tYnfk9vLQa5w=="></script>

    <script nonce="xwUlogTxD7tYnfk9vLQa5w==">
        //<![CDATA[
        //function to fix height of iframe!
        var calcHeight = function() {
            var headerDimensions = $('.preview__header').height();
            $('.full-screen-preview__frame').height($(window).height() - headerDimensions);
        }

        $(document).ready(function() {
            calcHeight();
        });

        $(window).resize(function() {
            calcHeight();
        }).load(function() {
            calcHeight();
        });

        //]]>
    </script>


    <style type="text/css" id="CookieConsentStateDisplayStyles">
        .cookieconsent-optin,
        .cookieconsent-optin-preferences,
        .cookieconsent-optin-statistics,
        .cookieconsent-optin-marketing {
            display: block;
            display: initial;
        }

        .cookieconsent-optout-preferences,
        .cookieconsent-optout-statistics,
        .cookieconsent-optout-marketing,
        .cookieconsent-optout {
            display: none;
        }
    </style>
    <meta http-equiv="origin-trial" content="AymqwRC7u88Y4JPvfIF2F37QKylC04248hLCdJAsh8xgOfe/dVJPV3XS3wLFca1ZMVOtnBfVjaCMTVudWM//5g4AAAB7eyJvcmlnaW4iOiJodHRwczovL3d3dy5nb29nbGV0YWdtYW5hZ2VyLmNvbTo0NDMiLCJmZWF0dXJlIjoiUHJpdmFjeVNhbmRib3hBZHNBUElzIiwiZXhwaXJ5IjoxNjk1MTY3OTk5LCJpc1RoaXJkUGFydHkiOnRydWV9">
    <script type="text/javascript" async="" src="https://googleads.g.doubleclick.net/pagead/viewthroughconversion/943617023/?random=1691584789245&amp;cv=11&amp;fst=1691584789245&amp;bg=ffffff&amp;guid=ON&amp;async=1&amp;gtm=45He3870&amp;u_w=1536&amp;u_h=864&amp;url=https%3A%2F%2Fpreview.themeforest.net%2Fitem%2Fboighor-books-library-ecommerce-store%2Ffull_screen_preview%2F22173065%3F_ga%3D2.190480811.1423815833.1691584470-652254206.1690313424&amp;ref=https%3A%2F%2Fthemeforest.net%2F&amp;hn=www.googleadservices.com&amp;frm=0&amp;tiba=Boighor%20%E2%80%93%20Books%20Store%20Library%20eCommerce%20Template%20Preview%20-%20ThemeForest&amp;us_privacy=1---&amp;auid=1818588447.1690313433&amp;uaa=x86&amp;uab=64&amp;uafvl=Not%252FA)Brand%3B99.0.0.0%7CGoogle%2520Chrome%3B115.0.5790.171%7CChromium%3B115.0.5790.171&amp;uamb=0&amp;uap=Windows&amp;uapv=10.0.0&amp;uaw=0&amp;rfmt=3&amp;fmt=4" nonce="xwUlogTxD7tYnfk9vLQa5w=="></script>
    <script src="https://bat.bing.com/p/action/16005611.js" type="text/javascript" async="" data-ueto="ueto_2d33c8e852"></script>
    <meta http-equiv="origin-trial" content="AxMeahpLO9nDB/vFXFMGOd/JLhKWx/mOjErAi0qFXDzWuMSYoKpfjFtFfQWMCx+Qg39PMxDJHSLlAJF/H8rtmAwAAABveyJvcmlnaW4iOiJodHRwczovL3MucGluaW1nLmNvbTo0NDMiLCJmZWF0dXJlIjoiUHJpdmFjeVNhbmRib3hBZHNBUElzIiwiZXhwaXJ5IjoxNjgwNjUyNzk5LCJpc1RoaXJkUGFydHkiOnRydWV9">
</head>

<body>
    <!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade
    your browser</a> to improve your experience and security.</p>
<![endif]-->

    <!-- Main wrapper -->
    <div class="wrapper" id="wrapper">

        <!-- Header -->
        <header id="wn__header" class="oth-page header__area header__absolute sticky__header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-7 col-lg-2">
                        <div class="logo">
                            <a href="index.html">
                                <img src="https://htmldemo.net/boighor/boighor/images/logo/logo.png" alt="logo images">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8 d-none d-lg-block">
                        <nav class="mainmenu__nav">
                            <ul class="meninmenu d-flex justify-content-start">
                                <li class="drop with--one--item" style="position: relative;"><a href="index.html">Home</a>
                                    <div class="megamenu dropdown">
                                        <ul class="item item01">
                                            <li><a href="index.html">Home Style Default</a></li>
                                            <li><a href="index-2.html">Home Style Two</a></li>
                                            <li><a href="index-3.html">Home Style Three</a></li>
                                            <li><a href="index-box.html">Home Box Style</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="drop"><a href="#">Shop</a>
                                    <div class="megamenu mega03">
                                        <ul class="item item03">
                                            <li class="title">Shop Layout</li>
                                            <li><a href="shop-grid.html">Shop Grid</a></li>
                                            <li><a href="shop-list.html">Shop List</a></li>
                                            <li><a href="shop-left-sidebar.html">Shop Left Sidebar</a></li>
                                            <li><a href="shop-right-sidebar.html">Shop Right Sidebar</a></li>
                                            <li><a href="shop-no-sidebar.html">Shop No sidebar</a></li>
                                            <li><a href="single-product.html">Single Product</a></li>
                                        </ul>
                                        <ul class="item item03">
                                            <li class="title">Shop Page</li>
                                            <li><a href="my-account.html">My Account</a></li>
                                            <li><a href="cart.html">Cart Page</a></li>
                                            <li><a href="checkout.html">Checkout Page</a></li>
                                            <li><a href="wishlist.html">Wishlist Page</a></li>
                                            <li><a href="error404.html">404 Page</a></li>
                                            <li><a href="faq.html">Faq Page</a></li>
                                        </ul>
                                        <ul class="item item03">
                                            <li class="title">Bargain Books</li>
                                            <li><a href="shop-grid.html">Bargain Bestsellers</a></li>
                                            <li><a href="shop-grid.html">Activity Kits</a></li>
                                            <li><a href="shop-grid.html">B&amp;N Classics</a></li>
                                            <li><a href="shop-grid.html">Books Under $5</a></li>
                                            <li><a href="shop-grid.html">Bargain Books</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="drop"><a href="shop-grid.html">Books</a>
                                    <div class="megamenu mega03">
                                        <ul class="item item03">
                                            <li class="title">Categories</li>
                                            <li><a href="shop-grid.html">Biography </a></li>
                                            <li><a href="shop-grid.html">Business </a></li>
                                            <li><a href="shop-grid.html">Cookbooks </a></li>
                                            <li><a href="shop-grid.html">Health &amp; Fitness </a></li>
                                            <li><a href="shop-grid.html">History </a></li>
                                        </ul>
                                        <ul class="item item03">
                                            <li class="title">Favourite</li>
                                            <li><a href="shop-grid.html">Mystery</a></li>
                                            <li><a href="shop-grid.html">Religion &amp; Inspiration</a></li>
                                            <li><a href="shop-grid.html">Romance</a></li>
                                            <li><a href="shop-grid.html">Fiction/Fantasy</a></li>
                                            <li><a href="shop-grid.html">Sleeveless</a></li>
                                        </ul>
                                        <ul class="item item03">
                                            <li class="title">Collections</li>
                                            <li><a href="shop-grid.html">Science </a></li>
                                            <li><a href="shop-grid.html">Fiction/Fantasy</a></li>
                                            <li><a href="shop-grid.html">Self-Improvemen</a></li>
                                            <li><a href="shop-grid.html">Home &amp; Garden</a></li>
                                            <li><a href="shop-grid.html">Humor Books</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="drop"><a href="shop-grid.html">Kids</a>
                                    <div class="megamenu mega02">
                                        <ul class="item item02">
                                            <li class="title">Top Collections</li>
                                            <li><a href="shop-grid.html">American Girl</a></li>
                                            <li><a href="shop-grid.html">Diary Wimpy Kid</a></li>
                                            <li><a href="shop-grid.html">Finding Dory</a></li>
                                            <li><a href="shop-grid.html">Harry Potter</a></li>
                                            <li><a href="shop-grid.html">Land of Stories</a></li>
                                        </ul>
                                        <ul class="item item02">
                                            <li class="title">More For Kids</li>
                                            <li><a href="shop-grid.html">B&amp;N Educators</a></li>
                                            <li><a href="shop-grid.html">B&amp;N Kids' Club</a></li>
                                            <li><a href="shop-grid.html">Kids' Music</a></li>
                                            <li><a href="shop-grid.html">Toys &amp; Games</a></li>
                                            <li><a href="shop-grid.html">hoodies</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="drop" style="position: relative;"><a href="#">Pages</a>
                                    <div class="megamenu dropdown">
                                        <ul class="item item01">
                                            <li><a href="about.html">About Page</a></li>
                                            <li class="label2"><a href="portfolio.html">Portfolio</a>
                                                <ul>
                                                    <li><a href="portfolio.html">Portfolio</a></li>
                                                    <li><a href="portfolio-three-column.html">Portfolio 3 Column</a>
                                                    </li>
                                                    <li><a href="portfolio-details.html">Portfolio Details</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="my-account.html">My Account</a></li>
                                            <li><a href="cart.html">Cart Page</a></li>
                                            <li><a href="checkout.html">Checkout Page</a></li>
                                            <li><a href="wishlist.html">Wishlist Page</a></li>
                                            <li><a href="error404.html">404 Page</a></li>
                                            <li><a href="faq.html">Faq Page</a></li>
                                            <li><a href="team.html">Team Page</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="drop" style="position: relative;"><a href="blog.html">Blog</a>
                                    <div class="megamenu dropdown">
                                        <ul class="item item01">
                                            <li><a href="blog.html">Blog Page</a></li>
                                            <li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
                                            <li><a href="blog-no-sidebar.html">Blog No Sidebar</a></li>
                                            <li><a href="blog-details.html">Blog Details</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li><a href="contact.html">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-md-8 col-sm-8 col-5 col-lg-2">
                        <ul class="header__sidebar__right d-flex justify-content-end align-items-center">
                            <li class="shop_search"><a class="search__active" href="#"></a></li>
                            <li class="wishlist"><a href="#"></a></li>
                            <li class="shopcart"><a class="cartbox_active" href="#"><span class="product_qun">3</span></a>
                                <!-- Start Shopping Cart -->
                                <div class="block-minicart minicart__active">
                                    <div class="minicart-content-wrapper">
                                        <div class="micart__close">
                                            <span>close</span>
                                        </div>
                                        <div class="items-total d-flex justify-content-between">
                                            <span>3 items</span>
                                            <span>Cart Subtotal</span>
                                        </div>
                                        <div class="total_amount text-end">
                                            <span>$66.00</span>
                                        </div>
                                        <div class="mini_action checkout">
                                            <a class="checkout__btn" href="cart.html">Go to Checkout</a>
                                        </div>
                                        <div class="single__items">
                                            <div class="miniproduct">
                                                <div class="item01 d-flex">
                                                    <div class="thumb">
                                                        <a href="product-details.html"><img src="https://htmldemo.net/boighor/boighor/images/product/sm-img/1.jpg" alt="product images"></a>
                                                    </div>
                                                    <div class="content">
                                                        <h6><a href="product-details.html">Voyage Yoga Bag</a></h6>
                                                        <span class="price">$30.00</span>
                                                        <div class="product_price d-flex justify-content-between">
                                                            <span class="qun">Qty: 01</span>
                                                            <ul class="d-flex justify-content-end">
                                                                <li><a href="#"><i class="zmdi zmdi-settings"></i></a>
                                                                </li>
                                                                <li><a href="#"><i class="zmdi zmdi-delete"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item01 d-flex mt--20">
                                                    <div class="thumb">
                                                        <a href="product-details.html"><img src="https://htmldemo.net/boighor/boighor/images/product/sm-img/3.jpg" alt="product images"></a>
                                                    </div>
                                                    <div class="content">
                                                        <h6><a href="product-details.html">Impulse Duffle</a></h6>
                                                        <span class="price">$40.00</span>
                                                        <div class="product_price d-flex justify-content-between">
                                                            <span class="qun">Qty: 03</span>
                                                            <ul class="d-flex justify-content-end">
                                                                <li><a href="#"><i class="zmdi zmdi-settings"></i></a>
                                                                </li>
                                                                <li><a href="#"><i class="zmdi zmdi-delete"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item01 d-flex mt--20">
                                                    <div class="thumb">
                                                        <a href="product-details.html"><img src="https://htmldemo.net/boighor/boighor/images/product/sm-img/2.jpg" alt="product images"></a>
                                                    </div>
                                                    <div class="content">
                                                        <h6><a href="product-details.html">Compete Track Tote</a></h6>
                                                        <span class="price">$40.00</span>
                                                        <div class="product_price d-flex justify-content-between">
                                                            <span class="qun">Qty: 03</span>
                                                            <ul class="d-flex justify-content-end">
                                                                <li><a href="#"><i class="zmdi zmdi-settings"></i></a>
                                                                </li>
                                                                <li><a href="#"><i class="zmdi zmdi-delete"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mini_action cart">
                                            <a class="cart__btn" href="cart.html">View and edit cart</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Shopping Cart -->
                            </li>
                            <li class="setting__bar__icon"><a class="setting__active" href="#"></a>
                                <div class="searchbar__content setting__block">
                                    <div class="content-inner">
                                        <div class="switcher-currency">
                                            <strong class="label switcher-label">
                                                <span>Currency</span>
                                            </strong>
                                            <div class="switcher-options">
                                                <div class="switcher-currency-trigger">
                                                    <span class="currency-trigger">USD - US Dollar</span>
                                                    <ul class="switcher-dropdown">
                                                        <li>GBP - British Pound Sterling</li>
                                                        <li>EUR - Euro</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="switcher-currency">
                                            <strong class="label switcher-label">
                                                <span>Language</span>
                                            </strong>
                                            <div class="switcher-options">
                                                <div class="switcher-currency-trigger">
                                                    <span class="currency-trigger">English01</span>
                                                    <ul class="switcher-dropdown">
                                                        <li>English02</li>
                                                        <li>English03</li>
                                                        <li>English04</li>
                                                        <li>English05</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="switcher-currency">
                                            <strong class="label switcher-label">
                                                <span>Select Store</span>
                                            </strong>
                                            <div class="switcher-options">
                                                <div class="switcher-currency-trigger">
                                                    <span class="currency-trigger">Fashion Store</span>
                                                    <ul class="switcher-dropdown">
                                                        <li>Furniture</li>
                                                        <li>Shoes</li>
                                                        <li>Speaker Store</li>
                                                        <li>Furniture</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="switcher-currency">
                                            <strong class="label switcher-label">
                                                <span>My Account</span>
                                            </strong>
                                            <div class="switcher-options">
                                                <div class="switcher-currency-trigger">
                                                    <div class="setting__menu">
                                                        <span><a href="#">Compare Product</a></span>
                                                        <span><a href="#">My Account</a></span>
                                                        <span><a href="#">My Wishlist</a></span>
                                                        <span><a href="#">Sign In</a></span>
                                                        <span><a href="#">Create An Account</a></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Start Mobile Menu -->
                <div class="row d-none">
                    <div class="col-lg-12 d-none">
                        <nav class="mobilemenu__nav" style="display: block;">
                            <ul class="meninmenu">
                                <li><a href="index.html">Home</a>
                                    <ul>
                                        <li><a href="index.html">Home Style Default</a></li>
                                        <li><a href="index-2.html">Home Style Two</a></li>
                                        <li><a href="index-3.html">Home Style Three</a></li>
                                        <li><a href="index-box.html">Home Box Style</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Pages</a>
                                    <ul>
                                        <li><a href="about.html">About Page</a></li>
                                        <li><a href="portfolio.html">Portfolio</a>
                                            <ul>
                                                <li><a href="portfolio.html">Portfolio</a></li>
                                                <li><a href="portfolio-three-column.html">Portfolio 3 Column</a></li>
                                                <li><a href="portfolio-details.html">Portfolio Details</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="my-account.html">My Account</a></li>
                                        <li><a href="cart.html">Cart Page</a></li>
                                        <li><a href="checkout.html">Checkout Page</a></li>
                                        <li><a href="wishlist.html">Wishlist Page</a></li>
                                        <li><a href="error404.html">404 Page</a></li>
                                        <li><a href="faq.html">Faq Page</a></li>
                                        <li><a href="team.html">Team Page</a></li>
                                    </ul>
                                </li>
                                <li><a href="shop-grid.html">Shop</a>
                                    <ul>
                                        <li><a href="shop-grid.html">Shop Grid</a></li>
                                        <li><a href="shop-list.html">Shop List</a></li>
                                        <li><a href="shop-left-sidebar.html">Shop Left Sidebar</a></li>
                                        <li><a href="shop-right-sidebar.html">Shop Right Sidebar</a></li>
                                        <li><a href="shop-no-sidebar.html">Shop No sidebar</a></li>
                                        <li><a href="single-product.html">Single Product</a></li>
                                    </ul>
                                </li>
                                <li><a href="blog.html">Blog</a>
                                    <ul>
                                        <li><a href="blog.html">Blog Page</a></li>
                                        <li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
                                        <li><a href="blog-no-sidebar.html">Blog No Sidebar</a></li>
                                        <li><a href="blog-details.html">Blog Details</a></li>
                                    </ul>
                                </li>
                                <li><a href="contact.html">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- End Mobile Menu -->
                <div class="mobile-menu d-block d-lg-none">
                </div>
                <!-- Mobile Menu -->
            </div>
        </header>
        <!-- //Header -->
        <!-- Start Search Popup -->
        <div class="box-search-content search_active block-bg close__top">
            <form id="search_mini_form" class="minisearch" action="index.php" name="search-form" method="get">
                <div class="field__search">
                    <input type="text" name="search-value" placeholder="Search entire store here...">
                    <div class="action">
                        <a href="#"><i class="zmdi zmdi-search"></i></a>
                    </div>
                </div>
            </form>
            <div class="close__wrap">
                <span>close</span>
            </div>
        </div>
        <!-- End Search Popup -->
        <!-- Start breadcrumb area -->
        <div class="ht__breadcrumb__area bg-image--6">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb__inner text-center">
                            <h2 class="breadcrumb-title">Shop Grid</h2>
                            <nav class="breadcrumb-content">
                                <a class="breadcrumb_item" href="index.html">Home</a>
                                <span class="brd-separator">/</span>
                                <span class="breadcrumb_item active">Shop Grid</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End breadcrumb area -->
        <!-- Start Shop Page -->
        <div class="page-shop-sidebar left--sidebar bg--white section-padding--lg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-12 order-2 order-lg-1 md-mt-40 sm-mt-40">
                        <div class="shop__sidebar">
                            <aside class="widget__categories products--cat">
                                <h3 class="widget__title">Product Categories</h3>
                                <ul>
                                    <?php


                                    // $library->getBooksByGenre();
                                    // foreach ($booksList as $book) {
                                    //     foreach ($book->genres as $key => $value) {
                                    //         $genreId = $library->getBooksByGenre($value);
                                    //     };
                                    // }


                                    ?>
                                    <?php
                                    foreach ($library->getGenresSortedByOccurence() as $key => $value) { ?>
                                        <li><a href="index.php?genreName=<?= $key ?>"><?= $key ?><span><?= $value ?></span></a></li>

                                    <?php } ?>
                                </ul>
                            </aside>
                            <!-- <aside class="widget__categories pro--range">
                                <h3 class="widget__title">Filter by price</h3>
                                <div class="content-shopby">
                                    <div class="price_filter s-filter clear">
                                        <form action="#" method="GET">
                                            <div id="slider-range" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                                                <div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 20.4082%; width: 59.1837%;"></div><span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 20.4082%;"></span><span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 79.5918%;"></span>
                                            </div>
                                            <div class="slider__range--output">
                                                <div class="price__output--wrap">
                                                    <div class="price--output">
                                                        <span>Price :</span><input type="text" id="amount" readonly="">
                                                    </div>
                                                    <div class="price--filter">
                                                        <a href="#">Filter</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </aside>
                            <aside class="widget__categories products--tag">
                                <h3 class="widget__title">Product Tags</h3>
                                <ul>
                                    <li><a href="#">Biography</a></li>
                                    <li><a href="#">Business</a></li>
                                    <li><a href="#">Cookbooks</a></li>
                                    <li><a href="#">Health &amp; Fitness</a></li>
                                    <li><a href="#">History</a></li>
                                    <li><a href="#">Mystery</a></li>
                                    <li><a href="#">Inspiration</a></li>
                                    <li><a href="#">Religion</a></li>
                                    <li><a href="#">Fiction</a></li>
                                    <li><a href="#">Fantasy</a></li>
                                    <li><a href="#">Music</a></li>
                                    <li><a href="#">Toys</a></li>
                                    <li><a href="#">Hoodies</a></li>
                                </ul>
                            </aside>
                            <aside class="widget__categories sidebar--banner">
                                <img src="https://htmldemo.net/boighor/boighor/images/others/banner_left.jpg" alt="banner images">
                                <div class="text">
                                    <h2>new products</h2>
                                    <h6>save up to <br> <strong>40%</strong>off</h6>
                                </div>
                            </aside> -->
                        </div>
                    </div>
                    <div class="col-lg-9 col-12 order-1 order-lg-2">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="shop__list__wrapper d-flex flex-wrap flex-md-nowrap justify-content-between">
                                    <div class="shop__list nav justify-content-center" role="tablist">
                                        <a class="nav-item nav-link active" data-bs-toggle="tab" href="#nav-grid" role="tab"><i class="fa fa-th"></i></a>
                                        <a class="nav-item nav-link" data-bs-toggle="tab" href="#nav-list" role="tab"><i class="fa fa-list"></i></a>
                                    </div>
                                    <p>Showing <?= count($library->filteredBooks) ?> results</p>
                                    <div class="orderby__wrapper">
                                        <span>Trier par</span>
                                        <form action="index.php" method="get" name="filter-sorting" id="filter-sorting">
                                            <?php
                                            foreach ($_GET as $key => $value) {
                                                if ($key !== 'sorting-selector') {

                                            ?>
                                                    <input type="hidden" name="<?= $key ?>" value="<?= $value ?>">
                                            <?php
                                                }
                                            }
                                            ?>
                                            <select class="shot__byselect" name="sorting-selector">

                                                <option value="author">Auteur</option>
                                                <option value="rating">Note</option>
                                            </select>
                                            <input type="submit" value="ok">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab__container tab-content">
                            <div class="shop-grid tab-pane fade show active" id="nav-grid" role="tabpanel">
                                <div class="row">
                                    <!-- Start Single Product -->
                                    <?php
                                    foreach ($library->filteredBooks as $book) { ?>


                                        <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                            <div class="product__thumb">
                                                <a class="first__img" href="single-product.php?bookId=<?= $book->bookId ?>"><img src="<?= $book->coverImg ?>" alt="product image"></a>
                                                <!-- <a class="second__img animation1" href="single-product.html"><img src="https://htmldemo.net/boighor/boighor/images/books/2.jpg" alt="product image"></a> -->
                                                <div class="hot__box">
                                                    <span class="hot-label">TOP <?= $book->rank ?></span>
                                                </div>
                                            </div>
                                            <div class="product__content content--center">
                                                <h4><a href="single-product.php?bookId=<?= $book->bookId ?>"><?= $book->author ?></a></h4>
                                                <!-- <ul class="price d-flex">
                                                    <li>$35.00</li>
                                                    <li class="old_price">$35.00</li>
                                                </ul> -->
                                                <div class="action">
                                                    <!-- <div class="actions_inner">
                                                        <ul class="add_to_links">
                                                            <li><a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a></li>
                                                            <li><a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a></li>
                                                            <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a></li>
                                                            <li><a data-bs-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div> -->
                                                </div>
                                                <!-- <div class="product__hover--content">
                                                    <ul class="rating d-flex">
                                                        <li class="on"><i class="fa fa-star-o"></i></li>
                                                        <li class="on"><i class="fa fa-star-o"></i></li>
                                                        <li class="on"><i class="fa fa-star-o"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                </div> -->
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <!-- End Single Product -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Shop Page -->
        <!-- Footer Area -->
        <footer id="wn__footer" class="footer__area bg__cat--8 brown--color">
            <div class="footer-static-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="footer__widget footer__menu">
                                <div class="ft__logo">
                                    <a href="index.html">
                                        <img src="https://htmldemo.net/boighor/boighor/images/logo/3.png" alt="logo">
                                    </a>
                                    <p>There are many variations of passages of Lorem Ipsum available, but the majority
                                        have suffered duskam alteration variations of passages</p>
                                </div>
                                <div class="footer__content">
                                    <ul class="social__net social__net--2 d-flex justify-content-center">
                                        <li><a href="#"><i class="bi bi-facebook"></i></a></li>
                                        <li><a href="#"><i class="bi bi-google"></i></a></li>
                                        <li><a href="#"><i class="bi bi-twitter"></i></a></li>
                                        <li><a href="#"><i class="bi bi-linkedin"></i></a></li>
                                        <li><a href="#"><i class="bi bi-youtube"></i></a></li>
                                    </ul>
                                    <ul class="mainmenu d-flex justify-content-center">
                                        <li><a href="index.html">Trending</a></li>
                                        <li><a href="index.html">Best Seller</a></li>
                                        <li><a href="index.html">All Product</a></li>
                                        <li><a href="index.html">Wishlist</a></li>
                                        <li><a href="index.html">Blog</a></li>
                                        <li><a href="index.html">Contact</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright__wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="copyright">
                                <div class="copy__right__inner text-start">
                                    <p>© 2021, Boighor. Made with <i class="fa fa-heart text-danger"></i> by <a href="//hasthemes.com" target="_blank">HasThemes</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="payment text-end">
                                <img src="https://htmldemo.net/boighor/boighor/images/icons/payment.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- //Footer Area -->
        <!-- QUICKVIEW PRODUCT -->
        <div id="quickview-wrapper">
            <!-- Modal -->
            <div class="modal fade" id="productmodal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal__container" role="document">
                    <div class="modal-content">
                        <div class="modal-header modal__header">
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-product">
                                <!-- Start product images -->
                                <div class="product-images">
                                    <div class="main-image images">
                                        <img alt="big images" src="https://htmldemo.net/boighor/boighor/images/product/big-img/1.jpg">
                                    </div>
                                </div>
                                <!-- end product images -->
                                <div class="product-info">
                                    <h1>Simple Fabric Bags</h1>
                                    <div class="rating__and__review">
                                        <ul class="rating">
                                            <li><span class="ti-star"></span></li>
                                            <li><span class="ti-star"></span></li>
                                            <li><span class="ti-star"></span></li>
                                            <li><span class="ti-star"></span></li>
                                            <li><span class="ti-star"></span></li>
                                        </ul>
                                        <div class="review">
                                            <a href="#">4 customer reviews</a>
                                        </div>
                                    </div>
                                    <div class="price-box-3">
                                        <div class="s-price-box">
                                            <span class="new-price">$17.20</span>
                                            <span class="old-price">$45.00</span>
                                        </div>
                                    </div>
                                    <div class="quick-desc">
                                        Designed for simplicity and made from high quality materials. Its sleek geometry
                                        and material combinations creates a modern look.
                                    </div>
                                    <div class="select__color">
                                        <h2>Select color</h2>
                                        <ul class="color__list">
                                            <li class="red"><a title="Red" href="#">Red</a></li>
                                            <li class="gold"><a title="Gold" href="#">Gold</a></li>
                                            <li class="orange"><a title="Orange" href="#">Orange</a></li>
                                            <li class="orange"><a title="Orange" href="#">Orange</a></li>
                                        </ul>
                                    </div>
                                    <div class="select__size">
                                        <h2>Select size</h2>
                                        <ul class="color__list">
                                            <li class="l__size"><a title="L" href="#">L</a></li>
                                            <li class="m__size"><a title="M" href="#">M</a></li>
                                            <li class="s__size"><a title="S" href="#">S</a></li>
                                            <li class="xl__size"><a title="XL" href="#">XL</a></li>
                                            <li class="xxl__size"><a title="XXL" href="#">XXL</a></li>
                                        </ul>
                                    </div>
                                    <div class="social-sharing">
                                        <div class="widget widget_socialsharing_widget">
                                            <h3 class="widget-title-modal">Share this product</h3>
                                            <ul class="social__net social__net--2 d-flex justify-content-start">
                                                <li class="facebook"><a href="#" class="rss social-icon"><i class="zmdi zmdi-rss"></i></a></li>
                                                <li class="linkedin"><a href="#" class="linkedin social-icon"><i class="zmdi zmdi-linkedin"></i></a></li>
                                                <li class="pinterest"><a href="#" class="pinterest social-icon"><i class="zmdi zmdi-pinterest"></i></a></li>
                                                <li class="tumblr"><a href="#" class="tumblr social-icon"><i class="zmdi zmdi-tumblr"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="addtocart-btn">
                                        <a href="#">Add to cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END QUICKVIEW PRODUCT -->
    </div>
    <!-- //Main wrapper -->

    <!-- JS Files -->
    <script src="https://htmldemo.net/boighor/boighor/js/vendor/jquery.min.js"></script>
    <script src="https://htmldemo.net/boighor/boighor/js/popper.min.js"></script>
    <script src="https://htmldemo.net/boighor/boighor/js/vendor/bootstrap.min.js"></script>
    <script src="https://htmldemo.net/boighor/boighor/js/plugins.js"></script>
    <script src="https://htmldemo.net/boighor/boighor/js/active.js"></script><a id="scrollUp" href="#top" style="position: fixed; z-index: 2147483647; display: none;"><i class="fa fa-angle-up"></i></a>



    <div id="lightboxOverlay" class="lightboxOverlay" style="display: none;"></div>
    <div id="lightbox" class="lightbox" style="display: none;">
        <div class="lb-outerContainer">
            <div class="lb-container"><img class="lb-image" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==">
                <div class="lb-nav"><a class="lb-prev" href=""></a><a class="lb-next" href=""></a></div>
                <div class="lb-loader"><a class="lb-cancel"></a></div>
            </div>
        </div>
        <div class="lb-dataContainer">
            <div class="lb-data">
                <div class="lb-details"><span class="lb-caption"></span><span class="lb-number"></span></div>
                <div class="lb-closeContainer"><a class="lb-close"></a></div>
            </div>
        </div>
    </div>
</body>

</html>