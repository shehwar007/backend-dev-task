var room = 1;

function audience_fields() {

    room++;
    var objTo = document.getElementById('audience_fields')
    var divtest = document.createElement("div");
    divtest.setAttribute("class", "form-group removeclass" + room);
    var rdiv = 'removeclass' + room;
    divtest.innerHTML = `<div class="row">
    <div class="col-sm-2"><div class="form-group"><input type="text" class="form-control" id="first_name" name="first_name[]" placeholder="First Name"></div></div>
    <div class="col-sm-2"> <div class="form-group"><input type="text" class="form-control" id="last_name" name="last_name[]" placeholder="Last name"> </div></div>
    <div class="col-sm-2"> <div class="form-group"><input type="tel" class="form-control" id="mobile" name="mobile[]" placeholder="0XXXXXXXXXX" required> </div></div>
    <div class="col-sm-2"> <div class="form-group"><input type="text" class="form-control" id="make" name="make[]" placeholder="Make"> </div></div>
    <div class="col-sm-2"> <div class="form-group"><input type="text" class="form-control" id="model" name="model[]" placeholder="Model"> </div></div>
    <div class="col-sm-1"> <div class="form-group"><input type="text" class="form-control" id="year" name="year[]" placeholder="Year"> </div></div>
    <div class="col-sm-1"> <div class="form-group"><button class="btn btn-danger" type="button" onclick="remove_audience_fields(` + room + `);"> <i class="fa fa-minus"></i> </button> </div></div></div>`;

    objTo.appendChild(divtest)
}

function remove_audience_fields(rid) {
    $('.removeclass' + rid).remove();
}