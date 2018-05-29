$(document).ready(function() {

    var random = Math.floor(Math.random() * $('.question[done="false"]').length);
    $('.question[done="false"').eq(random).addClass('active');

    var n_questions = $('.question').length,
        correct_answers = 0,
        incorrect_answers = 0;

    function next_question(e) {
        e.preventDefault();

        // Hide answer and disable next question button
        $('.active').find('.answer').val("");
        $('.active').find('.correct_answer').hide();
        $('.active').find('.correct_answer').removeClass('text-danger');

        $('#check_answer').prop('disabled', false);
        $('#next_question').prop('disabled', true);

        // Randomly display the next question
        $('.active').removeClass('active');
        var random = Math.floor(Math.random() * $('.question[done="false"]').length);
        $('.question[done="false"').eq(random).addClass('active');
        $('.active').find('.answer').focus();

    }

    $('#next_question').click(function(e) {
        next_question(e);
    });

    $('#check_answer').click(function(e) {
        e.preventDefault();

        var answer = $('.active').find('.answer').val(),
            correct_answer = $('.active').find('.correct_answer').text();

        if (answer == correct_answer) {
            $('.active').attr('done', 'true');
            $('.active').find('.correct').val(parseInt($('.active').find('.correct').val())+1);
            $('.active').find('.correct_answer').addClass('text-success');

            // Update progress bar
            var q_done = $('.question[done="true"]').length,
                new_progress = (q_done/n_questions)*100;
            $('.progress-bar').attr('aria-valuenow', new_progress).css('width', new_progress + '%');

            correct_answers += 1;
        } else {
            $('.active').find('.correct_answer').addClass('text-danger');
            $('.active').find('.incorrect').val(parseInt($('.active').find('.incorrect').val())+1);
            incorrect_answers += 1;
        }

        $('.active').find('.correct_answer').fadeIn(250);
        $('.active').find('.last_tested').val(Math.floor(Date.now() / 1000));

        $('#check_answer').prop('disabled', true);
        $('#next_question').prop('disabled', false);

        // Check if test is finished
        if ($('.question[done="false"]').length === 0) {

            $('#next_question').prop('disabled', true);

            // Calculate the test percentage
            var test_perc = ((correct_answers/(correct_answers+incorrect_answers))*100).toFixed(0);
            $('#test_percentage').html(test_perc + '%');
            $('#bar_correct').attr('aria-valuenow', test_perc).css('width', test_perc + '%');
            $('#bar_incorrect').attr('aria-valuenow', (100-test_perc)).css('width', (100-test_perc) + '%');

            // Display "test report" and save button
            $('#test_result').show();

        }

    });


    // (FLIP)CARDS
    function next_card(e) {
        e.preventDefault();

        $('.active').find('.correct_answer').hide();

        // Randomly display the next question
        $('.active').removeClass('active');
        var random = Math.floor(Math.random() * $('.question[done="false"]').length);
        $('.question[done="false"]').eq(random).addClass('active');
    }

    // Display flipcard answer
    $('.flipcard').click(function() {
        $(this).find('.correct_answer').toggle();
    });

    $('#btn_wrong').click(function(e) {
        e.preventDefault();
        $('.active').find('.last_tested').val(Math.floor(Date.now() / 1000));
        $('.active').find('.incorrect').val(parseInt($('.active').find('.incorrect').val())+1);
        
        incorrect_answers += 1;
        next_card(e);
    });

    $('#btn_correct').click(function(e) {
        e.preventDefault();
        $('.active').attr('done', 'true');
        $('.active').find('.last_tested').val(Math.floor(Date.now() / 1000));
        $('.active').find('.correct').val(parseInt($('.active').find('.correct').val())+1);

        // Update progress bar
        var q_done = $('.question[done="true"]').length,
            new_progress = (q_done/n_questions)*100;
        $('.progress-bar').attr('aria-valuenow', new_progress).css('width', new_progress + '%');

        correct_answers += 1;

        // Check if the test is finished
        if ($('.question[done="false"]').length === 0) {

            $('#btn_wrong').prop('disabled', true);
            $('#btn_correct').prop('disabled', true);

            // Calculate the test percentage
            var test_perc = ((correct_answers/(correct_answers+incorrect_answers))*100).toFixed(0);
            $('#test_percentage').html(test_perc + '%');
            $('#bar_correct').attr('aria-valuenow', test_perc).css('width', test_perc + '%');
            $('#bar_incorrect').attr('aria-valuenow', (100-test_perc)).css('width', (100-test_perc) + '%');

            // Display "test report" and save button
            $('#test_result').show();

        } else {
            next_card(e);
        }
    });

});