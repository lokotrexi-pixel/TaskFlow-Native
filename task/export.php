<?php

require '../includes/auth_check.php';
require '../config/database.php';

require '../vendor/autoload.php';


use Dompdf\Dompdf;
use Dompdf\Options;



$user_id = $_SESSION['user_id'];



$query = mysqli_query($conn,

"
SELECT

tasks.*,

projects.name AS project_name,

workspaces.name AS workspace_name


FROM tasks


JOIN projects

ON tasks.project_id = projects.id


JOIN workspaces

ON projects.workspace_id = workspaces.id


WHERE workspaces.user_id='$user_id'


ORDER BY tasks.id DESC

"

);





$html = '';


$html .= '

<!DOCTYPE html>

<html>

<head>

<title>
TaskFlow Report
</title>


<style>

body{

    font-family: Arial, sans-serif;

}


h1{

    text-align:center;

    color:#333;

}


.info{

    margin-bottom:20px;

}


table{

    width:100%;

    border-collapse:collapse;

}


table, th, td{

    border:1px solid #333;

}


th{

    background:#eee;

}


th, td{

    padding:8px;

    text-align:left;

}


</style>


</head>


<body>



<h1>
TaskFlow Report
</h1>



<div class="info">

<p>
User :
'.htmlspecialchars($_SESSION['name']).'
</p>


<p>
Email :
'.htmlspecialchars($_SESSION['email']).'
</p>


</div>





<table>


<tr>

<th>No</th>

<th>Workspace</th>

<th>Project</th>

<th>Task</th>

<th>Status</th>

<th>Deadline</th>

</tr>



';



$no = 1;


while($task = mysqli_fetch_assoc($query)){



$html .= '

<tr>


<td>
'.$no++.'
</td>


<td>
'.$task['workspace_name'].'
</td>


<td>
'.$task['project_name'].'
</td>


<td>
'.$task['title'].'
</td>


<td>
'.$task['status'].'
</td>


<td>
'.$task['deadline'].'
</td>


</tr>

';


}



$html .= '

</table>


</body>

</html>

';





$options = new Options();


$options->set('isRemoteEnabled', true);



$dompdf = new Dompdf($options);



$dompdf->loadHtml($html);



$dompdf->setPaper('A4','landscape');



$dompdf->render();



$dompdf->stream(

    "TaskFlow_Report.pdf",

    [

        "Attachment" => true

    ]

);


exit;