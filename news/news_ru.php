<?
$sql_n=mysql_query("SELECT * FROM tb_news WHERE hidden=0 ORDER by date DESC");
?>
<div style="margin-left:10%;margin-right:10%;"><br>	
<center><h1> НОВОСТИ </h1></center><br>
<?
for($i=0;$i<mysql_num_rows($sql_n);$i++)
{
$title=mysql_result($sql_n,$i,'title');

$date=date("d.m.y H:i", mysql_result($sql_n,$i,'date'));
$image=mysql_result($sql_n,$i,'image');
$body=mysql_result($sql_n,$i,'body');
?>	
		<div class="name_mtr"><b style="font-size:1.2em"><? echo $title;?></b></div>
						<div class="article_counters">
							<span class="dats"><?echo $date?></span> <!--date-->
						</div>  		
				<div class="mtr"> 
					<div class="im"> 
						<div class="inim">   
							<img src="../img/<?echo $image;?>" alt="<?echo $title;?>" title="<?echo $title;?>" />
						</div> 
					</div> 
					<div class="mtr_td"> 
						<p><?echo $body?></p> 
					</div> 
				</div>
				
<?}?></div>