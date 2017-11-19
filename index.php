
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="robots" content="noindex, nofollow">
	<meta name="googlebot" content="noindex, nofollow">
		<script type="text/javascript" src="https://d3js.org/d3.v4.min.js"></script>
		
		<script type="text/javascript">
			if (typeof d3 == 'undefined') {
				document.write(unescape("%3Cscript src='assets/vendors/d3.v4.min.js' type='text/javascript'%3E%3C/script%3E"));
				document.write(unescape("%3Cscript src='assets/vendors/lodash.min.js' type='text/javascript'%3E%3C/script%3E"));
				document.write(unescape("%3Cscript src='assets/vendors/dTree.js' type='text/javascript'%3E%3C/script%3E"));
			}
		</script>
		
		<script type="text/javascript" src="https://cdn.jsdelivr.net/lodash/4.17.4/lodash.min.js"></script>
		<script type="text/javascript" src="https://cdn.rawgit.com/ErikGartner/dTree/master/dist/dTree.js"></script>
	

	<style type="text/css">
		body {
	font: 10px sans-serif;
}

.linage {
	fill: none;
	stroke: #000;
}

.marriage {
	fill: none;
	stroke: black;
}

.man {
	background-color: lightblue;
	border-style: solid;
	border-width: 1px;
}

.woman {
	background-color: pink;
	border-style: solid;
	border-width: 1px;
}

.emphasis {
	font-style: italic;
}

p {
	padding: 0;
	margin: 0;
}

	</style>

	<title>dTree Demo</title>

	
		

<?php 
	$result = array(
		array(
			"id" => 1,
			"name" => "Sofyan Wiradinata",
			"nickname" => "Ucup",
			"gender" => "man",
			"parent_id" => 0
		),
		array(
			"id" => 2,
			"name" => "Djuarsih",
			"nickname" => "Mimih",
			"gender" => "woman",
			"spouse_id" => 1,
		),


		array(
			"id" => 3,
			"name" => "Dedi Achmad Hidayat",
			"nickname" => "Dedi",
			"gender" => "man",
			"parent_id" => 1,
		),
		array(
			"id" => 4,
			"name" => "Susilawati Wijaya",
			"nickname" => "Susi",
			"gender" => "woman",
			"spouse_id" => 3,
		),
		array(
			"id" => 5,
			"name" => "R. Muchamad Darajat",
			"nickname" => "Sidi",
			"gender" => "man",
			"parent_id" => 3,
		),
		array(
			"id" => 6,
			"name" => "Muchamad Ilman Maulana",
			"nickname" => "Ilman",
			"gender" => "man",
			"parent_id" => 3,
		),


		array(
			"id" => 7,
			"name" => "Deni Djuanda",
			"nickname" => "Deni",
			"gender" => "man",
			"parent_id" => 1,
		),
		array(
			"id" => 8,
			"name" => "Neneng",
			"nickname" => "Neneng",
			"gender" => "woman",
			"spouse_id" => 7,
		),
		array(
			"id" => 9,
			"name" => "Deden",
			"nickname" => "Deden",
			"gender" => "man",
			"parent_id" => 7,
		),
		array(
			"id" => 10,
			"name" => "Rika",
			"nickname" => "Rika",
			"gender" => "woman",
			"parent_id" => 7,
		),
	);

	function spouseTree($result, $spouse_id=0){
		
		$branch = array();

		foreach ($result as $row) {
			if (isset($row['spouse_id']) && $row['spouse_id'] == $spouse_id) {					
				$spouse = dataTree($result, $row['id'],'spouse');									
				if ($spouse) {
					if(!isset($row['marriages'])){
						$row['marriages'] = array();
					}
					$row['marriages']['spouse'] = $spouse;
				}
				$branch[] = $row;
			}
		}
		return $branch;
	}

	function dataTree($result, $parent_id=0){

		$branch = array();

		foreach ($result as $row) {
			if (isset($row['parent_id']) && $row['parent_id'] == $parent_id) {
				$children = dataTree($result, $row['id']);
				$spouse = spouseTree($result, $row['id']);
				if ($spouse) {
					if(!isset($row['marriages'])){
						$row['marriages'] = array();
					}
					$row['marriages']['spouse'] = $spouse;
				}
				if ($children) {
					if(!isset($row['marriages'])){
						$row['marriages'] = array();
					}
					$row['marriages']['children'] = $children;
				}
				$branch[] = $row;
			}
		}

		return $branch;
	}



	
	echo '<pre style="background:#ddd; border:#ccc solid 1px; padding:10px; margin:0 0 10px; clear:both;">';
	print_r(dataTree($result, 0));
	echo '</pre>';
	

