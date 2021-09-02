/*
 * File copied from original 1.x Scratch Wiki Skin, with some parts added and removed
 */

function showpersonallinks() {
	document.getElementById('scratchpersonallinks').style.visibility = 'visible';
	document.getElementById('scratchpersonallinks').style.display = 'block';
}

function hidepersonallinks() {
	document.getElementById('scratchpersonallinks').style.visibility = 'hidden';
	document.getElementById('scratchpersonallinks').style.display = 'none';
}

// Parts below this line have been added.
document.querySelector("#scratchwikiskin1-show-personal-links").onclick = showpersonallinks;
document.querySelector("#scratchwikiskin1-hide-personal-links").onclick = hidepersonallinks;