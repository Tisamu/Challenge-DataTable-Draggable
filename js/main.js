//THE INFO TAB COLUMNS ARE LIKE THIS:
//idcat => the category (transformed from the id in PHP when info is gathered)
//titleinfo => The title of the info
//info => The Info Content

//Check if field is empty
function isempty(str) {
    return str.replace(/ /g, '') === '';
}

function clearFields() {
    var inputs = $('input');
    var textareas = $('textarea');

    for (var i = 0; i < inputs.length; i++) {
        $(inputs[i]).val('');
    }
    for (var i = 0; i < textareas.length; i++) {
        $(textareas[i]).val('');
    }
}

function gatherCats() {
    var request = $.ajax({
        url: "php/getCats.php",
        method: "POST",
        dataType: "json",
        success: function (data) {
            for (var i = 0; i < data.length; i++) {
                if (i !== data.length - 1) {
                    $('#catList').append('<option value="' + data[i].idcat + '">' + data[i].nomcat + '</option>');
                } else {
                    $('#catList').append('<option value="' + data[i].idcat + '" selected>' + data[i].nomcat + '</option>');
                }

            }
            $('select').material_select();

        }
    });

}

//    /!\ /!\  /!\
//Manu j'utilise cette fonction pour recharger/charger le DataTable au lieu d'utiliser la méthode Ajax présent dans la Doc
function gatherInfos() {
    var request = $.ajax({
        url: "php/getInfos.php",
        method: "POST",
        dataType: "json",
        success: function (data) {

            info_table = $('#infoTable').DataTable({
                //Detroy the table when it's changing
                "createdRow": function (row, data, index) {
                    $(row).draggable({
                        scroll: false, /*Disable scrolling*/
                        revert: true, /*Enable revert if not dropped correctly*/
                        cursor: "move", /*Change cursor on drag*/
                        cursorAt: {top: 0, left: 20}, /*Relative position to the helper for dropping precisly*/
                        //Function to create a custom helper on drag
                        helper: function (event) {
                            return $("<div class='ui-widget-header'>Delete..</div>");
                            /*Set a custom onDrag helper*/
                        }
                    });
                },
                destroy: true,
                data: data,
                columns: [
                    {data: 'idcat'},
                    {data: 'titleinfo'},
                    {data: 'info'}
                ]
            });

        }
    });
}

//TODO
function rowDraggables() {
    setTimeout(function () {
        var rows = $('#infoTable tbody tr');

        for (var i = 0; i < rows.length; i++) {
            $(rows[i]).draggable({
                scroll: false, /*Disable scrolling*/
                revert: true, /*Enable revert if not dropped correctly*/
                cursor: "move", /*Change cursor on drag*/
                cursorAt: {top: 0, left: 20}, /*Relative position to the helper for dropping precisly*/
                //Function to create a custom helper on drag
                helper: function (event) {
                    return $("<div class='ui-widget-header'>Delete..</div>");
                    /*Set a custom onDrag helper*/
                }
            });
        }
    }, 100);


}

$(document).ready(function () {
    clearFields();

    //Form display button
    $('#formBtn').click(function () {
        //Check if it's the "+" or "-"
        if ($('#formBtn').hasClass('fa fa-plus-circle fa-2x')) {
            $('#addForm').show('slow');
            $('#formBtn').attr('class', 'fa fa-minus-circle fa-2x');
        } else {
            $('#addForm').hide('slow');
            $('#formBtn').attr('class', 'fa fa-plus-circle fa-2x');
        }

    });

    //Add Category Button
    $('#catAddBtn').click(function () {
        if ($(this).hasClass('fa fa-plus-circle fa-2x')) {
            $('#addCatField').show();
            $(this).attr('class', 'fa fa-minus-circle fa-2x');
            $(this).parent().attr('class', 'col s1');
        } else {
            $('#addCatField').hide();
            $(this).attr('class', 'fa fa-plus-circle fa-2x');
            $(this).parent().attr('class', 'col s6')
        }
    });

    //Submit the new row entry
    $('#submitBtn').click(function () {
        var category = $('#catList').find(":selected").val();
        var titleInfo = $('input[name="titleInfo"]').val();
        var info = $('textarea[name="info"]').val();

        if (!isempty(category) && !isempty(titleInfo) && !isempty(info)) {
            var request = $.ajax({
                url: "php/addInfo.php",
                method: "POST",
                data: {category: category, title: titleInfo, info: info},
                dataType: "html",
                success: function (response) {
                    gatherInfos();

                }
            });

            clearFields();
        } else {
            alert('Veuillez remplir tous les champs..');
        }


    });

    //Submit the new category entry
    $('#submitCatBtn').click(function () {
        var cat = $('input[name="catAdd"]').val();

        if (!isempty(cat)) {
            $('#addCatField').hide();
            $('#catAddBtn').attr('class', 'fa fa-plus-circle fa-2x');
            $('#catAddBtn').parent().attr('class', 'col s6');

            var request = $.ajax({
                url: "php/addCat.php",
                method: "POST",
                data: {category: cat},
                dataType: "html",
                success: function (response) {
                    $('#catList').html('');
                    gatherCats();
                }
            });
        } else {
            alert('Veuillez remplir tous les champs..');
        }
    });

//Gather the cat and infos List
    gatherCats();
    gatherInfos();

//Set a Timeout to avoid intializing the rows as draggable too soon


    $('.delete').droppable({
        drop: function (event, ui) {
            //Delete the dropped info
            var request = $.ajax({
                url: "php/deleteInfo.php",
                method: "POST",
                data: {idinfo: info_table.row(ui.draggable).data().idinfo},
                dataType: "html",
                success: function (response) {
                    Materialize.toast('Donnée supprimée !', 2000);
                    gatherInfos();
                    //Reinitialize the draggable
                }
            });
        }
    });

    $(document).on('mousedown', '#infoTable tbody tr', function () {
        $(this).css('color', 'red');
    });
    $(document).mouseup(function () {
        $('#infoTable tbody tr').css('color', 'black');
    });

});