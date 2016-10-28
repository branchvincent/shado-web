/****************************************************************************
*																			*
*	File:		graph_navBar.js		  										*
*																			*
*	Author:		Branch Vincent												*
*																			*
*	Purpose:	This file shows and hides the navigation bar in the 		*
*				results page.												*
*																			*
****************************************************************************/

/****************************************************************************
*																			*
*	Function:	graph_nav_check1											*
*																			*
*	Purpose:	To show the when tab 										*
*																			*
****************************************************************************/

function graph_nav_check1() {
	document.getElementById('when?').style.background='#75D3FE';
	document.getElementById('why?').style.background='#f1f1f1';
	document.getElementById('text_box').style.display="none";
	document.getElementById('introduction_text').style.display="none";
	document.getElementById('whenTab').style.display="block";
}

/****************************************************************************
*																			*
*	Function:	graph_nav_check2											*
*																			*
*	Purpose:	To show the why tab 										*
*																			*
****************************************************************************/

function graph_nav_check2() {
	document.getElementById('why?').style.background='#75D3FE';
	document.getElementById('when?').style.background='#f1f1f1';
	document.getElementById('text_box').style.display="block";
	document.getElementById('introduction_text').style.display="none";
	document.getElementById('whenTab').style.display="none";
}
