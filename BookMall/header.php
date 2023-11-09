<header>
    <h1><a href="/BookMall/main.php">신구문고</a></h1>
    <form method="get" action="/BookMall/searchresult.php" class="search">
        <input type="text" name="searchtext" value=<?= $searchtext ?? "" ?>>
        <button type="submit">검색</button>
    </form>
</header>