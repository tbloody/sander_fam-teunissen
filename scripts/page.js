let isDarkMode = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;

window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
	isDarkMode = event.matches;
	paintDarkMode();
});

window.addEventListener("load", function () {
	if(isDarkMode){
		document.body.className="dark";
	}else{
		document.body.className="light";
	}
	if(localStorage.getItem('darkmode')!=null){
		isDarkMode=!!localStorage.getItem('darkmode')
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
		console.log(elems,key);
		elems[key].className = elems[key].classList.remove("active");
	}
}
