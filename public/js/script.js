$(document).ready(function () {

    let meetForm = $('#meetForm');
    let meetCreateBtn = $('#meetCreateBtn');
    let newMeetBtn = $('#newMeet');
    let addAgendaBtn = $('#addAgenda');

    $('textarea').each(function () {
        $(this).val($(this).val().trim());
    }
    );

    $('textarea, input').change(function (e) {
        if ($(this).val()) {
            $(this).removeClass('error');
        }
    });

    newMeetBtn.on('click', function (e) {
        $('#select_container').addClass('d-none');
        $('#new_invitation_container').removeClass('d-none');
    });

    meetCreateBtn.on('click', function (e) {
        $('textarea, input').removeClass('error');

        let agendas = [];

        let agendaTextarea = $('[name="agenda_id[]"]');
        agendaTextarea.each(function () {
            let agendaValue = $(this).val();
            agendas.push(agendaValue);
        });


        e.preventDefault();
        $.ajax({
            url: '/invitation/store',
            method: 'POST',
            data: {
                '_token': $('input[name="_token"]').val(),
                'manager': $("#manager").val(),
                'reason': $('#reason').val(),
                'address': $("#address").val(),
                'meet_date': $("#meet_date").val(),
                'meet_time': $("#meet_time").val(),
                'location': $('#location').val(),
                'stick_place': $('#stick_place').val(),
                'agenda_id': agendas,
            },
            success: function (response) {
                if (response.success) {
                    let key = $('<div class="alert alert-success hero-form p-5"/>').text(response.message);
                    $('#meetContainer').append(key);
                    meetForm.remove();
                }

            },
            error: function (xhr, status, error) {
                // Handle error response
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        if (key === 'agenda_id[]') {
                            $('#agenda_id').addClass('error');
                        } else {
                            $(`[name=${key}]`).addClass('error');
                        }
                    });
                }
            }
        });

    });

    
    let counter = 2;

    addAgendaBtn.on('click', function (e) {
        e.preventDefault();
        let agendaText = $(`<textarea name="agenda_id[]" id="agenda_id" class="form-control mb-2"></textarea>`);

        let agendaId = $('[name="agenda_id[]"]').last();
        if (counter < 15 && agendaId.val() !== '') {
            counter++;
            agendaId.after(agendaText);
        }
    });

    const agendasInput = $('#agendasPoints input');
    let meetQuorum2 = $('#meetQuorum2');

    // Function to handle input changes
    function handleInputChange() {
        const changedInput = $(this);
        const changedRow = changedInput.parents('tr').first();


        // Do something with the changed row
        if (!meetQuorum2.val()) {
            // changedInput.val('');
            meetQuorum2.addClass('error');
        } 

        calculateTotal(changedRow);

    }

    // Calculate total for the current row
    function calculateTotal(changedRow) {
        let cell1Input = changedRow.children('.cell1').children('input');
        let cell2Input = changedRow.children('.cell2').children('input');
        let totalCell = changedRow.children('.total').children('input');

        let value1 = parseFloat(cell1Input.val());
        let value2 = parseFloat(cell2Input.val());

        console.log('------------- meetQuorum2:', parseFloat(meetQuorum2.val()));

        let total = isNaN(value1) || isNaN(value2) ? 0 : parseFloat(meetQuorum2.val()) - (value1 + value2);

        totalCell.val(total);
    }

    agendasInput.each(function() {
        $(this).on('change', handleInputChange);
    });

    $('input[value*="abstain"]').prop('checked', true);

});
