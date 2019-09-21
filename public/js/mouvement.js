

function deplacer(){

	var rangement={};

	function init(){
		
		var elements=document.querySelectorAll(".boitemobile"),
			longelements=elements.length;

		for(var i=0; i<longelements; i++){
			elements[i].addEventListener("mousedown", function(hopla){
				rangement.target=hopla.target;										// "target" doit être l'endroit où pointe le curseur
				rangement.offsetX=hopla.clientX - rangement.target.offsetLeft;
				rangement.offsetY=hopla.clientY - rangement.target.offsetTop;
			});

			elements[i].addEventListener("mouseup", function(){
				rangement={};
			});

		}

		document.addEventListener("mousemove", function(hopla){
			
			var cible=rangement.target;
			
			if(cible){

				cible.style.top=hopla.clientY - rangement.offsetY + "px";

				cible.style.left=hopla.clientX - rangement.offsetX + "px";
			}

		});

	}			// La fonction " init " est créée, mais pas activée

	init();
}

deplacer();




