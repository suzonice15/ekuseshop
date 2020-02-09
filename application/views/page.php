<div class="container container-fullwidth" style="margin-bottom: 50px">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-12" style="margin-left:-17px;">
				<div class="adsbox">
					<?php
					$adds = get_adds();

					if(isset($adds)>0)
					{
						$side_html='<ul>';

						foreach($adds as $add)
						{
							$link=base_url().$add->media_path;
							$side_html.='<li>
								<a href="'.$add->adds_link.'">
									<img  width="100%" class="img-fluid" src="'.$link.'">
								</a>
							</li><br/>';
						}

						$side_html.='</ul>';

						echo $side_html;
					}
					?>
				</div>
			</div>

			<div class="col-lg-9 col-md-9 col-12">
				<div class="subheader">
					<ul class="breadcrumb">
						<li><a href="<?=base_url()?>">Home</a>/</li>
						<li class="active" style="margin-left: 5px;"><?=$page_title?></li>
					</ul>

					<div class="page-title ">
					</div>
					<br>
				</div>

				<article class="txt">
					<?=$page_content?>
				</article>
				</div>
			
		</div>
	</div>
	</div>

