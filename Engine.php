<?php


function add_post($postKey, $postMainHeader, $postSubHeader, $postBody,$postTime,$postAuthor, $postCategory, $postTags){// Comment Key=null, commentj.json=null, likes=0,dislikes=0,comments=0){
$link ='../final_theme';
if ($postCategory=='') {
	$postCategory='UnCategoried';
}
if (!file_exists($link.'/categories')) {
    mkdir($link.'/categories', 0777, true);
    $categories = array();
	$categories[0] = $postCategory;
	write_json($categories, $link.'/categories/categories.json');
	$categorieskey=array();$categorykey=array();
	$categorykey[0]=get_key();
	$categorykey[1]=$postCategory;
	$categorieskey[0]=$categorykey;
	write_json($categorieskey, $link.'/categories/categorieskey.json');
	$categories='';
	mkdir($link.'/categories/'.$postCategory, 0777, true);
	$post=array();
	$post = form_post($postKey, $postMainHeader, $postSubHeader, $postBody,$postTime,$postAuthor, $postCategory, $postTags,0,0,0,'','');
	$posts[0]=$post;
	write_json($posts, $link.'/categories/'.$postCategory.'/post1.json');
	$post ='';
	$posts='';
	$temp =1;
	write_json($temp, $link.'/categories/'.$postCategory.'/posts.json');


	if (!file_exists($link.'/folder.json')) {
		if ($postTags!='') {
			$postdetails = array();
			$postdetail = array();
			$postdetail[0]= $postKey;
			$postdetail[1]=$link.'/categories/'.$postCategory.'/post1.json';
			$postdetail[2]=$postTags;
			$postdetails[0]= $postdetail; //// new edit 3/1/15 added this line
			write_json($postdetails, $link.'/folder.json'); //// new edit 3/1/15 added an s
			$postdetail='';
	}
	else{
		$postdetails = array();
		$postdetail = array();
		$postdetail[0]= $postKey;
		$postdetail[1]=$postdetail.'/categories/'.$postCategory.'/post1.json';
		$postdetail[2]='';
		$postdetails[0]= $postdetail;//// new edit 3/1/15 added this line
		write_json($postdetails, $link.'/folder.json');//// new edit 3/1/15 added an s
		$postdetail='';
	}
	}
} 
elseif (file_exists($link.'/categories')) {
	$categories=read_json($link.'/categories/categories.json');
	$categorysize = sizeof($categories); 
	$match='false';
	for ($i=0; $i < $categorysize ; $i++) { 
		if ($postCategory==$categories[$i]) {
			$match='true';
		}
	}
	if ($match=='false') {
		$categories[$categorysize]= $postCategory;
		write_json($categories, $link.'/categories/categories.json');
		$categorieskey=read_json($link.'/categories/categorieskey.json');$categorykey=array();
		$categorieskeysize = sizeof($categorieskey); 
		$categorykey[0]=get_key();
		$categorykey[1]=$postCategory;
		$categorieskey[$categorieskeysize]=$categorykey;
		write_json($categorieskey, $link.'/categories/categorieskey.json');
		mkdir($link.'/categories/'.$postCategory, 0777, true);
		$post=array();
		$post = form_post($postKey, $postMainHeader, $postSubHeader, $postBody,$postTime,$postAuthor, $postCategory, $postTags,0,0,0,'','');
		$posts[0]=$post;
		write_json($posts, $link.'/categories/'.$postCategory.'/post1.json');
		$post ='';
		$posts='';
		$temp =1;
		write_json($temp, $link.'/categories/'.$postCategory.'/posts.json');
		$foldercontent = read_json($link.'/folder.json');
		$k=sizeof($foldercontent);
			if ($postTags!='') {
			$postdetails = array();
			$postdetail = array();
			$postdetail[0]= $postKey;
			$postdetail[1]=$link.'/categories/'.$postCategory.'/post1.json';
			$postdetail[2]=$postTags;
			$foldercontent[$k]=$postdetail;
			write_json($foldercontent, $link.'/folder.json');
			$postdetail=''; $foldercontent='';
		}
		else{
			$postdetails = array();
			$postdetail = array();
			$postdetail[0]= $postKey;
			$postdetail[1]=$postdetail.'/categories/'.$postCategory.'/post1.json';
			$postdetail[2]='';
			$foldercontent[$k]=$postdetail;
			write_json($foldercontent, $link.'/folder.json');
			$postdetail=''; $foldercontent='';
	}
	}
	if ($match=='true') {
		$j = read_json($link.'/categories/'.$postCategory.'/posts.json');
		$posts=array();
		$posts=read_json($link.'/categories/'.$postCategory.'/post'.$j.'.json');
		$k = sizeof($posts);
		if ($k<20) {
			$post=array();
			$post = form_post($postKey, $postMainHeader, $postSubHeader, $postBody, $postTime, $postAuthor, $postCategory, $postTags,0,0,0,'','');
			$posts[$k]=$post;
			write_json($posts, $link.'/categories/'.$postCategory.'/post'.$j.'.json');
			$post ='';
			$posts='';
			$foldercontent = read_json($link.'/folder.json');
			$k=sizeof($foldercontent);
			if ($postTags!='') {
			$postdetails = array();
			$postdetail = array();
			$postdetail[0]= $postKey;
			$postdetail[1]=$link.'/categories/'.$postCategory.'/post'.$j.'.json';
			$postdetail[2]=$postTags;
			$foldercontent[$k]=$postdetail;
			write_json($foldercontent, $link.'/folder.json');
			$postdetail=''; $foldercontent='';
		}
		else{
			$postdetails = array();
			$postdetail = array();
			$postdetail[0]= $postKey;
			$postdetail[1]=$postdetail.'/categories/'.$postCategory.'/post'.$j.'.json';
			$postdetail[2]='';
			$foldercontent[$k]=$postdetail;
			write_json($foldercontent, $link.'/folder.json');
			$postdetail=''; $foldercontent='';
			}
		}
		else{
			$post=array(); $posts=array();
			$post = form_post($postKey, $postMainHeader, $postSubHeader, $postBody,$postTime,$postAuthor, $postCategory, $postTags,0,0,0,'','');
			$posts[0]=$post;
			$l = $j+1;
			write_json($posts, $link.'/categories/'.$postCategory.'/post'.$l.'.json');
			$post ='';
			$posts='';
			write_json($l, $link.'/categories/'.$postCategory.'/posts.json');
			$foldercontent = read_json($link.'/folder.json');
			$k=sizeof($foldercontent);
			if ($postTags!='') {
				$postdetails = array();
				$postdetail = array();
				$postdetail[0]= $postKey;
				$postdetail[1]=$link.'/categories/'.$postCategory.'/post'.$l.'.json';
				$postdetail[2]=$postTags;
				$foldercontent[$k]=$postdetail;
				write_json($foldercontent, $link.'/folder.json');
				$postdetail=''; $foldercontent='';
			}
		else{
				$postdetails = array();
				$postdetail = array();
				$postdetail[0]= $postKey;
				$postdetail[1]=$postdetail.'/categories/'.$postCategory.'/post'.$l.'.json';
				$postdetail[2]='';
				$foldercontent[$k]=$postdetail;
				write_json($foldercontent, $link.'/folder.json');
				$postdetail=''; $foldercontent='';
			}
		}
	}
	$categories=''; 
}
add_tag($postKey, $postMainHeader, $postSubHeader, $postBody,$postTime,$postAuthor, $postCategory, $postTags);
}

