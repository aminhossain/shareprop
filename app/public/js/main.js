var canSubmit = true;

$(document).ready(function() {
    $('#items').tagsinput({ 
        tagClass: 'badge badge-dark',
    });
    
    $('#phone').val(880);
})


function validate(field_name) {
    let field_value = $(`#${field_name}`).val();

    if(field_name == 'buyer_name') {
        if(!(/^[A-Za-z0-9\s]*$/.test(field_value))) {
            error(field_name, 'only letters, numbers and spaces are allowed.')
            canSubmit = false
        } else if(field_value.length > 20) {
            error(field_name, 'at most 20 charachter are allowed.')
            canSubmit = false
        } else {
            reset(field_name)
            canSubmit = true
        }
    } else if(field_name == 'buyer_email') {
        if(!(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(field_value))) {
            error(field_name, 'please enter a valid email.')
            canSubmit = false
        } else {
            reset(field_name)
            canSubmit = true
        }
    } else if(field_name == 'receipt_id' || field_name == 'city') {
        if(!(/^[A-Za-z]*$/.test(field_value))) {
            error(field_name, 'only letters are allowed.')
            canSubmit = false
        } else if(field_value.length > 20) {
            error(field_name, 'at most 20 charachter are allowed.')
            canSubmit = false
        } else {
            reset(field_name)
            canSubmit = true
        }
    } else if(field_name == 'items') {
        if(!(/^[A-Za-z\s]*$/.test(field_value))) {
            error(field_name, 'only letters are allowed.')
            canSubmit = false
        } else {
            reset(field_name)
            canSubmit = true
        }
    } else if(field_name == 'note') {
        if(field_value.split(' ').length > 30) {
            error(field_name, 'only 30 words are allowed.')
            canSubmit = false
        } else {
            reset(field_name)
            canSubmit = true
        }
    } else if(field_name == 'phone') {
        if(field_value.length-2 < 11 || field_value.length-2 > 11) {
            error(field_name, 'please enter a valid 11 digit number')
            canSubmit = false
        } else {
            reset(field_name)
            canSubmit = true
        }
    }
}

function error(field_name, message) {
    $(`.${field_name}`).html(message);
    $(`#${field_name}`).addClass('is-invalid')
}

function reset(field_name) {
    $(`.${field_name}`).html('');
    $(`#${field_name}`).removeClass('is-invalid')
}

function showNotification(msg) {
    let html = `<div id="throw-err" class="alert alert-info alert-dismissible fade show" role="alert">
                    ${msg}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`

    $("#show-notification").html(html);
}

$(document).ready(function() {
    $("#form").on("submit", function(event){
        event.preventDefault();

        if(!canSubmit) {
            $(`#throw-err`).removeClass("d-none")
            $(`#error-msg`).html('please fix the below issues')
            window.scrollTo({top: 0, behavior: 'smooth'});
            return;
        }

        let _data= $(this).serialize();
        let _action = $(this).attr('action')
        
        $.ajax({
			type:'POST',
			url: _action,
			data: _data,
			dataType:"json",
			success:function(res){
                if(Array.isArray(res.data)) {
                    res.data.forEach(function(val, key) {
                        error(key, val);
                    })
                } else {
                    showNotification(res.data);
                    window.scrollTo({top: 0, behavior: 'smooth'});
                    $("#form")[0].reset()
                }
			},
			error:function(data){

			}
		});
    });

    $("#filter_btn").on("click", function(event){
        let date_from = $("#date_from").val();
        let date_to = $("#date_to").val();
        let sort = $("#by_userid").find('option:selected').val();
        let action = $(this).data('url')

        if(!date_from && !date_to && sort != 2) return;
        else if((date_from && !date_to) || (date_to && !date_from)) return;
        else if(new Date(date_from).getTime() > new Date(date_to).getTime()) return;
        
        $.ajax({
			type:'POST',
			url: action,
			data: {from: date_from, to: date_to, sort: sort},
			dataType:"json",
			success:function(response) {
                let html = ``
                if(response.data.length == 0) {
                    html = `<h3 class="text-center">No Records Found!</h3>`
                } else {
                    response.data.forEach(function(value, index) {
                        html += `
                            <tr>
                                <td>${value.buyer}</td>
                                <td>${value.buyer_email}</td>
                                <td>${value.amount}</td>
                                <td>${value.receipt_id}</td>
                                <td>${value.items}</td>
                                <td>${value.buyer_ip}</td>
                                <td>${value.note}</td>
                                <td>${value.city}</td>
                                <td>${value.phone}</td>
                                <td>${value.entry_at}</td>
                                <td>${value.entry_by}</td>
                            </tr>
                        `
                    })
                }

                $("#props-data").html(html)
			},
			error:function(data){

			}
		});
    });
})