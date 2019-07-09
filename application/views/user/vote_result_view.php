<div class="w3-container w3-center">
  <br>
<b class='w3-text-theme w3-sxlarge'>RESULT</b>
<br>
<div class="w3-container" style="height: 320px;overflow-y: scroll;">
  <?php
for ($i=0; $i < count($results) ; $i++) { 
  echo "<b class='w3-text-theme w3-large'>".$results[$i]['stage_label']."</b><br>";
echo "<div>";

if(is_array($results[$i]['tips']))
{

  echo "<br><table class='w3-table w3-small w3-striped'>";

  //asort($results[$i]['tips'],SORT_NUMERIC);
echo "<tr><td><b style='margin-right:80px;'>Tips</b>     </td>";
echo "<td>    <b style='margin-left:40px;'>Votes</b></td></tr>";
$hold_score = [];
  foreach ($results[$i]['tips'] as $tip) {
    //use each score as id make the winner unique
    $id = mt_rand(1,100).''.mt_rand(1,100);
echo "<tr><td id='".$id."'><b style='margin-right:80px;'>".strtoupper($tip['label'])."</b>  <span id='".$id."div'></span>   </td>";
echo "<td>    <span style='margin-left:40px;'>".$tip['no_votes']."</span></td></tr>";
$hold_score[$tip['no_votes']] = $id;
//sort($hold_score);
 //var_dump($hold_score);
  $array_keys= array_keys($hold_score);
        sort($array_keys);
     if($array_keys[count($array_keys)-1] != 0)
     {
$winner_line_id = $hold_score[$array_keys[count($array_keys)-1]];
}
/*
echo "<script>";
echo "document.getElementById('".$winner_line_id."').style.color = 'green';";
echo "document.getElementById('".$winner_line_id."div').innerHTML = '  <span class=\'w3-serif w3-tiny\'>WINNING TIP</span>';";

echo "</script>";*/
  }

 
  echo "</table><br>";
     
echo "</div>";
}else{
  echo "No tip for this Stage<br>";
}

}





?></div>
</div>
</div>
</div>