function form_post($postKey, $postMainHeader, $postSubHeader, $postBody,$postTime,$postAuthor, $postCategory, $postTags, $postLike, $postDisLike, $postComments,$commentKey, $commentLocation){
	$post = array();
	$post[0]=$postKey;
	$post[1]=$postMainHeader;
	$post[2]=$postSubHeader;
	$post[3]=$postBody;
	$post[4]=$postTime;
	$post[5]=$postAuthor;
	$post[6]=$postCategory;
	$post[7]=$postTags;
	$post[8]=$postLike;
	$post[9]=$postDisLike;
	$post[10]=$postComments;
	$post[11]=$commentKey;
	$post[12]=$commentLocation;
	return $post;
}

function add_tag($postKey, $postMainHeader, $postSubHeader, $postBody,$postTime,$postAuthor, $postCategory, $postTags){// Comment Key=null, commentj.json=null, likes=0,dislikes=0,comments=0){
$link ='../final_theme';
if ($postTags=='') {
	$postTags = array();
	$postTags[0]='NoTag';
}

if (!file_exists($link.'/tags')) {
	mkdir($link.'/tags', 0777, true);
	for ($m=0; $m <sizeof($postTags) ; $m++) {
	$postTag='';
	$postTag=$postTags[$m];
    $categories = array();
	$categories[0] = $postTag;
	write_json($categories, $link.'/tags/tags.json');
	$categories='';
	mkdir($link.'/tags/'.$postTag, 0777, true);
	$post=array();
	$post = form_post($postKey, $postMainHeader, $postSubHeader, $postBody,$postTime,$postAuthor, $postCategory, $postTags,0,0,0,'','');
	$posts[0]=$post;
	write_json($posts, $link.'/tags/'.$postTag.'/post1.json');
	$post ='';
	$posts='';
	$temp =1;
	write_json($temp, $link.'/tags/'.$postTag.'/posts.json');
	$temper='';
	$temper=array(); $temper_postDetails=array();
	$temper_postDetails[0]=$postKey; $temper_postDetails[1]= 'post1';
	$temper[0]= $temper_postDetails;
	write_json($temper, $link.'/tags/'.$postTag.'/postsDetails.json');
	$temper='';$temp='';
	}

} 
elseif (file_exists($link.'/tags')) {
	for ($m=0; $m <sizeof($postTags) ; $m++) {
	$postTag='';
	$postTag=$postTags[$m];
	$categories=read_json($link.'/tags/tags.json');
	$categorysize = sizeof($categories); 
	$match='false';
	for ($i=0; $i < $categorysize ; $i++) { 
		if ($postTag==$categories[$i]) {
			$match='true';
		}
	}
	if ($match=='false') {
		$categories[$categorysize]= $postTag;
		write_json($categories, $link.'/tags/tags.json');
		if (!file_exists($link.'/tags/'.$postTag)) {
			mkdir($link.'/tags/'.$postTag, 0777, true);
		}
		
		$post=array();
		$post = form_post($postKey, $postMainHeader, $postSubHeader, $postBody,$postTime,$postAuthor, $postCategory, $postTags,0,0,0,'','');
		$posts[0]=$post;
		write_json($posts, $link.'/tags/'.$postTag.'/post1.json');
		$post ='';
		$posts='';
		$temp =1;
		write_json($temp, $link.'/tags/'.$postTag.'/posts.json');
		if (file_exists($link.'/tags/'.$postTag.'/postsDetails.json')) {
				$temper=array(); $temper_postDetails=array();
				$temper_postDetails[0]=$postKey; $temper_postDetails[1]= 'post1';
				$temper= read_json($link.'/tags/'.$postTag.'/postsDetails.json');
				$temper[sizeof(read_json($link.'/tags/'.$postTag.'/postsDetails.json'))]= $temper_postDetails;
				write_json($temper, $link.'/tags/'.$postTag.'/postsDetails.json');
				$temper='';$temp='';
		}
		}
		
	
	if ($match=='true') {
		$j = read_json($link.'/tags/'.$postTag.'/posts.json');
		$posts=array();
		$posts=read_json($link.'/tags/'.$postTag.'/post'.$j.'.json');
		$k = sizeof($posts);
		if ($k<20) {
			$post=array();
			$post = form_post($postKey, $postMainHeader, $postSubHeader, $postBody, $postTime, $postAuthor, $postCategory, $postTags,0,0,0,'','');
			$posts[$k]=$post;
			write_json($posts, $link.'/tags/'.$postTag.'/post'.$j.'.json');
			$post ='';
			$posts='';
			if (file_exists($link.'/tags/'.$postTag.'/postsDetails.json')) {
				$temper=read_json($link.'/tags/'.$postTag.'/postsDetails.json'); $temper_postDetails=array();
				$temper_postDetails[0]=$postKey; $temper_postDetails[1]= 'post'.$j;
				$temper[sizeof(read_json($link.'/tags/'.$postTag.'/postsDetails.json'))]= $temper_postDetails;
				write_json($temper, $link.'/tags/'.$postTag.'/postsDetails.json');
				$temper='';$temp='';
			}
		}
		else{
			$post=array(); $posts=array();
			$post = form_post($postKey, $postMainHeader, $postSubHeader, $postBody,$postTime,$postAuthor, $postCategory, $postTags,0,0,0,'','');
			$posts[0]=$post;
			$l = $j+1;
			write_json($posts, $link.'/tags/'.$postTag.'/post'.$l.'.json');
			$post ='';
			$posts='';
			write_json($l, $link.'/tags/'.$postTag.'/posts.json');
			if (file_exists($link.'/tags/'.$postTag.'/postsDetails.json')) {
				$temper=read_json($link.'/tags/'.$postTag.'/postsDetails.json'); $temper_postDetails=array();
				$temper_postDetails[0]=$postKey; $temper_postDetails[1]= 'post'.$l;
				$temper[sizeof(read_json($link.'/tags/'.$postTag.'/postsDetails.json'))]= $temper_postDetails;
				write_json($temper, $link.'/tags/'.$postTag.'/postsDetails.json');
				$temper='';$temp='';
			}
		}
	}
	$categories=''; 
}
}
}


