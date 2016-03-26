<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Challenge Before Forking</title>
    <!--Materialize CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
    <!--Font Awesome CSS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!--DataTable CSS-->
    <link type="text/css" rel="stylesheet" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
    <!--My CSS-->
    <link type="text/css" rel="stylesheet" href="css/main.css">
</head>
<body>


<div>
    <i class="delete fa fa-trash-o fa-2x"></i>
    <span class="delete">Delete</span>

</div>

<div class="row">
    <i id="formBtn" class="fa fa-plus-circle fa-2x"></i>
</div>

<div id="addForm">

    <p>Catégorie</p>


    <div class="row">

        <!--Select-->
        <div class="valign-wrapper col s4">
            <div class="col s6 input-field">
                <select id="catList">
                </select>
            </div>

            <!--Add Category-->
            <div class="col s6 ">
                <i id="catAddBtn" class="fa fa-plus-circle fa-2x"></i>
            </div>
            <!-- Add category Field-->
            <div id="addCatField" class="col s5 ">
                <input type="text" name="catAdd" placeholder="Catégorie">
                <a id="submitCatBtn" class="waves-effect waves-light btn">Ajouter</a>
            </div>
        </div>


    </div>

    <!--Info Title-->
    <p>Titre Info</p>
    <div class="row">
        <input class="col s2" type="text" name="titleInfo" placeholder="Titre">
    </div>

    <!--Info Content-->
    <p>Info</p>
    <div class="row input-field">
        <textarea class="materialize-textarea col s2" name="info" placeholder="Info"></textarea>
    </div>

    <a id="submitBtn" class="waves-effect waves-light btn">Ajouter</a>

</div>


<div class="container">


    <!--Music Table row-->
    <div class="row">

        <table id="infoTable">
            <thead>
            <tr>
                <th>Catégorie</th>
                <th>Titre</th>
                <th>Info</th>
            </tr>
            </thead>
            <tbody>
            <!--To Fill with Ajax Datas-->
            </tbody>
        </table>

    </div>
</div>

<!--Jquery-->
<script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
<!--Jquery UI-->
<script src="https://code.jquery.com/ui/1.12.0-beta.1/jquery-ui.min.js"></script>
<!--DataTable JS-->
<script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<!--Materialize CDN-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
<!--My JS-->
<script src="js/main.js"></script>
</body>
</html>