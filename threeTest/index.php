<!DOCTYPE html>
<html>
	<head>
	<title>Astrum</title>
	<link rel='stylesheet' type='text/css' href='../Astrum/css/loginsheet.css'/>
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type='text/javascript' src='../js/script.js'></script>
        
    <script src="three.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
		
        <script src="http://threejs.org/examples/js/controls/OrbitControls.js"></script>

		<script src="stats.min.js"></script>
        
	</head>
<body>

<?php
echo '<div class="wrapper" style="background-color:lightgrey;">';
echo '<div class="container">';
echo '<h1 id="titleHead">Astrum 3</h1>';
//echo '<script src="testScene.js"></script>';
echo '<div id ="planet"></div>';
echo '</div>';
echo '</div>';
?>

</body>
    <script type="text/javascript">

	// set the scene size
    var parent, renderer, scene, camera, controls, pointLight;
        
    //Call startup funcs
    init();
    animate();    
        
    function init() {  
        
	var WIDTH = 400,
	    HEIGHT = 300;
        // set some camera attributes
	var VIEW_ANGLE = 45,
	    ASPECT = WIDTH / HEIGHT,
	    NEAR = 0.1,
	    FAR = 10000;


	// get the DOM element to attach to

	var $container = $('#planet');

	// Define all variables --------------------------------------------------------------
	renderer = new THREE.WebGLRenderer({alpha: true});

	renderer.setSize(WIDTH, HEIGHT);

	// attach the render-supplied DOM element
	$container.append(renderer.domElement);
        
    //----------------------------------------------------------------

// scene
	scene = new THREE.Scene();
	
	// camera
	camera = new THREE.PerspectiveCamera(  VIEW_ANGLE,
	                                ASPECT,
	                                NEAR,
	                                FAR );
	camera.position.set( 20, 20, 20 );

	// controls
	controls = new THREE.OrbitControls( camera );
    controls.minDistance = 0;
    controls.maxDistance = 50;
        
        controls.update();
	
	// axes
	//scene.add( new THREE.AxisHelper( 20 ) );

	// geometry
	var geometry = new THREE.BoxGeometry( 2, 2, 2 );
	var planet = new THREE.SphereGeometry(5, 16, 16);
    var moon = new THREE.SphereGeometry(1,16,16);
        
	// material
	var material1 = new THREE.MeshLambertMaterial(
	{
	    color: 0x8C8C8C
	});
    var material2 = new THREE.MeshBasicMaterial(
	{
	    color: 0x2B2B2B
	});
        
	
	// parent
	parent = new THREE.Object3D();
	scene.add( parent );

	// pivots
	var pivot1 = new THREE.Object3D();
	var pivot2 = new THREE.Object3D();
	//var pivot3 = new THREE.Object3D();
	pivot1.rotation.z = 0;
	pivot2.rotation.z = 2 * Math.PI / 3;
	
	parent.add( pivot1 );
	parent.add( pivot2 );
	//parent.add( pivot3 );

	// mesh
	var mesh1 = new THREE.Mesh( planet, material1 );
	var mesh2 = new THREE.Mesh( moon, material1 );

	mesh1.position.y = 0;
	mesh2.position.y = 8; //dist from center

	pivot1.add( mesh1 );
	pivot2.add( mesh2 );
        
    pointLight = new THREE.PointLight( 0xFFFFFF );

	// set its position
	pointLight.position.x = 50;
	pointLight.position.y = 90;
	pointLight.position.z = 130;

	// add to the scene
	scene.add(pointLight);
	
}

function animate() {

	requestAnimationFrame( animate );

	parent.rotation.z += 0.03; //speed of rotation
    
	//controls.update();

	renderer.render( scene, camera );

}
	</script>
</html>