function delete_post($postKey){
	$link ='../final_theme';
	if (file_exists($link.'/folder.json')) {
		$folder = read_json($link.'/folder.json');
		for ($i=0; $i <sizeof($folder) ; $i++) { 
			$details = $folder[$i];
			if ($details!='') {
			

			// dele from categories
			if ($details[0]==$postKey) {
				if (file_exists($details[1])) {
					$postfile=read_json($details[1]);
					for ($j=0; $j <sizeof($postfile) ; $j++) {
						if ($postfile[$j]!='') {
							$post = $postfile[$j];
							if ($post[0]==$postKey) {
								$postfile[$j]='';
							}
						}
					}
					write_json($postfile,$details[1]);
				}

				// delete from tags
				$tags = $details[2];
				for ($l=0; $l <sizeof($tags) ; $l++) { 
					if (file_exists($link.'/tags/'.$tags[$l].'/postsDetails.json')) {
						$postsDetails=read_json($link.'/tags/'.$tags[$l].'/postsDetails.json');
						for ($j=0; $j <sizeof($postsDetails) ; $j++) {
							$postsDetail = $postsDetails[$j];

							if ($postsDetails[$j]!='') {
								if ($postsDetail[0]==$postKey) {
									$postsDetails[$j]='';
									if (file_exists($link.'/tags/'.$tags[$l].'/'.$postsDetail[1].'.json')){
										$postfile=read_json($link.'/tags/'.$tags[$l].'/'.$postsDetail[1].'.json');
										for ($n=0; $n <sizeof($postfile) ; $n++) {
											$post = $postfile[$n];
											if ($postfile[$n]!='') {
												if ($post[0]==$postKey) {
												$postfile[$n]='';
												write_json($postfile,$link.'/tags/'.$tags[$l].'/'.$postsDetail[1].'.json');
												}
											}

										}
									}

								}
							}

							
						}
						write_json($postsDetails,$link.'/tags/'.$tags[$l].'/postsDetails.json');
					}
				}
			

				$folder[$i]='';
			}
			}
		}

		


		write_json($folder,$link.'/folder.json');
	}
}




function update_post_no_comments($postKey, $postMainHeader, $postSubHeader, $postBody,$postTime,$postAuthor, $postCategory, $postTags){// Comment Key=null, commentj.json=null, likes=0,dislikes=0,comments=0){
	$link ='../final_theme';
	$updatePost = form_post($postKey, $postMainHeader, $postSubHeader, $postBody,$postTime,$postAuthor, $postCategory, $postTags,0,0,0,'','');
	if (file_exists($link.'/folder.json')) {
		$folder = read_json($link.'/folder.json');
		for ($i=0; $i <sizeof($folder) ; $i++) { 
			$details = $folder[$i];
			if ($details!='') {
			

			// update from categories
			if ($details[0]==$postKey) {
				if (file_exists($details[1])) {
					$postfile=read_json($details[1]);
					for ($j=0; $j <sizeof($postfile) ; $j++) {
						if ($postfile[$j]!='') {
							$post = $postfile[$j];
							if ($post[0]==$postKey) {
								$postfile[$j]=$updatePost;
							}
						}
					}
					write_json($postfile,$details[1]);
				}

				// update from tags
				$tags = $details[2];
				for ($l=0; $l <sizeof($tags) ; $l++) { 
					if (file_exists($link.'/tags/'.$tags[$l].'/postsDetails.json')) {
						$postsDetails=read_json($link.'/tags/'.$tags[$l].'/postsDetails.json');
						for ($j=0; $j <sizeof($postsDetails) ; $j++) {
							$postsDetail = $postsDetails[$j];

							if ($postsDetails[$j]!='') {
								if ($postsDetail[0]==$postKey) {
									//$postsDetails[$j]='';
									if (file_exists($link.'/tags/'.$tags[$l].'/'.$postsDetail[1].'.json')){
										$postfile=read_json($link.'/tags/'.$tags[$l].'/'.$postsDetail[1].'.json');
										for ($n=0; $n <sizeof($postfile) ; $n++) {
											$post = $postfile[$n];
											if ($postfile[$n]!='') {
												if ($post[0]==$postKey) {
												$postfile[$n]=$updatePost;
												write_json($postfile,$link.'/tags/'.$tags[$l].'/'.$postsDetail[1].'.json');
												}
											}

										}
									}

								}
							}

							
						}
						write_json($postsDetails,$link.'/tags/'.$tags[$l].'/postsDetails.json');
					}
				}
			

				//$folder[$i]='';
			}
			}
		}

		


		//write_json($folder,$link.'/folder.json');
	}
}

function get_recent_post($number){
$link ='../final_theme';
$returnposts = array();
	$returnpost = array();
	if (file_exists($link.'/folder.json')) {
			$folder = read_json($link.'/folder.json');
			$count =0;$counter=0;
			$size_folder=sizeof($folder)-1;
			for ($i=$size_folder; $i >-1 ; $i--) { 
				$details = $folder[$i];
				if ($details!=''&& $details!=array() && $details!=NULL) {
				//	echo $count.','.$i.'<br/>';
				if ($count<$number) {
					if (file_exists($details[1])) {
						$postfile=read_json($details[1]);
						for ($j=sizeof($postfile)-1; $j >-1 ; $j--) {
							if ($postfile[$j]!='') {
								$post = $postfile[$j];
								if ($post[0]==$details[0]) {
									$returnposts[$counter] = $postfile[$j];
									$counter++;
									}
								}
							}
						//write_json($postfile,$details[1]);
						}
					}
					$count++;
				}
			}
		}
		return $returnposts;
}

function get_post($postKey){
	$link ='../final_theme';
	$returnpost = array();
	if (file_exists($link.'/folder.json')) {
			$folder = read_json($link.'/folder.json');
			for ($i=0; $i <sizeof($folder) ; $i++) { 
				$details = $folder[$i];
				if ($details!='') {
				if ($details[0]==$postKey) {
					if (file_exists($details[1])) {
						$postfile=read_json($details[1]);
						for ($j=0; $j <sizeof($postfile) ; $j++) {
							if ($postfile[$j]!='') {
								$post = $postfile[$j];
								if ($post[0]==$postKey) {
									$returnpost = $postfile[$j];
									}
								}
							}
						//write_json($postfile,$details[1]);
						}
					}
				}
			}
		}
		return $returnpost;
}

function get_all_posts_from_category_key($categoryKeyInp){
	$link ='../final_theme';
	$returnposts = array();
	$categoryname ='';
	if (file_exists($link.'/categories/categorieskey.json')) {
		$categorieskey=read_json($link.'/categories/categorieskey.json');
		for ($i=0; $i <sizeof($categorieskey) ; $i++) { 
			$categorykey=$categorieskey[$i];
			if ($categorykey[0]==$categoryKeyInp) {
				$categoryname=$categorykey[1];
			}
		}
	}
	$returnposts=get_all_posts_from_category_name($categoryname);
	return $returnposts;
}

