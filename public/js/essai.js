
document.querySelector('p').textContent = "Autre texte, blablabla";
document.querySelector('p.changeante').style.color = 'yellow';

var x = document.querySelectorAll('p');
x.forEach(function(nom, index){
    nom.textContent += ' (paragraphe n°' + index + ')';
    nom.style.color = 'yellow';
});



