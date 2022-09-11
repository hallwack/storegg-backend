'use strict';

/*
NOTE:
------
PLACE HERE YOUR OWN JAVASCRIPT CODE IF NEEDED
WE WILL RELEASE FUTURE UPDATES SO IN ORDER TO NOT OVERWRITE YOUR JAVASCRIPT CODE PLEASE CONSIDER WRITING YOUR SCRIPT HERE.  */

//----------------------------------------------- Data Tables
window.table = "";
window.filterSearch = document.querySelector('[table-filter="search"]');
if (filterSearch) {
    filterSearch.addEventListener("keyup", function (e) {
        table.search(e.target.value).draw();
    });
}

$("#datatable").on("click", ".btn-delete", function () {
    const data_url = $(this).attr("data-url");
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        customClass: {
            confirmButton: "btn btn-primary",
            cancelButton: "btn btn-outline-danger ml-1",
        },
        buttonsStyling: false,
    }).then(function (result) {
        if (result.value) {
            formDestroy(data_url);
        }
    });
});

//----------------------------------------------- Form Submit
window.formSubmit = function (SubmitMethode, SubmitURL, SuccessURL, FailedURL) {
    var formData = new FormData($("#form")[0]);
    var e = document.querySelector("#btn_submit");
    const btnText = e ? e.textContent : '';

    if (SubmitURL == null) {
        SubmitURL = $("#form").attr("action");
    }
    $.ajax({
        url: SubmitURL,
        method: SubmitMethode,
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            "X-CSRF-TOKEN": _csrf,
        },
        beforeSend: function () {
            if(e) window.setButtonLoading(e);
        },
        success: function (response, statusText, xhr) {
            // e.setAttribute("data-kt-indicator", "off");
            // e.disabled = !1;

            if (xhr.status == 200 || xhr.status == 201) {
                // if success
                Swal.fire({
                    title: "Action Success!",
                    text: response.message,
                    icon: "success",
                    customClass: {
                        confirmButton: "btn btn-primary",
                    },
                    buttonsStyling: false,
                }).then(function () {
                    console.log(response);
                    if (SuccessURL) {
                        window.location.replace(SuccessURL);
                    } else {
                        if (response.results.redirect) {
                            window.location.replace(response.results.redirect);
                        }
                    }
                });
            } else {
                Swal.fire({
                    title: "Action Failed!",
                    text: response.message,
                    icon: "warning",
                    customClass: {
                        confirmButton: "btn btn-warning",
                    },
                    buttonsStyling: false,
                });
            }
        },
        error: function (err) {
            if (err.responseJSON.errors) {
                var messages = "";
                var errors = err.responseJSON.errors;
                for (const [key, value] of Object.entries(errors)) {
                    // messages.push(key+": "+value);
                    // messages.push(value);
                    messages += "<br>" + value;
                }
                Swal.fire({
                    title: "Action Failed!",
                    html: messages,
                    icon: "error",
                    customClass: {
                        confirmButton: "btn btn-danger",
                    },
                    buttonsStyling: false,
                }).then(function () {
                    if (FailedURL) {
                        window.location.replace(FailedURL);
                    }
                });
            } else {
                Swal.fire({
                    title: "Action Failed!",
                    text: err.responseJSON.message,
                    icon: "error",
                    customClass: {
                        confirmButton: "btn btn-danger",
                    },
                    buttonsStyling: false,
                }).then(function () {
                    if (FailedURL) {
                        window.location.replace(FailedURL);
                    }
                });
            }
        },
    }).always(function (res) {
        if(res) window.setButtonUnloading(e, btnText);
    });
}

//----------------------------------------------- Set Button Loading
window.setButtonLoading = function (btn) {
    if (btn) {
        btn.setAttribute('disabled', true);
        btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle">Loading...</span>';
    }
}
window.setButtonUnloading = function (btn, text) {
    if (btn) {
        btn.removeAttribute('disabled');
        btn.innerHTML = text;
    }
}


//----------------------------------------------- Action Delete
window.formDestroy = function formDestroy(SubmitURL) {
    $.ajax({
        url: SubmitURL,
        method: "POST",
        data: {
            _token: _csrf,
            _method: "DELETE",
        },
        dataType: "JSON",
        success: (response, textStatus, xhr) => {
            if (xhr.status == 200 || xhr.status == 201) {
                // if success
                table.ajax.reload();
                Swal.fire({
                    title: "Action Success!",
                    text: response.message,
                    icon: "success",
                    customClass: {
                        confirmButton: "btn btn-primary",
                    },
                    buttonsStyling: false,
                });
            } else {
                Swal.fire({
                    title: "Action Failed!",
                    text: response.message,
                    icon: "error",
                    customClass: {
                        confirmButton: "btn btn-danger",
                    },
                    buttonsStyling: false,
                });
            }
        },
        error: (err) => {
            Swal.fire({
                title: "Action Failed!",
                text: err.responseJSON.message,
                icon: "error",
                customClass: {
                    confirmButton: "btn btn-danger",
                },
                buttonsStyling: false,
            });
        },
    });
}

//----------------------------------------------- Fungsi Set Language
$(".change-language .menu-link").on("click", function () {
    setLanguage($(this).attr("data-language"));
});
window.setLanguage = function (lang) {
    var path = window.location.href;
    $.ajax({
        url: _baseurl + "/setLanguage",
        method: "POST",
        data: {
            _token: _csrf,
            lang: lang,
            path: path,
        },
        dataType: "JSON",
        success: (response, textStatus, xhr) => {
            window.location.replace(response.path);
            // location.reload();
        },
        error: (err) => {
            console.log("error");
        },
    });
}

//----------------------------------------------- Fungsi input only number
window.onlyNumber = function (event) {
    let value = $(this).val().replace(/,/g, "");
    if (!$.isNumeric(value) || value == NaN) {
        $(this).val(0).trigger("change");
        value = 0;
    }
    $(this).val(
        parseFloat(value, 10)
            .toString()
            .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    );
}
