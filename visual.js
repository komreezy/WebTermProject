var leftHeight = $('#left').outerHeight();
var rightHeight = $('#right').outerHeight();
console.log(leftHeight);
console.log(rightHeight);
if (leftHeight > rightHeight){
	$('#left').outerHeight($('#left').outerHeight()+30);
	$('#right').outerHeight($('#left').outerHeight());
} else {
	$('#right').outerHeight($('#right').outerHeight()+30);
	$('#left').outerHeight($('#right').outerHeight());
}