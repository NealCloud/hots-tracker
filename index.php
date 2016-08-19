<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Heroes</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</head>
<body>
    <form id="hotshero" action="api/hero_select.php" method="post">
        Name
        <input type="text" name="name">
        Universe
        <input type="text" name="universe">
        Role
        <input type="text" name="role">
        <button type="submit">submit</button>
    </form>

    <form id="hotscreate" action="api/hero_create.php" method="post">
        Name
        <input type="text" name="name">
        Universe

        <select name="universe">
            <option value="WarCraft">WarCraft</option>
            <option value="StarCraft">StarCraft</option>
            <option value="Diablo">Diablo</option>
            <option value="OverWatch">OverWatch</option>
        </select>
        Assassin:
        <input type="radio" name="role" value="assassin">
        Support:
        <input type="radio" name="role" value="support">
        Warrior:
        <input type="radio" name="role" value="warrior">
        Specialist:
        <input type="radio" name="role" value="specialist">

        <button type="submit">submit</button>
    </form>
    <script>
        $("#hotshero").submit(function(hots){
            var form = $(this);
            var formData = new FormData(this);

            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                success:function(res){
                    console.log(res);
                },
                error: function(e){
                    console.log('error: ', e);
                    console.log(e.responseText);
                }

            });
            hots.preventDefault();
        });

        $("#hotscreate").submit(function(hots){
            var form = $(this);
            var formData = new FormData(this);

            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                success:function(res){
                    console.log(res);
                },
                error: function(e){
                    console.log('error: ', e);
                    console.log(e.responseText);
                }
            });
            hots.preventDefault();
        });
    </script>
</body>
</html>