function get_all_posts_from_category_name($Categoryname){
	$link ='../final_theme';
	$returnposts = array(); 
	if (file_exists($link.'/categories/'.$Categoryname.'/posts.json')) {
	$count = read_json($link.'/categories/'.$Categoryname.'/posts.json');
	for ($i=1; $i <$count+1 ; $i++) {
		$temp=array();
		$temp= read_json($link.'/categories/'.$Categoryname.'/post'.$i.'.json');
		if ($i==1) {
			$returnposts=$temp;
		}
		else{
			$size2 = sizeof($temp);
			$size1=sizeof($returnpost);
			for ($j=0; $j <$size2 ; $j++) { 
				$returnposts[$size1+$j]=$temp[$j];
			}
		}
		}	
	}
	return $returnposts;
}

function get_all_posts_for_tags($tagname){
$link ='../final_theme';
	$returnposts = array(); 
	if (file_exists($link.'/tags/'.$tagname.'/posts.json')) {
	$count = read_json($link.'/tags/'.$tagname.'/posts.json');
	for ($i=1; $i <$count+1 ; $i++) {
		$temp=array();
		$temp= read_json($link.'/tags/'.$tagname.'/post'.$i.'.json');
		if ($i==1) {
			$returnposts=$temp;
		}
		else{
			$size2 = sizeof($temp);
			$size1=sizeof($returnpost);
			for ($j=0; $j <$size2 ; $j++) { 
				$returnposts[$size1+$j]=$temp[$j];
			}
		}
		}	
	}
	return $returnposts;
}

function form_comment($commentKey, $commentTime,$commentAuthor, $commentLike, $commentDisLike, $commentReplies,$commentBody){
	$comment = array();
	$comment[0]=$commentKey;
	$comment[1]=$commentTime;
	$comment[2]=$commentAuthor;
	$comment[3]=$commentLike;
	$comment[4]=$commentDisLike;
	$comment[5]=$commentReplies;
	$comment[6]=$commentBody;
	return $comment;
}

function add_comment($postKey, $commentKey, $commentTime,$commentAuthor, $commentLike, $commentDisLike, $commentReplies,$commentBody){
$link ='../final_theme'; $comments = array();
if (!file_exists($link.'/comments')) {
	mkdir($link.'/comments', 0777, true);
}
if (!file_exists($link.'/comments/commentsDetails.json')) {
		$comments = array();$comentDetail = array(); $commentsDetail=array(); $comment=array();
		$commentLocation = 'comments1';
		$comentDetail[0]=$postKey;
		$comentDetail[1]=$commentLocation;
		$commentsDetail[0]=$comentDetail;
		write_json($commentsDetail,$link.'/comments/commentsDetails.json');
		$comment[0]= $postKey;
		$temp = array();
		$temp[0]= form_comment($commentKey, $commentTime,$commentAuthor, $commentLike, $commentDisLike, $commentReplies,$commentBody);
		$comment[1] = $temp;
		$comments[0]=$comment;
		write_json($comments,$link.'/comments/comments1.json');
		$temp =1;
		write_json($temp,$link.'/comments/comments.json');
	}
	else{
		$details = read_json($link.'/comments/commentsDetails.json');
		$match = 'false';
		for ($i=0; $i <sizeof($details) ; $i++) { 
			$detail = $details[$i];
			//echo $detail[0];
			if ($detail[0]==$postKey) {
				$match ='true';
			//	echo "matched";
				if (file_exists($link.'/comments/'.$detail[1].'.json')) {
					$comments = read_json($link.'/comments/'.$detail[1].'.json');
					for ($j=0; $j <sizeof($comments) ; $j++) { 
						$comment = $comments[$j];
							if ($comment[0]==$postKey) {
								$commentdata=array();
								$commentdata = $comment[1];
								$size = sizeof($commentdata);
								$commentdata[$size]=form_comment($commentKey, $commentTime,$commentAuthor, $commentLike, $commentDisLike, $commentReplies,$commentBody);
								$comment[1]=$commentdata;
							}
						$comments[$j]=$comment;
						write_json($comments, $link.'/comments/'.$detail[1].'.json');
					}
				}
			}
		}

		if ($match=='false') {
		$g = read_json($link.'/comments/comments.json');
		if(sizeof(read_json($link.'/comments/comments'.$g.'.json'))<5){
			$detail = array();
			$detail[0]=$postKey;
			$detail[1]='comments'.$g;
			//$details[0]=$detail;
			$sizeofDetails2 = sizeof($details);
			$details[$sizeofDetails2]=$detail;
			$comments = read_json($link.'/comments/comments'.$g.'.json');
			$commentdata = array();
			$commentdata[0]= form_comment($commentKey, $commentTime,$commentAuthor, $commentLike, $commentDisLike, $commentReplies,$commentBody);
			$comment[0]= $postKey;
			$comment[1]= $commentdata;
			$sizeofcomments = sizeof($comments);
			$comments[$sizeofcomments]=$comment;
			write_json($comments, $link.'/comments/comments'.$g.'.json');
			write_json($details, $link.'/comments/commentsDetails.json');
		}
		else{
			$detail = array();
			$detail[0]=$postKey;
			$h = $g+1;
			$detail[1]='comments'.$h;
			$sizeofDetails2 = sizeof($details);
			$details[$sizeofDetails2]=$detail;
			$comments = array();
			$commentdata = array();
			$commentdata[0]= form_comment($commentKey, $commentTime,$commentAuthor, $commentLike, $commentDisLike, $commentReplies,$commentBody);
			$comment[0]= $postKey;
			$comment[1]= $commentdata;
			$sizeofcomments = sizeof($comments);
			$comments[$sizeofcomments]=$comment;
			write_json($comments, $link.'/comments/comments'.$h.'.json');
			write_json($details, $link.'/comments/commentsDetails.json');
			write_json($h,$link.'/comments/comments.json');

		}
		}
	}
}


function update_comment($postKey, $commentKey, $commentTime,$commentAuthor, $commentLike, $commentDisLike, $commentReplies,$commentBody){
	$link ='../final_theme'; $comments = array();
	if (file_exists($link.'/comments/commentsDetails.json')) {
		$details = read_json($link.'/comments/commentsDetails.json');
		for ($i=0; $i <sizeof($details) ; $i++) { 
			$detail = $details[$i];
			if ($detail[0]==$postKey) {
				if (file_exists($link.'/comments/'.$detail[1].'.json')) {
					$comments = read_json($link.'/comments/'.$detail[1].'.json');
					for ($j=0; $j <sizeof($comments) ; $j++) { 
						$comment = $comments[$j];
							if ($comment[0]==$postKey) {
								$commentdata=array();
								$commentdata = $comment[1];
								$size = sizeof($commentdata);
								for ($k=0; $k <$size ; $k++) { 
									$singlecommentdata=$commentdata[$k];
									if ($singlecommentdata[0]==$commentKey) {
										$commentdata[$k]=form_comment($commentKey, $commentTime,$commentAuthor, $commentLike, $commentDisLike, $commentReplies,$commentBody);
									}
								}
								$comment[1]=$commentdata;
							}
						$comments[$j]=$comment;
						write_json($comments, $link.'/comments/'.$detail[1].'.json');
					}
				}
			}
		}

	}
}

