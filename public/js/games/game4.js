document.addEventListener("DOMContentLoaded", function(){
    let cubes_container = document.querySelector('.column-container');
    let cube_1 = cubes_container.querySelectorAll('.cube-container')[0];
    let cube_2 = cubes_container.querySelectorAll('.cube-container')[1];
    let cube_3 = cubes_container.querySelectorAll('.cube-container')[2];

    const options_cube_top = JSON.parse(document.getElementById("options_cube_top").dataset.values);
    const options_cube_center = JSON.parse(document.getElementById("options_cube_center").dataset.values);
    const options_cube_bottom = JSON.parse(document.getElementById("options_cube_bottom").dataset.values);

    let selection_cube_top = document.getElementById("cube_top");
    let selection_cube_center = document.getElementById("cube_center");
    let selection_cube_bottom = document.getElementById("cube_bottom");

    let index_cube_1 = 0,
        index_cube_2 = 0,
        index_cube_3 = 0;

    let faces = ["face-1--show",
            "face-2--show",
            "face-3--show",
            "face-4--show"
        ];

    cube_1.addEventListener('click', function(){
        index_cube_1++;

        if(index_cube_1 > 3){
            index_cube_1 = 0;
        }

        rotateCube(cube_1, index_cube_1);
        selection_cube_top.value = options_cube_top[index_cube_1];
    });

    cube_2.addEventListener('click', function(){
        index_cube_2++;

        if(index_cube_2 > 3){
            index_cube_2 = 0;
        }

        rotateCube(cube_2, index_cube_2);
        selection_cube_center.value = options_cube_center[index_cube_2];
    });

    cube_3.addEventListener('click', function(){
        index_cube_3++;

        if(index_cube_3 > 3){
            index_cube_3 = 0;
        }

        rotateCube(cube_3, index_cube_3);
        selection_cube_bottom.value = options_cube_bottom[index_cube_3];
    });

    function rotateCube(cube, index){
        cube.classList.remove(...faces);
        cube.classList.add(faces[index]);
    }
});