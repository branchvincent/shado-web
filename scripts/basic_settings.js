/****************************************************************************
*																			*
*	File:		basic_settings.js  											*
*																			*
*	Author:		Branch Vincent												*
*																			*
*	Purpose:	This file makes calculations for the basic input settings 	*
*				page.														*
*																			*
****************************************************************************/

jQuery.noConflict()(function ($)
{
    $(document).ready(init());
});

/****************************************************************************
*																			*
*	Function:	init														*
*																			*
*	Purpose:	To initialize the page with the correct traffic table size 	*
*																			*
****************************************************************************/

function init()
{
	console.log("Window has loaded!");
	calculate_time();
    // init_hour_labels();
    toggle_custom_settings();
    jQuery('#table').removeClass('remove');
}

/****************************************************************************
*																			*
*	Function:	calculate_time												*
*																			*
*	Purpose:	To calculate the time difference between the provided 		*
*				inputs														*
*																			*
****************************************************************************/

function calculate_time()
{
//	Get times and calculate hour difference

	var begin_time = get_date('begin');
	var end_time = get_date('end');
	var hours = get_hour_diff(begin_time, end_time);
	// console.log("Hours = " + hours);

//	Store new times

	jQuery('#begin_time').val(begin_time.format("h:mm A"));
	jQuery('#end_time').val(end_time.format("h:mm A"));
	jQuery('#num_hours').val(hours);

//	Empty traffic table

	jQuery('#table tr').empty();
	// var table = document.getElementById('table');
    var row = document.getElementById('trafficLevels');
//
//	Insert hour columns

    var traffic_levels = JSON.parse(jQuery('#traffic_levels').val());

	for (i = 0; i < hours; i++)
    {
		var cell = row.insertCell(i);
		cell.innerHTML = "<input type='radio' name=traffic_levels[" + i + "] value='h'>High</input><br>"
		cell.innerHTML += "<input type='radio' name=traffic_levels[" + i + "] value='m'>Med</input><br>"
		cell.innerHTML += "<input type='radio' name=traffic_levels[" + i + "] value='l'>Low</input>";

    //  Check the selected traffic level, if applicable

        var buttons = jQuery('input:radio[name="traffic_levels[' + i + ']"]');
        if (traffic_levels.length == hours)
            buttons.filter('[value="' + traffic_levels[i] + '"]').attr('checked', true);
        else
            buttons.filter('[value="m"]').attr('checked', true);
	}

//	Change hour labels

	var hour_label = begin_time;
	var row = document.getElementById('trafficLevelLabels');
	for (i = 0; i < hours; i++)
    {
		var cell = row.insertCell(i);
		cell.innerHTML = hour_label.format("h A");
		hour_label.add(1, 'hour');
	}
}

/****************************************************************************
*																			*
*	Function:	init_hour_labels										    *
*																			*
*	Purpose:	To toggle the visibility of the custom operator settings 	*
*																			*
****************************************************************************/

// function init_hour_labels()
// {
//     var begin_time = jQuery('#begin_time').val();
//     // console.log(begin_time);
//     var hour_label = moment("2016-01-01 " + begin_time, "YYYY-MM-DD HH:mm A");
//     var traffic_table = document.getElementById('trafficLevelLabels');
//     console.log(traffic_table);
//     for (var i = 0; i < jQuery('#num_hours').val(); i++)
//     {
//         var cell = traffic_table.insertCell(i);
//         cell.innerHTML = hour_label.format("h A");
//         hour_label.add(1, 'hour');
//     }
//     jQuery('#table').removeClass('remove');
// }
/****************************************************************************
*																			*
*	Function:	get_date													*
*																			*
*	Purpose:	To create a date from the current input in the specified 	*
*				html division		 										*
*																			*
****************************************************************************/

function get_date(html_div)
{
	var hr = jQuery('#' + html_div + 'Hour').val();
	var min = jQuery('#' + html_div + 'Min').val();
	var md = jQuery('#' + html_div + 'Md').val();
	time = hr + ':' + min + ' ' + md;
	return moment("2016-01-01 " + time, "YYYY-MM-DD HH:mm A");
}

/****************************************************************************
*																			*
*	Function:	get_hour_diff												*
*																			*
*	Purpose:	To calculate the number of hours between the two 			*
*				specified dates 											*
*																			*
****************************************************************************/

function get_hour_diff(date1, date2)
{
	if (date1 >= date2) date2.add(1, 'day');
	var mins = date2.diff(date1, 'minutes');
	return Math.ceil(mins / 60);
}

/****************************************************************************
*																			*
*	Function:	toggle_custom_settings										*
*																			*
*	Purpose:	To toggle the visibility of the custom operator settings 	*
*																			*
****************************************************************************/

function toggle_custom_settings()
{
    var checked = jQuery('#custom_assistant').prop('checked');
    if (checked)
        jQuery('#custom_assistant_settings').removeClass('remove');
    else
        jQuery('#custom_assistant_settings').addClass('remove');
}
