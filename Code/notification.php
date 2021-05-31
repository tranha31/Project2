<?php 
    //header("Content-Type: text/xml");
    /*echo "<?xml version=\"1.0\"?>\n";*/
    if(!isset($_SESSION["username"])){
?>
<script>
    let div1 = document.getElementById("no_content");
    
    let a = document.createElement("a");
    a.innerHTML = "You need to login!";
    a.setAttribute('href', "#");
    div1.appendChild(a);
    
    document.getElementById("notification_count").innerHTML = "0";
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
            },1000);
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
            var div = document.getElementById("notificationsBody");
            var div2 = document.getElementById("no_content");
            
            div.removeChild(div2);
            div2 = document.createElement("div");
            div2.id = "no_content";
            
            idus = xhttp.responseXML.getElementsByTagName("idu");
            contents = xhttp.responseXML.getElementsByTagName("content");
            links = xhttp.responseXML.getElementsByTagName("link");
            times = xhttp.responseXML.getElementsByTagName("time");
            sums = xhttp.responseXML.getElementsByTagName("sum");
            idnos = xhttp.responseXML.getElementsByTagName("idno");
            s = sums[0].firstChild.nodeValue;
            if(s != "0"){
                document.getElementById("notification_count").innerHTML = s;
            }
            else{
                document.getElementById("notification_count").innerHTML = "";
            }
            
            for(i = 0; i < idus.length; i++){
                a = document.createElement("a");
                link = links[i].firstChild.nodeValue;
                idnotifi = idnos[i].firstChild.nodeValue;

                link = link+"&no="+idnotifi;
                console.log(link);
                p = idus[i].firstChild.nodeValue;
                p2 = contents[i].firstChild.nodeValue;
                t = times[i].firstChild.nodeValue;
                
                c = p+" "+p2+" at "+t;
                
                a.setAttribute('href',link);
                a.innerHTML = c;
                div2.appendChild(a);
            }
            if(idus.length == 0){
                a = document.createElement("a");
                a.innerHTML = "You have no notification";
                div2.appendChild(a);
            }
            div.appendChild(div2);
        }
        
    </script>
<?php
    }
?>

