$("#notificationMobilesAddRow").click(function () {
    var html = '';
    html += '<div class="row mt-2">';
    html += '<div class="col-xl-3">';
    html += '<div class="input-group mb-5">';
    html += '<input type="text" name="notification_mobiles[]" class="form-control" style="text-align:left;"/>';
    html += '</div>';
    html += '</div>';
    html += '<div class="col">';
    html += '<a class="btn btn-sm btn-danger notificationMobilesRemoveRow">حذف</a>';
    html += '</div>';
    html += '</div>';

    var elements = $('.notificationMobilesRemoveRow').length;

    if (elements < 3) {
        $('#notificationMobiles').append(html);
    } else {
        Swal.fire({
            title: "بیش از 3 مورد نمی توان اضافه کرد",
            icon: 'error',
            showCancelButton: true,
            showConfirmButton: false,
            cancelButtonText: 'بستن',

        });
    }
});

$(document).on('click', '.notificationMobilesRemoveRow', function () {
    Swal.fire({
        title: 'آیا از حذف مطمئن هستید؟',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'بله',
        cancelButtonText: 'بستن',
        reverseButtons: true,
      }).then((result) => {
        if (result.isConfirmed) {
            $(this).closest('.row').remove();
        }
      })
});

$("#rulesAddRow").click(function () {
    var html = '';
    html += '<div class="row mt-2">';
    html += '<div class="col-xl-11">';
    html += '<div class="input-group mb-5">';
    html += '<textarea type="text" name="rules[]" class="form-control"></textarea>';
    html += '</div>';
    html += '</div>';
    html += '<div class="col-xl-1">';
    html += '<a class="btn btn-sm btn-danger rulesRemoveRow">حذف</a>';
    html += '</div>';
    html += '</div>';

    $('#rules').append(html);

});

$(document).on('click', '.rulesRemoveRow', function () {
    Swal.fire({
        title: 'آیا از حذف مطمئن هستید؟',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'بله',
        cancelButtonText: 'بستن',
        reverseButtons: true,
      }).then((result) => {
        if (result.isConfirmed) {
            $(this).closest('.row').remove();
        }
      })
});

$("#conditionsAddRow").click(function () {
    var html = '<div class="row mt-2"> <div class="col-xl-5"> <input name="conditions[titles][]" type="text" class="form-control"/> </div><div class="col-xl-2"> <select name="conditions[answers][]" class="form-select"> <option selected disabled>انتخاب کنید ...</option> <option value="1">بله</option> <option value="0">خیر</option> </select> </div><div class="col-xl-2"> <input name="conditions[values][]" type="text" class="form-control text-center"/> </div><div class="col-xl-2"> <select name="conditions[changes][]" class="form-select"> <option selected disabled>انتخاب کنید ...</option> <option value="==">ریال شود</option> <option value="+%">درصد افزایش یابد</option> <option value="-%">درصد کاهش یابد</option> <option value="++">ریال افزایش یابد</option> <option value="--">ریال کاهش یابد</option> </select> </div><div class="col-xl-1"> <a class="btn btn-sm btn-danger conditionsRemoveRow">حذف</a> </div></div>';
    
    $('#conditions').append(html);
});

$(document).on('click', '.conditionsRemoveRow', function () {
    Swal.fire({
        title: 'آیا از حذف مطمئن هستید؟',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'بله',
        cancelButtonText: 'بستن',
        reverseButtons: true,
      }).then((result) => {
        if (result.isConfirmed) {
            $(this).closest('.row').remove();
        }
      })
});



