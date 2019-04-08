
<?php

/*Esto ya no es necesario debido a que utilizamos Composer*/
// require 'app/Models/Job.php';
// require 'app/Models/Project.php';
// require_once 'app/Models/Printable.php';

use App\Models\{Job, Project, Printable};



function printElement($job){
	// if($job->visible==false){
	// 	return;
	// }
	echo '<li class="work-position">';
	echo '<h5>'.$job->title.'</h5>';
	echo '<p>'.$job->description.'</p>';
	 echo '<p>'.$job->getDuration().'</p>';
	echo '<strong>Achievements:</strong>';
	echo '<ul>';
	echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
	echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
  echo '<li>Lorem ipsum dolor sit amet, 80% consectetuer adipiscing elit.</li>';
  echo '</br>';
	echo '</ul>';
	echo '</li>';
}