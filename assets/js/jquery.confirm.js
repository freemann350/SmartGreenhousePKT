$('#logout').click(function(){
$.confirm({
title: 'Sair',
content: 'Tem a certeza que pretende sair?',
buttons: {
Sim: function () {
window.location.href = "logout";
},
Não: function () {

},

}
});
});