function delete_single_comment($postKey, $commentKey){
update_comment($postKey, $commentKey, '', '','','','','');
}

function delete_comments($postKey){
$link ='../final_theme'; $comments = array();
	if (file_exists($link.'/comments/commentsDetails.json')) {
		$details = read_json($link.'/comments/commentsDetails.json');
		for ($i=0; $i <sizeof($details) ; $i++) { 
			$detail = $details[$i];
			if ($detail[0]==$postKey) {
				if (file_exists($link.'/comments/'.$detail[1].'.json')) {
					$comments = read_json($link.'/comments/'.$detail[1].'.json');
					for ($j=0; $j <sizeof($comments) ; $j++) { 
						$comment = $comments[$j];
							if ($comment[0]==$postKey) {
								$commentdata=array();
								$commentdata = $comment[1];
								$size = sizeof($commentdata);
								for ($k=0; $k <$size ; $k++) { 
									$singlecommentdata=$commentdata[$k];
										$commentdata[$k]=form_comment('','','','','','','');
								}
								$comment[1]=$commentdata;
							}
						$comments[$j]=$comment;
						write_json($comments, $link.'/comments/'.$detail[1].'.json');
					}
				}
			}
		}

	}
}
function get_comments_for_post($postKey){
$link ='../final_theme'; $comments = array(); $commentdata=array();
	if (file_exists($link.'/comments/commentsDetails.json')) {
		$details = read_json($link.'/comments/commentsDetails.json');
		for ($i=0; $i <sizeof($details) ; $i++) { 
			$detail = $details[$i];
			if ($detail[0]==$postKey) {
				if (file_exists($link.'/comments/'.$detail[1].'.json')) {
					$comments = read_json($link.'/comments/'.$detail[1].'.json');
					for ($j=0; $j <sizeof($comments) ; $j++) { 
						$comment = $comments[$j];
							if ($comment[0]==$postKey) {
								
								$commentdata = $comment[1];
							}
					}
				}
			}
		}

	}
	$comments='';
	return $commentdata;
}

function get_key(){
	$link ='../final_theme';
	if (file_exists($link.'/keystore.json')) {
		$i=read_json($link.'/keystore.json');
		$i=$i+1;
	}
	else{
		$i=1;
	}
	write_json($i,$link.'/keystore.json');
	return $i;
}

function write_json($posts, $file){
$fp = fopen($file, 'w');
fwrite($fp, json_encode($posts));
fclose($fp);
}


function read_json($file){
  $array = json_decode(file_get_contents($file), true);
  return $array;
}

// tells us what all folders exist
function make_my_directory($dir){
    if (!file_exists($dir)) {
    mkdir($dir, 0777, true);
    }
}


function form_user($key, $authority, $name, $username, $phone, $title, $subtitle, $email, $password,$postkeys,$commentkeys, $coverPhotoKey, $profilePhotoKey, $photoKeyArray,$aboutArray){
$user = array();
$user[0]=$key;
$user[1]=$authority;
$user[2]= $name;
$user[3]=$username;
$user[4]=$phone;
$user[5]=$title;
$user[6]=$subtitle;
$user[7]=$email;
$user[8]=$password;
$user[9]=$postkeys;
$user[10]=$commentkeys;
$user[11] = $coverPhotoKey;
$user[12] = $profilePhotoKey;
$user[13] = $photoKeyArray;
$user[14] = $aboutArray;
return $user;
}

function create_new_user($key, $authority, $name, $username, $phone, $title, $subtitle, $email, $password,$postkeys,$commentkeys, $coverPhotoKey, $profilePhotoKey, $photoKeyArray,$aboutArray){
	$link ='../final_theme';
	if (!file_exists($link.'/users')) {
	mkdir($link.'/users', 0777, true);
	}
	if (!file_exists($link.'/users/user1.json')) {
		$user= array();$users= array();$userDetails= array();$usersDetails= array();
		$user = form_user($key, $authority, $name, $username, $phone, $title, $subtitle, $email, $password,$postkeys,$commentkeys, $coverPhotoKey, $profilePhotoKey, $photoKeyArray,$aboutArray);
		$i = 1;
		write_json($i, $link.'/users/users.json');
		$users[0]=$user;
		write_json($users,$link.'/users/user1.json');
		$userDetails[0]=$key;
		$userDetails[1]='user1';
		$usersDetails[0]=$userDetails;
		write_json($usersDetails,$link.'/users/userDetails.json');
	}
	else{
		$j = read_json($link.'/users/users.json');
		$users = read_json($link.'/users/user'.$j.'.json');
		$size=sizeof($users);$userDetails= array(); $usersDetails= array();
		if ($size<32) {
			$users[$size]=form_user($key, $authority, $name, $username, $phone, $title, $subtitle, $email, $password,$postkeys,$commentkeys, $coverPhotoKey, $profilePhotoKey, $photoKeyArray,$aboutArray);
			write_json($users,$link.'/users/user'.$j.'.json');
			$usersDetails=read_json($link.'/users/userDetails.json');
			$usersize=sizeof($usersDetails);		
			$userDetails[0]=$key; $userDetails[1]='user'.$j;
			$usersDetails[$usersize]=$userDetails;
			write_json($usersDetails,$link.'/users/userDetails.json');
		}
		else{
			$j = $j+1;
			write_json($j, $link.'/users/users.json');
			$users=''; $users = array();
			$users[0]=form_user($key, $authority, $name, $username, $phone, $title, $subtitle, $email, $password,$postkeys,$commentkeys, $coverPhotoKey, $profilePhotoKey, $photoKeyArray,$aboutArray);
			write_json($users,$link.'/users/user'.$j.'.json');
			$usersDetails=read_json($link.'/users/userDetails.json');
			$usersize=sizeof($usersDetails);		
			$userDetails[0]=$key; $userDetails[1]='user'.$j;
			$usersDetails[$usersize]=$userDetails;
			write_json($usersDetails,$link.'/users/userDetails.json');
		}
	}
}

