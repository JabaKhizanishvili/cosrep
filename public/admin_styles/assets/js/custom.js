/*
=========================================
|                                       |
|           Scroll To Top               |
|                                       |
=========================================
*/
$('.scrollTop').click(function() {
    $("html, body").animate({scrollTop: 0});
});


$('.navbar .dropdown.notification-dropdown > .dropdown-menu, .navbar .dropdown.message-dropdown > .dropdown-menu ').click(function(e) {
    e.stopPropagation();
});

/*
=========================================
|                                       |
|       Multi-Check checkbox            |
|                                       |
=========================================
*/

function checkall(clickchk, relChkbox) {

    var checker = $('#' + clickchk);
    var multichk = $('.' + relChkbox);


    checker.click(function () {
        multichk.prop('checked', $(this).prop('checked'));
    });
}


/*
=========================================
|                                       |
|           MultiCheck                  |
|                                       |
=========================================
*/

/*
    This MultiCheck Function is recommanded for datatable
*/

function multiCheck(tb_var) {
    tb_var.on("change", ".chk-parent", function() {
        var e=$(this).closest("table").find("td:first-child .child-chk"), a=$(this).is(":checked");
        $(e).each(function() {
            a?($(this).prop("checked", !0), $(this).closest("tr").addClass("active")): ($(this).prop("checked", !1), $(this).closest("tr").removeClass("active"))
        })
    }),
    tb_var.on("change", "tbody tr .new-control", function() {
        $(this).parents("tr").toggleClass("active")
    })
}

/*
=========================================
|                                       |
|           MultiCheck                  |
|                                       |
=========================================
*/

function checkall(clickchk, relChkbox) {

    var checker = $('#' + clickchk);
    var multichk = $('.' + relChkbox);


    checker.click(function () {
        multichk.prop('checked', $(this).prop('checked'));
    });
}

/*
=========================================
|                                       |
|               Tooltips                |
|                                       |
=========================================
*/

$('.bs-tooltip').tooltip();

/*
=========================================
|                                       |
|               Popovers                |
|                                       |
=========================================
*/

$('.bs-popover').popover();


/*
================================================
|                                              |
|               Rounded Tooltip                |
|                                              |
================================================
*/

$('.t-dot').tooltip({
    template: '<div class="tooltip status rounded-tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
})


/*
================================================
|            IE VERSION Dector                 |
================================================
*/

function GetIEVersion() {
  var sAgent = window.navigator.userAgent;
  var Idx = sAgent.indexOf("MSIE");

  // If IE, return version number.
  if (Idx > 0)
    return parseInt(sAgent.substring(Idx+ 5, sAgent.indexOf(".", Idx)));

  // If IE 11 then look for Updated user agent string.
  else if (!!navigator.userAgent.match(/Trident\/7\./))
    return 11;

  else
    return 0; //It is not IE
}


function thumb(img){

    document.addEventListener('error', function (event) {
        if (event.target.tagName.toLowerCase() !== 'img') return;
        event.target.src = '/noimage.jpg';
    }, true);
}


function imageExists(url, callback) {
    var img = new Image();
    img.onload = function() { callback(true); };
    img.onerror = function() { callback(false); };
    img.src = url;
  }


function error(message){
    Snackbar.show({
        text: message,
        actionTextColor: '#fff',
        backgroundColor: '#e7515a',
        pos: 'bottom-right'
    });
}

function success(message){
    Snackbar.show({
        text: message,
        actionTextColor: '#fff',
        backgroundColor: '#8dbf42',
        pos: 'bottom-right'
    });
}


function ajaxCall(method, url, data, callback){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var result = '{}';
    $.ajax({
        type:method,
        url:url,
        data:data,
        success:function(res){
            callback(res);
        },
        error: function(xhr, status, error) {

            var errors = '';

            var allErrors = Object.entries(xhr.responseJSON.errors);

            for(var i = 0; i < allErrors.length; i++){
                errors += '<li>'+allErrors[i]+'</li>'
            }

            Snackbar.show({
                text: xhr.responseJSON.message + '<div><ul>'+errors+'</ul></div>',
                actionTextColor: '#fff',
                backgroundColor: '#e7515a',

                pos: 'bottom-right'
            });
        }
    });

    // return result;


}


function ajaxCallErr(method, url, data, callback){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var myform = document.getElementById("create_form");
    var fd = new FormData(myform );



    $.ajax({
        url: url,
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        type: method,
        success:function(res){
            callback(res);
        },
        error: function(xhr, status, error) {
            var errors = '';

            var allErrors = Object.entries(xhr.responseJSON.errors);



           var errs =  document.querySelectorAll('.customValidate');

           errs.forEach(el => {
           el.innerText = '';
        });
            var endResult = '';
            allErrors.forEach(element => {
                endResult += '<p style="color:#fff">'+element[1][0]+'</p>';
                // document.getElementById('err_'+element[0]).innerText = element[1][0]
            });


            if(allErrors.length > 0){
                   Snackbar.show({
                    text: endResult,
                    actionTextColor: '#fff',
                    backgroundColor: '#e7515a',
                    pos: 'bottom-right'
                });
            }
        }
    });
}


function limit_words(text, limit)
{
    if (text.length > limit) {
       return text.substr(0, limit) + '...';
    } else {
        return text;
    }
}



const generatePassword = (
    passwordLength = 8,
  ) => {
    const lowerCase = 'abcdefghijklmnopqrstuvwxyz'
    const upperCase = lowerCase.toUpperCase()
    const numberChars = '0123456789'
    const specialChars = '!"@$%+-_?^&*()'

    let generatedPassword = ''
    let restPassword = ''

    const restLength = passwordLength % 4
    const usableLength = passwordLength - restLength
    const generateLength = usableLength / 4

    const randomString = (char) => {
      return char[Math.floor(Math.random() * (char.length))]
    }
    for (let i = 0; i <= generateLength - 1; i++) {
      generatedPassword += `${randomString(lowerCase)}${randomString(upperCase)}${randomString(numberChars)}${randomString(specialChars)}`
    }

    for (let i = 0; i <= restLength - 1; i++) {
      restPassword += randomString([...lowerCase, ...upperCase, ...numberChars, ...specialChars])
    }

    return generatedPassword + restPassword
  }


  function showBlockUi(){
    $.blockUI({
        message: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>',
        fadeIn: 800,
        timeout: null, //unblock after 2 seconds
        overlayCSS: {
            backgroundColor: '#1b2024',
            opacity: 0.8,
            zIndex: 1200,
            cursor: 'wait'
        },
        css: {
            border: 0,
            color: '#fff',
            zIndex: 1201,
            padding: 0,
            backgroundColor: 'transparent'
        }
    });
}


function transactionStatus(status){
    var result = 'Unknown:' . status;
    if(status == "Created"){
        result = "<span class='btn-sm btn-info'>" + status + "</span>";
    }else if(status == 'Succeeded'){
        result = "<span class='btn-sm btn-success'>" + status + "</span>";
    }else if(status == "Expired"){
        result = "<span class='btn-sm btn-warning'>" + status + "</span>";

    }else if(status == "Failed"){
        result = "<span class='btn-sm btn-danger'>" + status + "</span>";

    }else if(status == "Returned"){
        result = "<span class='btn-sm btn-dark'>" + status + "</span>";

    }else if(status == null || status == ""){
        result = "";
    }

    return result;

}

