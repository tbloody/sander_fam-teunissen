let isDarkMode = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;

window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
	isDarkMode = event.matches;
	paintDarkMode();
});

window.addEventListener("load", function () {
	if(localStorage.getItem('darkmode')!=null){
		isDarkMode=localStorage.getItem('darkmode')=="true";
		paintDarkMode();
	}

	document.getElementById("darkmode-toggle").addEventListener("click", function (evt) {
		evt.preventDefault();
		isDarkMode=!isDarkMode;
		paintDarkMode()
	});
});

function paintDarkMode(){
	localStorage.setItem('darkmode',isDarkMode)
	document.body.className = isDarkMode ? 'dark': 'light';
}

function clearActiveLanguage(){
	let elems = document.querySelectorAll("#language-selection .active");
	for(let key in elems){
		if(isNaN(key)) continue;
		elems[key].className = elems[key].classList.remove("active");
	}
}