function update_user($key, $authority, $name, $username, $phone, $title, $subtitle, $email, $password,$postkeys,$commentkeys, $coverPhotoKey, $profilePhotoKey, $photoKeyArray,$aboutArray){
	$link ='../final_theme';
	if (file_exists($link.'/users/userDetails.json')) {
		$usersDetails=array(); $userDetails=array();
		$usersDetails = read_json($link.'/users/userDetails.json');
		for ($i=0; $i <sizeof($usersDetails) ; $i++) { 
			$userDetails=$usersDetails[$i];
			if ($userDetails[0]==$key) {
				$file = $userDetails[1];
				//echo $file;
				if (file_exists($link.'/users/'.$file.'.json')) {
					$users=read_json($link.'/users/'.$file.'.json');
					for ($j=0; $j <sizeof($users) ; $j++) { 
						$user = $users[$j];
						if ($user[0]==$key) {
							$newuser = array();
							$newuser=form_user($key, $authority, $name, $username, $phone, $title, $subtitle, $email, $password,$postkeys,$commentkeys, $coverPhotoKey, $profilePhotoKey, $photoKeyArray,$aboutArray);
							$users[$j]=$newuser;
						}
					}
					write_json($users,$link.'/users/'.$file.'.json');
				}
			}
		}
	}
}

function get_user_data($key){
$link ='../final_theme';
$returnuser = array();
	if (file_exists($link.'/users/userDetails.json')) {
		$usersDetails=array(); $userDetails=array();
		$usersDetails = read_json($link.'/users/userDetails.json');
		for ($i=0; $i <sizeof($usersDetails) ; $i++) { 
			$userDetails=$usersDetails[$i];
			if ($userDetails[0]==$key) {
				$file = $userDetails[1];
				if (file_exists($link.'/users/'.$file.'.json')) {
					$users=read_json($link.'/users/'.$file.'.json');
					for ($j=0; $j <sizeof($users) ; $j++) { 
						$user = $users[$j];
						if ($user[0]==$key) {
							$returnuser= $users[$j];
						}
					}
				}
			}
		}
	}

	return $returnuser;
}

// adds the comment list of user
function add_user_comment_to_profile($userKey, $commentKey){
$user = get_user_data($userKey);
$commentskeys=$user[10];
$size = sizeof($commentskeys);
$commentskeys[$size]=$commentKey;
update_user($user[0], $user[1], $user[2], $user[3], $user[4], $user[5], $user[6], $user[7], $user[8],$user[9],$commentskeys,$user[11],$user[12],$user[13],$user[14]);
}

function add_user_posts_to_profile($userKey, $postKey){
$user = get_user_data($userKey);
$postsKey=$user[9];
$size = sizeof($postsKey);
$postsKey[$size]=$postKey;
update_user($user[0], $user[1], $user[2], $user[3], $user[4], $user[5], $user[6], $user[7], $user[8],$postsKey,$user[10],$user[11],$user[12],$user[13],$user[14]);
}

function delete_user($key){
	$temp = array();
update_user($key, '', '', '', '', '', '', '', '',$temp,$temp,'','',$temp,$temp);//instead use default user
}


function get_all_posts_for_user($userkey){
$output = array();
$output= get_user_data($userkey);
return $output[9];
}

function get_all_comments_for_user($userkey){
$output = array();
$output= get_user_data($userkey);
return $output[10];
}


function get_key_image(){
	$link ='../final_theme';
	if (file_exists($link.'/imagekeystore.json')) {
		$i=read_json($link.'/imagekeystore.json');
		$i=$i+1;
	}
	else{
		$i=1;
	}
	write_json($i,$link.'/imagekeystore.json');
	return $i;
}


function delete_post_for_user($userKey, $postKey){
delete_post($postKey);
$user = get_user_data($userKey);
$postsKey=$user[9];
for ($i=0; $i <sizeof($postsKey) ; $i++) { 
	if ($postsKey[$i]==$postKey) {
		$postsKey[$i]='';
	}
}
$user[9]=$postsKey;
update_user($user[0], $user[1], $user[2], $user[3], $user[4], $user[5], $user[6], $user[7], $user[8],$user[9],$user[10],$user[11],$user[12],$user[13],$user[14]);
$user='';
$postsKey='';
}

function delete_comment_for_user_given_postKey($userKey, $commentKey, $postKey){
delete_single_comment($postKey, $commentKey);
$user = get_user_data($userKey);
$commentskeys=$user[10];
for ($i=0; $i <sizeof($commentskeys) ; $i++) { 
	if ($commentskeys[$i]==$commentKey) {
		$commentskeys[$i]='';
	}
}
$user[10] = $commentskeys;
update_user($user[0], $user[1], $user[2], $user[3], $user[4], $user[5], $user[6], $user[7], $user[8],$user[9],$user[10],$user[11],$user[12],$user[13],$user[14]);
$user='';
$commentskeys='';
}

function delete_comment_for_user($userKey, $commentKey){
$postsKey = get_all_posts_for_user($userKey);
for ($i=0; $i <sizeof($postsKey) ; $i++) { 
	delete_comment_for_user_given_postKey($userKey, $commentKey, $postsKey[$i]);
}
}
function write_post_for_user($userKey, $postMainHeader, $postSubHeader, $postBody,$postTime,$postAuthor, $postCategory, $postTags){
//$postKey, $postMainHeader, $postSubHeader, $postBody,$postTime,$postAuthor, $postCategory, $postTags
	$postKey = get_key();
	add_post($postKey, $postMainHeader, $postSubHeader, $postBody,$postTime,$postAuthor, $postCategory, $postTags);
	add_user_posts_to_profile($userKey, $postKey);
}

function write_comment_for_user($userKey,$postKey, $commentTime,$commentAuthor, $commentLike, $commentDisLike, $commentReplies,$commentBody){
	$commentKey = get_key();
	add_comment($postKey, $commentKey, $commentTime,$commentAuthor, $commentLike, $commentDisLike, $commentReplies,$commentBody);
	add_user_comment_to_profile($userKey, $commentKey);
}

function edit_post_for_user($userKey, $postKey, $postMainHeader, $postSubHeader, $postBody,$postTime,$postAuthor, $postCategory, $postTags){
update_post_no_comments($postKey, $postMainHeader, $postSubHeader, $postBody,$postTime,$postAuthor, $postCategory, $postTags);
}

function edit_comment_for_user_given_postKey($userKey,$postKey, $commentKey, $commentTime,$commentAuthor, $commentLike, $commentDisLike, $commentReplies,$commentBody){
update_comment($postKey, $commentKey, $commentTime,$commentAuthor, $commentLike, $commentDisLike, $commentReplies,$commentBody);
}

function edit_comment_for_user($userKey,$commentKey, $commentTime,$commentAuthor, $commentLike, $commentDisLike, $commentReplies){
	$postsKey = get_all_posts_for_user($userKey);
for ($i=0; $i <sizeof($postsKey) ; $i++) { 
	edit_comment_for_user_given_postKey($userKey,$postsKey[$i], $commentKey, $commentTime,$commentAuthor, $commentLike, $commentDisLike, $commentReplies);
	}
}

function change_user_cover_photo($userKey, $imageKey){
$user = get_user_data($userKey);
$userPhotos = $user[13];
$size = sizeof($userPhotos);
$userPhotos[$size] = $imageKey;
update_user($user[0], $user[1], $user[2], $user[3], $user[4], $user[5], $user[6], $user[7], $user[8],$user[9],$user[10],$imageKey,$user[12],$userPhotos,$user[14]);
}

