<?php
use yii\helpers\Url;
//$category = Yii::$app->request->get('category');
	$display = (Yii::$app->request->get('id') or Yii::$app->request->get('childCategory')?'none':'');
	$categories = \app\modules\admin\models\MainCategories::find()->all();
?>

<div id="main-container">

	<div id="content">
		<h1 style="text-align:center">Categories</h1>
		<div class="grid" style="margin-bottom:50px">
			<?php use app\modules\admin\models\ChildCategories;

				foreach($categories as $cat): ?>
					<div class="module">
						<?php	$sibebar = \app\modules\admin\models\Post::find()->where(['main_category'=>$cat->id])->limit(5)->all();?>

						<ol type="1"><h3 style="text-align:center"><a href="<?=\yii\helpers\Url::to(['site/posts','category'=>$cat->id,'slug'=>$cat->slug])?>"><?=$cat->name?></a></h3>

							<?php foreach($sibebar as $side) : ?>

								<p><a href="<?=Url::to(['site/detail','slug'=>$side->slug,'catslug'=>$cat->slug,'category'=>$cat->id])?>"><?=$side->title;?></a></p>
							<?php endforeach; ?>
							<?php if(sizeof($sibebar)>0): ?>
							<a href="<?=\yii\helpers\Url::to(['site/posts','category'=>$cat->id,'slug'=>$cat->slug])?>"><h4 style="text-align:center;text-decoration:none;text-underline:none;color:black">More</h4></a>
							<?php endif;?>

						</ol>
					</div>
				<?php endforeach; ?>
		</div>

<div class="panel panel-default">
	<div class="panel-body">India has witnessed a high demand for Government jobs for many decades. People prefer Government jobs as their career option considering the wide variety of benefits that are associated with these. ‘Sarkari Naukri’ is a dream for millions of people across the nation, and only a few are lucky to land up with such jobs. People tend to take pride in having a Sarkari or Government job.

		Government jobs hold the kind of authority not found in private jobs. These also offer job security for a lifetime, and hence a lot of youth prefer them. Getting into a Government job requires a person to go through multiple levels of tests. These include a written examination, interview and sometimes even physical examination. These are competitive exams, and millions of people appear for these exams to get into a coveted Government job.</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">Exams for Government Jobs</div>
	<div class="panel-body"> Sarkari or Government exams are conducted for various positions in the state as well as central Government. There are various groups in Government jobs and candidates can apply for either of these groups, depending on their qualifications. Group A mostly comprises of managerial roles and are considered to be the highest level of jobs. Group B is for Gazetted officers. To clear the Group B exam, one has to make the UPSC exam. Most seats under Group B are filled via promotions, so only limited seats are left for entrance via exam. Group C and D are for public servants who have non-supervisory roles.</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">Sarkari Results</div>
	<div class="panel-body">All information about Sarkari result and Rojgar results can be found on sarkariresult.com. It is now easy to log into sarkariresult.com and find out everything that you would want to know about most of the Government exams. </div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">State Level Exams</div>
	<div class="panel-body">State Governments conduct various exams, and the Sarkari Result Info for all these exams can be found online. Sarkari Results in Bihar for all government job exams conducted by the state of Bihar. Similarly, Sarkari info for the Sarkari Result in Jharkhand can be searched online for all the exams conducted for the state of Jharkhand. UP Sarkari result is one of the most common online searches in India, considering the high demand for Government jobs in the state of U.P. </div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">Get Access to Detailed Information</div>
	<div class="panel-body"> Sarkariresult.com is a one-stop destination for all queries on Sarkari results. It has a list of all the Government exams, which can be seen as links. If one clicks on these exam names or links, the website provides exhaustive information on that specific exam. This includes the timeline when the exam is conducted, admit card information, the number of seats offered, application forms, Sarkari result dates etc.</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">Online Application Process</div>
	<div class="panel-body">It is now easy to apply for any Government job online. Some of the posts even allow the submission of scanned copies of identification documents. The internet has made it very easy to apply for these jobs, which was once considered to be a cumbersome task. Sarkari result online form can be found on sarkariresult.com. After applying for the exam, one has to appear for the exam and wait for the Sarkari exam result. Some of the exams have multiple stages, and hence, one has to be prepared for all the levels.

		Be it Sarkari result news or Sarkari Naukri result, all of the information is at the fingertips for most applicants. It is even possible just to use the smartphone to make an application and live the dream of getting into a Government job. </div>
</div>


	</div>
</div>
