$(document).ready(function() {
    var uniqueSuggestions = []; // array to store unique suggestions
    var activeSuggestions; // variable to keep track of active suggestions

    $('#father_name').on('input', function() {
        var url = $(this).data('autocomplete-url');
        var inputVal = $(this).val();
        uniqueSuggestions = []; // clear the array whenever input value changes

        if (inputVal.trim() === '') {
            // clear suggestions if input field is empty
            $('#member-suggestions').empty();
            activeSuggestions = null;
            return;
        }

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            data: {q: inputVal},
            success: function(data) {
                var suggestions = data.filter(function(item) {
                    return item.toLowerCase().indexOf(inputVal.toLowerCase()) > -1;
                });

                // create a list of suggestions and append it to the input field
                var suggestionList = $('<ul>').addClass('suggestions');
                suggestions.forEach(function(suggestion) {
                    // only add new suggestions that haven't been added before
                    if (!uniqueSuggestions.includes(suggestion)) {
                        uniqueSuggestions.push(suggestion);
                        var listItem = $('<li>').text(suggestion);
                        suggestionList.append(listItem);
                    }
                });

                // clear existing suggestions before adding new ones
                $('#member-suggestions').empty();
                $('#member-suggestions').append(suggestionList);
                activeSuggestions = suggestionList; // keep track of active suggestions
            }
        });
    });

    // hide suggestions when input field loses focus
    $('#father_name').on('blur', function() {
        setTimeout(function() {
            if (!activeSuggestions || !activeSuggestions.is(':hover')) {
                // hide suggestions only if no suggestion is active or the active suggestion is not being hovered over
                $('#member-suggestions').empty();
            }
        }, 100);
    });

    // handle clicking on a suggestion
    $('#member-suggestions').on('click', 'li', function() {
        var suggestion = $(this).text();
        $('#father_name').val(suggestion);
        $('#member-suggestions').empty();
        activeSuggestions = null; // clear active suggestions
    });
});


$(document).ready(function() {
    var uniqueSuggestions = []; // array to store unique suggestions
    var activeSuggestions; // variable to keep track of active suggestions

    $('#mother_name').on('input', function() {
        var url = $(this).data('autocomplete-url');
        var inputVal = $(this).val();
        uniqueSuggestions = []; // clear the array whenever input value changes

        if (inputVal.trim() === '') {
            // clear suggestions if input field is empty
            $('#mother_suggestions').empty();
            activeSuggestions = null;
            return;
        }

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            data: {q: inputVal},
            success: function(data) {
                var suggestions = data.filter(function(item) {
                    return item.toLowerCase().indexOf(inputVal.toLowerCase()) > -1;
                });

                // create a list of suggestions and append it to the input field
                var suggestionList = $('<ul>').addClass('suggestions');
                suggestions.forEach(function(suggestion) {
                    // only add new suggestions that haven't been added before
                    if (!uniqueSuggestions.includes(suggestion)) {
                        uniqueSuggestions.push(suggestion);
                        var listItem = $('<li>').text(suggestion);
                        suggestionList.append(listItem);
                    }
                });

                // clear existing suggestions before adding new ones
                $('#mother_suggestions').empty();
                $('#mother_suggestions').append(suggestionList);
                activeSuggestions = suggestionList; // keep track of active suggestions
            }
        });
    });

    // hide suggestions when input field loses focus
    $('#mother_name').on('blur', function() {
        setTimeout(function() {
            if (!activeSuggestions || !activeSuggestions.is(':hover')) {
                // hide suggestions only if no suggestion is active or the active suggestion is not being hovered over
                $('#mother_suggestions').empty();
            }
        }, 100);
    });

    // handle clicking on a suggestion
    $('#mother_suggestions').on('click', 'li', function() {
        var suggestion = $(this).text();
        $('#mother_name').val(suggestion);
        $('#mother_suggestions').empty();
        activeSuggestions = null; // clear active suggestions
    });
});

$(document).ready(function() {
    var uniqueSuggestions = []; // array to store unique suggestions
    var activeSuggestions; // variable to keep track of active suggestions

    $('#guardian_name').on('input', function() {
        var url = $(this).data('autocomplete-url');
        var inputVal = $(this).val();
        uniqueSuggestions = []; // clear the array whenever input value changes

        if (inputVal.trim() === '') {
            // clear suggestions if input field is empty
            $('#guardian_suggestions').empty();
            activeSuggestions = null;
            return;
        }

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            data: {q: inputVal},
            success: function(data) {
                var suggestions = data.filter(function(item) {
                    return item.toLowerCase().indexOf(inputVal.toLowerCase()) > -1;
                });

                // create a list of suggestions and append it to the input field
                var suggestionList = $('<ul>').addClass('suggestions');
                suggestions.forEach(function(suggestion) {
                    // only add new suggestions that haven't been added before
                    if (!uniqueSuggestions.includes(suggestion)) {
                        uniqueSuggestions.push(suggestion);
                        var listItem = $('<li>').text(suggestion);
                        suggestionList.append(listItem);
                    }
                });

                // clear existing suggestions before adding new ones
                $('#guardian_suggestions').empty();
                $('#guardian_suggestions').append(suggestionList);
                activeSuggestions = suggestionList; // keep track of active suggestions
            }
        });
    });

    // hide suggestions when input field loses focus
    $('#guardian_name').on('blur', function() {
        setTimeout(function() {
            if (!activeSuggestions || !activeSuggestions.is(':hover')) {
                // hide suggestions only if no suggestion is active or the active suggestion is not being hovered over
                $('#guardian_suggestions').empty();
            }
        }, 100);
    });

    // handle clicking on a suggestion
    $('#guardian_suggestions').on('click', 'li', function() {
        var suggestion = $(this).text();
        $('#guardian_name').val(suggestion);
        $('#guardian_suggestions').empty();
        activeSuggestions = null; // clear active suggestions
    });
});