function add_user_photo($userKey, $imageKey){
$user = get_user_data($userKey);
$userPhotos = $user[13];
$size = sizeof($userPhotos);
$userPhotos[$size] = $imageKey;
update_user($user[0], $user[1], $user[2], $user[3], $user[4], $user[5], $user[6], $user[7], $user[8],$user[9],$user[10],$user[11],$user[12],$userPhotos,$user[14]);
}

function change_user_profile_photo($userKey, $imageKey){
$user = get_user_data($userKey);
$userPhotos = $user[13];
$size = sizeof($userPhotos);
$userPhotos[$size] = $imageKey;
update_user($user[0], $user[1], $user[2], $user[3], $user[4], $user[5], $user[6], $user[7], $user[8],$user[9],$user[10],$user[11],$imageKey,$userPhotos,$user[14]);
}


function form_user_about($pgpbatch, $address, $intern,$finalplacement,$pastWork,$pastEducation,$phone,$club,$interests){
	$about = array();
	$about[0]= $pgpbatch;
	$about[1]= $address;
	$about[2]=$intern;
	$about[3]=$finalplacement;
	$about[4]=$pastWork;
	$about[5]=$pastEducation;
	$about[6]=$phone;
	$about[7]=$club;
	$about[8]=$interests;
return $about;
}

function change_user_about($userKey, $pgpbatch, $address, $intern,$finalplacement,$pastWork,$pastEducation,$phone,$club,$interests){
	$about = form_user_about($pgpbatch, $address, $intern,$finalplacement,$pastWork,$pastEducation,$phone,$club,$interests);
	$user = get_user_data($userKey);
	update_user($user[0], $user[1], $user[2], $user[3], $user[4], $user[5], $user[6], $user[7], $user[8],$user[9],$user[10],$user[11],$user[12], $user[13], $about);
}

function change_user_pgpbatch($userKey, $pgpbatch){
	$user = get_user_data($userKey);
	$about = $user[14];
	$about[0]=$pgpbatch;
	update_user($user[0], $user[1], $user[2], $user[3], $user[4], $user[5], $user[6], $user[7], $user[8],$user[9],$user[10],$user[11],$user[12], $user[13], $about);
}

function change_user_address($userKey, $address){
	$user = get_user_data($userKey);
	$about = $user[14];
	$about[1]=$address;
	update_user($user[0], $user[1], $user[2], $user[3], $user[4], $user[5], $user[6], $user[7], $user[8],$user[9],$user[10],$user[11],$user[12], $user[13], $about);
}

function change_user_intern($userKey, $intern){
	$user = get_user_data($userKey);
	$about = $user[14];
	$about[2]=$intern;
	update_user($user[0], $user[1], $user[2], $user[3], $user[4], $user[5], $user[6], $user[7], $user[8],$user[9],$user[10],$user[11],$user[12], $user[13], $about);
}

function change_user_finalplacement($userKey, $finalplacement){
	$user = get_user_data($userKey);
	$about = $user[14];
	$about[3]=$finalplacement;
	update_user($user[0], $user[1], $user[2], $user[3], $user[4], $user[5], $user[6], $user[7], $user[8],$user[9],$user[10],$user[11],$user[12], $user[13], $about);
}

function change_user_pastWork($userKey, $pastWork){
	$user = get_user_data($userKey);
	$about = $user[14];
	$about[4]=$pastWork;
	update_user($user[0], $user[1], $user[2], $user[3], $user[4], $user[5], $user[6], $user[7], $user[8],$user[9],$user[10],$user[11],$user[12], $user[13], $about);
}

function change_user_pastEducation($userKey, $pastEducation){
	$user = get_user_data($userKey);
	$about = $user[14];
	$about[5]=$pastEducation;
	update_user($user[0], $user[1], $user[2], $user[3], $user[4], $user[5], $user[6], $user[7], $user[8],$user[9],$user[10],$user[11],$user[12], $user[13], $about);
}

function change_user_phone($userKey, $phone){
	$user = get_user_data($userKey);
	$about = $user[14];
	$about[6]=$phone;
	update_user($user[0], $user[1], $user[2], $user[3], $user[4], $user[5], $user[6], $user[7], $user[8],$user[9],$user[10],$user[11],$user[12], $user[13], $about);
}

function change_user_club($userKey, $club){
	$user = get_user_data($userKey);
	$about = $user[14];
	$about[7]=$club;
	update_user($user[0], $user[1], $user[2], $user[3], $user[4], $user[5], $user[6], $user[7], $user[8],$user[9],$user[10],$user[11],$user[12], $user[13], $about);
}

function change_user_interests($userKey, $interests){
	$user = get_user_data($userKey);
	$about = $user[14];
	$about[8]=$interests;
	update_user($user[0], $user[1], $user[2], $user[3], $user[4], $user[5], $user[6], $user[7], $user[8],$user[9],$user[10],$user[11],$user[12], $user[13], $about);
}

function add_photo(){
$link ='../final_theme';
$key = get_key_image();
$address = '';

if (file_exists($link.'/images2')) {
	if (file_exists($link.'/images2/images.json')) {
		$size = read_json($link.'/images2/images.json');
		if (file_exists($link.'/images2/'.$size)){
			if (file_exists($link.'/images2/'.$size.'/imagesDetails.json')) {
				$details = read_json($link.'/images2/'.$size.'/imagesDetails.json');
				$utility = sizeof($details);
				if ($utility<100) {
					$details[$utility] = $key;
					write_json($details, $link.'/images2/'.$size.'/imagesDetails.json');
					$address = '/images2/'.$size.'/'.$key;
				}
				else{
					$details =''; $details = array();
					$details[0] = $key;
					$size = $size+1;
					mkdir($link.'/images2/'.$size, 0777, true);
					write_json($details, $link.'/images2/'.$size.'/imagesDetails.json');
					write_json($size, $link.'/images2/images.json');
					$address = '/images2/'.$size.'/'.$key;
				}
			}
		}
	}
	else{
		$size = 1;
		mkdir($link.'/images2/'.$size, 0777, true);
		write_json($size, $link.'/images2/images.json');
		$details = array();
		$details[0] = $key;
		write_json($details, $link.'/images2/'.$size.'/imagesDetails.json');
		$address = '/images2/'.$size.'/'.$key;
	}

}
else{
        mkdir($link.'/images2', 0777, true);
        $size = 1;$details = array();
        mkdir($link.'/images2/'.$size, 0777, true);
		write_json($size, $link.'/images2/images.json');
		$details[0] = $key;
		write_json($details, $link.'/images2/1/imagesDetails.json');
		$address = '/images2/1/'.$key;
    }

    return $address;
}

