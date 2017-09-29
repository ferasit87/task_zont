<?php
/**
 * Created by PhpStorm.
 * User: feras
 * Date: 9/27/17
 * Time: 9:06 AM
 */


?>
<script type="text/javascript">
   function  getTop() {
       var count = $('#count').val();
       var post = {
           count: count,
       }
       $.ajax({
           url: '/post/gettop/',
           type: 'post',
           dataType: 'json',
           success: function (data) {
                var output = '' ;
                if (data.length > 0 ){
                    output = '<table class="table">\n' +
                        '                <thead class="thead-inverse">\n' +
                        '                <tr>\n' +
                        '                    <th>id</th>\n' +
                        '                    <th>title</th>\n' +
                        '                    <th>author_id</th>\n' +
                        '                    <th>rating</th>\n' +
                        '                </tr>\n' +
                        '                </thead>\n' +
                        '                <tbody>';
                    for (var i = 0; i < data.length; i++) {


                       output += '<tr>\n' +
                           '                    <th scope="row">'+data[i].id+'</th>\n' +
                           '                    <td>'+data[i].title+'</td>\n' +
                           '                    <td>'+data[i].user_id+'</td>\n' +
                           '                    <td>'+data[i].avg+'</td>\n' +
                           '                </tr>' ;
                   }
                   output += '</tbody>\n' +
                       '            </table>';
                }
               console.log(data);
               $('#result').css("color","green");
                $('#result').html(output);
           },
           error :  function (data) {
               console.log(data.responseText);
               $('#result').css("color","red");
               $('#result').html(data.responseText);
           },
           data: post
       });
   }

</script>
<div class="container">
    <div class="bs-docs-section">
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <h2>Get Top N Posts</h2>
                <div class="form-group">
                    <label for="formGroupExampleInput">coutn of posts</label>
                    <input type="text" class="form-control" id="count" placeholder="Количество Постов">
                </div>
                <button type="button" class="btn btn-primary" onclick="getTop();">Get result</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div id="result" class="with-margin-top col-sm-6 col-md-6">

        </div>
    </div>
</div>