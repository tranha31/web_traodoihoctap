function editInforFunction() {
    document.getElementById("edit_infor").style.display = "flex";
    document.getElementById("show_infor").style.display = "none";

  }
function showInforFunction() {
    document.getElementById("edit_infor").style.display = "none";
    document.getElementById("show_infor").style.display = "flex";

  }

function showAdminActivity(){
	document.getElementById("member_activity").style.display = "none";
    document.getElementById("admin_activity").style.display = "block";
  }

function showMemberActivity(){
	document.getElementById("member_activity").style.display = "block";
    document.getElementById("admin_activity").style.display = "none";
  }

function changeIframe(source_changed) {
    document.getElementById('iFrame').src = source_changed;
	document.getElementById('content_activity').style.display = "flex";
	document.getElementById('content_activity').onfocus();
  }