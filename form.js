function comment (){

    var comment = document.getElementById("comments").value;
    var comment_length = comment.length;
	if(comment_length < 1) {
            alert("Please enter a comment before submitting");
            document.getElementById ("comments").focus();
            return false;
        }
        else{
            alert("Thank you for the comments");
            return true;
    }
}
