import * as THREE from 'https://cdn.skypack.dev/three@0.135.0';


window.mostarDado = function (res){

    
    $('body').append($('<canvas id="3d-bgk"></canvas>'));

    var scene = new THREE.Scene();

    var camera = new THREE.PerspectiveCamera(75,800/600,0.1,1000);

    var renderer = new THREE.WebGLRenderer({
        canvas: document.getElementById('3d-bgk'),
        alpha: true,
    });

    renderer.setPixelRatio(window.devicePixelRatio);

    renderer.setSize(800, 600);

    camera.position.setZ(30);

    var geomerty = new THREE.IcosahedronGeometry(10,0);

    var material = new THREE.MeshStandardMaterial({color: 0xFF6347});

    var dado = new THREE.Mesh(geomerty,material);

    scene.add(dado);


    var pointLight = new THREE.PointLight(0xffffff);
    pointLight.position.set(20,20,20);
    scene.add(pointLight);



    var light = new THREE.AmbientLight( 0xffffff ); // soft white light
    scene.add(light);

    renderer.setClearColor( 0x000000, 0);

    var randomRotate=true

    setTimeout(()=>{
        randomRotate=false;
        dado.rotation.z= .2;
        dado.rotation.y= .32;
        dado.rotation.x= .05;
        $('body').append($('<div class="new_number"></div>').text(res));

        
    },2000);

    setTimeout(()=>{
        $('canvas').remove();
        $('.new_number').remove();
        randomRotate=true;
    },5000)

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

}

window.tirarDado=function(caras,habilidad,nombreHabilidaad){

    var tirada_bot= Math.floor(Math.random() * (caras - 1) + 1);

    var tirada_personaje= (Math.floor(Math.random() * (caras - 1) + 1))+habilidad;

    mostarDado(tirada_personaje);

    setTimeout(()=>{
        if(tirada_bot>tirada_personaje){
            $('body').append($('<div class="DIV_ERR_Message"><p>Ha ganado Abominatiogus en '+nombreHabilidaad+'</p><div><span>X</span></div></div>'));
        }else{
            $('body').append($('<div class="DIV_ERR_Message"><p>Has ganado en '+nombreHabilidaad+'</p><div><span>X</span></div></div>'));
        }
    },5000);

    setTimeout(()=>{
        $('.DIV_ERR_Message').remove();
    },8000);

}