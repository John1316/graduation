

 
$(".navbar ul li a").click(function(){

  var Selected = $(this).attr("href");
 var SectionTop = $(Selected).offset().top-50;
  $("body").animate({scrollTop: SectionTop},2000); 
   
});
window.alert("please sign in to checkout");





function myFunction() {
	let input = document.getElementById("myInput");
	let filter = input.value.toUpperCase();
	let ul = document.getElementById("cardName");
	let h4 = ul.getElementsByTagName("h4");
	for (i = 0; i < h4.length; i++) {
		a = li[i].getElementsByTagName("a")[0];
		txtValue = a.textContent || a.innerText;
		if (txtValue.toUpperCase().indexOf(filter) > -1) {
			h4[i].style.display = "";
		} else {
			h4[i].style.display = "none";
		}
	}
}