function add_thumb(){
$link ='../final_theme';
$address = '';
$key = get_key_image();
if (file_exists($link.'/imagesThumb')) {
	if (file_exists($link.'/imagesThumb/images.json')) {
		$size = read_json($link.'/imagesThumb/images.json');
		if (file_exists($link.'/imagesThumb/'.$size)){
			if (file_exists($link.'/imagesThumb/'.$size.'/imagesDetails.json')) {
				$details = read_json($link.'/imagesThumb/'.$size.'/imagesDetails.json');
				$utility = sizeof($details);
				if ($utility<5) {
					$details[$utility] = $key;
					write_json($details, $link.'/imagesThumb/'.$size.'/imagesDetails.json');
					$address = '/imagesThumb/'.$size.'/'.$key;
				}
				else{
					$details =''; $details = array();
					$details[0] = $key;
					$size = $size+1;
					mkdir($link.'/imagesThumb/'.$size, 0777, true);
					write_json($details, $link.'/imagesThumb/'.$size.'/imagesDetails.json');
					write_json($size, $link.'/imagesThumb/images.json');
					$address = '/imagesThumb/'.$size.'/'.$key;
				}
			}
		}
	}
	else{
		$size = 1;
		mkdir($link.'/imagesThumb/'.$size, 0777, true);
		write_json($size, $link.'/imagesThumb/images.json');
		$details = array();
		$details[0] = $key;
		write_json($details, $link.'/imagesThumb/'.$size.'/imagesDetails.json');
		$address = '/imagesThumb/'.$size.'/'.$key;
	}

}
else{
        mkdir($link.'/imagesThumb', 0777, true);
        $size = 1;$details = array();
        mkdir($link.'/imagesThumb/'.$size, 0777, true);
		write_json($size, $link.'/imagesThumb/images.json');
		$details[0] = $key;
		write_json($details, $link.'/imagesThumb/1/imagesDetails.json');
		$address = '/imagesThumb/1/'.$key;
    }

    return $address;
}

// this function is useless
function get_photo_address($photo_key){
$link ='../final_theme';
$address = '';
if (file_exists($link.'/images')) {
	if (file_exists($link.'/images/images.json')) {
		$size = read_json($link.'/images/images.json');
		for ($i=$size; $i >0 ; $i--) { 
			if (file_exists($link.'/images/'.$size)){
				if (file_exists($link.'/images/'.$size.'/imagesDetails.json')) {
					$details = read_json($link.'/images/'.$size.'/imagesDetails.json');
					for($j=0; $j<sizeof($details) ; $j++){
						if ($details[$j]==$photo_key) {
							$address = '/images/'.$size.'/'.$photo_key;
						}
					}
					
				}
			}
		}
	}
}
return $address;
}


function time_elapsed($ptime)
{
    $etime = time() - $ptime;

    if ($etime < 1)
    {
        return '0 seconds';
    }

    $a = array( 365 * 24 * 60 * 60  =>  'year',
                 30 * 24 * 60 * 60  =>  'month',
                      24 * 60 * 60  =>  'day',
                           60 * 60  =>  'hour',
                                60  =>  'minute',
                                 1  =>  'second'
                );
    $a_plural = array( 'year'   => 'years',
                       'month'  => 'months',
                       'day'    => 'days',
                       'hour'   => 'hours',
                       'minute' => 'minutes',
                       'second' => 'seconds'
                );

    foreach ($a as $secs => $str)
    {
        $d = $etime / $secs;
        if ($d >= 1)
        {
            $r = round($d);
            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
        }
    }
}


function test(){
	$tags=array();
$tags[0]='tag1';
$tags[1]='tag2';
$tags[2]='tag3';
add_post(1,1,0,0,0,0,1,$tags);
	for ($i=3; $i <100 ; $i++) { 
		add_post(get_key(),get_key(),0,0,0,0,2,$tags);
	}
	
}

function test2(){
	delete_post(5);
	delete_post(6);
}

function test3(){
	$tags=array();
$tags[0]='tag1';
$tags[1]='tag2';
$tags[2]='tag3';
	for ($i=10; $i <100 ; $i++) { 
		update_post_no_comments(get_key(),get_key(),5,0,0,0,2,$tags);

	}
	
}
function test4(){
	for ($i=1; $i<6; $i++) { 
		add_comment(get_key(), get_key(), $i,0, 0, 0, 0,'Body');

	}
	
}

function test5(){
delete_single_comment('postkey1',1);
}

function test6(){
	$postkeys=array(); $commentkeys=array(); $photoKeyArray=array(); $aboutArray = array();
	create_new_user(get_key(), 'admin', 'shrikant', 'shrikantz14', '982116480', 'title1', 'subtitle1', 'shrikant.zarekar@iimb.ernet.in', 'passwordd',$postkeys,$commentkeys,'','',$photoKeyArray,$aboutArray);
}

function test7(){
	$postkeys=array(); $commentkeys=array(); 
	update_user(630, 'admin', 'shrikant2', 'shrikantz14', '982116480', 'title1', 'subtitle1', 'shrikant.zarekar@iimb.ernet.in', 'passwordd',$postkeys,$commentkeys,'','',$photoKeyArray,$aboutArray);
}

function test8(){
	$output = get_user_data(630);
	print_r($output);
}

function test9(){
	add_user_comment_to_profile(630, 637);
	test8();

}

function test10(){
	add_user_posts_to_profile(630, 636);
	add_user_posts_to_profile(630, 640);
	//test8();

}
function test11(){
	//print_r(get_all_posts_for_user(630));
	print_r(get_all_comments_for_user(630));
}

function test12(){
	//test10();
	delete_post_for_user(630, 640);
	delete_comment_for_user(630, 637);
	test8();
}

function test13(){
	$postkeys=array(); $commentkeys=array(); $photoKeyArray=array(); $aboutArray = array();
	//$profilePhtoAddress = '/images2/1/1';
	$profilePhtoAddress = '';
	$photoKeyArray[0]= $profilePhtoAddress;
	$link ='../final_theme';
	for ($i=0; $i <800 ; $i++) { 
		create_new_user(get_key(), 'admin', 'shrikant', 'shrikantz14', '982116480', 'title1', 'subtitle1', 'shrikant.zarekar@iimb.ernet.in', 'passwordd',$postkeys,$commentkeys,$profilePhtoAddress,$profilePhtoAddress,$photoKeyArray,$aboutArray);
	}
	
}

function test14($key){
	$user = get_user_data($key);
	return $user;
}
function test15($userkey, $imageaddress){
	$user = get_user_data($key);
	return $user;
}

function test16(){
	$post = get_recent_post(20);
	return $post;
}

//test();
//test2();
//test3();
//test4();
//test5();
//delete_comments('postkey2');
//test6();
//test7();
//test8();
//test9();
//test10();
//test11();
//test12();
//test13();
//$user = test14(3);
//print_r($user);

//$post = test16();
//print_r(time_elapsed($post[4]));
?>
