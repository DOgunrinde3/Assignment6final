var voteButton = document.getElementsByClassName("votebutton");
for (var i = 0; voteButton.length > i; i++){
voteButton[i].addEventListener("click", vote, false);
}