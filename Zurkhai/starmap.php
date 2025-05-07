<?php
// starmap3d.php
include 'header.php';
?>
<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Babylon.js 3D Одны зураглал</title>
    <script src="https://cdn.babylonjs.com/babylon.js"></script>
    <script src="https://cdn.babylonjs.com/gui/babylon.gui.min.js"></script> <!-- GUI plugin -->
    <style>
        body {
            margin: 0;
            overflow: hidden;
        }
        canvas {
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>

<canvas id="renderCanvas"></canvas>

<script>
    const canvas = document.getElementById("renderCanvas");
    const engine = new BABYLON.Engine(canvas, true);
    const scene = new BABYLON.Scene(engine);


    const backgroundImage = "assets/images/Harnvh.jpg";  
    const photoDome = new BABYLON.PhotoDome(
        "galaxyDome",
        backgroundImage,
        {
            resolution: 64,
            size: 350,
            useDirectMapping: false,
        },
        scene
    );

    const camera = new BABYLON.ArcRotateCamera("camera1", Math.PI / 2, Math.PI / 2, 100, BABYLON.Vector3.Zero(), scene);
    camera.attachControl(canvas, true);
    camera.lowerBetaLimit = 0.1;
    camera.upperBetaLimit = Math.PI - 0.1;
    camera.setPosition(new BABYLON.Vector3(0, 0, -150));

    const light = new BABYLON.HemisphericLight("light1", BABYLON.Vector3.Up(), scene);
    light.intensity = 0.7;

    const stars = [];
    for (let i = 0; i < 2000; i++) {
        const star = BABYLON.MeshBuilder.CreateSphere("star" + i, { diameter: 0.2 }, scene);
        star.position.x = Math.random() * 200 - 100;
        star.position.y = Math.random() * 200 - 100;
        star.position.z = Math.random() * 200 - 100;
        const starMaterial = new BABYLON.StandardMaterial("starMaterial" + i, scene);
        starMaterial.emissiveColor = BABYLON.Color3.White();
        star.material = starMaterial;
        stars.push(star);
    }

    const constellations = [
        { name: "Хонь", stars: [
            new BABYLON.Vector3(20, 10, -30),
            new BABYLON.Vector3(30, 15, -25),
            new BABYLON.Vector3(35, 10, -35),
            new BABYLON.Vector3(25, 5, -40)
        ], color: BABYLON.Color3.White() },

        { name: "Үхэр", stars: [
            new BABYLON.Vector3(-50, 20, -40),
            new BABYLON.Vector3(-55, 15, -45),
            new BABYLON.Vector3(-60, 10, -50),
            new BABYLON.Vector3(-45, 5, -55)
        ], color: BABYLON.Color3.White() },

        { name: "Ихэр", stars: [
            new BABYLON.Vector3(10, -10, 20),
            new BABYLON.Vector3(15, -5, 25),
            new BABYLON.Vector3(20, -10, 30),
            new BABYLON.Vector3(5, -15, 35)
        ], color: BABYLON.Color3.White() },

        { name: "Мэлхий", stars: [
            new BABYLON.Vector3(60, 30, -30),
            new BABYLON.Vector3(65, 35, -35),
            new BABYLON.Vector3(70, 30, -25),
            new BABYLON.Vector3(65, 25, -20)
        ], color: BABYLON.Color3.Green() },

        { name: "Арслан", stars: [
            new BABYLON.Vector3(-20, 40, -70),
            new BABYLON.Vector3(-25, 45, -75),
            new BABYLON.Vector3(-30, 40, -80),
            new BABYLON.Vector3(-35, 35, -85)
        ], color: BABYLON.Color3.Yellow() },
    ];

    // Create lines between stars to form constellations
    constellations.forEach((constellation) => {
        const linePoints = constellation.stars;
        const lineMaterial = new BABYLON.StandardMaterial(constellation.name + "LineMaterial", scene);
        lineMaterial.emissiveColor = constellation.color;
        const line = BABYLON.MeshBuilder.CreateLines(constellation.name + "_line", { points: linePoints, updatable: true }, scene);
        line.material = lineMaterial;
    });

    // GUI ашиглаж constellation-ийн нэрүүдийг харуулах
    const advancedTexture = BABYLON.GUI.AdvancedDynamicTexture.CreateFullscreenUI("UI");

    constellations.forEach((constellation) => {
        // Нэрийг constellation-ийн эхний одны байршилд байрлуулна
        const labelPosition = constellation.stars[0];

        // Invisible mesh to attach label
        const dummy = BABYLON.MeshBuilder.CreateBox("dummy" + constellation.name, { size: 0.1 }, scene);
        dummy.position = labelPosition;

        const label = new BABYLON.GUI.Rectangle();
        label.background = "black";
        label.height = "30px";
        label.alpha = 0.5;
        label.width = "100px";
        label.cornerRadius = 8;
        label.thickness = 1;
        label.linkOffsetY = -20;
        advancedTexture.addControl(label);
        label.linkWithMesh(dummy);

        const text1 = new BABYLON.GUI.TextBlock();
        text1.text = constellation.name;
        text1.color = "white";
        text1.fontSize = "14px";
        label.addControl(text1);
    });

    // Animation loop
    engine.runRenderLoop(() => {
        scene.render();
    });

    // Handle window resize
    window.addEventListener("resize", () => {
        engine.resize();
    });
</script>

</body>
</html>
