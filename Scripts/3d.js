import * as THREE from 'https://cdn.skypack.dev/three@0.135.0';

const scene = new THREE.Scene();

const camera = new THREE.PerspectiveCamera(75,800/600,0.1,1000);

const renderer = new THREE.WebGLRenderer({
    canvas: document.getElementById('3d-bgk'),
});

renderer.setPixelRatio(window.devicePixelRatio);

renderer.setSize(800, 600);

camera.position.setZ(30);

const geomerty = new THREE.IcosahedronGeometry(10,0);

var material = new THREE.MeshStandardMaterial({color: 0xFF6347});

var dado = new THREE.Mesh(geomerty,material);

scene.add(dado);


const pointLight = new THREE.PointLight(0xffffff);
pointLight.position.set(20,20,20);
scene.add(pointLight);



const light = new THREE.AmbientLight( 0xffffff ); // soft white light
scene.add(light);



var randomRotate=true

setTimeout(()=>{
    randomRotate=false;
    dado.rotation.z= .2;
    dado.rotation.y= .32;
    dado.rotation.x= .05;
    $('body').append($('<div class="new_number"></div>').text(Math.floor(Math.random()*14)));

    
},2000);

function animate(){
    requestAnimationFrame(animate);

    
    if(randomRotate){
        dado.rotation.x+= Math.random()/5;
        dado.rotation.y+= Math.random()/5;
        dado.rotation.z+= Math.random()/5;
    }
    
    renderer.render(scene,camera);
}

animate();




