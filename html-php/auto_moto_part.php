<div id="categories">
        <div id="title"><b>Категории</b></div><br>
        <div id="chosen" class="categories"><p>Авто/мото</p></div>
        <a href="../html-php/job.php"><div class="categories"><p>Вакансии</p></div></a>
        <a href="../html-php/animals_plants.php"><div class="categories"><p>Животные и растения</p></div></a>
        <a href="../html-php/property.php"><div class="categories"><p>Недвижимость</p></div></a>
        <a href="../html-php/clothes.php"><div class="categories"><p>Одежда</p></div></a>
        <a href="../html-php/service.php"><div class="categories"><p>Услуги</p></div></a>
        <a href="../html-php/other.php"><div class="categories"><p>Другое</p></div></a>
    </div>

    <div id="content">
        <h1>Авто/мото</h1>
        <form id="for_who" action="get_address_ads.php" method="post">
            <input type="hidden" name="category" value="1">
            <input type="text" placeholder="(имя для адресных объявлений)" name="for_who">
            <button type="submit">Показать</button>
        </form>
        <a href="../html-php/auto_moto.php"><button>Вернуться ко всем объявлениям</button></a>