?>




<script type='text/javascript'>//<![CDATA[
window.onload=function(){
treeData = [{
	"name": "Sofyan Wiradinata",
	"nickname": "Ucup",
	"gender": "man",
	"textClass": "emphasis",
	"marriages": [{
		"spouse": {
			"name": "Djuarsih",
			"nickname": "Mimih",
			"gender": "woman"
		},
		"children": [
			{
				"name": "Dedi Achmad Hidayat",
				"nickname": "Dedi",
				"gender": "man",
				"marriages": [{
					"spouse": {
						"name": "Susilawati Wijaya",
						"nickname": "Susi",
						"gender": "woman"
					},
					"children": [{
						"name": "R. Muchamad Darajat",
						"nickname": "Sidi",
						"gender": "man"
					}, {
						"name": "Muchamad Ilman Maulana",
						"nickname": "Ilman",
						"gender": "man"
					}]
				}]
			},
			{
				"name": "Deni Djuanda",
				"nickname": "Deni",
				"gender": "man",
				"marriages": [{
					"spouse": {
						"name": "Neneng",
						"nickname": "Neneng",
						"gender": "woman"
					},
					"children": [{
						"name": "Deden",
						"nickname": "Deden",
						"gender": "man"
					}, {
						"name": "Rika",
						"nickname": "Rika",
						"gender": "woman"
					}]
				}]
			},
			{
				"name": "Heri Moh Sahri",
				"nickname": "Heri",
				"gender": "man",
				"marriages": [{
					"spouse": {
						"name": "Dewi",
						"nickname": "Dewi",
						"gender": "woman"
					},
					"children": [{
						"name": "Andri",
						"nickname": "Andri",
						"gender": "man"
					}, {
						"name": "Bisya",
						"nickname": "Bisya",
						"gender": "woman"
					}]
				}]
			}

		]
	}]
}]



dTree.init(treeData, {
	target: "#graph",
	debug: true,
	height: 800,
	width: 1200,
	nodeWidth: 150,
	callbacks: {
		nodeClick: function(name, extra) {
			console.log(name);
		},
		textRenderer(name, extra, textClass) {
	  var node = '';
	  if(typeof extra === 'undefined'){
		extra = {};
	  }
	  node += '<p align="center">\n';
	  node += extra.gender;
	  node += '</p>\n';
	  node += '<p align="center" class="' + textClass + '">\n';
	  node += name;
	  node += '</p>\n';
	  node += '<p align="center">\n';
	  node += '<small>' + extra.nickname + '</small>';
	  node += '</p>\n';
	  return node;
	}
	}
});

}//]]> 

</script>

	
</head>

<body>
	<!DOCTYPE html>

<body>
	<h1>Demo</h1>
	<div id="graph"></div>

	<script>


	</script>
</body>

</html>

	
	<script>
	// tell the embed parent frame the height of the content
	if (window.parent && window.parent.parent){
		window.parent.parent.postMessage(["resultsFrame", {
			height: document.body.getBoundingClientRect().height,
			slug: "tpde0cer"
		}], "*")
	}
</script>

</body>

</html>

