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
    <h1>Pagina Biblioteca</h1>
    <div style="display: flex;justify-content: center;margin-top: 3em;">
        <div style="margin-right: 10px; width: 500px; height: 500px;">
            <button type="button" onclick="gestionLibros()" style="padding: 10px; width: 100%; height: 100%; background-color: gray; color: white; border: 2px solid white; transition: all 0.2s ease-in-out; background-color: gray;" onmouseover="this.style.backgroundColor='#007bff'; this.style.borderColor='#007bff'" onmouseout="this.style.backgroundColor='gray'; this.style.borderColor='white'">
                Gestion de Libros
            </button>
        </div>
        <div style="margin-right: 10px; width: 500px; height: 500px;">
            <button type="button"  onclick=" gestionAutores()" style="padding: 10px; width: 100%; height: 100%; background-color: gray; color: white; border: 2px solid white; transition: all 0.2s ease-in-out; background-color: gray;" onmouseover="this.style.backgroundColor='#007bff'; this.style.borderColor='#007bff'" onmouseout="this.style.backgroundColor='gray'; this.style.borderColor='white'">
                Gestion de autores
            </button>
        </div>
        <div style="margin-right: 10px; width: 500px; height: 500px;">
            <button type="button"  onclick=" gestionLibrosAutores()" style="padding: 10px; width: 100%; height: 100%; background-color: gray; color: white; border: 2px solid white; transition: all 0.2s ease-in-out; background-color: gray;" onmouseover="this.style.backgroundColor='#007bff'; this.style.borderColor='#007bff'" onmouseout="this.style.backgroundColor='gray'; this.style.borderColor='white'">
                Gestion de autores tiene libros 
            </button>
        </div>
        <div style="margin-right: 10px; width: 500px; height: 500px;">
            <button type="button"  onclick=" gestionEditoriales()" style="padding: 10px; width: 100%; height: 100%; background-color: gray; color: white; border: 2px solid white; transition: all 0.2s ease-in-out; background-color: gray;" onmouseover="this.style.backgroundColor='#007bff'; this.style.borderColor='#007bff'" onmouseout="this.style.backgroundColor='gray'; this.style.borderColor='white'">
                Gestion de Editoriales
            </button>
        </div>

        <div style="margin-right: 10px; width: 500px; height: 500px;">
            <button type="button"  onclick=" gestionCategorias()" style="padding: 10px; width: 100%; height: 100%; background-color: gray; color: white; border: 2px solid white; transition: all 0.2s ease-in-out; background-color: gray;" onmouseover="this.style.backgroundColor='#007bff'; this.style.borderColor='#007bff'" onmouseout="this.style.backgroundColor='gray'; this.style.borderColor='white'">
                Gestion de Categorias
            </button>
        </div>
        <div style="margin-right: 10px; width: 500px; height: 500px;">
            <button type="button"  onclick=" gestionTemas()" style="padding: 10px; width: 100%; height: 100%; background-color: gray; color: white; border: 2px solid white; transition: all 0.2s ease-in-out; background-color: gray;" onmouseover="this.style.backgroundColor='#007bff'; this.style.borderColor='#007bff'" onmouseout="this.style.backgroundColor='gray'; this.style.borderColor='white'">
                Gestion de Temas
            </button>
        </div>
        <div style="margin-right: 10px; width: 500px; height: 500px;">
            <button type="button"  onclick=" gestionMultas()" style="padding: 10px; width: 100%; height: 100%; background-color: gray; color: white; border: 2px solid white; transition: all 0.2s ease-in-out; background-color: gray;" onmouseover="this.style.backgroundColor='#007bff'; this.style.borderColor='#007bff'" onmouseout="this.style.backgroundColor='gray'; this.style.borderColor='white'">
                Gestion de multas
            </button>
        </div>
        <div style="margin-right: 10px; width: 500px; height: 500px;">
            <button type="button"  onclick=" gestionPrestamos()" style="padding: 10px; width: 100%; height: 100%; background-color: gray; color: white; border: 2px solid white; transition: all 0.2s ease-in-out; background-color: gray;" onmouseover="this.style.backgroundColor='#007bff'; this.style.borderColor='#007bff'" onmouseout="this.style.backgroundColor='gray'; this.style.borderColor='white'">
                Gestion de prestamos
            </button>
        </div>
        <div style="margin-right: 10px; width: 500px; height: 500px;">
            <button type="button"  onclick=" mostrarlistadoEditoriales()" style="padding: 10px; width: 100%; height: 100%; background-color: gray; color: white; border: 2px solid white; transition: all 0.2s ease-in-out; background-color: gray;" onmouseover="this.style.backgroundColor='#007bff'; this.style.borderColor='#007bff'" onmouseout="this.style.backgroundColor='gray'; this.style.borderColor='white'">
                listado editoriales
            </button>
        </div>
    </div>
    <script>
        function gestionAutores(){
            window.location.href = 'gestion-autores.php';

        }

        function gestionEditoriales (){
            window.location.href = 'gestion-editoriales.php';
        }

        function  gestionLibros(){
            window.location.href = 'gestion-libros.php';
        }

        function gestionCategorias(){
            window.location.href = 'gestion-categorias.php';
        }
        function gestionTemas(){
            window.location.href = 'gestion-temas.php';
        }
        function gestionMultas(){
            window.location.href = 'motivos-multas.php';
        }

        function gestionPrestamos(){
            window.location.href = 'gestionprestamos.php'

        }
        function  gestionLibrosAutores(){
            window.location.href = 'geston-libros-autores.php';
        }

        function  mostrarlistadoEditoriales(){
            window.location.href = 'listadoeditoriales.php';
        }



        </script>

       




    




    

      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>