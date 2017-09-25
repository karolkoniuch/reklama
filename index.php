      <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml" lang="pl" xml:lang="pl">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title></title>
    <link rel="stylesheet" href="../../jqwidgets/styles/jqx.base.css" type="text/css" />
	<link rel="stylesheet" href="../../jqwidgets/styles/jqx.summer.css" type="text/css" />
    <script type="text/javascript" src="../../scripts/gettheme.js"></script>
    <script type="text/javascript" src="../../scripts/jquery-1.8.1.min.js"></script>
    <script type="text/javascript" src="../../jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="../../jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="../../jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="../../jqwidgets/jqxlistbox.js"></script>
    <script type="text/javascript" src="../../jqwidgets/jqxdropdownlist.js"></script>
<script type="text/javascript">

 $(document).ready(
 function()
 {
 $("#link").click(
 function()
 {
 $("#pomoc").toggle();
 }).toggle(function() { $("#link").text('zwiń'); }, function() { $("#link").text("rozwiń"); });
 }
 );
</script>
<link rel="stylesheet" type="text/css" href="../main.css" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
</head>

<body>

   <div id="wrapper">
   
         
<a href=""><img src="../images/logo.png" alt="logo"/></a>
	
		 <div id="glowny">
			   
<div id="panel_prawa">
 <div class="srodek"><div class="lewa"><div class="prawa"><span class="nazwa_forum">
 <a id="krok1">Krok 1</a>
 </span></div></div></div>

<div class="bgie">
<div id="krok1-1">
    <div id='content'>
        <script type="text/javascript">
            $(document).ready(function () {
                var theme = getTheme();
                var source = [
                    "Doladowanie Orange 5zl",
                    "Doladowanie Play 5zl",
                    "Doladowanie T-Mobile 5zl",
                    "Doladowanie Heyah 5zl",
                    "Doladowanie Plus 5zl",
                    "Doladowanie Orange 50zl",
                    "Doladowanie Play 50zl",
                    "Doladowanie T-Mobile 50zl",
                    "Doladowanie Heyah 50zl",
                    "Doladowanie Plus 50zl",
					"Doladowanie Chomikuj 1GB",
					"Doladowanie Chomikuj 2GB",
					"Doladowanie Chomikuj 5GB",
					"Doladowanie Chomikuj 9GB",
					"ChomikExplorer",
					"ChomikIce",
					"ChomikManiac",
                    "Counter Strike 1.6 Steam",
                    "Counter Strike:GO Steam",
                    "FIFA 13 PL CD-KEY"
		        ];

                // Create a jqxDropDownList
                $("#jqxWidget").jqxDropDownList({autoOpen: true, source: source, selectedIndex: 1, width: '200', height: '25', theme: 'summer' });
				    $('#jqxWidget').bind('select', function (event) {
                    var args = event.args;
                    var item = $('#jqxWidget').jqxDropDownList('getSelectedIndex', args.index);
                    alert('Selected: ' + item);
					$('#hidden').val(item)
                });
            });
        </script>
		<form action='main.php'>
        1.Wybierz interesujący Ciebie produkt<br><br><center><div id='jqxWidget'></div></center><br><br>
		<input type="hidden" value="" id="hidden" />
		<input type="submit" value="wajaa" class="button"/>
		</form>
    </div>
</div>
</div>
<div class="bottomsrodek"><div class="bottomlewa"><div class="bottomprawa"></div></div></div>
 <div class="srodek"><div class="lewa"><div class="prawa"><span class="nazwa_forum">
 Pomoc - <a id="link">rozwiń</a>
 </span></div></div></div>

<div class="bgie"> 
<div id="pomoc" style="display: none;">

<div id='content'>
        <script type="text/javascript">
            $(document).ready(function () {
                var source = [
                    "Affogato",
                    "Americano",
                    "Bicerin",
                    "Breve",
                    "Café Bombón",
                    "Café au lait",
                    "Caffé Corretto",
                    "Café Crema",
                    "Caffé Latte",
		        ];
                // Create a jqxDropDownList
                $("#jqxdropdownlist").jqxDropDownList({ source: source, selectedIndex: 0, width: '200px', height: '25px' });
                // disable the sixth item.
                $("#jqxdropdownlist").jqxDropDownList('disableAt', 5);
                // bind to 'select' event.
                $('#jqxdropdownlist').bind('select', function (event) {
                    var args = event.args;
                    var item = $('#jqxdropdownlist').jqxDropDownList('getSelectedIndex', args.index);
                    alert('Selected: ' + item);
                });
            });
        </script>
        <div id='jqxdropdownlist'>
        </div>
    </div>

</div>
</div>
<div class="bottomsrodek"><div class="bottomlewa"><div class="bottomprawa"></div></div></div>

</div>

         </div>	   

         <div id="footer">
		       
               &copy; Copyright 2012 by <span class="stopa">doladowania-za-darmo.tk</span>
Wszelkie prawa zastrzeżone.<br />Zabrania się kopiowania jakichkolwiek tresci zawartych na stronie.	

         </div>
		 
   </div>
</body>
</html>