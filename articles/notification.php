<?php 
    //header("Content-Type: text/xml");
    /*echo "<?xml version=\"1.0\"?>\n";*/
    if($loginUser == null){
?>
<script>
    let div2 = document.getElementById("modalWindow");
    let div3 = document.createElement("div");
    div3.className = "modal-each";
    let p = document.createElement("p");
    p.innerHTML = "You need to login!";
    div3.appendChild(p);
    div2.appendChild(div3);
</script>
<?php       
    }
    else {
        
    ?>
    <script>
        function loadNofi(){
            setInterval(function(){
                xhttp = getXMLHttpRequest();
                if (!xhttp) alert("Request error!");
                var x = Math.floor(Math.random() * 10);   
                var myURL = "notification_ajax.php?id="+x;
                
                xhttp.onreadystatechange = Response;
                xhttp.open("GET", myURL);
                xhttp.send(null);
            },10000);
        }
        
        loadNofi();
        function Response(){
            if(xhttp.readyState != 4){
                return;
            }
            else{
                if(xhttp.status == 200){
                    displayResults();
                }
                else{
                    alert("Request failed: "+xhttp.statusText);
                }
            }
        }
        function displayResults(){
            var div = document.getElementById("notifi");
            var div2 = document.getElementById("modalWindow");
            
            document.getElementById("no").style.display = "block";
            div.removeChild(div2);
            div2 = document.createElement("div");
            div2.id = "modalWindow";
            div2.className = "modalWindow";
            div2.setAttribute("hidden", true);
            ids = xhttp.responseXML.getElementsByTagName("id");
            accounts = xhttp.responseXML.getElementsByTagName("account");
            acts = xhttp.responseXML.getElementsByTagName("act");
            titles = xhttp.responseXML.getElementsByTagName("title");
            acttimes = xhttp.responseXML.getElementsByTagName("acttime");
            
            for(i = 0; i < ids.length; i++){
                let div3 = document.createElement("div");
                div3.className = "modal-each";
                let a = document.createElement("a");
                a.style.textDecoration = "none";
                
                let id = ids[i].firstChild.nodeValue;
                let account = accounts[i].firstChild.nodeValue;
                let act = acts[i].firstChild.nodeValue;
                let title = titles[i].firstChild.nodeValue;
                let acttime = acttimes[i].firstChild.nodeValue;
                
                let link = "link.php?a="+account+"&i="+id+"&act="+act+"&actt="+acttime;
                
                a.setAttribute("href", link);
                
//                let div4 = document.createElement("div");
//                let p = document.createElement("p");
                
                let content = "<span style='font-weight:bold;'>"+account+"</span> "+act+" your post: "+title;
                
//                p.innerHTML = content;
////                div4.appendChild(p);
                a.innerHTML = content;
                
                let hr = document.createElement("hr");
//                div5 = document.createElement("div");
//                div5.style.display = "flex";
//                div5.style.justifyContent = "flex-end";
                let p = document.createElement("p");
                let iii = document.createElement("i");
                iii.innerHTML = acttime;
                p.appendChild(iii);
//                div5.appendChild(p);
                
                div3.appendChild(a);
                div3.appendChild(hr);
                div3.appendChild(p);
                
                div2.appendChild(div3);
            }
            if(ids.length == 0){
                let div6 = document.createElement("div");
                div6.className = "modal-each";
                let pp = document.createElement("p");
                pp.innerHTML = "You have no notification!";
                div6.appendChild(pp);
                div2.appendChild(div6);
            }
            div.appendChild(div2);
        }
        
    </script>
<?php
    }
?>

