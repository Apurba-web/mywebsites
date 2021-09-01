// ---- SIDE NAV BAR PANEL

function navMain() {

  var wide = document.getElementById("navMain").clientWidth;

  document.getElementById("navMain").style.width = (wide == 0) ? "350px":"0px";
  document.getElementById("tribarMenu").src = (wide == 0) ? "../icons/x-menu.png" : "../icons/tribar-menu.png";

//  document.getElementsById("btn").disabled = true
    //  this.disabled = true;
  };


// ---- side nav bar ACCORDION submenu

function sidenavbarAccordion() {
  var acc = document.getElementsByClassName("accordion");
  var i;

  for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
      /* Toggle between adding and removing the "active" class,
      to highlight the button that controls the panel */
      this.classList.toggle("active");

      /* Toggle between hiding and showing the active panel */
      var panel = this.nextElementSibling;
      if (panel.style.display === "block") {
        panel.style.display = "none";
      } else {
        panel.style.display = "block";
      }
    });
  }
}


// ---- DESK TOP NAV BAR

function openNavDrop(num_of_links, drop_nav_name, drop_btn_name) {
  var ht = document.getElementById(drop_nav_name).offsetHeight;

  if(ht === 0) {
    var x = document.getElementById(drop_btn_name).offsetLeft;
    var ht = (num_of_links + 1) * 16;

    document.getElementById(drop_nav_name).style.height = ht+"px";
    document.getElementById(drop_nav_name).style.top = "1.85rem";
    document.getElementById(drop_nav_name).style.left = x+"px";
    document.getElementById(drop_nav_name).style.display = "block";
  }
}

function closeNavDrop(drop_nav_name) {
  document.getElementById(drop_nav_name).style.height = "0px";
  document.getElementById(drop_nav_name).style.display = "none";
}

//--------------------------------

// method 1
//document.getElementsById("btn").onclick = function () {
  //echo "Submit click";
  //  this.disabled = true;
//};

// method 2
//document.getElementById("f2").onsubmit = function() {
//    this.children[1].disabled = true;
//    return false; // prevent form from actually posting (only for demo purposes)
//}
