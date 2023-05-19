<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">

    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
    <title>Inicio de sesion</title>
</head>
<body>
    <h1>Menú Administrador </h1>
    <div style="display: flex;justify-content: center;margin-top: 3em;">
        <div style="margin-right: 10px; width: 500px; height: 500px;">
            <button type="button" onclick="gestionCarreras()" style="padding: 10px; width: 100%; height: 100%; background-color: gray; color: white; border: 2px solid white; transition: all 0.2s ease-in-out; background-color: gray;" onmouseover="this.style.backgroundColor='#007bff'; this.style.borderColor='#007bff'" onmouseout="this.style.backgroundColor='gray'; this.style.borderColor='white'">
                Gestion de carreras
            </button>
        </div>
        <div style="margin-right: 10px; width: 500px; height: 500px;">
            <button type="button"  onclick=" gestionEstudiantes()" style="padding: 10px; width: 100%; height: 100%; background-color: gray; color: white; border: 2px solid white; transition: all 0.2s ease-in-out; background-color: gray;" onmouseover="this.style.backgroundColor='#007bff'; this.style.borderColor='#007bff'" onmouseout="this.style.backgroundColor='gray'; this.style.borderColor='white'">
                Gestion de estudiantes 
            </button>
        </div>
        <div style="margin-right: 10px; width: 500px; height: 500px;">
            <button type="button"  onclick=" gestionSemestre()" style="padding: 10px; width: 100%; height: 100%; background-color: gray; color: white; border: 2px solid white; transition: all 0.2s ease-in-out; background-color: gray;" onmouseover="this.style.backgroundColor='#007bff'; this.style.borderColor='#007bff'" onmouseout="this.style.backgroundColor='gray'; this.style.borderColor='white'">
                Gestion de semestres
            </button>
        </div>

        <div style="margin-right: 10px; width: 500px; height: 500px;">
            <button type="button"  onclick=" gestionUsuarios()" style="padding: 10px; width: 100%; height: 100%; background-color: gray; color: white; border: 2px solid white; transition: all 0.2s ease-in-out; background-color: gray;" onmouseover="this.style.backgroundColor='#007bff'; this.style.borderColor='#007bff'" onmouseout="this.style.backgroundColor='gray'; this.style.borderColor='white'">
                Gestion de usuarios
            </button>
        </div>
        <div style="margin-right: 10px; width: 500px; height: 500px;">
            <button type="button"  onclick=" inscribirEstudiantes()" style="padding: 10px; width: 100%; height: 100%; background-color: gray; color: white; border: 2px solid white; transition: all 0.2s ease-in-out; background-color: gray;" onmouseover="this.style.backgroundColor='#007bff'; this.style.borderColor='#007bff'" onmouseout="this.style.backgroundColor='gray'; this.style.borderColor='white'">
                Inscribir estudiantes
            </button>
        </div>
    </div>
    <script>
        function gestionCarreras(){
            window.location.href = 'gestion-carrera.html';

        }

        function gestionEstudiantes(){
            window.location.href = 'gestion-estudiantes.php';
        }

        function  gestionSemestre(){
            window.location.href = 'gestion-semestre.html';
        }

        function gestionUsuarios(){
            window.location.href = 'gestion-usuarios.html';
        }


        function inscribirEstudiantes(){
            window.location.href = 'inscribirestudiantes.html';
        }
  



        </script>

       




    




    

      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>