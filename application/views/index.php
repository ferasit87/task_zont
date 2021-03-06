<div class="container">
    <div class="bs-docs-section">
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <a class="none" href="./post/">
                    <div class="thumbnail" >
                        <img src="./assets/images/Comment-add-icon.png" class="image-home" data-src="holder.js/300x200" alt="Emplyees records managment">
                        <div class="caption">
                            <h3>Add new post</h3>
                            <p>Создать пост. Принимает заголовок и содержание поста (не могут быть пустыми), а также логин и айпи автора.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-md-6">
                <a class="none" href="./vote/">
                    <div class="thumbnail" >
                        <img src="./assets/images/star-add-512.png" class="image-home" data-src="holder.js/300x200" alt="Emplyees records managment">
                        <div class="caption">
                            <h3>Add new vote for post</h3>
                            <p>  Поставить оценку посту. Принимает айди поста и значение, возвращает новый средний рейтинг поста.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-md-6">
                <a class="none" href="./post/get_top/">
                    <div class="thumbnail" >
                        <img src="./assets/images/top_menu1600.png" class="image-home" data-src="holder.js/300x200" alt="Emplyees records managment">
                        <div class="caption">
                            <h3>Get top N post</h3>
                            <p>Получить топ N постов по среднему рейтингу. </p>
                        </div>

                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-md-6">
                <a class="none" href="./user/">
                    <div class="thumbnail" >
                        <img src="./assets/images/list.png" class="image-home" data-src="holder.js/300x200" alt="Emplyees records managment">
                        <div class="caption">
                            <h3>Get multeiUsing IPS </h3>
                            <p> Получить список айпи, с которых постило несколько разных авторов</p>
                        </div>

                    </div>
                </a>
            </div>
            <button type="button" class="btn btn-primary" onclick="generatDb();">Add test data to DATA BASE</button>
    </div>
</div>
<div class="container">
    <div class="row">
        <div id="result" class="with-margin-top col-sm-6 col-md-6">
        </div>
    </div>
</div>
<script type="text/javascript">
function generatDb () {
    $.ajax({
        url: '/post/generatedbposts/',
        type: 'get',
        dataType: 'json',
        success: function (data) {
            console.log(data.responseText);
            $('#result').css("color", "green");
            $('#result').html(data.result);
        },
        error: function (data) {
            console.log(data.responseText);
            $('#result').css("color", "red");
            $('#result').html(data.responseText);
        },
        data: null
    });
}
</script>