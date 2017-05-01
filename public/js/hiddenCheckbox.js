Array.from(document.querySelectorAll("label")).forEach(l=>{
	if(document.querySelector(`#${l.getAttribute("for")}`).getAttribute("type")=="checkbox"){
		l.onclick=(e)=>{
    	e.target.classList.toggle("clicked")
  		}		
	}
  
})