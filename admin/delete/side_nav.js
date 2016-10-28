/****************************************************************************
*																			*
*	File:		side_nav.js		  											*
*																			*
*	Author:		Branch Vincent												*
*																			*
*	Purpose:	This file toggles the highlighting of the current page in   *
*               the side navigation.	                                    *
*																			*
****************************************************************************/

var acc = document.getElementsByClassName("accordion");

for (var i = 0; i < acc.length; i++) {
    acc[i].onclick = function() {
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("show");
    }
}
